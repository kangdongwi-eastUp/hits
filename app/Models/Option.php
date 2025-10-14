<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    public $table = 'option';
    protected $primaryKey = 'option_id';
    public $timestamps = false;
    protected $fillable = [
      'option_id',
      'board_id',
      'contents'
    ];
}
