<?php

namespace Core\UseCase\Produtor;

use Core\Domain\Repository\IProdutorRepository;
use Core\UseCase\DTO\Produtor\UpdateProdutor\ProdutorUpdateInputDto;
use Core\UseCase\DTO\Produtor\UpdateProdutor\ProdutorUpdateOutputDto;

class UpdateProdutorUseCase
{
    protected $repository;

    public function __construct(IProdutorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ProdutorUpdateInputDto $input): ProdutorUpdateOutputDto
    {
        $produtor = $this->repository->findById($input->idProdutor);

        $produtor->update(
            nomeProdutor: $input->nomeProdutor,
            cpfProdutor: $input->cpfProdutor ?? $produtor->cpfProdutor,
        );

        $produtorUpdated = $this->repository->update($produtor);

        return new ProdutorUpdateOutputDto(
            idProdutor: $produtorUpdated->id,
            nomeProdutor: $produtorUpdated->nomeProdutor,
            cpfProdutor: $produtorUpdated->cpfProdutor,
            isActive: $produtorUpdated->isActive,
            created_at: $produtorUpdated->createdAt(),
        );
    }
}
