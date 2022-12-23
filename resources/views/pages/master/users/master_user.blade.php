@extends("main")

@push('page_custom_css')
    <link href="{{ asset('src/sb-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('src/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('src/master/users/table_user.css') }}">
@endpush

@section('name_page')
    Master Users
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Add a new user</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('master_insert_user') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputFullname">Full Name</label>
                            <input type="text" id="inputFullname" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter full name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputUsername">Username</label>
                            <input type="text" id="inputUsername" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Enter username" value="{{ old('username') }}">
                            @error('username')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputConfirmPassword">Password</label>
                            <input type="password" id="inputConfirmPassword" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" value="{{ old('password') }}">
                            @error('password')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Confirm Password</label>
                            <input type="password" id="inputPassword" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter password again" value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputDOB">Date of Birth</label>
                            <input type="date" id="inputDOB" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob')}}">
                            @error('dob')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" id="inputAddress" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Enter address" value="{{ old('address')}}">
                            @error('address')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputMobileNumber">Phone Number</label>
                            <input type="number" id="inputMobileNumber" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="Enter phone number" value="{{ old('phone_number')}}">
                            @error('phone_number')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="selectSex">Sex</label>
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
                        <div class="form-group">
                            <label for="selectPosition">Position</label>
                            <select class="custom-select @error('role') is-invalid @enderror" id="selectPosition" name="role">
                                <option hidden></option>
                                <option value="0" {{ (old("role") == '0' ? "selected":"") }}>Owner</option>
                                <option value="1" {{ (old("role") == '1' ? "selected":"") }}>Manajer</option>
                                <option value="2" {{ (old("role") == '2' ? "selected":"") }}>Teknisi</option>
                                <option value="3" {{ (old("role") == '3' ? "selected":"") }}>Kasir</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-template">Add user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card shadow mb-4 wrapper-datatables border-0">
            <div class="card-header py-3 border-0 bg-that-more-light-than-black d-flex justify-content-between">
                <h4 class="m-0 font-weight-bold mt-auto mb-auto mr-3">Users Table</h4>
                <button type="button" class="btn btn-template" data-toggle="modal" data-target="#modalAddUser">Add User</button>
            </div>
            <div class="card-body bg-that-more-light-than-black">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="col-3 text-center">Full Name (Sex)</th>
                                <th class="col-2 text-center">Username</th>
                                <th class="col-2 text-center">DOB</th>
                                <th class="col-1 text-center">Position</th>
                                <th class="col-2 text-center">Hire Date</th>
                                <th class="col-1 text-center">Phone Num</th>
                                <th class="col-1 text-center">Status</th>
                                <th class="col-1 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) > 0)
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="fullnameColumn">{{ $user->user_name }} ({{ $user->user_jk }})</td>
                                        <td>{{ $user->user_username }}</td>
                                        <td class="dobColumn text-center">{{ date('d-m-Y', strtotime($user->user_dob)) }}</td>
                                        <td class="text-center">{{ UserHelper::getRole($user->user_role) }}</td>
                                        <td class="hireDateColumn text-center">{{ date('d M Y', strtotime($user->created_at))}}</td>
                                        <td class="text-center">{{ $user->user_phone_number }}</td>
                                        <td class="text-center">
                                            @if ($user->user_status == 1)
                                                <span class="text-success">Bekerja</span>
                                            @else
                                                <span class="text-danger">Dipecat</span>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-between">
                                            <a href="{{ url('owner/users/edit/'.$user->user_id) }}"><button class="btn btn-template btn_edit_user">EDIT</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center text-danger font-weight-bold py-4" colspan="7">NO USER</td>
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
                $('#modalAddUser').modal('show');
        </script>
    @endif
@endpush


