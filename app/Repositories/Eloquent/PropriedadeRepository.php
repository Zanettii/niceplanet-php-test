<?php

namespace App\Repositories\Eloquent;

use App\Models\Propriedade as Model;
use Core\Domain\Entity\Propriedade;
use Core\Domain\Repository\IPropriedadeRepository;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\Exception\NotFoundException;
use App\Repositories\Presenters\PaginationPresenter;

class PropriedadeRepository implements IPropriedadeRepository
{
    protected $model;
    public function __construct(Model $propriedade)
    {
        $this->model = $propriedade;
    }

    public function insert(Propriedade $propriedade): Propriedade
    {
        $propriedade = $this->model->create([
            'idPropriedade' => $propriedade->id(),
            'nomePropriedade' => $propriedade->nomePropriedade,
            'cadastroRural' => $propriedade->cadastroRural,
            'isActive' => $propriedade->isActive,
            'created_at' => $propriedade->createdAt(),
        ]);

        return $this->toPropriedade($propriedade);
    }

    public function findById(string $propriedadeId): Propriedade
    {
        if (!$propriedade = $this->model->find($propriedadeId)) {
            throw new NotFoundException('Category Not Found');
        }

        return $this->toPropriedade($propriedade);
    }
    public function findAll(string $filter = '', $order = 'DESC'): array
    {
        $propriedades = $this->model
                            ->where(function ($query) use ($filter) {
                                if ($filter) {
                                    $query->where('nomePropriedade', 'LIKE', "%{$filter}%");
                                }
                            })
                            ->orderBy('idPropriedade', $order)
                            ->get();

        return $propriedades->toArray();
    }

    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface
    {
        $query = $this->model;
        if ($filter) {
            $query = $query->where('nomePropriedade', 'LIKE', "%{$filter}%");
        }
        $query = $query->orderBy('id', $order);
        $paginator = $query->paginate();

        return new PaginationPresenter($paginator);
    }

    public function update(Propriedade $propriedade): Propriedade
    {
        if (! $propriedadeDb = $this->model->find($propriedade->id())) {
            throw new NotFoundException('Propriedade Not Found');
        }

        $propriedadeDb->update([
            'nomePropriedade' => $propriedade->nomepropriedade,
            'cadastroRural' => $propriedade->cadastroRural,
            'isActive' => $propriedade->isActive,
        ]);

        $propriedadeDb->refresh();

        return $this->toPropriedade($propriedadeDb);
    }

    public function delete(string $propriedadeId): bool
    {
        if (! $propriedadeDb = $this->model->find($propriedadeId)) {
            throw new NotFoundException('propriedade Not Found');
        }

        return $propriedadeDb->delete();
    }

    private function toPropriedade(object $object): Propriedade
    {
        $entity =  new Propriedade(
            idPropriedade: $object->idPropriedade,
            nomePropriedade: $object->nomePropriedade,
            cadastroRural: $object->cadastroRural,
        );
        ((bool) $object->isActive) ? $entity->activate() : $entity->disable();

        return $entity;
    }
}
