<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* 2025.10.12 강동위 수정 - 방충망 시공, 종합청소 서비스 추가 */

class mang_option extends Model
{
    use HasFactory;
    public $table = 'mang_option';
    protected $primaryKey = 'mang_option_id';
    public $timestamps = false;
    protected $fillable = [
        'add_option_id',
        'board_id',
        'contents'
    ];
}
