<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AsiaTeknik</title>
    <link rel="icon" href="{{ asset('src/sb-admin/img/logo_aja.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('src/kasir/checkout/checkout.css') }}">
</head>
<body>
    <main class="page payment-page">
        <section class="payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2>Payment</h2>
                </div>
                <form>
                    <div class="products">
                        <h3 class="title">Checkout</h3>
                        <div class="wrap-item">
                            @if (count($items) > 0)
                                @foreach ($items as $item)
                                    <div class="item">
                                        <span class="price">Rp {{number_format($item->item_price * $item->pivot->item_qty, 0, ',','.')}}</span>
                                        <p class="item-name">{{ $item->item_name }}</p>
                                        <p class="item-description">{{$item->pivot->item_qty}} x Rp {{number_format($item->item_price, 0, ',','.')}}</p>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex justify-content-center">
                                    <span class="text-danger font-weight-bold py-4" colspan="6">NO ITEM</span>
                                </div>
                            @endif
                        </div>
                        <div class="total">
                            @if (count($items) > 0)
                                Total<span class="price">Rp {{ number_format($total, 0, ',','.')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-details pt-0">
                        <div class="row pt-0 mt-0">
                            @if (count($items) > 0)
                                @if ($checkoutError)
                                    <div class="col-sm-12 text-danger text-center mb-2">
                                        There's an error in your cart! Please check it first!
                                    </div>
                                @else
                                    <div class="col-sm-12">
                                        <a href="{{ route('kasir_pay')}}" style="text-decoration: none;">
                                            <button type="button" class="btn btn-block btnProceed">Proceed</button>
                                        </a>
                                    </div>
                                @endif
                            @endif
                            <div class="form-group col-sm-12">
                                <a href="{{ route('kasir_cart') }}" style="text-decoration: none;">
                                    <button type="button" class="btn btn-secondary btn-block">Back to cart</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        window.addEventListener("pageshow", function ( event ) {
            var historyTraversal = event.persisted ||
                                    ( typeof window.performance != "undefined" &&
                                        window.performance.navigation.type === 2 );
            if ( historyTraversal ) {
                // Handle page restore.
                window.location.reload();
            }
        });
    </script>
</body>
</html>
