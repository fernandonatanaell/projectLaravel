<?php

use App\Http\Controllers\API\APIItem;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\web\Admin\WebUserController;
use App\Http\Controllers\web\Customer\CustomerController;
use App\Http\Controllers\web\Service\WebServiceController;
use App\Http\Controllers\web\WebLoginController;
use App\Mail\MailNotify;
use App\Models\Customer;
use App\Models\Htrans;
use App\Models\Item;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/sendmail', function(){
//     $name = 'agus';
//     $id = '123';
//     return new MailNotify($name,$id);
// });

Route::middleware('login')->group( function(){
    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('/login', [WebLoginController::class, 'indexLogin'])->name('login');

    Route::post('/login', [WebLoginController::class, 'doLogin'])->name('login');
});

Route::get('/logout', [WebLoginController::class, 'doLogout'])->name('logout');


// == KASIR ==
Route::prefix('kasir')->group( function() {
    Route::get('/', function() {
        return redirect()->route("kasir_store");
    });

    Route::prefix('store')->group( function() {
        Route::get('/', function(Request $request) {
            $search = "";
            if($request->has('search')) {
                $itemsInStock = Item::where([
                    ['item_name', 'like', '%'.$request->search.'%'],
                    ['item_stock', '>', 0]
                ])->get();

                $itemsOutOfStock = Item::where([
                    ['item_name', 'like', '%'.$request->search.'%'],
                    ['item_stock', 0]
                ])->get();

                $search = $request->search;
            } else {
                $itemsInStock = Item::where('item_stock', '>', 0)->get();

                $itemsOutOfStock = Item::where('item_stock', 0)->get();
            }

            return view('pages.kasir.store', compact('itemsInStock', 'itemsOutOfStock', 'search'));
        })->name('kasir_store');

        Route::prefix('history')->group( function() {
            Route::get('/', function(Request $request) {
                $historys = Htrans::get();

                return view('pages.kasir.history', compact('historys'));
            })->name('kasir_history');

            Route::get('/detail/{id}', function(Request $request) {
                return Htrans::where('htrans_id', $request->id)->first()->Dtrans()->get();
            })->name('kasir_history_detail');
        });
    });

    Route::get('/cart', function() {
        $items = User::find(Auth::user()->user_id)->Carts()->get();
        $checkoutError = false;
        $total = 0;

        foreach($items as $item) {
            $total += $item->pivot->item_qty * $item->item_price;
            $selectedItemStock = Item::where('item_id', $item->pivot->item_id)->first()->item_stock;

            if($selectedItemStock < $item->pivot->item_qty){
                $checkoutError = true;
                $item->stock_error = true;

                if($selectedItemStock == 0){
                    $item->stock_error_message = "OUT OF STOCK!";
                } else {
                    $item->stock_error_message = "ONLY $selectedItemStock STOCKS REMAIN!";
                }
            } else {
                $item->stock_error = false;
            }
        }

        return view('pages.kasir.cart', compact('items', 'total', 'checkoutError'));
    })->name('kasir_cart');

    Route::get('/checkout', function() {
        $items = User::find(Auth::user()->user_id)->Carts()->get();
        $checkoutError = false;
        $total = 0;

        foreach($items as $item) {
            $total += $item->pivot->item_qty * $item->item_price;
            $selectedItemStock = Item::where('item_id', $item->pivot->item_id)->first()->item_stock;

            if($selectedItemStock < $item->pivot->item_qty){
                $checkoutError = true;
            }
        }

        return view('pages.kasir.checkout', compact('items', 'total', 'checkoutError'));
    })->name('kasir_checkout');

    Route::post('/cart', function(Request $request) {
        $buy_qty = $request->item_qty;
        $id_item = $request->item_id;
        $getItem = Item::where('item_id', $id_item)->first();

        if($getItem->item_stock < $buy_qty){
            alert()->error('Oooppss!!', 'Stock yang dibeli melebihi batas!');
        } else {
            $user = User::find(Auth::user()->user_id);

            if($user->Carts()->wherePivot('item_id', )->exists()){
                $user->Carts()->updateExistingPivot($id_item, ['item_qty' => DB::raw('item_qty + '. $buy_qty)]);
            } else {
                $user->Carts()->attach($id_item, ['item_qty' => $buy_qty]);
            };

            alert()->success('Yayyy!!', 'Barang berhasil ditambahkan ke keranjang!');
        }

        return redirect()->route("kasir_store");
    })->name('kasir_insert_cart');

    Route::post('/cart/change', function(Request $request){
        $user = User::find(Auth::user()->user_id);

        if($request->item_qty == 0) {
            $user->Carts()->detach($request->item_id);
        } else {
            $user->Carts()->updateExistingPivot($request->item_id, ['item_qty' => $request->item_qty]);
        }

        alert()->success('Yayyy!!', 'Barang di keranjang berhasil diupdate!');
        return redirect()->route("kasir_cart");
    })->name('kasir_change_cart');

    Route::get('/cart/remove', function(Request $request){
        $user = User::find(Auth::user()->user_id);

        $user->Carts()->detach($request->item_id);

        alert()->success('Yayyy!!', 'Barang berhasil dihapus ke keranjang!');
        return redirect()->route("kasir_cart");
    })->name('kasir_remove_cart');

    Route::get('/pay', [MidtransController::class, 'pay'])->name('kasir_pay');
});


