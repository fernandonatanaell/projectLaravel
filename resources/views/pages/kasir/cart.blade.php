@extends('main')

@push('page_custom_css')
    <link rel="stylesheet" href="{{ asset('src/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('src/kasir/cart/cart.css') }}">
@endpush

@section('name_page')
    Cart
@endsection

@section('content')
    <div class="wrap cf">
        <div class="heading cf">
            <h1>My Cart</h1>
            <a href="{{ route('kasir_store') }}" class="continue">Continue Shopping</a>
        </div>

        {{-- <div class="cart">
            <ul class="cartWrap">
                @foreach ($items as $item)
                    <li class="items">
                        <div class="infoWrap">
                            <div class="cartSection">
                                <img src="{{ asset('src/card-product/img/ac.png') }}" alt="" class="itemImg" />
                                <p class="itemNumber">{{ $item->item_brand }}</p>
                                <h3 class="color-white-high-emphasis">{{ $item->item_name}}</h3>

                                <form class="change_amount" action="{{ route('kasir_change_cart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->item_id}}">
                                    <p> <input type="number" name="item_qty" class="qty" value="{{ $item->pivot->item_qty }}"/> x Rp. {{number_format($item->item_price, 2, ',','.')}}</p>
                                </form>
                            </div>

                            <div class="prodTotal cartSection">
                                <p>Rp. {{number_format($item->item_price * $item->pivot->item_qty, 2, ',','.')}}</p>
                            </div>

                            <div class="cartSection removeWrap">
                                <a href="{{ route('kasir_remove_cart', ['item_id' => $item->item_id]) }}" class="remove">x</a>
                            </div>
                        </div>
                    </li>
                @endforeach
                <!--<li class="items even">Item 2</li>-->
            </ul>
        </div> --}}

        <table class="table cart" id="dataTable" width="100%" cellspacing="0">
            <tbody class="cartWrap">
                @if (count($items) > 0)
                    @foreach ($items as $item)
                        <tr class="items">
                            <td class="col-8">
                                <div class="cartSection">
                                    <div class="d-flex justify-content-between">
                                        <p class="itemNumber">{{ $item->item_brand }}</p>
                                        <a href="{{ route('kasir_remove_cart', ['item_id' => $item->item_id]) }}" class="removeInvisible">x</a>
                                    </div>
                                    <h3 class="color-white-high-emphasis">{{ $item->item_name}}</h3>
                                    <form class="change_amount" action="{{ route('kasir_change_cart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="item_id" value="{{ $item->item_id}}">
                                        <p><input type="number" name="item_qty" class="qty" value="{{ $item->pivot->item_qty }}"/> x Rp {{number_format($item->item_price, 0, ',','.')}}</p>
                                    </form>
                                    @if ($item->stock_error)
                                        <span class="text-danger font-weight-bold" style="font-size: 0.8rem;">{{ $item->stock_error_message }}</span>
                                    @endif
                                </div>
                                <div class="hargaInvisible color-white-high-emphasis font-weight-bold">Rp {{number_format($item->item_price * $item->pivot->item_qty, 0, ',','.')}}</div>
                            </td>
                            <td class="col-3 prodTotal cartSection">
                                <p>Rp {{number_format($item->item_price * $item->pivot->item_qty, 0, ',','.')}}</p>
                            </td>
                            <td class="col-1 cartSection removeWrap">
                                <a href="{{ route('kasir_remove_cart', ['item_id' => $item->item_id]) }}" class="remove">x</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center text-danger font-weight-bold py-4" colspan="6">NO ITEM</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <table class="table" id="dataTable" width="100%" cellspacing="0">
            <tbody>
                <tr class="color-white-high-emphasis">
                    <td class="col-5 col-md-9 text-right">ITEM TYPE COUNT:</td>
                    <td class="col pr-4 text-right"><span class="mr-4"></span>{{ count($items)}}</td>
                </tr>
                <tr class="color-white-high-emphasis font-weight-bolder">
                    <td class="col-5 col-md-9 text-right">TOTAL PRICE:</td>
                    <td class="col pr-4 text-right"><span class="mr-4"></span>Rp {{number_format($total, 0, ',','.')}}</td>
                </tr>
            </tbody>
        </table>

        @if ($checkoutError)
            <a href="#" onclick="showErrorCheckout()" class="btn btn-cart continue">Checkout</a>
        @else
            <a href="{{ route('kasir_checkout') }}" class="btn btn-cart continue">Checkout</a>
        @endif

    </div>
@endsection

@push('page_custom_js')
    <script>
        var input = document.querySelector('.qty');

        input.addEventListener('keydown',
            function(e) {
                if (e.keyCode == 13) {
                    var form = document.querySelector('.change_amount');
                    form.submit();
                }
            }
        );

        function showErrorCheckout(){
            alert("There is an issue in the cart, please edit first before checkout!");
        }
    </script>
@endpush
