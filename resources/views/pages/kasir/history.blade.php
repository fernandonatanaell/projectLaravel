@extends('main')

@push('page_custom_css')
    <link href="{{ asset('src/sb-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('src/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('src/kasir/history/history.css') }}">
@endpush

@section('name_page')
    History Store
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal" id="modalShowDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  bg-warning w-100" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <b id="exampleModalLabel"></b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0 pt-2">
                    <table class="table" id="detailTable">
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer pt-2 pr-4">
                    <h5><b id="totalHtransLabel"></b></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card shadow mb-4 wrapper-datatables border-0">
            <div class="card-header py-3 border-0 bg-that-more-light-than-black d-flex justify-content-between">
                <h4 class="m-0 font-weight-bold mt-auto mb-auto mr-3">History Transaction</h4>
            </div>
            <div class="card-body bg-that-more-light-than-black">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="col-1 text-center">ID</th>
                                <th class="col-2 text-center">Date</th>
                                <th class="col-3 text-center">Total</th>
                                <th class="col-3 text-center">Cashier</th>
                                <th class="col-2 text-center">Order ID</th>
                                <th class="col-1 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($historys) > 0)
                                @foreach ($historys as $history)
                                    <tr>
                                        <td class="historyIDColumn" data-toggle="modal" data-target="#modalShowDetail" data-id="{{ $history->htrans_id}}" data-total="{{ $history->htrans_total }}">#{{ $history->htrans_id }}</td>
                                        <td class="text-center dateColumn">{{ date('d M Y', strtotime($history->htrans_date))}} </td>
                                        <td class="totalColumn">Rp {{ number_format($history->htrans_total, 0, ',','.')}}</td>
                                        <td class="cashierNameColumn">{{ $history->Cashier->user_name }}</td>
                                        <td class="text-center midtransIDColumn">{{ $history->midtrans_id }}</td>
                                        <td class="actionColumn">
                                            <button type="button" class="btn btn-template w-100" onclick="window.open('{{ $history->midtrans_url}}')">OPEN MIDTRANS</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center text-danger py-4">NO TRANSACTION</td>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

        $(document).ready(function(){
            $('.historyIDColumn').click(function(){
                var id = $(this).data('id');
                var totalHtrans = $(this).data('total');
                $("#totalHtransLabel").html("Total : Rp " + new Intl.NumberFormat('en-ID', {style: 'currency', currency: 'IDR', minimumFractionDigits: 0}).format(totalHtrans).substring(4).replace(",", "."));

                // alert(id);
                $.ajax({
                    url:  'history/detail/' + id,
                    type: 'GET',
                    data: {
                        "id": id
                    },
                    success: function(response){
                        console.log(response);
                        var len = 0;

                        $('#detailTable tbody').empty(); // Empty <tbody>
                        if(response != null){
                            len = response.length;
                        }

                        if(len > 0){
                            for(var i=0; i<len; i++){
                                var id = response[i].id;
                                var item_id = response[i].item_name;
                                var dtrans_quantity = response[i].pivot.dtrans_quantity;
                                var dtrans_subtotal = new Intl.NumberFormat('en-ID', {style: 'currency', currency: 'IDR', minimumFractionDigits: 0}).format(response[i].pivot.dtrans_subtotal);

                                var tr_str = "<tr>" +
                                                "<td class='col-1 text-left text-weight-bold'>" + (i+1) + "</td>" +
                                                "<td class='col-5 text-left'>" + item_id + "</td>" +
                                                "<td class='col-2 text-center'>" + dtrans_quantity + "</td>" +
                                                "<td class='col-4 text-right'>Rp " + dtrans_subtotal.substring(4).replace(",", ".") + "</td>" +
                                            "</tr>";

                                $("#detailTable tbody").append(tr_str);
                                $("#exampleModalLabel").html("Detail transaction #" + response[i].pivot.htrans_id);
                            }
                        }else{
                            var tr_str = "<tr>" +
                                "<td align='center' colspan='12'>No record found.</td>" +
                            "</tr>";

                            $("#detailTable tbody").append(tr_str);
                        }
                    }
                });
            });
        });
    </script>
@endpush
