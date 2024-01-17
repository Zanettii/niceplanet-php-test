<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Produtor;

interface IProdutorRepository
{
    public function insert(Produtor $produtor): Produtor;
    public function findById(string $produtorId): Produtor;
    public function findAll(string $filter = '', $order = 'DESC'): array;
    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface;
    public function update(Produtor $category): Produtor;
    public function delete(string $propriedadeId): bool;
}