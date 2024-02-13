<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'type'
    ];
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = true;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
