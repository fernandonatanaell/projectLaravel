@extends("main")

@push('page_custom_css')
    <link rel="stylesheet" href="{{ asset('src/master/items/edit_item.css') }}">
@endpush

@section('name_page')
    Master User
@endsection

@section('content')
    <div class="container bg-that-more-light-than-black p-4" style="width: 90%;">
        <h3 class="mb-4 color-white-high-emphasis">Form to edit user data</h3>
        <form action="{{ url('owner/users/edit/'.$user->user_id) }}" method="POST">
            @csrf
            <input type="hidden" name="old_username" value="{{ $user->user_username }}">
            
            <div class="form-group">
                <label for="inputFullname">Full Name</label>
                <input type="text" id="inputFullname" name="name" class="form-control bg-content border-1 ml-2 @error('name') is-invalid @enderror" placeholder="Enter full name" value="{{ old('name', $user->user_name ) }}">
                @error('name')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputUsername">Username</label>
                <input type="text" id="inputUsername" name="username" class="form-control bg-content border-1 ml-2 @error('username') is-invalid @enderror" placeholder="Enter username" value="{{ old('username', $user->user_username ) }}">
                @error('username')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="selectDOB">Date of Birth</label>
                <div class="input-group date" id="datepicker">
                    <input type="date" id="selectDOB" class="form-control  border-1 ml-2 @error('dob') is-invalid @enderror" name="dob" placeholder="Select date of birth" value="{{ old('dob', $user->user_dob ) }}">
                </div>
                @error('dob')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" id="inputAddress" class="form-control bg-content border-1 ml-2 @error('address') is-invalid @enderror" name="address" placeholder="Enter address" value="{{ old('address', $user->user_address ) }}">
                @error('address')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputPhoneNumber">Phone Number</label>
                <input type="number" id="inputPhoneNumber" class="form-control bg-content border-1 ml-2 @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="Enter phone number" value="{{ old('phone_number', $user->user_phone_number ) }}">
                @error('phone_number')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="selectSex">Sex</label>
                <select id="selectSex" class="custom-select color-white-high-emphasis bg-content border-1 ml-2 @error('jk') is-invalid @enderror" name="jk">
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="L" {{ (old("jk", $user->user_jk) == 'L' ? "selected":"") }}>Laki-laki</option>
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="P" {{ (old("jk", $user->user_jk) == 'P' ? "selected":"") }}>Perempuan</option>
                </select>
                @error('jk')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for= "selectPosition">Position</label>
                <select id="selectPosition" class="custom-select color-white-high-emphasis bg-content border-1 ml-2 @error('role') is-invalid @enderror" name="role">
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="0" {{ (old("role", $user->user_role) == '0' ? "selected":"") }}>Owner</option>
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="1" {{ (old("role", $user->user_role) == '1' ? "selected":"") }}>Manajer</option>
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="2" {{ (old("role", $user->user_role) == '2' ? "selected":"") }}>Teknisi</option>
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="3" {{ (old("role", $user->user_role) == '3' ? "selected":"") }}>Kasir</option>
                </select>
                @error('role')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <h4 class="mt-5 color-white-high-emphasis">Change Password</h4>

            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control bg-content border-1 ml-2 @error('password') is-invalid @enderror" placeholder="Enter password">
                @error('password')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputPassword">Confirm Password</label>
                <input type="password" id="inputPassword" name="password_confirmation" class="form-control bg-content border-1 ml-2 @error('password_confirmation') is-invalid @enderror" placeholder="Enter password again">
                @error('password_confirmation')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-md-flex justify-content-between mt-5">
                <button type="submit" class="btn @if ($user->user_status == 0)
                    btn-template
                    @else
                    btn-danger
                @endif  mt-3 col-12 col-md-3" name="fired">@if ($user->user_status == 0)
                    Rehire
                    @else
                    Fired
                @endif</button>
                <button type="submit" class="btn btn-template mt-3 col-12 col-md-3" name="edit">Edit User</button>
            </div>
        </form>
    </div>
@endsection
