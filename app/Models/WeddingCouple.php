<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingCouple extends Model
{
    use HasFactory;
    protected $table = 'wedding_couple';
    protected $guarded = [];
}
