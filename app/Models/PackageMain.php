<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageMain extends Model
{
    use HasFactory;
    protected $table = 'package_main';
    protected $guarded = [];

    public function detail(){
        return $this->belongsTo(PackageFeature::class, 'feature_id');
    }
}
