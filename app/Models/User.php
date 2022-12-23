<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        "user_name",
        "user_username",
        "user_password",
        "user_dob",
        "user_address",
        "user_phone_number",
        "user_jk",
        "user_status",
        "user_role",
        "user_salary"
    ];

    public function Services()
    {
        // Param 1. Sdata yg mau diambil itu ada di table apa
        // Param 2. melewati table pivot apa?
        // Param 3. kau punya apa untuk masuk ke pivot?
        // Param 4. lha table yg kamu rujuk dia dikenali sebagai apa di pivot?

        return $this->belongsToMany(Service::class, 'services_users', 'user_id', 'service_id');
    }

    public function Carts(){
        return $this->belongsToMany(Item::class, 'carts', 'user_id', 'item_id')
            ->withPivot('item_qty')
            ->withTimestamps();
    }

    public function Htrans(){
        return $this->hasMany(Htrans::class, "cashier_id", "user_id");
    }
}
