<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'client_id',
        'service_id',
        'status',
        'payment_due_date',
        'paid_at',
        'price'
    ];
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = true;

    protected $casts = [
        'payment_due_date' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
