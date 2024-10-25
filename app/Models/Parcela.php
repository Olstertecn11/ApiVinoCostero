<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'parcelas';

    // Campos que pueden ser asignados de forma masiva
    protected $fillable = [
        'nombre_parcela',
        'ubicacion',
        'superficie',
        'tipo_suelo'
    ];

    // Opcional: Si los campos de fechas se llaman diferente a 'created_at' y 'updated_at'
    // public $timestamps = true;
    // const CREATED_AT = 'fecha_creacion';
    // const UPDATED_AT = 'fecha_actualizacion';
}
