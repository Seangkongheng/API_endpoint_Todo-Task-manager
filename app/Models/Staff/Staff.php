<?php

namespace App\Models\Staff;

use App\Models\Position\Positon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = "staffs";
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender_id',
        'position_id',
        'profile'
    ];

    public function position(){
        return $this->belongsTo(Positon::class);
    }
    public function task(){
        return $this->hasMany(Positon::class);
    }
}
