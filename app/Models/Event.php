<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $guarded = [];

    public function detail(){
        return $this->hasMany(EventDetail::class, 'event_id');
    }
    public function category(){
        return $this->belongsTo(ThemeCategory::class, 'category_id');
    }
    public function couple(){
        return $this->hasMany(WeddingCouple::class, 'event_id');
    }
}
