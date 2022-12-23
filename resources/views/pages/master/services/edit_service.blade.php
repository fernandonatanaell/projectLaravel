@extends("main")

@push('page_custom_css')
    <link rel="stylesheet" href="{{ asset('src/master/items/edit_item.css') }}">
@endpush

@section('name_page')
    Master Service
@endsection

@section('content')
    <div class="container bg-that-more-light-than-black p-4" style="width: 90%;">
        <h3 class="mb-4 color-white-high-emphasis">Form to edit service</h3>
        <form action="{{ route('master_update_service')}}" method="POST">
            @csrf
            <input type="hidden" name="service_id" value="{{ $service->service_id }}">
            <div class="form-group">
                <label for="inputNameCustomer">Customer</label>
                <select class="custom-select color-white-high-emphasis bg-content border-1 @error('customer') is-invalid @enderror" id="inputNameCustomer" name="customer">
                    @foreach ($customers as $customer)
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="{{ $customer->customer_id }}"
                        @if ($customer->customer_id == $service->Customers->customer_id) selected
                    @endif>{{ $customer->customer_name}}</option>
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
                <input type="text" class="form-control @error('description') is-invalid @enderror" id="inputServiceDescription" name="description" placeholder="Enter the service name"
                value="{{ old('description', $service->service_description ) }}">
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputDateService">Date of Service</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" id="inputDateService" name="date" placeholder="Enter the service date"
                value="{{ old('date', $service->service_date ) }}">
                @error('date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputItemPrice">Service Cost</label>
                <input type="number" class="form-control @error('cost') is-invalid @enderror" id="inputItemPrice" name="cost" placeholder="Enter the service cost"
                value="{{ old('cost', $service->service_cost ) }}">
                @error('cost')
                    <div class="invalid-feedback ml-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputNameFirstTechnician">Name of First Technician</label>
                <select class="custom-select color-white-high-emphasis bg-content border-1 @error('firstTech') is-invalid @enderror" id="inputNameFirstTechnician" name="firstTech">
                    @foreach ($teknisis as $teknisi)
                        <option class="bg-white-high-emphasis color-white-low-emphasis" value="{{ $teknisi->user_id }}"
                            @if ($teknisi->user_id == $service->Users->first()->user_id) selected
                            @endif>{{ $teknisi->user_name }}</option>
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
                <select class="custom-select color-white-high-emphasis bg-content border-1 @error('secondTech') is-invalid @enderror" id="inputNameSecondTechnician" name="secondTech">
                    @foreach ($teknisis as $teknisi)
                        <option class="bg-white-high-emphasis color-white-low-emphasis" value="{{ $teknisi->user_id }}"
                            @if ($teknisi->user_id == $service->Users->last()->user_id) selected
                            @endif>{{ $teknisi->user_name }}</option>
                    @endforeach
                </select>
                @error('secondTech')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-template mt-3 col-12 col-md-3">Update service</button>
            </div>
        </form>
    </div>
@endsection

@push('page_custom_js')
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
        checkDropdown("#inputNameSecondTechnician", "#inputNameFirstTechnician")

        $("#inputNameFirstTechnician").on("change", function() {
            checkDropdown("#inputNameFirstTechnician", "#inputNameSecondTechnician")
        });

        $("#inputNameSecondTechnician").on("change", function() {
            checkDropdown("#inputNameSecondTechnician", "#inputNameFirstTechnician")
        });
    </script>
@endpush
