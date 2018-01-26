@extends ('backend.layouts.master')


@section('page-header')
    <h1>
        {{ 'Daily Management' }}
        <small>Print label and invoices</small>
    </h1>
@endsection
@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection
@section('content')
    <div class="content">
       <!-- /.row -->

        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <!-- small box -->
                <div class="box box-primary" >

                    <div class="box-header">
                        <form class="print-invoice-action">
                            <div> <h4 style="float: left;">Order Selection for Print:</h4><span class=""  style="float:left; font-size: 16px">
                                            <label for="one" style="margin: 7px">
                                                <input type="radio" class="flat-red" name="exampleRadios" id="exampleRadios1" value="option1" checked>Print Eligible Orders
                                                &nbsp;<input type="radio"  class="flat-red" name="exampleRadios" id="exampleRadios2" value="option1">Print Selected order</label>

                                        </span></div>
                            <div> <h5 style="float: left;">Label & Invoice Action(Sort By):</h5><span class=""  style="float:left; font-size: 16px">
                                            <label for="one" style="margin: 7px">
                                                <input type="radio" class="flat-red" name="exampleRadios" id="exampleRadios1" value="option1" checked>Order  &nbsp;<input type="radio"  class="flat-red" name="exampleRadios" id="exampleRadios2" value="option1">SKU</label>

                                        </span></div>
                            <div> <h5 style="float: left;">Print-invoices:</h5><span class=""  style="float:left; font-size: 16px">
                                            <label for="one" style="margin: 7px">
                                                <input type="radio" class="flat-red" name="exampleRadios" id="exampleRadios1" value="option1" checked>Download PDF  &nbsp;<input type="radio"  class="flat-red" name="exampleRadios" id="exampleRadios2" value="option1">Email</label>

                                        </span></div>
                            <button type="button" class="btn btn-primary">Print Invices/Lablel</button>
                            <button type="button" class="btn btn-primary">Import Tracking File</button>
                        </form>
                        <div class="clearfix"></div>
                        <p>

                        </p>
                    </div>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-6 col-xs-12">
                <!-- small box -->
                <div class="box box-primary" id="loading-example">

                    <div class="box-header">
                        <form>
                        <div class="form-group" style="padding-bottom: 45px;">
                            <h4>Tracking Order</h4>
                            {{--<select class="form-control" id="sel1">
                                <option>HB SUPLLIES2015</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                            </select>--}}

                            <label>Enter Tracking Number</label>
                            <input class="form-control" placeholder="" type="text">

                        </div>
                            <div>
                                <button type="button" class="btn btn-primary">Track Order</button>
                            </div>
                        </form>
{{--
                        <p><h4>Transit Inventory Update</h4></p>
--}}

                    </div>
                </div>
            </div><!-- ./col -->

        </div>



        {{--gopal--}}
<div class="row">
        <div class="col-lg-6 col-xs-12">
            <!-- small box -->
            <div class="box box-primary" id="loading-example" style="height: 216px;">

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
        </div><!-- ./col -->
    <div class="col-lg-6 col-xs-12">
        <div class="box box-primary" id="loading-example">

        <div class="box-header">
            <p><h4>Selected Order Dispatch Action</h4></p>
            <form>
                <div class="form-group">

                <label style="margin-bottom: 0px">Order Place from</label>
                <input class="form-control" placeholder="" type="text">
                <label style="margin-bottom: 0px;">Order value</label>
                <input class="form-control" placeholder="" type="text">
                <button class="btn btn-success" style="margin-top: 3px;"
                        ><i class="fa  fa-external-link "></i> Order Place </button></label>
</div>
            </form>
        </div>
        </div>
        </div>

</div>
        {{--//end--}}
        <div class="box box-success" id="loading-example">

            <div class="box-header">

                <p><h4>Selected Order Action</h4></p>
                <button class="btn btn-success hold-order"><i class="fa fa-download"></i> Hold Order</button>
                <button class="btn btn-primary"><i class="fa fa-arrow-circle-up"></i> Unhold Order</button>
                <button class="btn btn-success"><i class="fa fa-download"></i> Cancel Order</button>
                <button class="btn btn-primary"><i class="fa fa-arrow-circle-up"></i>Cancel Invoice</button>
                <button class="btn btn-success"><i class="fa fa-download"></i> Cancel Label</button>

            </div>
        </div>

        <div class="box box-danger" id="loading-example">
            <div class="box-header">
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /. tools -->
                <i class="fa fa-th-list"></i>

                <h3 class="box-title">Final Order Table</h3>
            </div><!-- /.box-header -->
            <div class="box">

                <div class="box-body table-responsive">
                    <table id="todaysfinaltable1" class="table table-bordered table-hover">
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
                                Product<br>Name</th>
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
                            <td class="check"><input type="checkbox" class="check" name="check"> </td>
                            <td class="order-id"><?php echo $item->order_id ?></td>
                            <td class="status"><?php $status=$item->status;
                                if($status==1)
                                    echo 'new';
                                ?></td>
                            <td><?php echo $item->print_count ?></td>
                            <td><?php  echo $item->carrier?></td>
                            <td><?php  echo $item->ordered.'|'.$item->available.'|'.$item->in_transit?></td>
                            <td><?php  echo 'L'?></td>
                            <td><?php echo $item->market_name?></td>
                            <td><?php echo $item->volume ?></td>
                            <td><?php echo $item->supplier_product_name ?></td>
                            <td><?php echo $item->market_order_id?></td>
                            <td><?php  echo $item->sku?></td>
                            <td><?php echo $item->supplier_product_name?></td>
                            <td><?php  echo $item->supplier_image_link?></td>
                            <td><?php echo $item->created_at?></td>
                            <td><?php echo $item->past_order_count?></td>
                            <td><?php echo $item->product_link?></td>
                        </tr>

                        <?php  }?>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        </div>






@endsection
<style>

</style>
