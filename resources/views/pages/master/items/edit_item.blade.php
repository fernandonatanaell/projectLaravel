@extends("main")

@push('page_custom_css')
    <link rel="stylesheet" href="{{ asset('src/master/items/edit_item.css') }}">
@endpush

@section('name_page')
    Master Item
@endsection

@section('content')
    <div class="container bg-that-more-light-than-black p-4" style="width: 90%;">
        <h3 class="mb-4 color-white-high-emphasis">Form to edit item</h3>
        <form action="{{ route('master_update_item') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item->item_id }}">

            <div class="form-group">
                <label for="inputNameItem">Name of Item</label>
                <input type="text" class="form-control bg-content border-1 ml-2 @error('name') is-invalid @enderror" id="inputNameItem" name="name" placeholder="Enter the item name" value="{{ $item->item_name }}">
                @error('name')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputBrandItem">Item Brand</label>
                <input type="text" class="form-control bg-content border-1 ml-2 @error('brand') is-invalid @enderror" id="inputBrandItem" name="brand" placeholder="Enter the item brand"  value="{{ $item->item_brand }}">
                @error('brand')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputStockItem">Stock Item</label>
                <input type="number" class="form-control bg-content border-1 ml-2 mr-3 @error('stock') is-invalid @enderror" id="inputStockItem" name="stock" placeholder="Enter stock item"  value="{{ $item->item_stock }}">
                @error('stock')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputItemPrice">Item Price</label>
                <input type="number" class="form-control bg-content border-1 ml-2 @error('price') is-invalid @enderror" id="inputItemPrice" name="price" placeholder="Enter the item price"  value="{{ $item->item_price }}">
                @error('price')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="customFile">Upload Image</label>
                <input type="file" class="form-control bg-that-more-light-than-black border-0 ml-2 w-25 @error('image') is-invalid @enderror" id="customFile" name="image" />
                @error('image')
                    <span class="invalid-feedback" style="margin-left: 2.5%;">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-template mt-3 col-12 col-md-3">Update item</button>
            </div>
        </form>
    </div>
@endsection
