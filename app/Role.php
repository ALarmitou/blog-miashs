<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";

    protected $fillable = [
        "libelle"
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function permissisons()
    {
        return $this->belongsToMany('App\Permission','permisions_roles');
    }
}
