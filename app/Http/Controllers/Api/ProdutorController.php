<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Core\UseCase\DTO\Produtor\ListProdutores\ListProdutoresInputDto;
use Illuminate\Http\Request;
use Core\UseCase\Produtor\ListProdutoresUseCase;
use App\Http\Resources\ProdutorResource;
use App\Http\Requests\StoreProdutorRequest;
use Core\UseCase\Category\ListProdutorUseCase;
use Core\UseCase\DTO\Produtor\CreateProdutor\ProdutorCreateInputDto;
use Core\UseCase\DTO\Produtor\ProdutorInputDto;
use Core\UseCase\Produtor\CreateProdutorUseCase;
use Illuminate\Http\Response;

class ProdutorController extends Controller
{
    /**
     * @OA\Get(
     *     path="/index",
     *     @OA\Response(response="200", description="Descrição da resposta")
     * )
    */
    public function index(Request $request, ListProdutoresUseCase $useCase)
    {
        $response = $useCase->execute(
            input: new ListProdutoresInputDto(
                filter: $request->get('filter', ''),
                order: $request->get('order', 'DESC'),
                page: (int) $request->get('page', 1),
                totalPage: (int) $request->get('total_page', 15),
            )
        );

        return ProdutorResource::collection(collect($response->items))
                                    ->additional([
                                        'meta' => [
                                            'total' => $response->total,
                                            'last_page' => $response->last_page,
                                            'first_page' => $response->first_page,
                                            'per_page' => $response->per_page,
                                            'to' => $response->to,
                                            'from' => $response->from,
                                        ],
                                    ]);
    }

    /**
 * @OA\Post(
 *     path="/api/produtor",
 *     summary="Cria um novo produtor",
 *     description="Cadastra um novo produtor no sistema.",
 *     operationId="storeProdutor",
 *     tags={"Produtor"},
 *     security={{"Bearer": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Dados necessários para criar um novo produtor",
 *         @OA\JsonContent(
 *             required={"nomeProdutor"},
 *             @OA\Property(property="nomeProdutor", type="string", example="João Silva"),
 *             @OA\Property(property="cpfProdutor", type="string", example="123.456.789-01"),
 *             @OA\Property(property="is_active", type="boolean", example=true)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Produtor criado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="idProdutor", type="integer", example=1),
 *             @OA\Property(property="nomeProdutor", type="string", example="João Silva"),
 *             @OA\Property(property="cpfProdutor", type="string", example="123.456.789-01"),
 *             @OA\Property(property="is_active", type="boolean", example=true),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T00:00:00Z")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Dados inválidos fornecidos"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno no servidor"
 *     )
 * )
 */
    public function store(StoreProdutorRequest $request, CreateProdutorUseCase $useCase)
    {
        $response = $useCase->execute(
            input: new ProdutorCreateInputDto(
                nomeProdutor: $request->nomeProdutor,
                cpfProdutor: $request->cpfProdutor ?? '',
                isActive: (bool) $request->is_active ?? true,
            )
        );

        return (new ProdutorResource(collect($response)))
                    ->response()
                    ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
 * @OA\Get(
 *     path="/api/produtor/{id}",
 *     summary="Obtém informações de um produtor pelo ID",
 *     description="Obtém informações de um produtor com base no ID fornecido.",
 *     operationId="getProdutorById",
 *     tags={"Produtor"},
 *     security={{"Bearer": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID do produtor a ser obtido",
 *         @OA\Schema(type="integer", format="int64", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Informações do produtor obtidas com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="idProdutor", type="integer", example=1),
 *             @OA\Property(property="nomeProdutor", type="string", example="João Silva"),
 *             @OA\Property(property="cpfProdutor", type="string", example="123.456.789-01"),
 *             @OA\Property(property="is_active", type="boolean", example=true),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T00:00:00Z")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Produtor não encontrado"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno no servidor"
 *     )
 * )
 */
    public function show(ListProdutorUseCase $useCase, $id)
    {
        $produtor = $useCase->execute(new ProdutorInputDto($id));

        return (new ProdutorResource(collect($produtor)))->response();
    }
}
