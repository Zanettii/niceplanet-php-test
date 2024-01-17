<?php

namespace Core\UseCase\Produtor;

use Core\Domain\Entity\Produtor;
use Core\Domain\Repository\IProdutorRepository;
use Core\UseCase\DTO\Produtor\CreateProdutor\{
    ProdutorCreateInputDto,
    ProdutorCreateOutputDto
};

class CreateProdutorUseCase
{
    protected $repository;

    public function __construct(IProdutorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ProdutorCreateInputDto $input): ProdutorCreateOutputDto 
    {
        $produtor = new Produtor(
            nomeProdutor: $input->nomeProdutor,
            cpfProdutor: $input->cpfProdutor,
            isActive: $input->isActive,
        );

        $newProdutor = $this->repository->insert($produtor);

        return new ProdutorCreateOutputDto(
            idProdutor: $newProdutor->id(),
            nomeProdutor: $newProdutor->nomeProdutor,
            cpfProdutor: $produtor->cpfProdutor,
            is_active: $produtor->isActive,
            created_at: $produtor->createdAt(),
        );
    }
}
