<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
  use HasFactory;
  public $table = 'board';
  protected $primaryKey = 'board_id';
  public $timestamps = false;
  protected $fillable = [
    'board_id',
    'start_date',
    'end_date',
    'address1',
    'address2',
    'name',
    'phone',
    'company_name',
    'company_phone',
    'option1',
    'manager_name',
    'manager_phone',
    'resident_name',
    'resident_phone',
    'contents',
    'noise_date',
    'created_at',
    'option2',
    'type',
    'option3',
    'option4',
    'terms1',
    'terms2',
    'terms3',
    'terms4',
    'contents2',
    'status',
    'delete_status',
    'tmp'
  ];
}
