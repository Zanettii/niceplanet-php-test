<?php

namespace Core\UseCase\DTO\Produtor\UpdateProdutor;

class ProdutorUpdateOutputDto
{
    public function __construct(
        public string $idProdutor,
        public string $nomeProdutor,
        public string $cpfProdutor = '',
        public bool $isActive = true,
        public string $created_at = '',
    ) {}
}
