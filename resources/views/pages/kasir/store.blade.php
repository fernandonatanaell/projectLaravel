@extends('main')

@push('page_custom_css')
    <link rel="stylesheet" href="{{ asset('src/kasir/store/css/store.css') }}">
@endpush

@section('name_page')
    Store
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="modalAddToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>How many would you like to buy?</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kasir_insert_cart')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="item_id" name="item_id">
                        <span id="item_name"></span>
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label for="exampleInputEmail1">Amount</label>
                                <i style="font-size: .9rem; paddding-top: 5px;">Rp <span id="showPriceEach">0</span> / each</i>
                            </div>
                            <input type="number" id="qty_input" name="item_qty" class="form-control" placeholder="Number of items you wish to purchase.." min="1">
                        </div>
                        <div class="col text-right"><b>Subtotal :</b> Rp <span id="showSubotal">0</span></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-template">Add to cart</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="super-container mx-2">
        <div class="main-search-input-wrap mx-3 mb-4">
            <div class="main-search-input fl-wrap">
                <form action="{{ route('kasir_store')}}" method="GET">
                    <div class="main-search-input-item">
                        <input type="text" name="search"  value="{{ $search }}" placeholder="Search Products...">
                    </div>

                    <button class="main-search-button">Search</button>
                </form>
            </div>
        </div>

        @if (count($itemsInStock) > 0 || count($itemsOutOfStock) > 0)
            <div class="container-store mx-3">

                @foreach ($itemsInStock as $item)
                    <div class="wrapper-card mb-4" data-name={{$item->item_name}} data-id={{$item->item_id}} data-price={{$item->item_price}} data-toggle="modal" data-target="#modalAddToCart">
                        <div class="card">
                            <div class="wrapper-head-card">
                                <img src="{{ asset('src/kasir/store/img/'.$item->item_image_name) }}" class="card-img-top" alt="...">
                                <span class="color-white-high-emphasis alert-outofstock font-weight-bold p-2">
                                    STOCK : {{ $item->item_stock }}
                                </span>
                            </div>
                            <div class="card-body">
                                <p class="brand-text color-white-medium-emphasis font-weight-bold">{{ $item->item_brand}}</p>
                                <h5 class="card-title">{{ $item->item_name}}</h5>
                                <div class="wrapper-bottom mt-2">
                                    <p class="card-price color-white-high-emphasis">Rp {{ number_format($item->item_price, 0, ',','.')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @foreach ($itemsOutOfStock as $item)
                    <div class="wrapper-card mb-4">
                        <div class="card">
                            <div class="wrapper-head-card">
                                <img src="{{ asset('src/kasir/store/img/'.$item->item_image_name) }}" class="card-img-top" alt="...">
                                <span class="bg-danger color-white-high-emphasis alert-outofstock font-weight-bold p-2">
                                    OUT OF STOCK!
                                </span>
                            </div>
                            <div class="card-body">
                                <p class="brand-text color-white-medium-emphasis font-weight-bold">{{ $item->item_brand}}</p>
                                <h5 class="card-title">{{ $item->item_name}}</h5>
                                <div class="wrapper-bottom mt-2">
                                    <p class="card-price color-white-high-emphasis">Rp {{ number_format($item->item_price, 0, ',','.')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="d-flex justify-content-center text-danger">
                <h3 class="mt-5">NO ITEM</h3>
            </div>
        @endif

    </div>
@endsection

@push('page_custom_js')
    <script>
        $(window).on('load', function() {
            $(document).on("click", ".wrapper-card", function () {
                var itemPrice = $(this).data('price');
                var id = $(this).data('id');
                var name= $(this).data('name');
                console.log(id);
                $("#showPriceEach").html( itemPrice );
                $("#showSubotal").html( itemPrice );
                // $("#item_name").html( name );
                $("#qty_input").val( 1 );
                $("#item_id").val( id );
            });

            $("#qty_input").bind('keyup mouseup', function () {
                if($(this).val() != ""){
                    $("#showSubotal").html( $(this).val() * $("#showPriceEach").html() );
                } else {
                    $("#showSubotal").html( 0 );
                }
            });
        });
    </script>
@endpush
