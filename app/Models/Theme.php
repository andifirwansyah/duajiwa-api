<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
    protected $table = 'themes';
    protected $guarded = [];

    public function creator_d(){
        return $this->belongsTo(Creator::class, 'creator_id');
    }
    public function category_d(){
        return $this->belongsTo(ThemeCategory::class, 'category_id');
    }
}
