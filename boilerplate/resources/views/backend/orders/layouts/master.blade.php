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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/bs/jqc-1.11.3,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.10,af-2.1.0,b-1.1.0,b-colvis-1.1.0,b-flash-1.1.0,b-html5-1.1.0,b-print-1.1.0,cr-1.3.0,fc-3.2.0,fh-3.1.0,kt-2.1.0,r-2.0.0,rr-1.1.0,sc-1.4.0,se-1.1.0/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"/>
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>



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
                var importinventorytable1;
                $.fn.exists = function(callback) {
                    var args = [].slice.call(arguments, 1);

                    if (this.length) {
                        callback.call(this, args);
                    }

                    return this;
                };

// Usage


                var i = 1;
                $.fn.dataTable.Api.register('column().data().sum()', function () {
                    return this.reduce(function (a, b) {
                        var x = parseFloat(a) || 0;
                        var y = parseFloat(b) || 0;
                        return x + y;
                    });
                });
                $('#importtable1addnew').on( 'click', function () {
                    var token = $('input[name="_token"]').val();
                    $.ajax({

                        url: "{!! \Illuminate\Support\Facades\URL::route('add-row') !!}",
                        type: "post",
                        data: {
                            _token: token
                        },
                        success: function (data) {
                            var len = data.length;
                            console.log(len);
                            var output = "<select class='impselectedattributemagento'>";
                            output +="<option selected>Select MAGENTO Attribute</option>";
                            for (var i = 0; i < len; i++) {
                                output += "<option>" + data[i] + "</option>";
                            }
                            output += "</select>";
                            importinventorytable1.row.add([
                                123,
                                output,
                                'double tap to enter supplier attribute',
                                "<button class='btn btn-primary imptable1remove'>Remove</button>"
                            ]).draw(false);
                            toastr.success('new row added', 'success');
                        }
                    });
                });
				/*vikas*/
				$(".add-new-product-magento").on('click',function(e){
					var id = $(this).attr('row_id');
					var token = jQuery('#updateinventory').find('[name=_token]').val();
					jQuery('body').mask("");
					$.ajax({
						url: "{!! \Illuminate\Support\Facades\URL::route('addProductToMage') !!}",
						type: "post",
						async: false,
						dataType: 'json',
						data: {
							_token: token,
							rowid: id
						},
						success: function (response) {
							jQuery('body').unmask();
						   if(response.data){
							   toastr.success(response.msg, 'success');
						   }else{
							   toastr.error(response.msg, 'error');
						   }
						}

					});
				});
				/*end*/
                function importinventory1(){

                importinventorytable1 = jQuery('#importinventorytable1').DataTable(

                        {
                            data: importinventory1data(),
                            "dom": '<"top">rt<"row"<"col-md-6"i><"col-md-6"p>><"clear">',
                            "columnDefs": [
                                {className: "impmagentoattr", "targets": [1]},
                                {className: "impsupplierattr", "targets": [2]}

                            ],
                            "footerCallback": function (row, data, start, end, display) {
                                var api = this.api(), data;
                                importtable();
                            }
                        }
                );
                function importinventory1data(){
                    var supplier_id = $('#importtableselectsupp option:selected').attr('data-supplier_id');
                    var token = $('input[name="_token"]').val();
                    var ajaxdata;

                    $.ajax({
                        url: "{!! \Illuminate\Support\Facades\URL::route('importinventory1data') !!}",
                        type: "post",
                        async: false,
                        dataType: 'json',
                        data: {
                            _token: token,
                            supplier_id: supplier_id
                        },
                        success: function (data) {
                            ajaxdata= data;
                        }

                    });
                    return ajaxdata;

                }
                }
                $('#importinventorytable1').exists(function() {
                    importinventory1();
                });
                jQuery('#importtableselectsupp').change(function(){
                    var minimum_value = $('#importtableselectsupp option:selected').attr('data-minimumvalue');
                    var total_products = $('#importtableselectsupp option:selected').attr('data-total_products');
                    var new_products = $('#importtableselectsupp option:selected').attr('data-new_products');
                    var zero_inventory_products = $('#importtableselectsupp option:selected').attr('data-zero_inventory_products');
                    var updated_products = $('#importtableselectsupp option:selected').attr('data-updated_products');
                    jQuery('.mimimum_value').html(minimum_value+"  <i class='fa fa-gbp'></i>");
                    jQuery('.total_product').html(total_products);
                    jQuery('.update_product').html(updated_products);
                    jQuery('.new_product').html(new_products);
                    jQuery('.zero_inventory').html(zero_inventory_products);
                    importinventory1();
                });
                function importtable(){
                    var minimum_value = $('#importtableselectsupp option:selected').attr('data-minimumvalue');
                    var total_products = $('#importtableselectsupp option:selected').attr('data-total_products');
                    var new_products = $('#importtableselectsupp option:selected').attr('data-new_products');
                    var zero_inventory_products = $('#importtableselectsupp option:selected').attr('data-zero_inventory_products');
                    var updated_products = $('#importtableselectsupp option:selected').attr('data-updated_products');
                    jQuery('.mimimum_value').html(minimum_value+"  <i class='fa fa-gbp'></i>");
                    jQuery('.total_product').html(total_products);
                    jQuery('.update_product').html(updated_products);
                    jQuery('.new_product').html(new_products);
                    jQuery('.zero_inventory').html(zero_inventory_products);
                }
