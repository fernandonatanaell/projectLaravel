@extends("main")

@push('page_custom_css')
    <link href="{{ asset('src/sb-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('src/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('src/master/services/table_service.css') }}">
@endpush

@section('name_page')
    Master Service
@endsection

@section('content')
    <!-- Modal tambah service -->
    <div class="modal fade" id="modalAddService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('master_insert_service') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="inputNameCustomer">Customer</label>
                            <select class="custom-select @error('customer') is-invalid @enderror" id="inputNameCustomer" name="customer">
                                <option hidden></option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->customer_id }}" {{ (old("customer") == $customer->customer_id ? "selected":"") }}>{{ $customer->customer_name}}</option>
                                @endforeach
                            </select>
                            @error('customer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputServiceDescription">Service Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="inputServiceDescription" name="description" placeholder="Enter the service name" value="{{ old('description') }}">
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputDateService">Date of Service</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="inputDateService" name="date" placeholder="Enter the service date" value="{{ old('date') }}">
                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputItemPrice">Service Cost</label>
                            <input type="number" class="form-control @error('cost') is-invalid @enderror" id="inputItemPrice" name="cost" placeholder="Enter the service cost" value="{{ old('cost') }}">
                            @error('cost')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputNameFirstTechnician">Name of First Technician</label>
                            <select class="custom-select @error('firstTech') is-invalid @enderror" id="inputNameFirstTechnician" name="firstTech">
                                <option hidden></option>
                                @foreach ($teknisis as $teknisi)
                                    <option value="{{ $teknisi->user_id }}" {{ (old("firstTech") == $teknisi->user_id ? "selected":"") }}>{{ $teknisi->user_name }}</option>
                                @endforeach
                            </select>
                            @error('firstTech')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputNameSecondTechnician">Name of Second Technician</label>
                            <select class="custom-select @error('secondTech') is-invalid @enderror" id="inputNameSecondTechnician" name="secondTech">
                                <option hidden></option>
                                @foreach ($teknisis as $teknisi)
                                    <option value="{{ $teknisi->user_id }}" {{ (old("secondTech") == $teknisi->user_id ? "selected":"") }}>{{ $teknisi->user_name }}</option>
                                @endforeach
                            </select>
                            @error('secondTech')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-template">Add new service</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card shadow mb-4 wrapper-datatables border-0">
            <div class="card-header py-3 border-0 bg-that-more-light-than-black d-flex justify-content-between">
                <h4 class="m-0 font-weight-bold mt-auto mb-auto mr-3">Services Table</h4>
                <button type="button" class="btn btn-template" data-toggle="modal" data-target="#modalAddService">Add Service</button>
            </div>
            <div class="card-body bg-that-more-light-than-black">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="col-1 text-center">ID</th>
                                <th class="col-2 text-center">Description of Service</th>
                                <th class="col-2 text-center">Cust. Name</th>
                                <th class="col-2 text-center">Address</th>
                                <th class="col-2 text-center">Service Cost</th>
                                <th class="col-2 text-center dateServiceColumn">Date of Service</th>
                                <th class="col-1 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($services) > 0)
                                @foreach ($services as $service)
                                    <tr>
                                        <td class="idColumn">#{{ $service->service_id}}</td>
                                        <td class="descriptionColumn">{{ $service->service_description}}</td>
                                        <td class="nameCustomerColumn">{{ $service->Customers->customer_name}}</td>
                                        <td class="addressCustomerColumn">{{ $service->Customers->customer_address}}</td>
                                        <td class="costColumn">Rp {{ number_format($service->service_cost, 0, ',','.')}}</td>
                                        <td class="text-center dateServiceColumn">{{ date('d M Y', strtotime($service->service_date))}}</td>
                                        <td>
                                            <div class="d-flex justify-content-between mb-2">
                                                @if ($service->service_payment_status == 1)
                                                    <a href="{{ route('master_paid_service', ['service_id'=>$service->service_id])}}" class="w-100"><button type="button" class="btn btn-success w-100">PAID</button></a>
                                                @else
                                                    <a href="{{ route('master_paid_service', ['service_id'=>$service->service_id])}}"><button type="button" class="btn btn-danger">UNPAID</button></a>
                                                @endif

                                                @if ($service->service_status == 0)
                                                    <a style="width: 100%" class="ml-2" href="{{ route('master_done_service', ['service_id'=>$service->service_id]) }}"><button class="btn btn-danger" style="width: 100%">UNDONE</button></a>
                                                @else
                                                    <a style="width: 100%" class="ml-2" href="{{ route('master_done_service', ['service_id'=>$service->service_id]) }}"><button class="btn btn-success" style="width: 100%">DONE</button></a>
                                                @endif
                                            </div>
                                            <a href="{{ route('master_edit_service', ['service_id'=>$service->service_id]) }}" class="w-100"><button class="btn btn-template w-100">EDIT</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center text-danger font-weight-bold py-4" colspan="7">NO SERVICE</td>
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
                $('#modalAddService').modal('show');
        </script>
    @endif

    <script>
        function checkDropdown($selectedName, $anotherName){
            let $boxval = $($selectedName).val();

            $($anotherName + " > option").each(function(ind) {
                let ele = $($anotherName + " > option").eq(ind);
                if (ele.val() === $boxval) ele.hide();
                else ele.show();
            });
        }

        checkDropdown("#inputNameFirstTechnician", "#inputNameSecondTechnician")

        $("#inputNameFirstTechnician").on("change", function() {
            checkDropdown("#inputNameFirstTechnician", "#inputNameSecondTechnician")
        });

        $("#inputNameSecondTechnician").on("change", function() {
            checkDropdown("#inputNameSecondTechnician", "#inputNameFirstTechnician")
        });
    </script>
@endpush
