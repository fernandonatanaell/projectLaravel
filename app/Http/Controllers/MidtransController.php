<?php

namespace App\Http\Controllers;

use App\Models\Htrans;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap as Snap;
use Midtrans\Config as MidtransConfig;

class MidtransController extends Controller
{
    public function pay(Request $request)
    {
        $user = User::find(Auth::user()->user_id);

        $temp = $user->Carts()->get();

        $items = [];

        $total = 0;
        foreach ($temp as $t){
            $items[] = [
                'id' => $t->item_id,
                'price' => $t->item_price,
                'quantity' => $t->pivot->item_qty,
                'name' => $t->item_name
            ];
            $total += $t->pivot->item_qty * $t->item_price;
        }

        // $total /= 100;

        // $statement = DB::select("SHOW TABLE STATUS LIKE 'htrans'");
        // $nextId = $statement[0]->Auto_increment;
        $nextId = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
        // $nextId = str_pad(date('dmy').$nextId, 8, '0', STR_PAD_LEFT);

        MidtransConfig::$serverKey = env('MIDTRANS_SERVER_KEY');
        MidtransConfig::$clientKey = env('MIDTRANS_CLIENT_KEY');
        MidtransConfig::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        MidtransConfig::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        MidtransConfig::$is3ds = env('MIDTRANS_IS_3DS');

        $transaction = [
            'transaction_details' => [
                'order_id' => $nextId,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $user->user_name,
            ],
            'item_details' => $items,
            'enable_payments' => ['gopay', 'bank_transfer', 'credit_card'],
        ];

        $paymentURL = Snap::createTransaction($transaction)->redirect_url;

        $user->Carts()->detach();

        $htrans = $user->Htrans()->create([
            'htrans_date' => date('Y-m-d'),
            'htrans_total' => $total,
            'midtrans_url' => $paymentURL,
            'midtrans_id' => $nextId
        ]);

        $htrans = Htrans::find($htrans->htrans_id);

        foreach ($items as $item){
            $htrans->Dtrans()->attach($item['id'], [
                'dtrans_quantity' => $item['quantity'],
                'dtrans_subtotal' => $item['price'] * $item['quantity']
            ]);

            $selectedItem = Item::where('item_id', $item['id'])->first();
            $selectedItem->item_stock -= $item['quantity'];
            $selectedItem->save();
        }

        return redirect($paymentURL);
    }
}
