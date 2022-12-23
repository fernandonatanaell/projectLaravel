@extends("main")

@push('page_custom_css')
    <link rel="stylesheet" href="{{ asset('src/master/items/edit_item.css') }}">
@endpush

@section('name_page')
    Master customer
@endsection

@section('content')
    <div class="container bg-that-more-light-than-black p-4" style="width: 90%;">
        <h3 class="mb-4 color-white-high-emphasis">Form to edit customer</h3>
        <form action="{{ route('master_update_customer') }}" method="POST">
            @csrf
            <input type="hidden" name="customer_id" value="{{ $customer->customer_id }}">

            <div class="form-group">
                <label for="inputNameItem">Customer Name</label>
                <input type="text" class="form-control bg-content border-1 ml-2 @error('name') is-invalid @enderror" id="inputNameItem" name="name" placeholder="Enter the item name" value="{{ $customer->customer_name }}">
                @error('name')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputBrandItem">Customer Email</label>
                <input type="email" class="form-control bg-content border-1 ml-2 @error('email') is-invalid @enderror" id="inputBrandItem" name="email" placeholder="Enter the item email"  value="{{ $customer->customer_email }}">
                @error('email')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputBrandItem">Customer Address</label>
                <input type="text" class="form-control bg-content border-1 ml-2 @error('address') is-invalid @enderror" id="inputBrandItem" name="address" placeholder="Enter the item address"  value="{{ $customer->customer_address }}">
                @error('address')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputBrandItem">Customer Phone Number</label>
                <input type="text" class="form-control bg-content border-1 ml-2 @error('phone_number') is-invalid @enderror" id="inputBrandItem" name="phone_number" placeholder="Enter the item phone_number"  value="{{ $customer->customer_phone_number }}">
                @error('phone_number')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="selectSex">Sex</label>
                <select id="selectSex" class="custom-select color-white-high-emphasis bg-content border-1 ml-2 @error('jk') is-invalid @enderror" name="jk">
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="L" {{ (old("jk", $customer->customer_jk) == 'L' ? "selected":"") }}>Laki-laki</option>
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="P" {{ (old("jk", $customer->customer_jk) == 'P' ? "selected":"") }}>Perempuan</option>
                </select>
                @error('jk')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-template mt-3 col-12 col-md-3">Update customer</button>
            </div>
        </form>
    </div>
@endsection
