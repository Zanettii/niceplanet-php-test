<?php

namespace Core\UseCase\Produtor;

use Core\Domain\Repository\IProdutorRepository;
use Core\UseCase\DTO\Produtor\ProdutorInputDto;
use Core\UseCase\DTO\Produtor\DeleteProdutor\ProdutorDeleteOutputDto;

class DeleteProdutorUseCase
{
    protected $repository;

    public function __construct(IProdutorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ProdutorInputDto $input): ProdutorDeleteOutputDto
    {
        $responseDelete = $this->repository->delete($input->idProdutor);

        return new ProdutorDeleteOutputDto(
            success: $responseDelete
        );
    }
}
