<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;
use DateTime;

class Propriedade
{
    use MethodsMagicsTrait;

    public function __construct(
        protected Uuid|string $idPropriedade = '',
        protected string $nomePropriedade = '',
        protected string $cadastroRural = '',
        protected bool $isActive = true,
        protected DateTime|string $createdAt = '',
    ) {
        $this->idPropriedade = $this->idPropriedade ? new Uuid($this->idPropriedade) : Uuid::random();
        $this->createdAt = $this->createdAt ? new DateTime($this->createdAt) : new DateTime();

        $this->validate();
    }


    public function activate(): void
    {
        $this->isActive = true;
    }

    public function disable(): void
    {
        $this->isActive = false;
    }

    public function update(string $nomePropriedade, string $cadastroRural = '')
    {
        $this->nomePropriedade = $nomePropriedade;
        $this->cadastroRural = $cadastroRural;

        $this->validate();
    }

    protected function validate()
    {
        DomainValidation::strMaxLength($this->nomePropriedade);
        DomainValidation::strMinLength($this->nomePropriedade);
        DomainValidation::strCanNullAndMaxLength($this->cadastroRural);
    }
}