<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model
{
    use HasFactory;

    protected $table = 'articles';
    protected $primaryKey = 'id_article';
    protected $keyType = 'string';


    protected $fillable = [
        'id_article',
        'id_category',
        'id_user',
        'slug_article',
        'subject',
        'title',
        'cover',
        'description',
        'is_publish',
        'view',
        'created_at',
        'updated_at',
    ];
}
