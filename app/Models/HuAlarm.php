<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HuAlarm extends Model
{
    use HasFactory;

    protected $guarded = [];

    //neType table relation
    public function netypes() {
        return $this->hasOne(NeType::class, 'ne_type', 'nType');
    }
    //type table relation
    public function types() {
        return $this->hasOne(Type::class, 'type', 'type');
    }
    //severity table relation
    // public function severities() {
    //     return $this->hasOne(Severity::class, 'id', 'sev');
    // }
    //severity table relation
    public function user() {
        return $this->hasOne(User::class);
    }
}
