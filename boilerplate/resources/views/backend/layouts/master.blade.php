<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}" />
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'Default Description')">
        <meta name="author" content="@yield('author', 'Anthony Rappa')">
        @yield('meta')

        @yield('before-styles-end')
        {!! HTML::style(elixir('css/backend.css')) !!}
        @yield('after-styles-end')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        {{--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/bs/jqc-1.11.3,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.10,af-2.1.0,b-1.1.0,b-colvis-1.1.0,b-flash-1.1.0,b-html5-1.1.0,b-print-1.1.0,cr-1.3.0,fc-3.2.0,fh-3.1.0,kt-2.1.0,r-2.0.0,rr-1.1.0,sc-1.4.0,se-1.1.0/datatables.min.css"/>--}}
        <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"/>



    </head>
    <body class="skin-blue">
        <div class="wrapper">
          @include('backend.includes.header')
          @include('backend.includes.sidebar')

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              @yield('page-header')
              <ol class="breadcrumb">
                @yield('breadcrumbs')
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">
              @include('includes.partials.messages')
              @yield('content')
            </section><!-- /.content -->
          </div><!-- /.content-wrapper -->

          @include('backend.includes.footer')
        </div><!-- ./wrapper -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery-1.11.2.min.js')}}"><\/script>')</script>
        {!! HTML::script('js/vendor/bootstrap.min.js') !!}
        <script type="text/javascript" src="https://cdn.datatables.net/s/bs/jqc-1.11.3,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.10,af-2.1.0,b-1.1.0,b-colvis-1.1.0,b-flash-1.1.0,b-html5-1.1.0,b-print-1.1.0,cr-1.3.0,fc-3.2.0,fh-3.1.0,kt-2.1.0,r-2.0.0,rr-1.1.0,sc-1.4.0,se-1.1.0/datatables.min.js"></script>

        <script>
            jQuery(document).ready(function() {
                jQuery('#importinventorytable1').dataTable(
                        {
                            "dom": '<"top">rt<"row"<"col-md-6"i><"col-md-6"p>><"clear">'
                        }
                );
                jQuery('#importinventorytable2').dataTable({
                    "dom": '<"top">rt<"row"<"col-md-6"i><"col-md-6"p>><"clear">'
                });


                jQuery('#printlabelinvoicetable').dataTable();

                jQuery('#todaysfinaltable1').dataTable({
                    "dom": '<"top"l>rt<"row"<"col-md-6"i><"col-md-6"p>><"clear">'
                });

                jQuery('#todaysfinaltable2').dataTable({
                    "dom": '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>><"clear">',
                    language: {
                        searchPlaceholder: "SKU/S. Code/S.P. Name"
                    },
                    "aaSorting": [[ 2, "desc" ]]

                });

                jQuery('#transitordertable1').dataTable({
                    "dom": '<"top">rt<"row"<"col-md-6"i><"col-md-6"p>><"clear">'
                });

                jQuery('#transitordertable2').dataTable({
                    "dom": '<"top">rt<"row"<"col-md-6"i><"col-md-6"p>><"clear">'
                });
              jQuery("input[type=radio][name=InvoiceAction]").click(function() {
                    var value = $(this).val();
                    alert(value);
                });
                var oTable = jQuery('#todaysfinaltable2').DataTable();
                jQuery('#todaysfinalordersearch').on("keyup search input paste cut", function () {
                    oTable.search($(this).val()).draw();
                });
                var oTableshipment = jQuery('#orderandshipmenttable').DataTable();
                jQuery('#orderandshipmentbyorder').on("keyup search input paste cut", function () {
                    oTableshipment.search($(this).val()).draw();
                });
                jQuery('#orderandshipmentamazon').on("keyup search input paste cut", function () {
                    oTableshipment.search($(this).val()).draw();
                });
                jQuery('.addabove').click(function () {
                    var names=$(this).attr("name");
                    console.log(names);
                    var string='tbody #'+names;
                    console.log(string);
                    last14days = $('#todaysfinaltable2').dataTable();
                    todaysfinal = $('#todaysfinaltable1').dataTable();
                    last14days.$(string).each(function() {

                        var userData = last14days.fnGetData(this);
                        userData[7]="<button class='removebtn' id="+names+">Remove</button>";
                        userData[6]="calculate it";

                        var rowindex=todaysfinal.fnAddData([
                            userData[0],
                            userData[1],
                            userData[2],
                            userData[3],
                            userData[4],
                            userData[5],
                            userData[6],
                            userData[7]

                        ]);
                        var row =todaysfinal.fnGetNodes(rowindex);
                        $(row).attr( 'id', names );

//                                $('#groupMembersTable tbody tr').each(function() {
//                                    var cells = $(this).find('td');
//                                    if ($(cells[2]).html() === userData[2]) {
//                                        $(this).find("input").attr("name", "addRow[]");
//                                    }
//                                });
                        last14days.fnDeleteRow(this);
                    } ) ;
                });
                jQuery('.removebtn').click(function () {
                    var names=$(this).attr("name");
                    console.log(names);
                    var string='tbody #'+names;
                    console.log(string);
                    todaysfinal = $('#todaysfinaltable1').dataTable();
                    last14days = $('#todaysfinaltable2').dataTable();
                    todaysfinal.$(string).each(function() {

                        var userData = todaysfinal.fnGetData(this);
                        userData[6]="<button class='addabove' id="+names+">Add above</button>";

                        last14days.fnAddData([
                            userData[0],
                            userData[1],
                            userData[2],
                            userData[3],
                            userData[4],
                            userData[5],
                            userData[6]

                        ]);

//                                $('#groupMembersTable tbody tr').each(function() {
//                                    var cells = $(this).find('td');
//                                    if ($(cells[2]).html() === userData[2]) {
//                                        $(this).find("input").attr("name", "addRow[]");
//                                    }
//                                });
                        var row =last14days.fnGetNodes(rowindex);
                        $(row).attr( 'id', names );

                        todaysfinal.fnDeleteRow(this);
                    } ) ;
                });

            });

                    $(function() {
                        $("#example2").dataTable();
                        $('#example1').dataTable({
                            "bPaginate": true,
                            "bLengthChange": false,
                            "bFilter": false,
                            "bSort": true,
                            "bInfo": true,
                            "bAutoWidth": false
                        });
                    });





        </script>

        @yield('before-scripts-end')
        {!! HTML::script(elixir('js/backend.js')) !!}




        @yield('after-scripts-end')
    </body>
</html>
