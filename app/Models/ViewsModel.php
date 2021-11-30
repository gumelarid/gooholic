<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewsModel extends Model
{
    use HasFactory;

    protected $table = 'views';
    protected $primaryKey = 'id';


    protected $fillable = [
        'ip',
        'id_article',
        'created_at',
        'updated_at'
    ];
}
