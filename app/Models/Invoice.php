<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    use HasFactory;
    protected int $uuidVersion = 1;
    protected $fillable = [
        'id',
        'amount',
        'emission_date',
        'sender_cnpj',
        'sender_name',
        'transporter_cnpj',
        'transporter_name',
        'file'
    ];

    protected $casts = [
        'emission_date' => 'date',
        'amount' => 'float',
    ];

    protected $attributes = [
        'amount' => 0,
    ];

    public static function rules(){
        return [
            'id' => 'required|uuid',
            'amount' => 'required|numeric|min:0',
            'emission_date' => 'required|date|before_or_equal:today',
            'sender_cnpj' => 'required|string|size:14|regex:/^\d{14}$/',
            'sender_name' => 'required|string|max:100',
            'transporter_cnpj' => 'required|string|size:14|regex:/^\d{14}$/',
            'transporter_name' => 'required|string|max:100',
        ];
    }
    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = (float) $value;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
