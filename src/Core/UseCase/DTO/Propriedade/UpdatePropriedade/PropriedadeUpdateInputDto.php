<?php

namespace Core\UseCase\DTO\Propriedade\UpdatePropriedade;

class PropriedadeUpdateInputDto
{
    public function __construct(
        public string $idPropriedade,
        public string $nomePropriedade,
        public string|null $cadastroRural = null,
        public bool $isActive = true,
    ) {}
}
