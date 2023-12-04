<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $table = 'employees';
    // protected $primaryKey = 'id';
    // protected $fillable = [
    //     'first_nm',
    //     'last_nm',
    //     'email',
    //     'phone',
    //     'company_id'
    // ];
    protected $guarded = []; //agar semua column bisa diisi, bisa pake fillable atau guarded diisi dengan array kosong
    public function Company(){
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
