<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* 2025.11.07 강동위 수정 - 다른서비스 이용 선택 모델 추가 */

class other_service_option extends Model
{
    use HasFactory;
    public $table = 'other_service_option';
    protected $primaryKey = 'other_service_option_id';
    public $timestamps = false;
    protected $fillable = [
        'other_service_option_id',
        'board_id',
        'contents'
    ];
}
