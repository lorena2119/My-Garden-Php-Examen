<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\DomainException\User\UserAlreadyExistsException;
use App\Domain\DomainException\User\UserNotFoundException;
use App\Domain\Model\Riego\Riego;
use App\Domain\Repository\RiegoRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ElloquentRiegoRepository implements RiegoRepository
{
    /**
     * {@inheritdoc}
     */
    public function findAll(?array $filters = null): array
    {
        $query = Riego::query();

        if ($filters) {
            $query->where($filters);
        }

        return $query->get()->toArray();
    }

    /**
     * {@inheritdoc}
     */
    public function findRiegoOfId(int $id_planta): Riego
    {
        try {
            return Riego::findOrFail($id_planta);
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException();
        }
    }


    /**
     * {@inheritdoc}
     */
    public function deleteRiego(int $id): bool
    {
        $riego = $this->findRiegoOfId($id);
        return $riego->delete();
    }


    /**
     * {@inheritdoc}
     */
    public function createRiego(array $data): Riego
    {
        $riego = Riego::create($data);
        if (!$riego) {
            throw new UserAlreadyExistsException();
        }
        return $riego;
    }


    /**
     * {@inheritdoc}
     */
    public function updateRiego(int $id, array $data): bool
    {
        $riego = $this->findRiegoOfId($id);
        return $riego->update($data);
    }
}
