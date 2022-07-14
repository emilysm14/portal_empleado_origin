<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{

    //campos que se agregaran
    protected $fillable = [
        'titulo', 'preparacion','imagen','categoria_id'
    ];

    // Obtiene la categoria de la Receta vía FK

    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class);  
    }

    // Obtiene la informacion del usuario via PK

    public function autor()
    {

        return $this->belongsTo(User::class, 'user_id'); // fk de esta tabla
    }

    // Likes que ha recibido una Receta

    public function likes()
    {
        return $this->belongsToMany(User::class,'likes_receta');
    }

}
