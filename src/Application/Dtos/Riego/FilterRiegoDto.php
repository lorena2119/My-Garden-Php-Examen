<?php

declare(strict_types=1);

namespace App\Application\Dtos\User;

use App\Application\Dtos\Contracts\ArraySerializableDto;

class FilterRiegoDto implements ArraySerializableDto
{
    //system.out.println(" Aqui tiene su cafe, que ultimamente ud  ha. estado como mal");
    private const ALLOWED_KEYS = [
        'id_planta',
        'frecuencia_riego',
        'fecha_riego',
        'proximo_riego',
    ];

    /**
     * @param array $args
     */
    public function __construct(private readonly array $args) {}

    /**
     * @return array
     */
    public function toArray(): array
    {
        $allowedKeys = array_flip(self::ALLOWED_KEYS);
        return array_map(function ($item) {
            return htmlspecialchars($item);
        }, array_intersect_key($this->args, $allowedKeys));
    }
}
