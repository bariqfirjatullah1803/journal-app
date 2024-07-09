<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $table = 'journals';
    protected $fillable = [
        'employee_id',
        'coordinator_id',
        'timing',
        'category_id',
        'description',
        'target',
        'status',
        'comment'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function coordinator()
    {
        return $this->belongsTo(User::class, 'coordinator_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
