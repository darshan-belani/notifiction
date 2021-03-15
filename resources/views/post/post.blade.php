@extends('layouts.adminHeader')

@section('content')
    <div class="container body">
        <div class="main_container">
            <!-- page content -->
            <div class="right_col" role="main">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <a class="close" data-dismiss="alert">×</a>
                        <strong>{!!Session::get('success')!!} </strong>
                    </div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-error">
                        <a class="close" data-dismiss="alert">×</a>
                        <strong>{!!Session::get('error')!!} </strong>
                    </div>
                @endif
                <div class="">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel" style="height: 55px;">
                                <h3 align="center" style="font-weight: bold">Posts</h3>
                                    <div class="col-md-12" align="right">
                                        <a href="{{url('/admin/posts/add')}}" class="btn black custom-filter-submit"
                                           style="margin: -75px 0px 0px 0px;color: #000 !important;border-radius: 5px;background-color: #00b3ee;">
                                            Add
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- /page content -->
                    <!-- page content -->
                    <div class="">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <table id="post_table" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Post Title</th>
                                            <th>Post Description</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->
            </div>
         </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    <script>
        // $(document).on('click', "#search_cloth_item", function () {
        $(function () {
            var postTable = $('#post_table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    "url": "{{ url('/admin/getAllPost') }}",
                    "type": "GET",
                    dataType: "json",
                    data: function (data) {
                        //  data.client_name = $("#client_name").val();*/
                    }
                },
                drawCallback: function () {
                    $("#dataListLoader .widget-loader").hide();
                    $(".wz-datatable td .tooltips").tooltip();
                },
                columns: [
                    {"data": 'DT_RowIndex'},
                    {data: 'name'},
                    {data: 'description'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            /* Reset Client List Data */
            $("#reset").click(function () {
                $("input[type=text], textarea").val("");
                $('#order_table').DataTable().ajax.reload();
            });
        });
        // });
        $("document").ready(function(){
            $(".alert").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert").slideUp(500);
            });
        });
    </script>
@endsection