// == TEKNISI ==
Route::prefix('teknisi')->group( function() {
    // Route::get('/', function() {
    //     return view('pages.teknisi.dashboard');
    // })->name('teknisi_dashboard');

    Route::get('/', function() {
        return redirect()->route("teknisi_service");
    });

    Route::prefix('service')->group( function() {
        Route::get('/',function() {
            $user = User::find(Auth::user()->user_id);

            $services = $user->Services()->whereDate('service_date', Carbon::today())->get();
            // $services = [];

            return view('pages.teknisi.my_service', compact('services'));
        })->name('teknisi_service');

        Route::get('/edit',function() {
            return view('pages.teknisi.edit_my_service');
        })->name('teknisi_edit_service');
    });

    Route::get('/history',function() {
        $user = User::find(Auth::user()->user_id);

        $services = $user->Services()->get();

        return view('pages.teknisi.history', compact('services'));
    })->name('teknisi_service_history');

    Route::get('/done', function(Request $request){
        $service = Service::find($request->service_id);

        if($service->service_status == 0)
        {
            $customer=$service->Customers()->first();
            $name=$customer->customer_name;
            $id=$service->service_id;

            Mail::to($customer->customer_email)->send(new MailNotify($name,$id));
        }
        $service->service_status = 1 - $service->service_status;
        $service->save();

        alert()->success('Yayyy!!', 'Status servis berhasil diupdate!');
        return redirect()->back();
    })->name('teknisi_done_service');;
});


// == OWNER ==
Route::middleware(['auth:sanctum', 'ability:owner'])->prefix('owner')->group( function() {
    Route::get('/', function() {
        return redirect()->route("owner_report");
    });

    Route::get('/report', function(Request $request) {

        if (!isset ($request->start_date)&& !isset($request->end_date))
        {
             $start_date = Carbon::now()->startOfMonth()->toDateString();
             $end_date = Carbon::now()->endOfMonth()->toDateString();
        }else{
            $request->validate([
                'start_date'=>'required',
                'end_date'=>'required|after_or_equal:'.$request->start_date

            ]);
            $start_date = Carbon::parse($request->start_date);
            $end_date = Carbon::parse($request->end_date);
        }
        $serviceThisMonth = Service::whereDate('service_date','<=',$end_date)->whereDate('service_date','>=',$start_date)  ->orderBy('service_cost', 'DESC')->get();
        $earningService = $serviceThisMonth->sum('service_cost');
        $numberOfServices = $serviceThisMonth->count();

        $top3customer = [];
        $allCustomers = Customer::get();
        foreach($allCustomers as $customer){
            $temp_total = $serviceThisMonth->where('customer_id', $customer->customer_id)->sum('service_cost');

            if($temp_total > 0){
                array_push($top3customer, [
                    'customer_name' => $customer->customer_name,
                    'total' => $temp_total
                ]);
            }
        }
        usort($top3customer, fn($a, $b) => $b['total'] > $a['total']);
        $top3customer = array_slice($top3customer, 0, 3);

        $salesThisMonth = Htrans::whereDate('htrans_date','<=',$end_date)->whereDate('htrans_date','>=',$start_date)->get();
        $earningSales = $salesThisMonth->sum('htrans_total');
        $numberOfSales = $salesThisMonth->count();

        $top3item = [];
        $allItems = Item::get();
        foreach($allItems as $item){
            $tempCtr = 0;

            foreach($salesThisMonth as $sales){
                $detailSales = $sales->Dtrans()->get();

                $tempDetail = $detailSales->where('item_id', $item->item_id)->first();
                if($tempDetail){
                    $tempCtr += $tempDetail->pivot->dtrans_quantity;
                }
            }

            if($tempCtr > 0){
                array_push($top3item, [
                    'item_name' => $item->item_name,
                    'total' => $tempCtr
                ]);
            }
        }
        usort($top3item, fn($a, $b) => $b['total'] > $a['total']);
        $top3item = array_slice($top3item, 0, 3);

        return view('pages.owner.laporan', compact('earningService', 'numberOfServices', 'earningSales', 'numberOfSales', 'top3customer', 'top3item','start_date','end_date'));
    })->name('owner_report');

    // == USER ==
    Route::prefix('users')->group( function() {
        Route::get('/', [WebUserController::class, 'index'])->name('master_user');

        Route::post('/insert', [WebUserController::class, 'doinsert'])->name('master_insert_user');

        Route::get('/edit/{user_id}', [WebUserController::class, 'edit'])->name('master_edit_user');

        Route::post('/edit/{user_id}', [WebUserController::class, 'doedit']);
    });
});


