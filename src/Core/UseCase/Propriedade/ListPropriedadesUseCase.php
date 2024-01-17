<?php

namespace Core\UseCase\Propriedade;

use Core\Domain\Repository\IPropriedadeRepository;
use Core\UseCase\DTO\Propriedade\ListPropriedades\{
    ListPropriedadesInputDto,
    ListPropriedadesOutputDto
};

class ListPropriedadesUseCase
{
    protected $repository;

    public function __construct(IPropriedadeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ListPropriedadesInputDto $input): ListPropriedadesOutputDto
    {
        $propriedades = $this->repository->paginate(
            filter: $input->filter,
            order: $input->order,
            page: $input->page,
            totalPage: $input->totalPage,
        );

        return new ListPropriedadesOutputDto(
            items: $propriedades->items(),
            total: $propriedades->total(),
            last_page: $propriedades->lastPage(),
            first_page: $propriedades->firstPage(),
            per_page: $propriedades->perPage(),
            to: $propriedades->to(),
            from: $propriedades->from(),
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
