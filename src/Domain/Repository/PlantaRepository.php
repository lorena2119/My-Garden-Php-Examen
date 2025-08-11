<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Planta\Planta;

interface PlantaRepository
{
    public function findAll(?array $filters = null): array;

    public function findPlantaOfId(int $id): Planta;

    public function findPlantaOfCategory(string $category): Planta;

    public function deletePlanta(int $id): bool;

    public function createPlanta(array $data): Planta;

    public function updatePlanta(int $id, array $data): bool;
}
