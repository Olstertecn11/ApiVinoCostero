<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUva extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'tipos_uvas';

    // Campos que pueden ser asignados de manera masiva
    protected $fillable = [
        'nombre_uva',
        'tamano_uva',
        'color_uva',
        'tiempo_maduracion',
        'parcela_id'
    ];

    public function parcela()
    {
        return $this->belongsTo(Parcela::class, 'parcela_id');
    }

}
