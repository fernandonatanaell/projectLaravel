<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'services';
    protected $primaryKey = 'service_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        "service_description",
        "service_cost",
        "service_date",
        "service_status",
        "service_payment_status",
        "customer_id"
    ];

    public function Customers()
    {
        // ini untuk mendefinisikan
        // kalo ada 1 field yang SEBENARNYA bukan miliknya
        // belongTo = milik si ... == Customer::class
        // param kedua             == kamu akui sebagai apa di tablemu?
        // parak ketiga            == di tempat aslinya namanya apa?

        return $this->belongsTo(Customer::class, "customer_id", "customer_id");
    }

    public function Users()
    {
        // Param 1. data yg mau diambil itu ada di table apa
        // Param 2. melewati table pivot apa?
        // Param 3. kau punya apa untuk masuk ke pivot?
        // Param 4. lha table yg kamu rujuk dia dikenali sebagai apa di pivot?

        return $this->belongsToMany(User::class, 'services_users', 'service_id', 'user_id');
    }

    public function Items()
    {
        // Param 1. Sdata yg mau diambil itu ada di table apa
        // Param 2. melewati table pivot apa?
        // Param 3. kau punya apa untuk masuk ke pivot?
        // Param 4. lha table yg kamu rujuk dia dikenali sebagai apa di pivot?

        return $this->belongsToMany(Item::class, 'services_items', 'service_id', 'item_id');
    }
}
