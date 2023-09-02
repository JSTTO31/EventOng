<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function folder(){
        return $this->belongsTo(Folder::class);
    }

    public function folders(){
        return $this->hasMany(Folder::class);
    }
}
