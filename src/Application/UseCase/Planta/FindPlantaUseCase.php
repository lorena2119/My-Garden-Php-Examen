<?php

namespace App\Application\UseCase\User;

use App\Application\Dtos\Contracts\ArraySerializableDto;
use App\Application\UseCase\Contracts\ActionUseCase;
use App\Domain\Repository\PlantaRepository;
use App\Domain\Repository\UserRepository;

class FindPlantaUseCase implements ActionUseCase
{
    public function __construct(private readonly PlantaRepository $repository) {}

    /**
     * @param ?ArraySerializableDto $dto
     * @return mixed
     */
    public function __invoke(?ArraySerializableDto $dto = null)
    {
        return $this->repository->findPlantaOfId($dto->toArray()['id']);
    }
}
