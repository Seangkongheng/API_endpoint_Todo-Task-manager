<?php

namespace App\Models\Task;

use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = "task_managers";
    public $timestamps = false;

    protected $fillable = [
        'staff_id',
        'title',
        'description',
        'status',
        'date'
    ];
    public function staff(){
        return $this->belongsTo(Staff::class);
    }
}
