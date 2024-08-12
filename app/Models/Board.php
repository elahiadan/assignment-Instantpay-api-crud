<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Board extends BaseModel
{
    use HasFactory;

    const TABLE = 'boards';
    const USER_ID = "user_id";
    const NAME = "name";

    protected $fillable = [self::USER_ID, self::NAME];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
