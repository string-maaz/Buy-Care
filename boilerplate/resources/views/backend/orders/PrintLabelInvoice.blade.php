@extends ('backend.orders.layouts.master')


@section('page-header')
    <h1>
        {{ 'Daily Management' }}
        <small>Print label and invoices</small>
    </h1>
@endsection
@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a>
    </li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection
@section('content')
    <div class="alert alert-danger fade in" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Danger!</strong> please select only one order
    </div>
    <div class="alert alert-success hold fade in" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> Order placed on Hold
    </div>
    <div class="alert alert-success unhold fade in" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> Order placed on unHold
    </div>
    <div class="alert alert-success order-removed fade in" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> Order removed successfulley
    </div>
    <div class="alert alert-success cancel-invoice fade in" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> Invoice canceled successfulley
    </div>
    <div class="alert alert-success cancel-label fade in" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> Label canceled successfulley
    </div>
    <div class="alert alert-success order-placed fade in" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> Order Placed successfulley
    </div>


    <div class="content">
        <!-- /.row -->
        <div class="row">

        <div class="col-md-6" style="padding:0px;">
            <div class="col-lg-6 col-xs-12">
                <!-- small box -->
                <div class="box box-primary" style="height: 250px">

                    <div class="box-header">
                        {{-- <form class="print-invoice-action">--}}
                        {!!  Form::open(array('url' => '','class' => 'print-invoice-action form-horizontal','files'=>true,'enctype'=>'multipart/form-data')) !!}
                        <div><h4 style="float: left;margin-top: 6px; margin-bottom: 3px;">Order Selection for Print:</h4>
                                            <label for="one" style="margin: 3px">
                                                <input type="radio" class="flat-red invoice-selection"
                                                       name="OrderSelection" id="OrderSelection1" value="eligible"
                                                       checked>Print Eligible Orders
                                                <input type="radio" class="flat-red invoice-selection"
                                                             name="OrderSelection" id="OrderSelection2"
                                                             value="selected">Print Selected order</label>

                                        </div>
                        <div><h5 style="margin-top: 6px;margin-bottom: 3px;">Label & Invoice Action(Sort By):</h5><span class="" style="float:left; font-size: 16px">
                                            <label for="one" style="margin: 3px">
                                                <input type="radio" class="flat-red" name="InvoiceAction"
                                                       id="InvoiceAction1" value="order" checked>Order &nbsp;<input
                                                        type="radio" class="flat-red" name="InvoiceAction"
                                                        id="InvoiceAction2" value="SKU">SKU</label>

                                        </span></div>
                        <div><h5 style="margin-top: 6px;margin-bottom: 3px;">Print-invoices:</h5><span class=""
                                                                                style="float:left; font-size: 16px">
                                            <label for="one" style="margin: 3px">
                                                <input type="radio" class="flat-red" name="Print-invoices"
                                                       id="exampleRadios1" value="pdf" checked>Download PDF &nbsp;<input
                                                        type="radio" class="flat-red" name="Print-invoices"
                                                        id="exampleRadios2" value="Email">Email</label>

                                        </span></div>
                        <button type="button" class="btn btn-primary print-invoice" style="float: right">Print Invoices/Lablel</button>
                        {!! Form::close() !!}
                        <div class="clearfix"></div>
                        <p>

                        </p>

                    </div>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-6 col-xs-12" >
                <!-- small box -->
                <div class="box box-primary" id="loading-example" style="height: 250px">

                    <div class="box-header">
                        <h4>Tracking Order</h4>
                        <form class="form-horizontal">
                            <div class="form-group" >
                                <label class="col-sm-4 control-label">Tracking Number</label>
                                <div class="col-sm-8">
                                <input class="form-control track-number" placeholder="" type="text">
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary track-order" style="float: right">Track Order</button>
                            </div>
                        </form>
                        <h4>Import Tracking File</h4>
                        {!!  Form::open(array('url' => '','class' => 'print-invoice-action form-horizontal','id'=>'track-file','files'=>true,'enctype'=>'multipart/form-data')) !!}
                        <div class="fileupload fileupload-new" data-provides="fileupload" style="float: left">
                                    <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-upload"></i> Select file</span>
                                     <span class="fileupload-exists">Change</span>         <input type="file" name='form-track-file' class="track-import" id="import-tracking-file" /></span>
                            <span class="fileupload-preview" style=" display:inline-block;width:150px;white-space: nowrap;overflow:hidden !important; text-overflow: ellipsis;"></span>
                        </div>
                        <button type="submit" class="btn btn-primary import-tracking-file">Import Tracking File</button>


                        {!! Form::close() !!}
                        {{--
                                                <p><h4>Transit Inventory Update</h4></p>
                        --}}

                    </div>
                </div>
            </div>
            <!-- ./col -->

        </div>


        {{--gopal--}}
        <div class="col-md-6" style="padding: 0px;">
            <div class="col-lg-6 col-xs-12">
                <!-- small box -->
                <div class="box box-primary" id="loading-example" style="height: 250px">

                    <div class="box-header">
                        <form>
                            <div class="form-group" style="padding-bottom: 53px;">
                                <h4>Transit Inventory Update</h4>
                                <select class="form-control" id="sel1">
                                    <option>HB SUPLLIES2015</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                </select>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary">Update Inventory</button>
                            </div>
                        </form>
                        {{--
                                                <p><h4>Transit Inventory Update</h4></p>
                        --}}

                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-xs-12">
                <div class="box box-primary" id="loading-example" style="height: 250px">

                    <div class="box-header">
                        <p><h4>Selected Order Dispatch Action</h4></p>
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="col-sm-4 control-label" style="text-align: left">Order Place from</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control order-place-from" id="inputEmail3" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label" style="text-align: left">Order value</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control order-value"  placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label" style="text-align: left">Tracking Number</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control track-number-place-order"  placeholder="">
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary  place-order" style="float: right">
                                <i class="fa  fa-external-link "></i> Order Place
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        </div>
        {{--//end--}}
        <div class="box box-success" id="loading-example">

            <div class="box-header">

                <p><h4>Selected Order Action   <span style="float: right"><button class="btn btn-success hold-order"><i class="fa fa-download"></i> Hold Order</button>
                    <button class="btn btn-primary unhold-order"><i class="fa fa-arrow-circle-up"></i> Unhold Order</button>
                    <button class="btn btn-success remove-order"><i class="fa fa-download"></i> Remove Order</button>
                    <button class="btn btn-primary cancel-invoice"><i class="fa fa-arrow-circle-up"></i>Cancel Invoice</button>
                    <button class="btn btn-success cancel-label"><i class="fa fa-download"></i> Cancel Label</button></span></h4></p>



            </div>
        </div>

        <div class="box box-danger" id="loading-example">
            <div class="box-header">
                <!-- tools box -->
                <div class="pull-right box-tools">
                </div>
                <!-- /. tools -->
                <i class="fa fa-th-list"></i>

                <h3 class="box-title">Final Order Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box">

                <div class="box-body table-responsive">
                    <table id="printlabelinvoice" class="table table-bordered table-hover">
                        <thead>
                        <tr class="headings">
                            <th>s#</th>
                            <th>Tick box</th>
                            <th>order #<br>sorted</th>
                            <th>status</th>
                            <th>Print<br>count</th>
                            <th>carrier</th>
                            <th>O|A|T</th>
                            <th>Label |L/N</th>
                            <th>
                                Market Name
                            </th>
                            <th>volume</th>
                            <th>Supplier<br>
                                Product<br>Name
                            </th>
                            <th>Market<br>Order#</th>
                            <th>SKU</th>
                            <th>supplier Name</th>
                            <th>Supplier Code</th>
                            <th>Order Date</th>
                            <th>Past count<br>/confirm</th>
                            <th>Product Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($orderitems as $item)
                        {?>
                        <tr class="order-record">
                            <td class="id"><?php echo $item->id?></td>
                            <td class="check"><input type="checkbox" class="checkbox" name="check"></td>
                            <td class="order-id"><?php echo $item->order_id ?></td>
                            <td class="status"><?php $status = $item->status;
                                if ($status == 1)
                                    echo 'new';
                                if ($status == 2)
                                    echo 'hold';
                                ?></td>
                            <td class="print-count"><?php echo $item->print_count ?></td>
                            <td><?php  echo $item->carrier?></td>

                            <td class="amount"><span
                                        class="order-amount"><?php echo $item->ordered_qty ?></span><span>|</span><span
                                        class="available"><?php echo $item->available_qty ?></span><span>|</span><span
                                        class="in-transit"> <?php echo $item->in_transit_qty ?> </span></td>

                            <td class="label-cancel"><?php
                                $label = $item->label;
                                if ($label == 0) echo 'L';
                                else
                                    echo 'N'?></td>
                            <td><?php echo $item->market_name?></td>
                            <td><?php echo $item->volume ?></td>
                            <td><?php echo $item->supplier_product_name ?></td>
                            <td><?php echo $item->market_order_id?></td>
                            <td class="sku"><?php  echo $item->sku?></td>
                            <td><?php echo $item->supplier_product_name?></td>
                            <td><?php  echo $item->supplier_image_link?></td>
                            <td><?php echo $item->created_at?></td>
                            <td><?php echo $item->past_order_count?></td>
                            <td><?php echo $item->product_link?></td>
                        </tr>

                        <?php  }?>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>



    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>

        jQuery(function () {

//hold order ajax
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            jQuery('.hold-order').click(function (e) {
                var orderid = new Array();
                var token = $('input[name="_token"]').val();

                // console.log(token);
                var table = $('#printlabelinvoice').DataTable();

                var row = table
                        .rows();

                jQuery('tr.order-record').each(function (e1) {
                    if ($(this).find('td.check .checkbox').prop("checked") == true) {
                        var id = $(this).find('.id').html();
                        orderid.push(id);

                    }
                });
                /*    for(i=0;i<rows.length;i++)
                 {
                 if(jQuery(rows[i]).find('td.check .checkbox').prop("checked") == true) {
                 var id = $(this).find('.id').html();
                 orderid.push(id);

                 }
                 }*/
                if (orderid.length > 0) {
                    $.ajax({

                        url: "{!! \Illuminate\Support\Facades\URL::route('hold-order') !!}",
                        type: "post",
                        data: {
                            _token: token,
                            hold_order_id: orderid
                        },

                        success: function (data) {
                            jQuery('#printlabelinvoice  tr.order-record').each(function (e1) {
                                if ($(this).find('td.check .checkbox').prop("checked") == true) {
                                    $(this).find('.status').text('hold');
                                    $(this).find('td.check .checkbox').attr('checked', false);

                                    // $('.alert.alert-success.hold').css({"display":"block"});

                                    //toastr.success('successfulley placed on hold', 'success');

                                }

                            });
                            toastr.success('successfulley placed on hold', 'success');

                        }

                    });
                }
                else {
                    toastr.error('please select atleast one order', 'error');


                }

            });


            //ajax to unhold order


            jQuery('.unhold-order').click(function (e) {
                var orderid = new Array();
                var token = $('input[name="_token"]').val();

                jQuery('tr.order-record').each(function (e1) {
                    if ($(this).find('td.check .checkbox').prop("checked") == true) {
                        var id = $(this).find('.id').html();
                        orderid.push(id);

                    }
                });
                if (orderid.length > 0) {
                    $.ajax({

                        url: "{!! \Illuminate\Support\Facades\URL::route('unhold-order') !!}",
                        type: "post",
                        data: {
                            _token: token,
                            hold_order_id: orderid
                        },

                        success: function (data) {
                            jQuery('#printlabelinvoice  tr.order-record').each(function (e1) {
                                if ($(this).find('td.check .checkbox').prop("checked") == true) {
                                    $(this).find('.status').text('new');
                                    $(this).find('td.check .checkbox').attr('checked', false);
                                    // $('.alert.alert-success.unhold').css({"display":"block"});
                                    // toastr.success('successfulley placed on unhold', 'success');


                                }
                            });
                            toastr.success('successfulley placed on unhold', 'success');
                        }

                    });
                }
                else {
                    toastr.error('please select atleast one order', 'error');


                }

            });
//ajx to cancel Invoice

            jQuery('.cancel-invoice').click(function (e) {
                var orderid = new Array();
                var token = $('input[name="_token"]').val();

                jQuery('tr.order-record').each(function (e1) {
                    if ($(this).find('td.check .checkbox').prop("checked") == true) {
                        var id = $(this).find('.id').html();
                        orderid.push(id);

                    }
                });
                if (orderid.length > 0) {
                    $.ajax({

                        url: "{!! \Illuminate\Support\Facades\URL::route('cancel-invoice') !!}",
                        type: "post",
                        data: {
                            _token: token,
                            hold_order_id: orderid
                        },

                        success: function (data) {
                            jQuery('#printlabelinvoice  tr.order-record').each(function (e1) {
                                if ($(this).find('td.check .checkbox').prop("checked") == true) {
                                    $(this).find('.print-count').text('0');
                                    $(this).find('td.check .checkbox').attr('checked', false);
                                    // $('.alert.alert-success.cancel-invoice').css({"display":"block"});
                                    toastr.success('invoice cancelled successfulley', 'success');


                                }
                            });
                        }

                    });
                }
                else {
                    toastr.error('please select atleast one order ', 'error');

                }

            });


            //ajax to remove order


            jQuery('.remove-order').click(function (e) {
                var orderid = new Array();
                var token = $('input[name="_token"]').val();

                jQuery('tr.order-record').each(function (e1) {
                    if ($(this).find('td.check .checkbox').prop("checked") == true) {
                        var id = $(this).find('.id').html();
                        orderid.push(id);

                    }
                });
                if (orderid.length > 0) {
                    $.ajax({

                        url: "{!! \Illuminate\Support\Facades\URL::route('remove-order') !!}",
                        type: "post",
                        data: {
                            _token: token,
                            hold_order_id: orderid
                        },

                        success: function (data) {
                            jQuery('#printlabelinvoice  tr.order-record').each(function (e1) {
                                if ($(this).find('td.check .checkbox').prop("checked") == true) {
                                    //$(this).find('.print-count').text('0');
                                    $(this).remove();
                                    $(this).find('td.check .checkbox').attr('checked', false);
                                    // $('.alert.alert-success.order-removed').css({"display":"block"});
                                    // toastr.success('Order has been removed successfulley', 'success');


                                }
                            });
                            toastr.success('Order has been removed successfulley', 'success');

                        }

                    });
                }
                else {
                    toastr.error('please select atleast one order', 'error');

                }

            });

            //ajax to cancel LAbel


            jQuery('.cancel-label').click(function (e) {
                var orderid = new Array();
                var token = $('input[name="_token"]').val();

                jQuery('tr.order-record').each(function (e1) {
                    if ($(this).find('td.check .checkbox').prop("checked") == true) {
                        var id = $(this).find('.id').html();
                        orderid.push(id);

                    }
                });
                if (orderid.length > 0) {
                    $.ajax({

                        url: "{!! \Illuminate\Support\Facades\URL::route('cancel-label') !!}",
                        type: "post",
                        data: {
                            _token: token,
                            hold_order_id: orderid
                        },

                        success: function (data) {
                            jQuery('#printlabelinvoice  tr.order-record').each(function (e1) {
                                if ($(this).find('td.check .checkbox').prop("checked") == true) {
                                    //$(this).find('.print-count').text('0');
                                    //$(this).remove();
                                    $(this).find('td.label-cancel').text('N');
                                    $(this).find('td.check .checkbox').attr('checked', false);
                                    //  $('.alert.alert-success.cancel-label').css({"display":"block"});
                                    // toastr.success('Label cancelled successfulley', 'success');


                                }
                            });
                            toastr.success('Label cancelled successfulley', 'success');

                        }

                    });
                }
                else {
                    toastr.error('please select atleast one order', 'error');

                }

            });


//ajax for track order Action

            jQuery('.track-order').click(function (e) {
                var orderid = new Array();
                var token = $('input[name="_token"]').val();
                var count = 0;
                jQuery('tr.order-record').each(function (e1) {
                    if ($(this).find('td.check .checkbox').prop("checked") == true) {
                        var id = $(this).find('.id').html();
                        orderid.push(id);
                        count = count + 1;

                    }
                });
                if (count == 1) {

                    var trackno = $('.track-number').val();
                    if (trackno != '') {
                        $.ajax({

                            url: "{!! \Illuminate\Support\Facades\URL::route('track-order') !!}",
                            type: "post",
                            data: {
                                _token: token,
                                hold_order_id: orderid,
                                track_no: trackno
                            },

                            success: function (data) {
                                console.log('here');
                                jQuery('#printlabelinvoice  tr.order-record').each(function (e1) {
                                    if ($(this).find('td.check .checkbox').prop("checked") == true) {
                                        //$(this).find('.print-count').text('0');
                                        $(this).remove();
                                        $(this).find('td.check .checkbox').attr('checked', false);
                                        $('.track-number').val('');
                                        // toastr.success('tracking no updated successfulley', 'success');

                                    }
                                });
                                toastr.success('tracking no updated successfulley', 'success');

                            }

                        });
                    }
                    else {
                        toastr.error('please enter tracking number', 'error');

                    }
                }

                else {


                    // jQuery('.alert.alert-danger').css({"display":"block"});
                    toastr.error('you can select only one order at a time', 'error');


                }

            });

//ajax for place order to third party
            jQuery('.place-order').click(function (e) {

                var orderid = new Array();
                var token = $('input[name="_token"]').val();

                jQuery('tr.order-record').each(function (e1) {
                    if ($(this).find('td.check .checkbox').prop("checked") == true) {
                        var id = $(this).find('.id').html();
                        orderid.push(id);

                    }
                });
                var trackno = $('.track-number-place-order').val();
                var order_from = $('.order-place-from').val();
                var order_value = $('.order-value').val();
                console.log(trackno);
                console.log(order_from);
                console.log(order_value);

                if (orderid.length > 0) {
                    if (trackno != '' && order_from != '' && order_value != '') {

                        $.ajax({

                            url: "{!! \Illuminate\Support\Facades\URL::route('place-order') !!}",
                            type: "post",
                            data: {
                                _token: token,
                                hold_order_id: orderid,
                                track_no: trackno,
                                orderfrom: order_from,
                                ordervalue: order_value,
                            },

                            success: function (data) {
                                jQuery('#printlabelinvoice  tr.order-record').each(function (e1) {
                                    if ($(this).find('td.check .checkbox').prop("checked") == true) {
                                        $(this).remove();

                                        $(this).find('td.check .checkbox').attr('checked', false);
                                        $('.track-number-place-order').val('');
                                        $('.order-place-from').val('');
                                        $('.order-value').val('');
                                        // $('.alert.alert-success.order-placed').css({"display":"block"});
                                        // toastr.success('Order Placed successfulley', 'success');


                                    }
                                });
                                toastr.success('Order Placed successfulley', 'success');

                            }

                        });
                    }
                    else {
                        toastr.error('please enter all required field', 'error');

                    }

                }
                else {
                    toastr.error('select atleast one order', 'error');

                }

            });


// ajax for print invoice

            jQuery('.print-invoice').click(function () {
                var itemid = new Array();
                var sku = new Array();
                var orderId = new Array();
                var token = $('input[name="_token"]').val();
                InvoiceAction = $('input[type=radio][name=InvoiceAction]:checked').val();
                order_selection = $('input[type=radio][name=OrderSelection]:checked').val();
                printinvoice = $('input[type=radio][name=Print-invoices]:checked').val();
                if (order_selection == 'eligible') {
                    jQuery('tr.order-record').each(function (e1) {
                        var id = $(this).find('.id').html();
                        var sku_id = $(this).find('.sku').html();
                        var order_id = $(this).find('.order-id').html();
                        var printcount = $(this).find('.print-count').html();


                        var order_amount = $(this).find('.amount .order-amount').html();
                        var avilable_amount = $(this).find('.amount .available').html();
                        console.log(order_amount);
                        console.log(avilable_amount);
                        if (parseInt(order_amount) <= parseInt(avilable_amount)) {
                            console.log(order_id);
                            itemid.push(id);
                            sku.push(sku_id);
                            orderId.push(order_id);

                        }


                    });
                }
                else {
                    console.log('selected');
                    jQuery('tr.order-record').each(function (e1) {
                        if ($(this).find('td.check .checkbox').prop("checked") == true) {
                            var id = $(this).find('.id').html();
                            var sku_id = $(this).find('.sku').html();
                            var order_amount = $(this).find('.amount .order-amount').html();
                            var avilable_amount = $(this).find('.amount .available').html();
                            var order_id = $(this).find('.order-id').html();
                            console.log(order_amount);
                            console.log(avilable_amount);
                            //if(parseInt(order_amount)<=parseInt(avilable_amount))
                            // {
                            itemid.push(id);
                            sku.push(sku_id);
                            orderId.push(order_id);

                            // }


                        }
                    });


                }
                console.log(itemid);
                console.log(sku);
                console.log(orderId);
                if (itemid.length != 0) {

                    $.ajax({

                        url: "{!! \Illuminate\Support\Facades\URL::route('print-invoice') !!}",
                        type: "post",
                        data: {
                            _token: token,
                            item_id: itemid,
                            item_sku: sku,
                            order_id: orderId,
                            invoice_action: InvoiceAction,
                            print_invoice: printinvoice
                        },

                        success: function (data) {
                            if(data){
                                console.log(data);
                                var win = window.open(data[0],'_blank');
                                var win = window.open(data[1],'_blank');

                            }
                            if(data==null)
                            {
                                toastr.success('Email has been sent', 'success');

                            }
                        }
                    });
                }
                else {

                    toastr.error('select atleast one order', 'error');


                }


            });
//ajax to import tracking file
            /*  var form = document.getElementById('track-file');

             form.onsubmit = function(event) {
             event.preventDefault();
             var token = jQuery('#track-file').find('[name=_token]').val();
             console.log("_token "+token);
             var fileSelect = document.getElementById('import-tracking-file');
             var uploadButton = jQuery('.import-tracking-file');
             console.log(fileSelect);

             uploadButton.innerHTML = 'Uploading...';
             var files = fileSelect.files;
             console.log(files);
             var formData = new FormData();

             for (var i = 0; i < files.length; i++) {
             var file = files[i];


             console.log("file:"+file.name);
             // Add the file to the request.
             formData.append('import-tracking-file[]', file, file.name);

             }
             formData.append('_token', token);
             var xhr = new XMLHttpRequest();
             xhr.open('POST', "{!! \Illuminate\Support\Facades\URL::route('tracking-file') !!}", true);
             xhr.onload = function () {
             if (xhr.status === 200) {
             // console.log('here test');

             uploadButton.innerHTML = 'Upload';
             } else {
             alert('An error occurred!');
             }
             };
             xhr.send(formData);


             }
             */

            var files;

// Add events
            $('input[type=file]').on('change', prepareUpload);

// Grab the files and set them to our variable
            function prepareUpload(event)
            {
                files = event.target.files;
            }
            $('#track-file').on('submit', uploadFiles);
            function uploadFiles(event)
            {
                var token = jQuery('#track-file').find('[name=_token]').val();

                event.stopPropagation(); // Stop stuff happening
                event.preventDefault(); // Totally stop stuff happening

                // START A LOADING SPINNER HERE

                // Create a formdata object and add the files
                var formdata = new FormData();
                /*$.each(files, function(key, value)
                 {
                 data.append(key, value);
                 });*/

                formdata.append('file', files[0]);

                formdata.append('_token',token);
                // formdata.append('_token')
                console.log(formdata);

                $.ajax({
                    url: "{!! \Illuminate\Support\Facades\URL::route('tracking-file') !!}",
                    type: 'POST',
                    data: formdata,
                    cache: false,
                    dataType: 'json',
                    processData: false, // Don't process the files
                    contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                    success: function(data, textStatus, jqXHR)
                    {
                        // console.log('here success');
                        toastr.success('Tracking file imported successfulley', 'success');
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        // Handle errors here
                        console.log('ERRORS: ' + textStatus);
                        // STOP LOADING SPINNER
                    }
                });
            }



        });
    </script>


@endsection
<style>
    #printlabelinvoice span::after {
        content: none;;
    }
</style>

