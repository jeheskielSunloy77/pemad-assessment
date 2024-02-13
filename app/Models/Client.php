<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'bank_account_number',
        'bank_account_name'
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
