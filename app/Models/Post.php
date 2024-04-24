<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    //Con esta funcion definimos la relacion que hay entre la tabla post y user
    //podría decirse que es una forma de hacer una consulta
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    //Creamos la relacion de posts con la tabla de likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Con este metodo verificamos si el usuario ya tiene registrado un like
    public function checkLikes(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
