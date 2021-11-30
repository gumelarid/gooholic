<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'id_comment';
    protected $keyType = 'string';


    protected $fillable = [
        'id_comments',
        'id_article',
        'name',
        'email',
        'comments',
        'id_parent',
        'is_publish',
        'created_at',
        'updated_at'
    ];
}
