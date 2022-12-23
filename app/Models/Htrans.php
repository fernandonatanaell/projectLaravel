<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Htrans extends Model
{
    use HasFactory;

    protected $table = 'htrans';
    protected $primaryKey = 'htrans_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        "htrans_date",
        "htrans_total",
        "cashier_id",
        'midtrans_id',
        'midtrans_url'
    ];

    public function Cashier()
    {
        return $this->belongsTo(User::class, "cashier_id", "user_id");
    }

    public function Dtrans()
    {
        return $this->belongsToMany(Item::class, 'dtrans', 'htrans_id', 'item_id')
            ->withPivot('dtrans_quantity', 'dtrans_subtotal');
    }

}
