<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'categorys';
    protected $primaryKey = 'id_category';
    protected $keyType = 'string';


    protected $fillable = [
        'id_category',
        'slug_category',
        'category',
        'created_at',
        'updated_at'
    ];
}
