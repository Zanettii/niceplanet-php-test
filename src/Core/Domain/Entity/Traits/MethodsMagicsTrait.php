<?php

namespace Core\Domain\Entity\Traits;

use Exception;

trait MethodsMagicsTrait
{
    public function __get($property)
    {
        if ($property === 'id') {
            return $this->getIdProperty();
        }

        if (isset($this->{$property})) {
            return $this->{$property};
        }

        $className = get_class($this);
        throw new Exception("Property {$property} not found in class {$className}");
    }

    private function getIdProperty() {
        $properties = ['idPropriedade', 'idProdutor', /* outros nomes de id possíveis */];
        foreach ($properties as $prop) {
            if (isset($this->{$prop})) {
                return $this->{$prop};
            }
        }

        throw new Exception("ID property not found in " . get_class($this));
    }

    public function id(): string
    {
        return (string) $this->__get('id');
    }

    public function createdAt(): string
    {
        return $this->createdAt->format('Y-m-d H:i:s');
    }
}
