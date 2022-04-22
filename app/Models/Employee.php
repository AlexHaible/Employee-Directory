<?php

namespace App\Models;

use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['position'];

    public function position()
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }
}
