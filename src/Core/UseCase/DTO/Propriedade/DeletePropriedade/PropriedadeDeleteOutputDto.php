<?php

namespace Core\UseCase\DTO\Propriedade\DeletePropriedade;

class PropriedadeDeleteOutputDto
{
    public function __construct(
        public bool $success
    ) {}
}
