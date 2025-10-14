<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    public $table = 'banner';
    protected $primaryKey = 'banner_id';
    public $timestamps = false;
    protected $fillable = [
      'banner_id',
      'banner_name',
      'status',
      'saved',
      'origin',
      'created_at',
      'updated_at',
      'url'
    ];
}
