@extends('main')

@push('page_custom_css')
    <link href="{{ asset('src/sb-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('src/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('src/teknisi/service/table_service.css') }}">
@endpush

@section('name_page')
    History Service
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4 wrapper-datatables border-0">
            <div class="card-header py-3 border-0 bg-that-more-light-than-black d-flex justify-content-between">
                <h4 class="m-0 font-weight-bold mt-auto mb-auto mr-3">Services Table</h4>
            </div>
            <div class="card-body bg-that-more-light-than-black">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="col-1 text-center">ID</th>
                                <th class="col-3 text-center descServiceColumn">Description of Service</th>
                                <th class="col-2 text-center customerNameColumn">Customer Name</th>
                                <th class="col-2 text-center dateOfServiceColumn">Address</th>
                                <th class="col-2 text-center serviceCostColumn">Service Cost</th>
                                <th class="col-1 text-center">Payment Status</th>
                                <th class="col-1 text-center">Service Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($services) > 0)
                                @foreach ($services as $service)
                                    <tr>
                                        <td>#{{ $service->service_id}}</td>
                                        <td>{{ $service->service_description}}</td>
                                        <td>{{ $service->Customers->customer_name}}</td>
                                        <td class="text-center">{{ $service->Customers->customer_address}}</td>
                                        <td>Rp {{ number_format($service->service_cost, 0, ',','.') }}</td>
                                        @if ($service->service_payment_status == 0)
                                            <td class="text-center text-bold text-danger">UNPAID</td>
                                        @else
                                            <td class="text-center text-bold text-success">PAID</td>
                                        @endif
                                        <td class="text-left">
                                            @if ($service->service_status == 1)
                                                <a href="{{ route('teknisi_done_service', ['service_id' => $service->service_id]) }}" class="w-100"><button class="btn btn-success w-100">DONE</button></a>
                                            @else
                                                <a href="{{ route('teknisi_done_service', ['service_id' => $service->service_id]) }}" class="w-100"><button class="btn btn-danger w-100">UNDONE</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center text-danger py-4">NO SERVICE</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
