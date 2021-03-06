<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'task';
    protected $connection = 'mysql';
    
    protected $fillable = ['name', 'description', 'status'];

    public function mark_task_as_completed()
    {
        $this->completed = 1;
        $this->save();
    }

    public function is_completed()
    {
        return $this->completed;
    }
 
}
