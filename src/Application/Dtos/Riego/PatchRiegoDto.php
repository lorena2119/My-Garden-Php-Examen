<?php

declare(strict_types=1);

namespace App\Application\Dtos\User;

use App\Application\Dtos\Contracts\ArraySerializableDto;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class PatchPlantaDto implements ArraySerializableDto
{
    /**
     * @param array $args
     */
    public function __construct(private readonly array $args)
    {
        $this->validate();
    }

    /**
     * @throws InvalidArgumentException
     */
    private function validate()
    {
        try {
            v::intType()->setName('riegoId')->assert((int)$this->args['id']);
            v::intType()->setName('plantaId')->assert((int)$this->args['id_planta']);
            v::intType()->setName('frecuencia_riego')->assert((int)$this->args['frecuencia_riego']);
            v::stringType()->length(min: 10, max: 10)->setName('fecha_riego')->assert($this->args['fecha_riego']);
            v::stringType()->length(min: 10, max: 10)->setName('proximo_riego')->assert($this->args['proximo_riego']);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException($e->getFullMessage());
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => (int)$this->args['id'],
            'id_planta' => (int)$this->args['id_planta'],
            'frecuencia_riego' => (int)$this->args['frecuencia_riego'],
            'fecha_riego' => htmlspecialchars($this->args['fecha_riego']),
            'proximo_riego' => htmlspecialchars($this->args['proximo_riego']),
        ];
    }
}
