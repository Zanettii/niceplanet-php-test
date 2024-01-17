<?php

namespace Core\UseCase\DTO\Produtor\UpdateProdutor;

class ProdutorUpdateInputDto
{
    public function __construct(
        public string $idProdutor,
        public string $nomeProdutor,
        public string|null $cpfProdutor = null,
        public bool $isActive = true,
    ) {}
}
