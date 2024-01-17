<?php

namespace Core\UseCase\Propriedade;

use Core\Domain\Repository\IPropriedadeRepository;
use Core\UseCase\DTO\Propriedade\UpdatePropriedade\PropriedadeUpdateInputDto;
use Core\UseCase\DTO\Propriedade\UpdatePropriedade\PropriedadeUpdateOutputDto;

class UpdatePropriedadeUseCase
{
    protected $repository;

    public function __construct(IPropriedadeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(PropriedadeUpdateInputDto $input): PropriedadeUpdateOutputDto
    {
        $propriedade = $this->repository->findById($input->idPropriedade);

        $propriedade->update(
            nomePropriedade: $input->nomePropriedade,
            cadastroRural: $input->cadastroRural ?? $propriedade->cadastroRural,
        );

        $propriedadeUpdated = $this->repository->update($propriedade);

        return new PropriedadeUpdateOutputDto(
            idPropriedade: $propriedadeUpdated->id,
            nomePropriedade: $propriedadeUpdated->nomePropriedade,
            cadastroRural: $propriedadeUpdated->cadastroRural,
            isActive: $propriedadeUpdated->isActive,
            created_at: $propriedadeUpdated->createdAt(),
        );
    }
}
