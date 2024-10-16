<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transacoes extends Model
{
    use HasFactory;
    protected $table = 'transacoes';

    public function produto()

    {

        return $this->hasOne(Produtos::class, 'id', 'id_produto');

    }

    
    public function user()

    {

        return $this->hasOne(User::class, 'id', 'id_user');

    }
}
