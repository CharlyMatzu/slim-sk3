<?php namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class UserEntity extends Model
{
    protected $table = 'Users';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [
        'id',
	    'firstName',
	    'lastName',
	    'email'
    ];
}