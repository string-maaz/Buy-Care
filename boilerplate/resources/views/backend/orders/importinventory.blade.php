@extends('backend.orders.layouts.master')

@section('page-header')
    <h1>
        Import Inventory
        <small>{{ trans('strings.backend.dashboard_title') }}</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection

@section('content')
    <div class="content">
        <div class="box box-success" id="loading-example">

            <div class="box-header">
                <h4>Last Update Selected Supplier Summary</h4>
        <!-- Small boxes (Stat box) -->

        <div class="row">
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 class="mimimum_value">
                            150 <i class="fa fa-gbp"></i>
                        </h3>
                        <p>
                        <h4> Minumum Value</h4>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua-active">
                    <div class="inner">
                        <h3 class="total_product">
                            150
                        </h3>
                        <p>
                        <h4> Total Products</h4>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-cart"></i>
                    </div>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green-active">
                    <div class="inner">
                        <h3 class="update_product">
                            120
                        </h3>
                        <p>
                        <h4> Update Products</h4>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-podium"></i>
                    </div>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-active">
                    <div class="inner">
                        <h3 class="new_product">
                            20
                        </h3>
                        <p>
                        <h4> New Products</h4>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-briefcase"></i>
                    </div>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red-active">
                    <div class="inner">
                        <h3 class="zero_inventory">
                            140
                        </h3>
                        <p>
                        <h4> Zero Inventory Products</h4>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cube"></i>
                    </div>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-xs-6">

                <!-- small box -->
                <div class="box box-Success" id="loading-example">

                    <div class="box-header">
                        <p><h4>Select Supplier</h4></p>
                        <div class="form-group" style="padding: 0px 0px;">
                            <select class="form-control" id="importtableselectsupp">
                                <?php foreach($info as $information){
                                ?>
                                <option data-supplier_id="<?php echo $information['6']; ?>" data-minimumvalue="<?php echo $information['1']; ?>" data-total_products="<?php echo $information['2']?>" data-updated_products="<?php echo $information['3']?>" data-new_products="<?php echo $information['4']?>" data-zero_inventory_products="<?php echo $information['5']; ?>"> <?php echo $information['0'];?> </option>
                                <?php
                                } ?>
                            </select>
                        </div>

                    </div>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-6 col-xs-6">
                <!-- small box -->

                <div class="box box-success" id="loading-example">

                    <div class="box-header">
                        {!!  Form::open(array('url' => '','class' => 'update-inventory','id'=>'updateinventory','files'=>true,'enctype'=>'multipart/form-data')) !!}

                            <div class="fileupload fileupload-new" data-provides="fileupload" style="float: left">
                                <label> Import file:</label>
                                    <span class="btn btn-primary btn-file"><span class="fileupload-new"><i class="fa fa-upload"></i> Select file</span>
                                     <span class="fileupload-exists">Change</span>         <input type="file" /></span>
                                <span class="fileupload-preview" style=" display:inline-block;width:150px;white-space: nowrap;overflow:hidden !important; text-overflow: ellipsis;"></span>
                            </div>
                            &nbsp;&nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary"><i class="fa fa-download"></i> Update Inventory</button>
                        {!! Form::close() !!}


                        <label>Update Options:
                        <button type="button" class="btn btn-success"><i class="fa fa-arrow-circle-up"></i> Update Live</button>
                            &nbsp;
                        <button type="button" class="btn btn-danger"><i class="fa fa-cogs"></i> Settings</button>
                            </label>




                    </div>
                </div>
            </div><!-- ./col -->
        </div>
        <div class="box box-danger" id="loading-example">
            <div class="box-header">
                <!-- tools box -->
                <!-- /. tools -->
                <i class="fa fa-th-list"></i>

                <h3 class="box-title">Import Inventory Report</h3> &nbsp; &nbsp;<button class="btn btn-primary" id="importtable1addnew">Add New Attribute</button>
                &nbsp; &nbsp;<button class="btn btn-primary" id="updateattribute">Update Attribute</button>
            </div><!-- /.box-header -->
            <div class="box">

                <div class="box-body table-responsive">
                    <table id="importinventorytable1" class="table table-bordered table-hover">
                        <thead>
                        <tr class="headings">
                            <th>
                                S#
                            </th>
                            <th>Magento Attribute</th>
                            <th>Supplier Attribute Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>


        <!-- small box -->
        <div class="box box-success" id="loading-example">

            <div class="box-header">
                <h4>New Product Report(Selected Supplier) </h4>
                <button class="btn btn-success"><i class="fa fa-minus"></i> Remove Selected</button>
                <button class="btn btn-primary"><i class="fa fa-minus-square"></i> Remove All</button>

            </div>
        </div>


        <span class="clearfix"></span>
        <div class="box box-danger" id="loading-example">
            <div class="box-header">
                <!-- tools box -->
               <!-- /. tools -->
                <i class="fa fa-th-list"></i>

                <h3 class="box-title">New Produc Report</h3>
            </div><!-- /.box-header -->
            <div class="box">
                <div class="box-body table-responsive">
                    <table id="importinventorytable2" class="table table-bordered table-hover">
                        <thead>
                        <tr class="headings">
                        <tr class="headings">
                            <th>S# </th>
                            <th>
                                Tmp SKU(tmp-8xdigit)
                            </th>
                            <th>Product Name </th>
                            <th>Volume </th>
                            <th>Brand Name</th>
                            <th>Product Category</th>
                            <th>Supplier Code </th>
                            <th>Price </th>
                            <th>Stock Available </th>
                            <th>product UPC(13 digit) </th>
                            <th>Image URL</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr class="even pointer">
                            <td class="a-center ">
                                <input type="checkbox" class="tableflat">
                            </td>
                            <td class=" ">121000040</td>
                            <td class=" ">adidas</td>
                            <td class=" ">121000210</td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class=" ">121000040</td>
                            <td class=" ">200</td>
                            <td class=" ">121000210</td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td ><button row_id = "1" class="btn btn-primary add-new-product-magento">Add to Magento</button></td>

                        </tr>
                        <tr class="odd pointer">
                            <td class="a-center ">
                                <input type="checkbox" class="tableflat">
                            </td>
                            <td class=" ">121000039</td>
                            <td class=" ">nike</td>
                            <td class=" ">121000208</td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class=" ">121000040</td>
                            <td class=" ">100 </td>
                            <td class=" ">121000210</td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td ><button class="btn btn-primary" >Add to Magento</button></td>
                        </tr>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        var files;

        // Add events
        jQuery('input[type=file]').on('change', prepareUpload);

        // Grab the files and set them to our variable
        function prepareUpload(event)
        {
            files = event.target.files;
        }
        $('#updateinventory').on('submit', uploadFiles);
        function uploadFiles(event)
        {
            var token = jQuery('#updateinventory').find('[name=_token]').val();

            event.stopPropagation(); // Stop stuff happening
            event.preventDefault(); // Totally stop stuff happening

            // START A LOADING SPINNER HERE

            // Create a formdata object and add the files
            var formdata = new FormData();


            formdata.append('file', files[0]);

            formdata.append('_token',token);
            // formdata.append('_token')
            console.log(formdata);

            $.ajax({
                url: "{!! \Illuminate\Support\Facades\URL::route('update-inventory') !!}",
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
    </script>
@endsection
