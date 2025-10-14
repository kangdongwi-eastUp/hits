<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;
    public $table = 'notice';
    protected $primaryKey = 'notice_id';
    public $timestamps = false;
    protected $fillable = [
      'notice_id',
      'title',
      'saved',
      'origin',
      'created_at',
      'updated_at'
    ];
}
