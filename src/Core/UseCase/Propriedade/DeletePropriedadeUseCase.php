<?php

namespace Core\UseCase\Propriedade;

use Core\Domain\Repository\IPropriedadeRepository;
use Core\UseCase\DTO\Propriedade\PropriedadeInputDto;
use Core\UseCase\DTO\Propriedade\DeletePropriedade\PropriedadeDeleteOutputDto;

class DeletePropriedadeUseCase
{
    protected $repository;

    public function __construct(IPropriedadeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(PropriedadeInputDto $input): PropriedadeDeleteOutputDto
    {
        $responseDelete = $this->repository->delete($input->idPropriedade);

        return new PropriedadeDeleteOutputDto(
            success: $responseDelete
        );
    }
}
