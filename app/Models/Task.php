<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends BaseModel
{
    use HasFactory;

    const TABLE = "tasks";
    const BOARD_ID = "board_id";
    const USER_ID = "user_id";
    const NAME = "name";
    const DESCRIPTION = 'description';

    protected $fillable = [self::USER_ID, self::BOARD_ID, self::NAME, self::DESCRIPTION];

    const TASK_STATUS = [self::PENDING, self::WORKING, self::COMPLETED];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
