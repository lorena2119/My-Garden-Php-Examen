<?php

namespace App\Application\UseCase\Riego;

use App\Application\Dtos\Contracts\ArraySerializableDto;
use App\Application\UseCase\Contracts\ActionUseCase;
use App\Domain\Repository\RiegoRepository;
use App\Domain\Repository\UserRepository;

class GetAllRiegoUseCase implements ActionUseCase
{
    public function __construct(private readonly RiegoRepository $repository) {}

    /**
     * @param ?ArraySerializableDto $dto
     * @return mixed
     */
    public function __invoke(?ArraySerializableDto $dto = null)
    {
        return $this->repository->findAll($dto->toArray());
    }
}
