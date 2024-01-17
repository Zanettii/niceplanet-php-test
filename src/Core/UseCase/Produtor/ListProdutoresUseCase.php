<?php

namespace Core\UseCase\Produtor;

use Core\Domain\Repository\IProdutorRepository;
use Core\UseCase\DTO\Produtor\ListProdutores\{
    ListProdutoresInputDto,
    ListProdutoresOutputDto
};

class ListProdutoresUseCase
{
    protected $repository;

    public function __construct(IProdutorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ListProdutoresInputDto $input): ListProdutoresOutputDto
    {
        $produtores = $this->repository->paginate(
            filter: $input->filter,
            order: $input->order,
            page: $input->page,
            totalPage: $input->totalPage,
        );

        return new ListProdutoresOutputDto(
            items: $produtores->items(),
            total: $produtores->total(),
            last_page: $produtores->lastPage(),
            first_page: $produtores->firstPage(),
            per_page: $produtores->perPage(),
            to: $produtores->to(),
            from: $produtores->from(),
        );

        // return new ListCategoriesOutputDto(
        //     items: array_map(function ($data) {
        //         return [
        //             'id' => $data->id,
        //             'name' => $data->name,
        //             'description' => $data->description,
        //             'is_active' => (bool) $data->is_active,
        //             'created_at' => (string) $data->created_at,
        //         ];
        //     }, $categories->items()),
        //     total: $categories->total(),
        //     last_page: $categories->lastPage(),
        //     first_page: $categories->firstPage(),
        //     per_page: $categories->perPage(),
        //     to: $categories->to(),
        //     from: $categories->to(),
        // );
    }
}
