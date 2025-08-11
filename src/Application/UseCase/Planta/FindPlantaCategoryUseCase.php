<?php

namespace App\Application\UseCase\Planta;

use App\Application\Dtos\Contracts\ArraySerializableDto;
use App\Application\UseCase\Contracts\ActionUseCase;
use App\Domain\Repository\PlantaRepository;

class FindPlantaCategoryUseCase implements ActionUseCase
{
    public function __construct(private readonly PlantaRepository $repository) {}

    /**
     * @param ?ArraySerializableDto $dto
     * @return mixed
     */
    public function __invoke(?ArraySerializableDto $dto = null)
    {
        return $this->repository->findPlantaOfCategory($dto->toArray()['categoria']);
    }
}
