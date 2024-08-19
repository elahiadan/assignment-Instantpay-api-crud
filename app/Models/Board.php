<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Observers\BoardObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// I can use observer class to bind with usermodel like below or in AppServiceProvide
#[ObservedBy([BoardObserver::class])]
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