//                jQuery('#importinventorytable1').on('dblclick', 'td.impmagentoattr', function () {
//                    var text = $(this).text();
//                    $(this).text('');
//                    $('<input type="text" class="impmagentoattr" />').appendTo($(this)).val(text).select().blur(
//                            function () {
//                                var newText = $(this).val();
//                                $(this).parent().text(newText).find('input[type=text]').remove();
//                            });
//                });
                jQuery('#importinventorytable1').on('dblclick', 'td.impsupplierattr', function () {
                    var text = $(this).text();
                    var test= $(this);
                    $(this).text('');
                    var newText;
                    $('<input type="text" class="impsupplierattr" />').appendTo($(this)).val(text).select().blur(
                            function () {
                                newText = $(this).val();
                                $(this).parent().text(newText).find('input[type=text]').remove();
                                var row_index =importinventorytable1.row( $(test).parents('tr' )).index();
                                var userData = importinventorytable1.row($(test).parents('tr')).data();
                                importinventorytable1.row($(test).parents('tr')).remove();
                                userData[2]=newText;
                                var currentRows = importinventorytable1.data().toArray();  // current table data
                                currentRows.splice(row_index, 0, userData);
                                importinventorytable1.clear();
                                importinventorytable1.rows.add(currentRows);
                                importinventorytable1.draw();
                            });

                });
              jQuery('#importinventorytable1').on('change','.impselectedattributemagento',function(){
                    var select= $('option:selected', this).val();
                  //var test= $(this);
                  console.log($(this));
                  var row_index =importinventorytable1.row( $(this).parents('tr')).index();
                //  console.log(row_index);
                  var userData = importinventorytable1.row($(this).parents('tr')).data();
                  importinventorytable1.row($(this).parents('tr')).remove();
                  $(this).parent().text(select).find('select').remove();
                  userData[1]=select;
                  console.log(userData[1]);
                  var currentRows = importinventorytable1.data().toArray();  // current table data
                  currentRows.splice(row_index, 0, userData);
                  importinventorytable1.clear();
                  importinventorytable1.rows.add(currentRows);
                  importinventorytable1.draw();
                });
                jQuery('#todaysfinaltable1').on('dblclick', 'td.quanity_of_item', function () {
                    var text = $(this).text();
                    $(this).text('');
                    $('<input type="number" class="quanity_of_item" min="1"/>').appendTo($(this)).val(text).select().blur(
                            function () {
                                var newText = $(this).val();
                                $(this).parent().text(newText).find('input[type=text]').remove();
                            });
                });
                jQuery('#transitordertable1').on('dblclick', 'td.tor_ordered_quantity', function () {
                    var text = $(this).text();
                    $(this).text('');
                    $('<input type="number" class="tor_ordered_quantitys" min="1"/>').appendTo($(this)).val(text).select().blur(
                            function () {
                                var newText = $(this).val();
                                $(this).parent().text(newText).find('input[type=text]').remove();
                            });
                });
                function newproductdata(){
                    var supplier_id = $('#importtableselectsupp option:selected').attr('data-supplier_id');
                    var token = $('input[name="_token"]').val();
                    var ajaxData;
                    $.ajax({
                        url: "{!! \Illuminate\Support\Facades\URL::route('imptable2') !!}",
                        type: "post",
                        async: false,
                        dataType: 'json',
                        data: {
                            _token: token,
                            supplier_id: supplier_id
                        },
                        success: function (data) {
                            ajaxData = data;
                            console.log(ajaxData)
                        }

                    });
                   // return ajaxData;
                }
                newproductdata();
                jQuery('#importinventorytable2').DataTable({
                    "dom": '<"top">rt<"row"<"col-md-6"i><"col-md-6"p>><"clear">'
                });
                var total_exp_search, total_value_search,todayfinancesum;
                var orderandshipmenttable = jQuery('#orderandshipmenttable').DataTable({
                    "dom": '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>><"clear">',
                    language: {searchPlaceholder: "#Order/SKU/Amazon/eBay/Customer Name"},
                    "columnDefs": [
                        {className: "ordershipment_serial", "targets":[2],'searchable': false,
                            'orderable': false},
                        {className: "total_exp", "targets": [13]},
                        {className: "total_val", "targets": [15]},
                        {className: "is_remove", "sWidth": "10px", "targets": [16]},
                        {className: "is_refunded", "sWidth": "10px", "targets": [17]}

                    ],
                    "footerCallback": function (row, data, start, end, display) {
                        var api = this.api(), data;
                        // Remove the formatting to get integer data for summation
                        var intVal = function (i) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                        };
                        total_exp_search = api.column(13, {'search': 'applied'}).data().reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        total_value_search = api.column(15, {'search': 'applied'}).data().reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        total_exp_search = parseFloat(total_exp_search);
                        total_value_search = parseFloat(total_value_search);
                        total_saving = total_value_search - total_exp_search;
                        // Update footer
                        $('.total_expense').html(total_exp_search.toFixed(2) + "  <i class='fa fa-gbp'></i>");
                        $('.total_value').html(total_value_search.toFixed(2) + "  <i class='fa fa-gbp'></i>");
                        $('.total_saving').html(total_saving.toFixed(2) + "  <i class='fa fa-gbp'></i>");
                        totalCalculation(this);
                    }
                });
                var printlabelinvoicetable = jQuery('#printlabelinvoice').DataTable({
                    "dom": '<"top"l>rt<"row"<"col-md-6"i><"col-md-6"p>><"clear">',
                    "aaSorting": [[ 2, "desc" ]]
                });





                var todaysfinaltable1;
                function todaysfinal(){
                function gettodaytabledata() {
                    var supplierid = $('#todaysfinalselectsupp option:selected').attr('data-supplierid');
                    var token = $('input[name="_token"]').val();
                        var ajaxData;
                       $.ajax({
                            url: "{!! \Illuminate\Support\Facades\URL::route('gettodaytable1') !!}",
                            type: "post",
                            async: false,
                            dataType: 'json',
                            data: {
                                _token: token,
                                supplier_id: supplierid
                            },
                            success: function (data) {
                                ajaxData = data;
                            }

                        });
                        return ajaxData;

                }

                // console.log(gettodaytabledata());

                   todaysfinaltable1 = jQuery('#todaysfinaltable1').DataTable({
                    "bDestroy": true,
                    data: gettodaytabledata(),
                    "dom": '<"top"l>rt<"row"<"col-md-6"i><"col-md-6"p>><"clear">',
                    "columnDefs": [
                        {className: "item_serial", "targets": [1]},
                        {className: "supp_product_name", "targets":[2] },
                        {className: "quanity_of_item", "targets": [3]},
                        {className: "product_id","targets":[4]},
                        {className: "sku","targets":[5]},
                        {className: "supplier_code","targets":[6]},
                        {className: "supplier_price", "targets": [7]},
                        {className: "sub_total", "targets": [8]},
                        {className: "vat_price", "targets": [9]}
                    ],
                    "footerCallback": function (row, data, start, end, display) {
                        var api = this.api(), data;
                        // Remove the formatting to get integer data for summation
                        var intVal = function (i) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                        };
                        // total_salary over all pages
                        total_sub_total = api.column(8).data().reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        total_vat_total = api.column(9).data().reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        total_sub_total = parseFloat(total_sub_total);
                        total_vat_total = parseFloat(total_vat_total);
                        finance_sum = total_sub_total + total_vat_total;
                        todayfinancesum=finance_sum;
                        // Update footer
                        $('.sub_totals').html(total_sub_total.toFixed(2) + "  <i class='fa fa-gbp'></i>");
                        $('.vat_total').html(total_vat_total.toFixed(2) + "  <i class='fa fa-gbp'></i>");
                        $('.finance_summ').html(finance_sum.toFixed(2) + "  <i class='fa fa-gbp'></i>");
                        selectedsupplier();
                    }
                });
            }
                $('#todaysfinaltable1').exists(function() {
                    todaysfinal();
                    lastndaysfinal();
                });

                jQuery('#todaysfinalselectsupp').change(function(){
                    var minimumvalue = $('option:selected', this).attr('data-minimumvalue');
                    var supplierid = $('option:selected', this).attr('data-supplierid');
                    jQuery('.todaysminimumvalue').html(minimumvalue+"  <i class='fa fa-gbp'></i>");
                    todaysfinal();
                });
                jQuery('#todaysfinalselectdays').change(function(){
                    lastndaysfinal();
                });
                function lastndaysfinal(){
                function lastndaytabledata() {
                    var supp_product_name= [];
                    var supplierid = $('#todaysfinalselectsupp option:selected').attr('data-supplierid');
                    var selecteddays = $('#todaysfinalselectdays option:selected').val();
                    $('#todaysfinaltable1 tr  .supp_product_name').each(function(){
                        supp_product_name.push($(this).text());
                    });
                    var token = $('input[name="_token"]').val();
                        var lastndata;
                            var test =$.ajax({
                                url: "{!! \Illuminate\Support\Facades\URL::route('gettodaytable2') !!}",
                                type: "post",
                                async: false,
                               dataType: 'json',
                                data: {
                                    _token: token,
                                    supplier_id: supplierid,
                                    selecteddays: 100,
                                    supp_product_name : supp_product_name
                                },success: function (data) {
                                    lastndata = data;
                                }
                            });
                    console.log(test);
                    return lastndata;

                    }
            jQuery('#todaysfinaltable2').DataTable({
                    "bDestroy": true,
                    data : lastndaytabledata(),
                    "dom": '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>><"clear">',
                    language: {searchPlaceholder: "SKU/S. Code/S.P. Name"},
                    "aaSorting": [[ 2, "desc" ]]
                });
                }
				var transistordertable;
				$('#transitordertable1').exists(function() {
                    importinventory1();
                });
				function tortable1get(){
                function tortable1data(){
                    var report_id = $('#torselectreport option:selected').attr('data-transitreportid');
                    var token = $('input[name="_token"]').val();
                    var tordata;
                    $.ajax({
                        url: "{!! \Illuminate\Support\Facades\URL::route('tortable1') !!}",
                        type: "post",
                        async: false,
                        dataType: 'json',
                        data: {
                            _token: token,
                            report_id: report_id
                        },success: function (data) {
                            tordata = data;
                        }
                    });
                    return tordata;
                }
                    transistordertable = jQuery('#transitordertable1').DataTable({
                     data: tortable1data(),
                    "dom": '<"top">rt<"row"<"col-md-6"i><"col-md-6"p>><"clear">',
                    "columnDefs": [
                        {className: "tor_checkox", "targets": [0],'searchable': false,
                            'orderable': false},
                        {className: "tor_item_serial", "targets": [1]},
                        {className: "tor_product_sku", "targets":[2] },
                        {className: "tor_supp_product_name", "targets": [3]},
                        {className: "tor_ordered_quantity","targets":[4]},
                        {className: "tor_supplier_code", "targets": [5]},
                        {className: "tor_supplier_price","targets":[6]},
                        {className: "tor_sub_total", "targets": [7]},
                        {className: "tor_vat", "targets": [8]},
                        {className: "tor_action", "targets": [9]}
                    ],
                    "footerCallback": function (row, data, start, end, display) {
                        var api = this.api(), data;
                        // Remove the formatting to get integer data for summation
                        var intVal = function (i) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                        };
                        // total_salary over all pages
                        total_sub_total = api.column(7).data().reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        total_vat_total = api.column(8).data().reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        total_sub_total = parseFloat(total_sub_total);
                        total_vat_total = parseFloat(total_vat_total);
                        finance_sum = total_sub_total + total_vat_total;
                        // Update footer
                        $('.sub_totals').html(total_sub_total.toFixed(2) + "  <i class='fa fa-gbp'></i>");
                        $('.vat_total').html(total_vat_total.toFixed(2) + "  <i class='fa fa-gbp'></i>");
                        $('.finance_summ').html(finance_sum.toFixed(2) + "  <i class='fa fa-gbp'></i>");
                        selectedreport();
                    }
                });
				}
                    jQuery("#transitordertable1").on('change','.tor_ordered_quantitys',function(){
                        var currentvalue =$(this).val();
                        var supplierprice =$(this).parents('tr').find('.tor_supplier_price').text();
                        var product_sku =$(this).parents('tr').find('.tor_product_sku').text();
                        var totalprice=currentvalue*supplierprice;
                        var currentRows = transistordertable.data().toArray();  // current table data
                        var row_index =transistordertable.row( $(this).parents('tr' )).index();
                        var userData = transistordertable.row($(this).parents('tr')).data();
                       // currentRows.splice(row_index, 0, userData);
                        transistordertable.clear();

                        /*Caluclate VAT*/
                        userData[7]=parseFloat(totalprice.toFixed(2));
                        userData[8]= parseFloat ((totalprice *.2).toFixed(2));
                       // userData[4]="<input type='number' class='todaysfinaltable_quantity' min='1' value='"+ currentvalue+"'>";
                        userData[4]= currentvalue;
                        var sub_total =userData[7];
                        var tor_vat =userData[8];

                        transistordertable.row($(this).parents('tr')).remove();
                        userData[9]="<button class='removebtn btn btn-primary'>Remove</button>";


                        transistordertable.rows.add(currentRows);
                        transistordertable.draw();
                       // transistordertable.rows( row_index ).nodes().to$().addClass( 'todaysfinal1row' );


                        var token = $('input[name="_token"]').val();

                        console.log(product_sku);
                        $.ajax({
                            url: "{!! \Illuminate\Support\Facades\URL::route('transitquantityupdate') !!}",
                            type: "post",
                            async: false,
                            data: {
                                _token: token,
                                current_value:currentvalue,
                                product_sku: product_sku,
                                sub_total:sub_total,
                                tor_vat:tor_vat

                            },
                            success: function (data) {
                                if(data==1){
                                    toastr.success('sucessfully quntity changed', 'success')

                                }else{
                                    toastr.error('error in updation of quantity', 'error');
                                }
                            }

                        });


                        var subtotal = transistordertable.column(7).data().sum();
                        var vat = transistordertable.column(8).data().sum();
                        var finance_total = subtotal + vat;

                        $('.sub_totals').html(subtotal.toFixed(2)+"  <i class='fa fa-gbp'></i>");
                        $('.vat_total').html(vat.toFixed(2)+"  <i class='fa fa-gbp'></i>");
                        $('.finance_summ').html(finance_total.toFixed(2)+"  <i class='fa fa-gbp'></i>" );

                    });
                    jQuery('.tor_form_add_product').click(function(e){
                      $('body').mask('');
						e.preventDefault();
						var scode = jQuery('.tor_form_scode').val();
						var qty = jQuery('.tor_form_quantity').val();
						var token = jQuery('input[name="_token"]').val();
						var tid =  jQuery('.transit-id').find(":selected").val();
						$.ajax({
							url: "{!! \Illuminate\Support\Facades\URL::route('toraddproduct') !!}",
							type: "post",
							async: false,
							dataType: 'json',
							data: {
								_token: token,
								scode:scode,
								qty: qty,
								tid: tid
							},
							success: function (response) {
								jQuery('body').unmask();
								if(response.data){
									toastr.success(response.msg, 'success');
								}else{
									toastr.error(response.msg, 'error');
								}
							}

						});

                    });
                jQuery('#transitordertable2').DataTable({
                    "dom": '<"top">rt<"row"<"col-md-6"i><"col-md-6"p>><"clear">'
                });
                jQuery("input[type=radio][name=InvoiceAction]").click(function() {
                    var value = $(this).val();
                    if(value=='SKU'){
                        value=12;
                    }else{
                        value=2
                    }

                    $('#printlabelinvoice').DataTable().order([value, 'desc']).draw();
                });


                // Activate an inline edit on click of a table cell
                jQuery('#todaysfinaltable2').on("click",".addabove",function () {
                    last14days = $('#todaysfinaltable2').DataTable();
                    todaysfinal = $('#todaysfinaltable1').DataTable();
                    var userData = last14days.row($(this).parents('tr')).data();
                    var temp="<input type='checkbox' class='todayscheckbox'/>";
                    userData[8]="<button class='removebtn btn btn-primary'>Remove</button>";

                    /*Caluclate VAT*/
                    var a = parseFloat(userData[6]);
                    var b=20/100;
                    b= parseFloat(b);
                    var c = (a*b).toFixed(2);
                    var scode =userData[5];
                    userData[5]=userData[6];
                    userData[7]=(userData[5]*.2).toFixed(2);
                    userData[2]=1;
                    var rowindex=todaysfinal.row.add([
                            temp,
                        userData[0],
                        userData[1],
                        userData[2],
                        userData[3],
                        userData[4],
                        scode,
                        userData[5],
                        userData[6],
                        userData[7],
                        userData[8]

                    ]).draw(false);
                    todaysfinal.rows( rowindex ).nodes().to$().addClass( 'todaysfinal1row' );
                    last14days.row($(this).parents('tr')).remove().draw();
                });
                jQuery("#todaysfinaltable1").on('change','.quanity_of_item',function(){
                    var currentvalue =$(this).val();
                    var supplierprice =$(this).parents('tr').find('.supplier_price').text();
                    var totalprice=currentvalue*supplierprice;
                    var row_index =todaysfinaltable1.row( $(this).parents('tr' )).index();
                    var userData = todaysfinaltable1.row($(this).parents('tr')).data();
                    todaysfinaltable1.row($(this).parents('tr')).remove();
                    userData[10]="<button class='removebtn btn btn-primary'>Remove</button>";

                    /*Caluclate VAT*/
                    userData[8]=parseFloat(totalprice.toFixed(2));
                    userData[9]= parseFloat ((totalprice *.2).toFixed(2));
                    //userData[3]="<input type='text' class='todaysfinaltable_quantity' min='1' value='"+ currentvalue+"'>";
                    userData[3]= currentvalue;

                    var currentRows = todaysfinaltable1.data().toArray();  // current table data
                    currentRows.splice(row_index, 0, userData);

                    todaysfinaltable1.clear();
                    todaysfinaltable1.rows.add(currentRows);
                    todaysfinaltable1.draw();
                    todaysfinaltable1.rows( row_index ).nodes().to$().addClass( 'todaysfinal1row' );


                    var subtotal = todaysfinaltable1.column(7).data().sum();
                    var vat = todaysfinaltable1.column(8).data().sum();
                    var finance_total = subtotal + vat;

                    $('.sub_totals').html(subtotal.toFixed(2)+"  <i class='fa fa-gbp'></i>");
					$('.vat_total').html(vat.toFixed(2)+"  <i class='fa fa-gbp'></i>");
					$('.finance_summ').html(finance_total.toFixed(2)+"  <i class='fa fa-gbp'></i>" );

                });
                jQuery('#todaysfinaltable1').on("click",".removebtn",function () {

                    todaysfinal = $('#todaysfinaltable1').DataTable();
                    last14days = $('#todaysfinaltable2').DataTable();

                        var userData = todaysfinal.row($(this).parents('tr')).data();
                        userData[9]="<button class='addabove btn btn-primary'>Add above</button>";
                        var rowindex=last14days.row.add([
                            userData[1],
                            userData[2],
                            userData[3],
                            userData[4],
                            userData[5],
                            userData[6],
                            userData[7],
                            userData[9]
                        ]).draw(false);
                        todaysfinal.row($(this).parents('tr')).remove().draw();
                    } ) ;
                jQuery('#importinventorytable1').on("click",".imptable1remove",function(){
                    importinventorytable1.row($(this).parents('tr')).remove().draw();
                });
                jQuery("#updateattribute").on("click",function(){
                    var supplierattr;
                    var magentoattr;
                    var supplier_id = $('#importtableselectsupp option:selected').attr('data-supplier_id');
                    var supplier_name= $('#importtableselectsupp option:selected').text();
                    console.log(supplier_name);
                    importinventorytable1.columns().eq(0).each( function ( index ) {
                        if(index == 1){
                            /*magento attributre*/
                            var row = importinventorytable1.column( index );
                          magentoattr = row.data().toArray();
                            console.log(magentoattr);
                        }else if(index == 2){
                            /*supplier attribute*/
                            var temp = importinventorytable1.column( index );
                           supplierattr = temp.data().toArray();
                        }
                    });
                    var token = $('input[name="_token"]').val();
                    $.ajax({
                     url: "{!! \Illuminate\Support\Facades\URL::route('importattributeupdate') !!}",
                     type: "post",
                     data: {
                     _token: token,
                     supplier_name:supplier_name,
                     magentoattr: magentoattr,
                     supplierattr:supplierattr,
                     supplier_id:supplier_id

                     }, success: function (data) {
                            if(data=1){
                      toastr.success('attribute updated sucessfully', 'success');
                            }else{
                                toastr.error('attribute not updated', 'eroor');
                            }
                     }
                     });


                } );
                var info = orderandshipmenttable.$('tr', {"filter":"applied"}).length;
                jQuery('#shipment-order-count').html(info);
                jQuery('#orderandshipmenttable_filter input').attr('id', 'orderandshipment_filter_id');
                function totalCalculation(orderandshipmenttable){
                    var info = orderandshipmenttable.$('tr', {"filter":"applied"}).length;
                    var filtereddata = orderandshipmenttable.$('tr', {"filter":"applied"});
                    var remove= new Array();
                    var refund = new Array();
                    var total_val= new Array();
                    var total_exp = new Array();
                    var tv= 0,te=0;
                    filtereddata.find("td.is_remove").each(function( index ) {
                        remove.push($( this ).text());
                    });
                    filtereddata.find("td.is_refunded").each(function( index ) {
                        refund.push($( this ).text());
                    });
                    filtereddata.find("td.total_val").each(function( index ) {
                        var a;
                        a=$( this ).text();
                        a= parseFloat(a);
                        total_val.push(a);
                    });
                    filtereddata.find("td.total_exp").each(function( index ) {
                        var a;
                        a= $( this ).text();
                        a= parseFloat(a);
                        total_exp.push(a);
                    });
                    var i,counter=0;
                    var count= remove.length;
                    for(i=0; i<count;i++){
                        if(remove[i] == 1 || refund[i] == 1){
                            tv=tv+total_val[i];
                            te =te+ total_exp[i];
                        }
                    }
                    total_exp_search=total_exp_search-te;
                    total_value_search=total_value_search-tv;
                    var   total_saving = total_value_search -  total_exp_search;
                    // Update footer
                    $('.total_expense').html(total_exp_search.toFixed(2)+"  <i class='fa fa-gbp'></i>");
                    $('.total_value').html(total_value_search.toFixed(2)+"  <i class='fa fa-gbp'></i>");
                    $('.total_saving').html(total_saving.toFixed(2)+"  <i class='fa fa-gbp'></i>");
                    info= parseInt(info);
                    jQuery('#shipment-order-count').html(info);
                }
                jQuery('.ordershipmentresend').click(function(e) {
                    e.preventDefault();
                    var orderid = new Array();
                    jQuery('.ordershipmentrow').each(function () {
                        if ($(this).find('.ordershipmentcheckbox').prop("checked") == true) {
                            var id = $(this).find('.itemid').html();
                            orderid.push(id);
                        }
                    });
                    var token = $('input[name="_token"]').val();
                    if (orderid.length > 0) {
                        $.ajax({
                            url: "{!! \Illuminate\Support\Facades\URL::route('re-send') !!}",
                            type: "post",
                            data: {
                                _token: token,
                                order_id: orderid
                            }, success: function (data) {
                                jQuery('td').each(function (e1) {
                                    if ($(this).find('ordershipmentcheckbox').prop("checked") == true) {
                                        $(this).find('ordershipmentcheckbox').attr('checked', false);
                                        //$('.alert.alert-success.unhold').css({"display": "block"});
                                    }
                                });
                                toastr.success('Order Resend successfulley', 'success');
                            }

                        });
                    }
                });
                jQuery('.ordershipmentrefund').click(function(e){
                    e.preventDefault();
                    var orderid= new Array();
                    jQuery('.ordershipmentrow').each(function () {
                        if ($(this).find('.ordershipmentcheckbox').prop("checked") == true) {
                            var id = $(this).find('.itemid').html();
                            orderid.push(id);
                        }
                    });
                    var token = $('input[name="_token"]').val();
                    if (orderid.length > 0) {
                        $.ajax({
                            url: "{!! \Illuminate\Support\Facades\URL::route('refund') !!}",
                            type: "post",
                            data: {
                                _token: token,
                                order_id: orderid
                            }, success: function (data) {
                                jQuery('td').each(function (e1) {
                                    if ($(this).find('ordershipmentcheckbox').prop("checked") == true) {
                                        $(this).find('ordershipmentcheckbox').attr('checked', false);
                                    }
                                });
                                toastr.success('Order Resend successfulley', 'success');


                            }
                        });
                    }
                });
                jQuery('.todaysgenratefinal').on('click',function(e) {
                    e.preventDefault();
                    var datarow=new Array();
                    var product_id = new Array();
                    var supplierid = $('#todaysfinalselectsupp option:selected').attr('data-supplierid');
                    var minimumvalue = $('#todaysfinalselectsupp option:selected').attr('data-minimumvalue');
                    var suppliername=$( "#todaysfinalselectsupp option:selected" ).text();
                    jQuery('tr').each(function () {
                        if ($(this).find('.todayscheckbox').prop("checked") == true) {
                            var productdata=new Array();
                            var temp = $(this).find('.product_id').text();
                            product_id.push(temp);
                            temp = $(this).find('.product_id').text();
                            productdata.push(temp);
                            temp = $(this).find('.supp_product_name').text();
                            productdata.push(temp);
                            temp = $(this).find('.sku').text();
                            productdata.push(temp);
                            temp = $(this).find('.quanity_of_item').text();
                            productdata.push(temp);
                            temp = $(this).find('.supplier_code').text();
                            productdata.push(temp);
                            temp = $(this).find('.supplier_price').text();
                            productdata.push(temp);
                            temp = $(this).find('.sub_total').text();
                            productdata.push(temp);
                            temp = $(this).find('.vat_price').text();
                            productdata.push(temp);
                            datarow.push(productdata);
                        }
                    });


                    var token = $('input[name="_token"]').val();
                    if (product_id.length > 0) {
                        if(todayfinancesum> minimumvalue){

                        $.ajax({
                            url: "{!! \Illuminate\Support\Facades\URL::route('genratefinal') !!}",
                            type: "post",
                            data: {
                                _token: token,
                                supplierid: supplierid,
                                product_id: product_id,
                                data_row: datarow,
                                supplier_name:suppliername,
                                minimumvalue:minimumvalue,
                                type:"final"
                            }, success: function (data) {
//                                jQuery('#printlabelinvoice  tr.order-record').each(function (e1) {
//                                    if ($(this).find('td.check .checkbox').prop("checked") == true) {
//                                        $(this).find('.status').text('new');
//              $(this).find('td.check .checkbox').attr('checked', false);
                                // $('.alert.alert-success.unhold').css({"display":"block"});
                                // toastr.success('successfulley placed on unhold', 'success');
                                console.log(data);
                            }
                        });
                        }
                    }
                });
                jQuery('.todaysgenratereserv').on('click',function(e){
                    e.preventDefault();
                    var product_id =  new Array();
                    var supplierid = $('#todaysfinalselectsupp option:selected').attr('data-supplierid');
                    jQuery('tr').each(function(){
                        if($(this).find('.todayscheckbox').prop("checked")== true){
                            var temp = $(this).find('.product_id').html();
                            product_id.push(temp);
                        }
                    });
                    var token = $('input[name="_token"]').val();
                    if (product_id.length > 0) {
                        if (todayfinancesum > minimumvalue) {
                            $.ajax({
                                url: "{!! \Illuminate\Support\Facades\URL::route('todaysreserv') !!}",
                                type: "post",
                                data: {
                                    _token: token,
                                    supplierid: supplierid,
                                    product_id: product_id,
                                    type: "reservation"
                                }, success: function (data) {
//                                jQuery('#printlabelinvoice  tr.order-record').each(function (e1) {
//                                    if ($(this).find('td.check .checkbox').prop("checked") == true) {
//                                        $(this).find('.status').text('new');
//              $(this).find('td.check .checkbox').attr('checked', false);
                                    // $('.alert.alert-success.unhold').css({"display":"block"});
                                    // toastr.success('successfulley placed on unhold', 'success');
                                    console.log(data);
                                }
                            });
                        }
                    }
                });
                function selectedreport(){
                   var minimumvalue = $('#torselectreport option:selected').attr('data-minimumvalue');
                    jQuery('.torminimumvalue').html(minimumvalue+"  <i class='fa fa-gbp'></i>");
                }
                function selectedsupplier(){
                    var minimumvalue = $('#todaysfinalselectsupp option:selected').attr('data-minimumvalue');
                    var supplierid = $('#todaysfinalselectsupp option:selected').attr('data-supplierid');
                    jQuery('.todaysminimumvalue').html(minimumvalue+"  <i class='fa fa-gbp'></i>");
                }

                $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                });
            });

        </script>

        @yield('before-scripts-end')
        {!! HTML::script(elixir('js/backend.js')) !!}




        @yield('after-scripts-end')
    </body>
</html>
