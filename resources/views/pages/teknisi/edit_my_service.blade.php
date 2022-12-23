@extends('main')

@section('name_page')
    Master Service
@endsection

@push('page_custom_css')
    <link rel="stylesheet" href="{{ asset('src/teknisi/add_item/add_item.css') }}">
@endpush

@section('content')
    <div class="container bg-that-more-light-than-black p-4" style="width: 90%;">
        <h3 class="mb-4 color-white-high-emphasis">Form to edit service</h3>
        <form action="#" method="POST">
            @csrf
            <div class="form-group">
                <label for="inputDescriptionService" style="color: #e2e0e1;">Description of Service</label>
                <input type="text" class="form-control bg-content border-1 ml-2" id="inputDescriptionService" placeholder="Enter the description of service">
            </div>
            <div class="form-group">
                <label for="inputServiceCost" style="color: #e2e0e1;">Service Cost</label>
                <input type="number" class="form-control bg-content border-1 ml-2" id="inputServiceCost" placeholder="Enter the service cost">
            </div>
            <div class="form-group">
                <label for="inputPaymentStatus" style="color: #e2e0e1;">Service Payment Status</label>
                <select class="custom-select bg-content border-1 ml-2" name="qty_edit_position" id="inputPaymentStatus">
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="0" selected>Unpaid</option>
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="1">Paid</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputServiceStatus" style="color: #e2e0e1;">Service Status</label>
                <select class="custom-select bg-content border-1 ml-2" name="qty_edit_position" id="inputServiceStatus">
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="0" selected>Undone</option>
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="1">Done</option>
                </select>
            </div>
            <div class="d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-template mt-3 col-12 col-md-3">Update service</button>
            </div>
        </form>
    </div>
@endsection
