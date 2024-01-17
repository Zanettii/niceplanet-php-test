<?php

namespace Core\UseCase\DTO\Propriedade\CreatePropriedade;

class PropriedadeCreateInputDto
{
    public function __construct(
        public string $nomePropriedade,
        public string $cadastroRural = '',
        public bool $isActive = true,
    ) {}
}
