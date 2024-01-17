<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Propriedade;

interface IPropriedadeRepository
{
    public function insert(Propriedade $propriedade): Propriedade;
    public function findById(string $propriedadeId): Propriedade;
    public function findAll(string $filter = '', $order = 'DESC'): array;
    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface;
    public function update(Propriedade $category): Propriedade;
    public function delete(string $propriedadeId): bool;
}