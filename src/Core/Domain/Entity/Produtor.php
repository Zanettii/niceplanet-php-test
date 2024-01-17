<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;
use DateTime;

class Produtor
{
    use MethodsMagicsTrait;

    public function __construct(
        protected Uuid|string $idProdutor = '',
        protected string $nomeProdutor = '',
        protected string $cpfProdutor = '',
        protected bool $is_Active = true,
        protected DateTime|string $createdAt = '',
    ) {
        $this->idProdutor = $this->idProdutor ? new Uuid($this->idProdutor) : Uuid::random();
        $this->createdAt = $this->createdAt ? new DateTime($this->createdAt) : new DateTime();

        $this->validate();
    }


    public function activate(): void
    {
        $this->is_Active = true;
    }

    public function disable(): void
    {
        $this->is_Active = false;
    }

    public function update(string $nomeProdutor, string $cpfProdutor = '')
    {
        $this->nomeProdutor = $nomeProdutor;
        $this->cpfProdutor = $cpfProdutor;

        $this->validate();
    }

    protected function validate()
    {
        DomainValidation::strMaxLength($this->nomeProdutor);
        DomainValidation::strMinLength($this->nomeProdutor);
        DomainValidation::strCanNullAndMaxLength($this->cpfProdutor);
    }
}
