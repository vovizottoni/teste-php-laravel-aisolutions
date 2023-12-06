<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public $table = 'documents';
    public $timestamps = true;

    protected $guarded = []; //Nenhum campo protegido para alteração.

}
