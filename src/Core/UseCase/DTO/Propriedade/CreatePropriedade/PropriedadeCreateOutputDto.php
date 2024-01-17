<?php

namespace Core\UseCase\DTO\Propriedade\CreatePropriedade;

class PropriedadeCreateOutputDto
{
    public function __construct(
        public string $idPropriedade,
        public string $nomePropriedade,
        public string $cadastroRural = '',
        public bool $is_active = true,
        public string $created_at = '',
    ) {}
}
