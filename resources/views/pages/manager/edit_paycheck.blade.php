@extends("pages.manager.main_manager")

@push('page_manager_custom_css')
    <link rel="stylesheet" href="{{ asset('src/master/items/edit_item.css') }}">
    <link rel="stylesheet" href="{{ asset('src/manajer/edit_paycheck.css') }}">
@endpush

@section('name_page')
    Paycheck
@endsection

@section('content_manager')
    <div class="container bg-that-more-light-than-black p-4" style="width: 90%;">
        <h3 class="mb-4 color-white-high-emphasis">Form to edit paycheck</h3>
        <p class="text-justify mb-4">
            Kepada PNS yang beristri / bersuami diberikan tunjangan istri / suami sebesar 5% dari gaji pokok. Dan kepada
            anak / anak angkat (maksimal sampai anak ke-3) yang berusia kurang dari 18 tahun, belum pernah kawin, tidak
            mempunyai penghasilan sendiri, diberikan tunjangan anak sebesar 2% dari gaji pokok untuk tiap-tiap anak.
        </p>
        <div class="wrapper-profile row mb-4">
            <div class="col-12 col-lg-3 d-flex justify-content-center align-items-center">
                @if ($user->user_jk == 'L')
                    <img class="img-profile rounded-circle imgAja"
                    src="{{ asset('src/sb-admin/img/undraw_profile.svg') }}">
                @else
                    <img class="img-profile rounded-circle imgAja"
                    src="{{ asset('src/sb-admin/img/undraw_profile_3.svg') }}">
                @endif
            </div>
            <div class="col-12 col-lg-9 pl-3 pl-lg-4 d-flex align-items-center">
                <table width="100%" cellspacing="0">
                    <tr>
                        <td class="col-3"><b>Name</b></td>
                        <td class="color-white-high-emphasis">{{ $user->user_name }}</td>
                    </tr>
                    <tr >
                        <td class="col-3"><b>Username</b></td>
                        <td class="color-white-high-emphasis">{{ $user->user_username }}</td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>Address</b></td>
                        <td class="color-white-high-emphasis">{{ $user->user_address }}</td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>Phone Number</b></td>
                        <td class="color-white-high-emphasis">{{ $user->user_phone_number }}</td>
                    </tr>
                    <tr>
                        <td class="col-3"><b>Position</b></td>
                        <td class="color-white-high-emphasis">{{ UserHelper::getRole($user->user_role) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <form action="{{ route('manager_update_paycheck') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="inputBaseSalary">Base Salary</label>
                <input type="number" class="form-control bg-content border-1 ml-2" id="inputBaseSalary" name="price" placeholder="Enter the base salary" min="1000" value="0" required>
            </div>
            <div class="form-group">
                <label for="selectMarriageStatus">Marriage Status</label>
                <select id="selectMarriageStatus" class="custom-select color-white-high-emphasis bg-content border-1 ml-2 @error('marriageStatus') is-invalid @enderror" name="marriageStatus">
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="belum_menikah">Belum Menikah</option>
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="menikah">Sudah Menikah</option>
                </select>
                @error('marriageStatus')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="selectTotalKids">Total Kids</label>
                <select id="selectTotalKids" class="custom-select color-white-high-emphasis bg-content border-1 ml-2 @error('totalKids') is-invalid @enderror" name="totalKids">
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="0">0</option>
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="1">1</option>
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="2">2</option>
                    <option class="bg-white-high-emphasis color-white-low-emphasis" value="3">>= 3</option>
                </select>
                @error('totalKids')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-md-flex justify-content-md-between">
                <input type="hidden" name="user_id" id="" value="{{ $user->user_id }}">
                <input type="hidden" name="finalSalary" id="inputFinalSalary" value="{{ $user->user_salary }}">

                <div class="mt-2 col-12 col-md-7 col-lg-9">Final Salary<br><b class="color-white-high-emphasis font-weight-bold" id="finalSalary">Rp 0</b></div>
                <button type="submit" class="btn btn-template mt-3 col-12 col-md-5 col-lg-3">Update paycheck</button>
            </div>
        </form>
    </div>
@endsection

@push('page_manager_custom_js')
    <script>
        $("input").change(function(){
            hello();
        });
        $("select").change(function(){
            hello();
        });

        function hello(){
            $base_salary = parseInt($("#inputBaseSalary").val());
            $marriage_status = $("#selectMarriageStatus").val();
            $total_kids = $("#selectTotalKids").val();
            $total_tunjangan = 0;

            if($marriage_status == "menikah"){
                $total_tunjangan += ($base_salary * 5)/100;
            }

            $total_tunjangan += ($base_salary * (2 * parseInt($total_kids)))/100;
            $total_akhir = $base_salary + $total_tunjangan;

            $("#inputFinalSalary").val($total_akhir)
            $("#finalSalary").html("Rp " + $total_akhir.toLocaleString('id-ID'));
        }
    </script>
@endpush
