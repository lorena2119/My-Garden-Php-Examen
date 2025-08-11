<?php

declare(strict_types=1);

use App\Domain\Repository\PlantaRepository;
use App\Domain\Repository\RiegoRepository;
use App\Domain\Repository\UserRepository;
use App\Infrastructure\Persistence\Planta\ElloquentPlantaRepository;
use App\Infrastructure\Persistence\Riego\ElloquentRiegoRepository;
use App\Infrastructure\Persistence\User\ElloquentUserRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(ElloquentUserRepository::class),
        PlantaRepository::class => \DI\autowire(ElloquentPlantaRepository::class),
        RiegoRepository::class => \DI\autowire(ElloquentRiegoRepository::class)
    ]);
};
