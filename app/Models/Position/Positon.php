<?php

namespace App\Models\Position;

use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Positon extends Model
{
    use HasFactory;
    protected $table = "positions";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'title',
        'description'
    ];

    public function staff(){
        return $this->hasMany(Staff::class);
    }
}
