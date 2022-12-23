@extends("pages.manager.main_manager")

@push('page_manager_custom_css')
    <link href="{{ asset('src/sb-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('src/datatables/datatables.css') }}">
@endpush

@section('name_page')
    Paycheck
@endsection

@section('content_manager')
    <div class="container-fluid">
        <div class="card shadow mb-4 wrapper-datatables border-0">
            <div class="card-body bg-that-more-light-than-black">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="col-4 text-center">Full Name</th>
                                <th class="col-2 text-center">Username</th>
                                <th class="col-2 text-center">Gender</th>
                                <th class="col-1 text-center">Position</th>
                                <th class="col-2 text-center">Salary</th>
                                <th class="col-1 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->user_name }}</td>
                                    <td>{{ $user->user_username }}</td>
                                    <td class="text-center">
                                        @if ($user->user_jk == 'L')
                                            Laki-laki
                                        @else
                                            Perempuan
                                        @endif
                                    </td>
                                    <td class="text-center">{{ UserHelper::getRole($user->user_role) }}</td>
                                    <td>Rp {{ number_format($user->user_salary, 0, ',','.') }}</td>
                                    <td>
                                        <a href="{{ route('manager_edit_paycheck', ['user_id'=>$user->user_id]) }}"><button class="btn btn-template">EDIT</button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
