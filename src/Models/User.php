<?php namespace Src\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'idUser';
    public $timestamps = false;
    public $incrementing = true;

    protected $casts = [
        'active' => 'boolean'
    ];

//    public function licences()
//    {
//        return $this->hasMany(, 'idUser', 'idUser');
//    }
}