// == MANAJER ==
Route::prefix('manajer')->group( function() {
    Route::get('/', function() {
        return redirect()->route("master_service");
    });

    Route::prefix('paycheck')->group( function() {
        Route::get('/', function() {
            $param = array();
            $param["users"] = User::where([
                ['user_status', 1],
                ['user_role', '<>', '0']
            ])->get();

            return view('pages.manager.paycheck', $param); // ini list gajian
        })->name('manager_paycheck');

        Route::get('/edit', function(Request $request) {
            $param = array();
            $param["user"] = User::where('user_id', $request->user_id)->first();

            return view('pages.manager.edit_paycheck', $param); // ini list gajian
        })->name('manager_edit_paycheck');

        Route::post('/update', function(Request $request) {
            $user = User::where("user_id", $request->user_id)->first();
            $user->user_salary = $request->finalSalary;
            $user->save();

            alert()->success('Yayyy!!', 'Gaji milik ' . $user->user_name . ' berhasil diubah!');
            return redirect()->route('manager_paycheck');
        })->name('manager_update_paycheck');
    });
});


// == SERVICE ==
Route::prefix('services')->group( function() {
    Route::get('/', [WebServiceController::class, 'index'])->name('master_service');

    Route::get('/edit', function(Request $request) {
        $param = array();
        $param["service"] = Service::where('service_id', $request->service_id)->first();
        $param["customers"] = Customer::all();
        $param["teknisis"] = User::where('user_role', 2)->get();

        return view('pages.master.services.edit_service', $param);
    })->name('master_edit_service');

    Route::post('/insert', [WebServiceController::class, "insert"])->name('master_insert_service');

    Route::post('/update', [WebServiceController::class, "update"])->name('master_update_service');

    Route::get('/delete', [WebServiceController::class, "delete"])->name('master_delete_service');

    Route::get('/done', [WebServiceController::class, "done"])->name('master_done_service');

    Route::get('/paid', [WebServiceController::class, "paid"])->name('master_paid_service');
});


// == ITEM ==
Route::middleware(['auth:sanctum', 'ability:owner,manajer'])->prefix('items')->group( function() {
    Route::get('/', function() {
        $param = array();
        $param["items"] = Item::withTrashed()->get();

        return view('pages.master.items.master_item', $param);
    })->name('master_item');

    Route::get('/edit', function(Request $request) {
        $param = array();
        $param["item"] = Item::where('item_id', $request->item_id)->first();

        return view('pages.master.items.edit_item', $param);
    })->name('master_edit_item');

    Route::post('/insert', [APIItem::class, "insert"])->name('master_insert_item');

    Route::post('/update', [APIItem::class, "update"])->name('master_update_item');

    Route::get('/delete', [APIItem::class, "delete"])->name('master_delete_item');

    Route::get('/restore', [APIItem::class, "restore"])->name('master_restore_item');
});


// == CUSTOMER ==
Route::middleware(['auth:sanctum', 'ability:owner,manajer'])->prefix('customers')->group( function() {
    Route::get('/', function() {
        $param = array();
        $param["loginUser"] = Auth::user();
        $param["customers"] = Customer::withTrashed()->get();

        return view('pages.master.customers.master_customer', $param);
    })->name('master_customer');

    Route::get('/edit', function(Request $request) {
        $param = array();
        $param["loginUser"] = Auth::user();
        $param["customer"] = Customer::where('customer_id', $request->customer_id)->first();

        return view('pages.master.customers.edit_customer', $param);
    })->name('master_edit_customer');

    Route::post('/insert', [CustomerController::class, "insert"])->name('master_insert_customer');

    Route::post('/update', [CustomerController::class, "update"])->name('master_update_customer');

    Route::get('/delete', [CustomerController::class, "delete"])->name('master_delete_customer');

    Route::get('/restore', [CustomerController::class, "restore"])->name('master_restore_customer');
});

