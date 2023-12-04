<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company';
    // protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'address'
    ];
    public function Employee(){
        return $this->hasMany('App\Models\Employee', 'company_id');
    }
}
