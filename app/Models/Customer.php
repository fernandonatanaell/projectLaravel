<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';
    protected $primaryKey = 'customer_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        "customer_name",
        "customer_email",
        "customer_address",
        "customer_phone_number",
        "customer_jk"
    ];

    public function Services()
    {
        // param 1 adalah classnya
        // param 2 adalah foreign keynya
        // param 3 adalah local

        return $this->hasMany(Service::class, "customer_id", "customer_id");
    }
}
