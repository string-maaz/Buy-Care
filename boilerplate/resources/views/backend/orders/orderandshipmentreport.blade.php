@extends('backend.orders.layouts.master')

@section('page-header')
    <h1>
        Order & Shipment Report
        <small>{{ trans('strings.backend.dashboard_title') }}</small>
    </h1>
@endsection

@section('breadcrumbs')
    <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li class="active">{{ trans('strings.here') }}</li>
@endsection

@section('content')
    <div class="content">
        <!-- Small boxes (Stat box) -->

            <div class="box box-success" id="loading-example">

                <div class="box-header">
                    <h4>Last Update Selected Supplier Summary</h4>

            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua-active">
                    <div class="inner">
                        <h3 class="total_expense">
                           0 <i class='fa fa-gbp'></i>

                        </h3>
                        <p>
                        <h4> Total Expenses</h4>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green-active">
                    <div class="inner">
                        <h3 class="total_value">
                            0 <i class='fa fa-gbp'></i>

                        </h3>
                        <p>
                        <h4>Total Value</h4>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-attach"></i>
                    </div>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-active">
                    <div class="inner">
                        <h3 class="total_saving">
                            0 <i class='fa fa-gbp'></i>

                        </h3>
                        <p>
                        <h4>Total Saving</h4>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-podium"></i>
                    </div>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red-active">
                    <div class="inner">
                        <h3 id="shipment-order-count">
                            0

                        </h3>
                        <p>
                        <h4> Order Count</h4>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-arrow-graph-up-right"></i>
                    </div>
                </div>
            </div>
                </div>
            </div><!-- ./col -->

        <div class="box box-success" id="loading-example">

            <div class="box-header">
                <h4>Selected Order Action :   <form style="display: inline">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                        <button class="btn btn-success ordershipmentresend"><i class="fa fa-download"></i> Resend</button>
                        <button class="btn btn-primary ordershipmentrefund"><i class="fa fa-arrow-circle-up"></i> Refund</button>
                    </form></h4>
            </div>
        </div>

        <div class="box box-danger" id="loading-example">
            <div class="box-header">
                <!-- tools box -->
                <!-- /. tools -->
                <i class="fa fa-th-list"></i>

                <h3 class="box-title">Final Order Table</h3>
            </div><!-- /.box-header -->
            <div class="box">

                <div class="box-body table-responsive">
                    <table id="orderandshipmenttable" class="table table-bordered table-hover">
                        <thead>
                            <tr class="headings">
                                <th>S#</th>
                                <th>Order# </th>
                                <th>
                                    Select Order
                                </th>
                                <th>Tracking </th>
                                <th>Packing </th>
                                <th>Carrier </th>
                                <th>Order Receive Date </th>
                                <th>Dispatch Date </th>
                                <th>Expected Delivery Befror(Date)</th>
                                <th>Marketplace Name </th>
                                <th>Marketplace Order# </th>
                                <th>Product Name(Magento) </th>
                                <th>Price (Supplier) </th>
                                <th>Expenses + PayPal Fee </th>
                                <th>Selling Commision(set% value) </th>
                                <th>Price(Selling) </th>
                                <th>Is Removed </th>
                                <th>Is Refunded</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($orderitems as $orderitem){?>

                        <tr class="ordershipmentrow">
                            <td class="itemid"><?php echo $orderitem->id; ?></td>
                            <td><?php echo $orderitem->order_id ;?></td>
                            <td><input type="checkbox" class="ordershipmentcheckbox"> </td>
                            <td><?php echo $orderitem->tracking_number; ?></td>
                            <td><?php echo $orderitem->packing; ?> </td>
                            <td><?php echo $orderitem->carrier; ?></td>
                            <td><?php echo $orderitem->ordered_date; ?></td>
                            <td> <?php echo $orderitem->dispacted_date; ?></td>
                            <td><?php echo $orderitem->expected_delivery_date; ?></td>
                            <td><?php echo $orderitem->market_name; ?></td>
                            <td><?php echo $orderitem->market_order_id; ?></td>
                            <td> <?php echo $orderitem->product_name; ?></td>
                            <td><?php echo $orderitem->supplier_price; ?></td>
                            <td><?php echo $orderitem->expenses; ?></td>
                            <td> <?php echo $orderitem->selling_commission; ?></td>
                            <td><?php echo $orderitem->price; ?></td>
                            <td> <?php echo $orderitem->is_removed; ?></td>
                            <td><?php echo $orderitem->is_refunded; ?></td>

                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

@endsection
