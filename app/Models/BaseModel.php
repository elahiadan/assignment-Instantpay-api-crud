<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    const ID = "id";
    const STATUS = "status";
    const PENDING = 0;
    const COMPLETED = 1;
    const WORKING = 2;
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    const CASCADE = "cascade";
}
