<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot(){
        parent::boot();
        self::deleting(function($image){
            Storage::disk('public')->delete($image->location);
        });
    }

    public function folder(){
        return $this->belongsTo(Folder::class);
    }
}
