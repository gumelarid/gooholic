<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageModel extends Model
{
    use HasFactory;

    protected $table = 'pages';
    protected $primaryKey = 'id_page';
    protected $keyType = 'string';


    protected $fillable = [
        'id_page',
        'slug_page',
        'title',
        'description',
        'is_publish',
        'created_at',
        'updated_at'
    ];
}
