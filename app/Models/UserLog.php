<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;
    protected $guarded = [];
//table relation with user
    public function user()
    {
      return $this->hasOne(User::class, 'id', 'userId');
    }
//table relation with user
    public function activitylog()
    {
      return $this->hasOne(ActivityLog::class, 'logId', 'id');
    }
}
