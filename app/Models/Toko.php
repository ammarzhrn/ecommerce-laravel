<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\User;

class Toko extends Model
{
    use HasFactory;

    protected $table = 'toko';
    protected $guarded = [];

    public function  user() {
        return $this->belongsTo(User::class,  "id_user");
    }
}
