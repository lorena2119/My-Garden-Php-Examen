<?php

declare(strict_types=1);

namespace App\Application\Controllers\Planta;

use App\Application\Dtos\Planta\FilterPlantaDto;
use App\Application\Dtos\Planta\FindPlantaDto;
use App\Application\Dtos\Planta\FindCategoryPlantaDto;
use App\Application\Dtos\Planta\PatchPlantaDto;
use App\Application\Dtos\Planta\PlantaDto;
use App\Application\Http\Traits\ApiResponseTrait;
use App\Application\UseCase\Planta\CreatePlantaUseCase;
use App\Application\UseCase\Planta\DeletePlantaUseCase;
use App\Application\UseCase\Planta\FindPlantaCategoryUseCase;
use App\Application\UseCase\Planta\FindPlantaUseCase;
use App\Application\UseCase\Planta\GetAllPlantaUseCase;
use App\Application\UseCase\Planta\UpdatePlantaUseCase;
use App\Domain\Repository\PlantaRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PlantaController
{
    use ApiResponseTrait;

    public function __construct(private readonly PlantaRepository $plantaRepository) {}

    /**
     * @return mixed
     */
    public function index(Request $request, Response $response)
    {
        $dto = new FilterPlantaDto($request->getQueryParams());
        $useCase = new GetAllPlantaUseCase($this->plantaRepository);
        return $this->successResponse($response, $useCase($dto));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function findById(Request $request, Response $response, array $args)
    {
        $dto = new FindPlantaDto($args);
        $useCase = new FindPlantaUseCase($this->plantaRepository);
        return $this->successResponse($response, $useCase($dto));
    }

    public function findByCategory(Request $request, Response $response, array $args)
    {
        $dto = new FindCategoryPlantaDto($args);
        $useCase = new FindPlantaCategoryUseCase($this->plantaRepository);
        return $this->successResponse($response, $useCase($dto));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function create(Request $request, Response $response)
    {
        $dto = new PlantaDto($request->getParsedBody());
        $useCase = new CreatePlantaUseCase($this->plantaRepository);
        return $this->successResponse($response, $useCase($dto));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function update(Request $request, Response $response, array $args)
    {
        $dto = new PatchPlantaDto(array_merge($request->getParsedBody(), $args));
        $useCase = new UpdatePlantaUseCase($this->plantaRepository);
        return $this->successResponse($response, $useCase($dto));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function delete(Request $request, Response $response, array $args)
    {
        $dto = new FindPlantaDto($args);
        $useCase = new DeletePlantaUseCase($this->plantaRepository);
        return $this->successResponse($response, $useCase($dto));
    }
}
