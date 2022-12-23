@extends("main")

@push('page_custom_css')
    <link href="{{ asset('src/sb-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('src/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('src/master/items/table_item.css') }}">
@endpush

@section('name_page')
    Master Item
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="modalAddItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Add a new item</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('master_insert_item') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputNameItem">Name of Item</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputNameItem" name="name" placeholder="Enter the item name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputBrandItem">Item Brand</label>
                            <input type="text" class="form-control @error('brand') is-invalid @enderror" id="inputBrandItem" name="brand" placeholder="Enter the item brand" value="{{ old('brand') }}">
                            @error('brand')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputStockItem">Stock Item</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="inputStockItem" name="stock" placeholder="Enter stock item" value="{{ old('stock') }}">
                            @error('stock')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputItemPrice">Item Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="inputItemPrice" name="price" placeholder="Enter the item price" value="{{ old('price') }}">
                            @error('price')
                                <div class="invalid-feedback ml-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="customFile">Upload Image</label>
                            <input type="file" style="width: 99%;" class="form-control border-0 @error('image') is-invalid @enderror" id="customFile" name="image" value="{{ old('image') }}"/>
                            @error('image')
                                <span class="invalid-feedback ml-1" style="margin-left: 2.5%;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-template">Add item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card shadow mb-4 wrapper-datatables border-0">
            <div class="card-header py-3 border-0 bg-that-more-light-than-black d-flex justify-content-between">
                <h4 class="m-0 font-weight-bold mt-auto mb-auto mr-3">Items Table</h4>
                <button type="button" class="btn btn-template" data-toggle="modal" data-target="#modalAddItem">Add Item</button>
            </div>
            <div class="card-body bg-that-more-light-than-black">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="col-1 text-center">ID</th>
                                <th class="col-4 text-center">Name of Item</th>
                                <th class="col-2 text-center">Brand</th>
                                <th class="col-1 text-center">Stock</th>
                                <th class="col-2 text-center">Price</th>
                                <th class="col-1 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($items) > 0)
                                @foreach ($items as $item)
                                    <tr>
                                        <td>#{{ $item->item_id }}</td>
                                        <td class="nameColumn">{{ $item->item_name }}</td>
                                        <td>{{ $item->item_brand }}</td>
                                        <td class="text-right">{{ $item->item_stock }}</td>
                                        <td class="priceColumn">Rp {{ number_format($item->item_price, 0, ',','.') }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            @if ($item->deleted_at == null)
                                                <a href="{{ route('master_edit_item', ['item_id'=>$item->item_id]) }}"><button type="button" class="btn btn-template mr-md-2">EDIT</button></a>
                                                <a href="{{ route('master_delete_item', ['item_id'=>$item->item_id]) }}"><button type="button" class="btn btn-danger">DELETE</button></a>
                                            @else
                                                <a style="width: 100%" href="{{ route('master_restore_item', ['item_id'=>$item->item_id]) }}"><button type="button" class="btn btn-success" style="width: 100%">RESTORE</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center text-danger font-weight-bold py-4" colspan="6">NO ITEM</td>
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
