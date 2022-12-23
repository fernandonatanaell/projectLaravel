@extends("pages.owner.main_owner")

@section('name_page')
    Report (Monthly)
@endsection

@push('page_owner_custom_css')
    <style>
        ol {
            counter-reset: li;
            list-style: none;
            padding: 0;
            text-shadow: 0 1px 0 rgba(255,255,255,.5);
        }

        ol li {
            position: relative;
            display: block;
            padding: .4em .4em .4em 2em;
            margin: .5em 0;
            background: #111011;
            text-decoration: none;
            border-radius: .3em;
            transition: .3s ease-out;
        }

        ol li:hover {
            background: #484DB3;
        }

        ol li:hover:before {
            transform: rotate(360deg);
            background: #484DB3;
        }

        ol li:before {
            content: counter(li);
            counter-increment: li;
            position: absolute;
            left: -1.3em;
            top: 50%;
            margin-top: -1em;
            background: #6b6fc3;
            height: 2em;
            width: 2em;
            line-height: 1.6em;
            border: .3em solid #1f1f28;
            text-align: center;
            font-weight: bold;
            border-radius: 2em;
            transition: all .3s ease-out;
        }
    </style>
@endpush

@section('content_owner')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Filter -->
    <form action="{{ route('owner_report') }}" method="get" >
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4" >
                <div class="form-group">
                    <label for="inputDateService">Start Date</label>
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="inputDateService" name="start_date" placeholder="Enter the service date" value="{{ old('start_date', $start_date) }}">
                            @error('start_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4" >
                <div class="form-group">
                    <label for="inputDateService">End Date</label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="inputDateService" name="end_date" placeholder="Enter the service date" value="{{ old('end_date', $end_date) }}">
                    @error('end_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-2 mb-2 d-flex align-items-center" >
                <button type="submit" class="btn btn-template">Submit</button>
            </div>
        </div>
    </form>
        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 bg-that-more-light-than-black border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Earnings Service</div>
                                <div class="h5 mb-0 font-weight-bold color-white-high-emphasis">Rp {{ number_format($earningService, 0, ',','.')}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-that-more-light-than-black border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Number of services</div>
                                <div class="h5 mb-0 font-weight-bold color-white-high-emphasis">{{ $numberOfServices }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-wrench fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2 bg-that-more-light-than-black border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Earnings Store</div>
                                <div class="h5 mb-0 font-weight-bold color-white-high-emphasis">Rp {{ number_format($earningSales, 0, ',','.')}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2 bg-that-more-light-than-black border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Number of items sold</div>
                                <div class="h5 mb-0 font-weight-bold color-white-high-emphasis">{{ $numberOfSales }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-cubes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-6 col-sm-12">
                <div class="card shadow mb-4 bg-that-more-light-than-black border-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-that-more-light-than-black border-0">
                        <h6 class="m-0 font-weight-bold color-white-high-emphasis">Top 3 Customer</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body pt-0">
                        <ol class="color-white-high-emphasis mx-4">
                            @if (count($top3customer) > 0)
                                @foreach ($top3customer as $customer)
                                    <li>
                                        <div class="row">
                                            <div class="col-7">{{ $customer['customer_name'] }}</div>
                                            <div class="col-5 pr-4 text-success d-flex justify-content-end align-items-center">Rp {{ number_format($customer['total'], 0, ',','.') }}</div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <div class="d-flex justify-content-center text-danger">
                                    NO CUSTOMER
                                </div>
                            @endif
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-6 col-sm-12">
                <div class="card shadow mb-4 bg-that-more-light-than-black border-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-that-more-light-than-black border-0">
                        <h6 class="m-0 font-weight-bold color-white-high-emphasis">Top 3 Item</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body pt-0">
                        <ol class="color-white-high-emphasis mx-4">
                            @if (count($top3item) > 0)
                                @foreach ($top3item as $item)
                                    <li>
                                        <div class="row">
                                            <div class="col-9">{{ $item['item_name'] }}</div>
                                            <div class="col-3 pr-4 text-success d-flex justify-content-end align-items-center">{{ $item['total'] }}</div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <div class="d-flex justify-content-center text-danger">
                                    NO ITEM
                                </div>
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
