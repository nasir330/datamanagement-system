<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function domain() {
        return $this->hasOne(Domain::class, 'id', 'domainId');
    }
}
