<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Produtor;
use Core\Domain\Repository\IProdutorRepository;
use Core\UseCase\DTO\Produtor\{
    ProdutorInputDto,
    ProdutorOutupDto
};

class ListProdutorUseCase
{
    protected $repository;

    public function __construct(IProdutorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ProdutorInputDto $input): ProdutorOutupDto
    {
        $produtor = $this->repository->findById($input->idProdutor);

        return new ProdutorOutupDto(
            id: $produtor->id(),
            nomeProdutor: $produtor->nomeProdutor,
            cpfProdutor: $produtor->cpfProdutor,
            is_active: $produtor->isActive,
            created_at: $produtor->createdAt(),
        );
    }
}