<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Propriedade;
use Core\Domain\Repository\IPropriedadeRepository;
use Core\UseCase\DTO\Propriedade\{
    PropriedadeInputDto,
    PropriedadeOutupDto
};

class ListPropriedadeUseCase
{
    protected $repository;

    public function __construct(IPropriedadeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(PropriedadeInputDto $input): PropriedadeOutupDto
    {
        $propriedade = $this->repository->findById($input->idPropriedade);

        return new PropriedadeOutupDto(
            idPropriedade: $propriedade->id(),
            nomePropriedade: $propriedade->nomePropriedade,
            cadastroRural: $propriedade->cadastroRural,
            is_active: $propriedade->isActive,
            created_at: $propriedade->createdAt(),
        );
    }
}