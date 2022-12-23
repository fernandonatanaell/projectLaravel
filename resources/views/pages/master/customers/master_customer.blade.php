@extends("main")

@push('page_custom_css')
    <link href="{{ asset('src/sb-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('src/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('src/master/customers/table_customer.css') }}">
@endpush

@section('name_page')
    Master Customer
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="modalAddItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Add a new customer</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('master_insert_customer') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputNameItem">Customer Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputNameItem" name="name" placeholder="Enter customer name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputBrandItem">Customer Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputBrandItem" name="email" placeholder="Enter customer email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputStockItem">Customer Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="inputStockItem" name="address" placeholder="Enter customer address" value="{{ old('address') }}">
                            @error('address')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputItemPrice">Customer Phone Number</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="inputItemPrice" name="phone_number" placeholder="Enter customer phone number" value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="selectSex">Customer Sex</label>
                            <select class="custom-select @error('jk') is-invalid @enderror" id="selectSex" name="jk">
                                <option hidden></option>
                                <option value="L" {{ (old("jk") == 'L' ? "selected":"") }}>Laki-laki</option>
                                <option value="P" {{ (old("jk") == 'P' ? "selected":"") }}>Perempuan</option>
                            </select>
                            @error('jk')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-template">Add Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card shadow mb-4 wrapper-datatables border-0">
            <div class="card-header py-3 border-0 bg-that-more-light-than-black d-flex justify-content-between">
                <h4 class="m-0 font-weight-bold mt-auto mb-auto mr-3">Customers Table</h4>
                <button type="button" class="btn btn-template" data-toggle="modal" data-target="#modalAddItem">Add Customer</button>
            </div>
            <div class="card-body bg-that-more-light-than-black">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="col-1 text-center">ID</th>
                                <th class="col-4 text-center">Full Name (Sex)</th>
                                <th class="col-2 text-center">Email</th>
                                <th class="col-3 text-center">Address</th>
                                <th class="col-1 text-center">Phone Number</th>
                                <th class="col-1 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($customers) > 0)
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>#{{ $customer->customer_id }}</td>
                                        <td class="nameColumn">{{ $customer->customer_name }} ({{ $customer->customer_jk }})</td>
                                        <td>{{ $customer->customer_email }}</td>
                                        <td class="addressColumn">{{ $customer->customer_address }}</td>
                                        <td>{{ $customer->customer_phone_number }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            @if ($customer->deleted_at == null)
                                                <a href="{{ route('master_edit_customer', ['customer_id'=>$customer->customer_id]) }}"><button type="button" class="btn btn-template mr-md-2">EDIT</button></a>
                                                <a href="{{ route('master_delete_customer', ['customer_id'=>$customer->customer_id]) }}"><button type="button" class="btn btn-danger">DELETE</button></a>
                                            @else
                                                <a style="width: 100%" href="{{ route('master_restore_customer', ['customer_id'=>$customer->customer_id]) }}"><button type="button" class="btn btn-success" style="width: 100%">RESTORE</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center text-danger font-weight-bold py-4" colspan="6">NO CUSTOMER</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_custom_js')
    @if (count($errors) > 0)
        <script type="text/javascript">
                $('#modalAddItem').modal('show');
        </script>
    @endif
@endpush
