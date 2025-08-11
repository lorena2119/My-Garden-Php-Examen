<?php

declare(strict_types=1);

namespace App\Domain\Model\Riego;

use Illuminate\Database\Eloquent\Model;

class Riego extends Model
{
    protected $table = 'riegos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_planta', 'frecuencia_riego', 'fecha_riego', 'proximo_riego'];
}
