<?php

namespace App\Repositories\Eloquent;

use App\Models\Produtor as Model;
use Core\Domain\Entity\Produtor;
use Core\Domain\Repository\IProdutorRepository;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\Exception\NotFoundException;
use App\Repositories\Presenters\PaginationPresenter;

class ProdutorRepository implements IProdutorRepository
{
    protected $model;
    public function __construct(Model $produtor)
    {
        $this->model = $produtor;
    }

    public function insert(Produtor $produtor): Produtor
    {
        $produtor = $this->model->create([
            'idProdutor' => $produtor->id(),
            'nomeProdutor' => $produtor->nomeProdutor,
            'nomeProdutor' => $produtor->nomeProdutor,
            'is_active' => $produtor->is_active,
            'created_at' => $produtor->createdAt(),
        ]);

        return $this->toProdutor($produtor);
    }

    public function findById(string $produtorId): Produtor
    {
        if (!$produtor = $this->model->find($produtorId)) {
            throw new NotFoundException('Category Not Found');
        }

        return $this->toProdutor($produtor);
    }
    public function findAll(string $filter = '', $order = 'DESC'): array
    {
        $produtors = $this->model
                            ->where(function ($query) use ($filter) {
                                if ($filter) {
                                    $query->where('nomeProdutor', 'LIKE', "%{$filter}%");
                                }
                            })
                            ->orderBy('idProdutor', $order)
                            ->get();

        return $produtors->toArray();
    }

    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface
    {
        $query = $this->model;
        if ($filter) {
            $query = $query->where('nomeProdutor', 'LIKE', "%{$filter}%");
        }
        $query = $query->orderBy('id', $order);
        $paginator = $query->paginate();

        return new PaginationPresenter($paginator);
    }

    public function update(Produtor $produtor): Produtor
    {
        if (! $produtorDb = $this->model->find($produtor->id())) {
            throw new NotFoundException('Category Not Found');
        }

        $produtorDb->update([
            'nomeProdutor' => $produtor->nomeProdutor,
            'cpfProdutor' => $produtor->cpfProdutor,
            'is_active' => $produtor->isActive,
        ]);

        $produtorDb->refresh();

        return $this->toProdutor($produtorDb);
    }

    public function delete(string $produtorId): bool
    {
        if (! $produtorDb = $this->model->find($produtorId)) {
            throw new NotFoundException('Produtor Not Found');
        }

        return $produtorDb->delete();
    }

    private function toProdutor(object $object): Produtor
    {
        $entity =  new Produtor(
            idProdutor: $object->idProdutor,
            nomeProdutor: $object->nomeProdutor,
            cpfProdutor: $object->cpfProdutor,
        );
        ((bool) $object->is_active) ? $entity->activate() : $entity->disable();

        return $entity;
    }
}