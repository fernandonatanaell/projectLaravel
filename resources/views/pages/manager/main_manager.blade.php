@extends("main")

@push("page_custom_css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('src/sb-admin/vendor/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    @stack('page_manager_custom_css')
@endpush

@section("content")
    @yield("content_manager")
@endsection

@push("page_custom_js")
    <!-- Data TABLE USER -->
    <script src="{{ asset('src/sb-admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('src/sb-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker();
        });
    </script>

    @stack('page_manager_custom_js')
@endpush


{{-- <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include("partials.sidebarManager")
        <!-- End of Sidebar -->

        <!-- Content Wrapper         -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="content pb-5">

                <!-- Topbar -->
                @include("partials.topbar")
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield("content")
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include("partials.footer")
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('src/sb-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('src/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('src/sb-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('src/sb-admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Data TABLE USER -->
    <script src="{{ asset('src/sb-admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('src/sb-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('src/sb-admin/js/demo/datatables-demo.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker();
        });
    </script>
</body>

</html> --}}

