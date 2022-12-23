<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'items';
    protected $primaryKey = 'item_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        "item_name",
        "item_brand",
        "item_price",
        "item_stock",
        "item_image_name"
    ];

    public function Services()
    {
        // Param 1. Sdata yg mau diambil itu ada di table apa
        // Param 2. melewati table pivot apa?
        // Param 3. kau punya apa untuk masuk ke pivot?
        // Param 4. lha table yg kamu rujuk dia dikenali sebagai apa di pivot?

        return $this->belongsToMany(Service::class, 'services_items', 'item_id', 'service_id');
    }
}
