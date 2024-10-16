<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recargas extends Model
{
    use HasFactory;
    protected $table = 'recargas';

    public function user()

    {

        return $this->hasOne(User::class, 'id', 'id_user');

    }
}
