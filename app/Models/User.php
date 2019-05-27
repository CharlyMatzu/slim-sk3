<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
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