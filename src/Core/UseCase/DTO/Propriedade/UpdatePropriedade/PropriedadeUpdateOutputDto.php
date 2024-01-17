<?php

namespace Core\UseCase\DTO\Propriedade\UpdatePropriedade;

class PropriedadeUpdateOutputDto
{
    public function __construct(
        public string $idPropriedade,
        public string $nomePropriedade,
        public string $cadastroRural = '',
        public bool $isActive = true,
        public string $created_at = '',
    ) {}
}
