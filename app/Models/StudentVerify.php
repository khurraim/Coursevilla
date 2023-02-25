<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentVerify extends Model
{
    use HasFactory;

    public $table = "students_verify";

    
    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'student_id',
        'token',
    ];
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function user()
    {
        return $this->belongsTo(Student::class);
    }
}
