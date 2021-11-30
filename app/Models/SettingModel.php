<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $primaryKey = 'id_web';
    protected $keyType = 'string';


    protected $fillable = [
        'id_web',
        'logo',
        'name_web',
        'description',
        'created_at',
        'updated_at'
    ];
}
