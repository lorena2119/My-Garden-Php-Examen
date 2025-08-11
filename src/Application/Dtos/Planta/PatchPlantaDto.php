<?php

declare(strict_types=1);

namespace App\Application\Dtos\Planta;

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
            v::intType()->setName('plantaId')->assert((int)$this->args['id']);
            v::stringType()->length(min: 2, max: 100)->setName('nombre_comun')->assert($this->args['nombre_comun']);
            v::stringType()->length(min: 2, max: 100)->setName('familia')->assert($this->args['familia']);
            v::stringType()->length(min: 2, max: 100)->setName('categoria')->assert($this->args['categoria']);
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
            'nombre_comun' => htmlspecialchars($this->args['nombre_comun']),
            'familia' => htmlspecialchars($this->args['familia']),
            'categoria' => htmlspecialchars($this->args['categoria']),
        ];
    }
}
