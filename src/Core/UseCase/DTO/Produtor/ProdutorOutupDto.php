<?php

namespace Core\UseCase\DTO\Produtor;

class ProdutorOutupDto
{
    public function __construct(
        public string $idProdutor,
        public string $nomeProdutor,
        public string $cpfProdutor = '',
        public bool $is_active = true,
        public string $created_at = '',
    ) {}
}
