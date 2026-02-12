<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TahirRasheed\MediaLibrary\Traits\HasMedia;

class Employee extends Model
{
    use HasFactory, HasMedia;

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
