<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Core\UseCase\DTO\Propriedade\ListPropriedades\ListPropriedadesInputDto;
use Illuminate\Http\Request;
use Core\UseCase\Propriedade\ListPropriedadesUseCase;
use App\Http\Resources\PropriedadeResource;
use App\Http\Requests\StorePropriedadeRequest;
use Core\UseCase\Category\ListPropriedadeUseCase;
use Core\UseCase\DTO\Propriedade\CreatePropriedade\PropriedadeCreateInputDto;
use Core\UseCase\DTO\Propriedade\PropriedadeInputDto;
use Core\UseCase\Propriedade\CreatePropriedadeUseCase;
use Illuminate\Http\Response;

class PropriedadeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/proriedadeindex",
     *     @OA\Response(response="200", description="Descrição da resposta")
     * )
    */
    public function index(Request $request, ListPropriedadesUseCase $useCase)
    {
        $response = $useCase->execute(
            input: new ListPropriedadesInputDto(
                filter: $request->get('filter', ''),
                order: $request->get('order', 'DESC'),
                page: (int) $request->get('page', 1),
                totalPage: (int) $request->get('total_page', 15),
            )
        );

        return PropriedadeResource::collection(collect($response->items))
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
 *     path="/api/propriedade",
 *     summary="Cria uma nova propriedade",
 *     description="Cadastra uma nova propriedade no sistema.",
 *     operationId="storePropriedade",
 *     tags={"Propriedade"},
 *     security={{"Bearer": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Dados necessários para criar uma nova propriedade",
 *         @OA\JsonContent(
 *             required={"nomePropriedade"},
 *             @OA\Property(property="nomePropriedade", type="string", example="Fazenda São João"),
 *             @OA\Property(property="cadastroRural", type="string", example="1234567890"),
 *             @OA\Property(property="isActive", type="boolean", example=true)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Propriedade criada com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="idPropriedade", type="integer", example=1),
 *             @OA\Property(property="nomePropriedade", type="string", example="Fazenda São João"),
 *             @OA\Property(property="cpfPropriedade", type="string", example="123.456.789-01"),
 *             @OA\Property(property="isActive", type="boolean", example=true),
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
    public function store(StorePropriedadeRequest $request, CreatePropriedadeUseCase $useCase)
    {
        $response = $useCase->execute(
            input: new PropriedadeCreateInputDto(
                nomePropriedade: $request->nomePropriedade,
                cadastroRural: $request->cadastroRural ?? '',
                isActive: (bool) $request->is_active ?? true,
            )
        );

        return (new PropriedadeResource(collect($response)))
                    ->response()
                    ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
 * @OA\Get(
 *     path="/api/propriedade/{id}",
 *     summary="Obter detalhes de uma propriedade",
 *     description="Obtém os detalhes de uma propriedade com base no ID fornecido.",
 *     operationId="showPropriedade",
 *     tags={"Propriedade"},
 *     security={{"Bearer": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID da propriedade a ser obtida",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             format="uuid",
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalhes da propriedade obtidos com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="idPropriedade", type="integer", example=1),
 *             @OA\Property(property="nomePropriedade", type="string", example="Fazenda São João"),
 *             @OA\Property(property="cadastroRural", type="string", example="1234567890"),
 *             @OA\Property(property="isActive", type="boolean", example=true),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T00:00:00Z")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Propriedade não encontrada"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno no servidor"
 *     )
 * )
 */
    public function show(ListPropriedadeUseCase $useCase, $id)
    {
        $propriedade = $useCase->execute(new PropriedadeInputDto($id));

        return (new PropriedadeResource(collect($propriedade)))->response();
    }
}
