<?php

declare(strict_types=1);

namespace App\Application\Controllers\Riego;

use App\Application\Dtos\Riego\PatchRiegoDto;
use App\Application\Dtos\Riego\RiegoDto;
use App\Application\Dtos\Riego\FilterRiegoDto;
use App\Application\Dtos\Riego\FindRiegoDto;
use App\Application\Http\Traits\ApiResponseTrait;
use App\Application\UseCase\Riego\CreateRiegoUseCase;
use App\Application\UseCase\Riego\DeleteRiegoUseCase;
use App\Application\UseCase\Riego\FindRiegoUseCase;
use App\Application\UseCase\Riego\GetAllRiegoUseCase;
use App\Application\UseCase\Riego\UpdateRiegoUseCase;
use App\Domain\Repository\RiegoRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RiegoController
{
    use ApiResponseTrait;

    public function __construct(private readonly RiegoRepository $riegoRepository) {}

    /**
     * @return mixed
     */
    public function index(Request $request, Response $response)
    {
        $dto = new FilterRiegoDto($request->getQueryParams());
        $useCase = new GetAllRiegoUseCase($this->riegoRepository);
        return $this->successResponse($response, $useCase($dto));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function findById(Request $request, Response $response, array $args)
    {
        $dto = new FindRiegoDto($args);
        $useCase = new FindRiegoUseCase($this->riegoRepository);
        return $this->successResponse($response, $useCase($dto));
    }


    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function create(Request $request, Response $response)
    {
        $dto = new RiegoDto($request->getParsedBody());
        $useCase = new CreateRiegoUseCase($this->riegoRepository);
        return $this->successResponse($response, $useCase($dto));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function update(Request $request, Response $response, array $args)
    {
        $dto = new PatchRiegoDto(array_merge($request->getParsedBody(), $args));
        $useCase = new UpdateRiegoUseCase($this->riegoRepository);
        return $this->successResponse($response, $useCase($dto));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function delete(Request $request, Response $response, array $args)
    {
        $dto = new FindRiegoDto($args);
        $useCase = new DeleteRiegoUseCase($this->riegoRepository);
        return $this->successResponse($response, $useCase($dto));
    }
}
