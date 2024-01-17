<?php

namespace Core\UseCase\Propriedade;

use Core\Domain\Entity\Propriedade;
use Core\Domain\Repository\IPropriedadeRepository;
use Core\UseCase\DTO\Propriedade\CreatePropriedade\{
    PropriedadeCreateInputDto,
    PropriedadeCreateOutputDto
};

class CreatePropriedadeUseCase
{
    protected $repository;

    public function __construct(IPropriedadeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(PropriedadeCreateInputDto $input): PropriedadeCreateOutputDto
    {
        $propriedade = new Propriedade(
            nomePropriedade: $input->nomePropriedade,
            cadastroRural: $input->cadastroRural,
            isActive: $input->isActive,
        );

        $newPropriedade = $this->repository->insert($propriedade);

        return new PropriedadeCreateOutputDto(
            idPropriedade: $newPropriedade->id(),
            nomePropriedade: $newPropriedade->nomePropriedade,
            cadastroRural: $propriedade->cadastroRural,
            is_active: $propriedade->isActive,
            created_at: $propriedade->createdAt(),
        );
    }
}
