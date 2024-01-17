<?php

namespace Core\UseCase\DTO\Produtor\CreateProdutor;

class ProdutorCreateInputDto
{
    public function __construct(
        public string $nomeProdutor,
        public string $cpfProdutor = '',
        public bool $isActive = true,
    ) {}
}
