<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Riego\Riego;

interface RiegoRepository
{
    public function findAll(?array $filters = null): array;

    public function findRiegoOfId(int $id_planta): Riego;

    // public function findRiegoOfCategory(string $category): Riego;

    public function deleteRiego(int $id): bool;

    public function createRiego(array $data): Riego;

    public function updateRiego(int $id, array $data): bool;
}
