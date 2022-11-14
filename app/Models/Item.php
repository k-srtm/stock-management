<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use HasFactory;
    protected $fillable = ['user_id','name','type','detail','status',];

    const TYPE = [
        1 => "文学・文芸" ,
        2 => "ビジネス" ,
        3 => "趣味・実用" ,
        4 => "絵本" ,
        5 => "雑誌" ,
        6 => "コミックス" ,
        7 => "専門書・参考書"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];
}
