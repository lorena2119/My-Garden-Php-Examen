<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Planta;

use App\Domain\DomainException\User\PlantNotFoundException;
use App\Domain\DomainException\User\UserAlreadyExistsException;
use App\Domain\DomainException\User\UserNotFoundException;
use App\Domain\Model\Planta\Planta;
use App\Domain\Repository\PlantaRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ElloquentPlantaRepository implements PlantaRepository
{
    /**
     * {@inheritdoc}
     */
    public function findAll(?array $filters = null): array
    {
        $query = Planta::query();

        if ($filters) {
            $query->where($filters);
        }

        return $query->get()->toArray();
    }

    /**
     * {@inheritdoc}
     */
    public function findPlantaOfId(int $id): Planta
    {
        try {
            return Planta::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new PlantNotFoundException();
        }
    }


    /**
     * {@inheritdoc}
     */
    public function deletePlanta(int $id): bool
    {
        $planta = $this->findPlantaOfId($id);
        return $planta->delete();
    }


    /**
     * {@inheritdoc}
     */
    public function createPlanta(array $data): Planta
    {
        $planta = Planta::create($data);
        if (!$planta) {
            throw new UserAlreadyExistsException();
        }
        return $planta;
    }
    public function findPlantaOfCategory(string $category): Planta
    {
        try {
            return Planta::findOrFail($category);
        } catch (ModelNotFoundException $e) {
            throw new PlantNotFoundException();
        }
    }


    /**
     * {@inheritdoc}
     */
    public function updatePlanta(int $id, array $data): bool
    {
        $planta = $this->findPlantaOfId($id);
        return $planta->update($data);
    }
}
