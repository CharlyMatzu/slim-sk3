<?php namespace Src\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'UsersController';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [
        'id',
	    'firstName',
	    'lastName',
	    'email'
    ];
}