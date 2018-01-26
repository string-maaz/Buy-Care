@extends('backend.orders.layouts.master')

@section('page-header')
    <h1>
        Transit order report
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
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua-active">
                    <div class="inner">
                        <h3 class="torminimumvalue">
                            0 <i class="fa fa-gbp"></i>
                        </h3>
                        <p>
                        <h4> Minumum Value</h4>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green-active">
                    <div class="inner">
                        <h3 class="sub_totals">
                            0 <i class='fa fa-gbp'></i>
                        </h3>
                        <p>
                        <h4> Sub Total</h4>
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
                        <h3 class="vat_total">
                            0 <i class='fa fa-gbp'></i>
                        </h3>
                        <p>
                        <h4> V A T</h4>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-attach"></i>
                    </div>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red-active">
                    <div class="inner">
                        <h3 class="finance_summ">
                            0 <i class='fa fa-gbp'></i>
                        </h3>
                        <p>
                        <h4> Finance Summry</h4>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-arrow-graph-up-right"></i>
                    </div>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-lg-6 col-xs-6">

                <!-- small box -->
                <div class="box box-Success" id="loading-example">

                    <div class="box-header">
                        <p><h4>Select Order In Transit ID</h4></p>
                        <div class="form-group" style="padding: 0px 0px;">
                            <form>
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <select class="form-control transit-id" id="torselectreport">
                                <?php foreach($arr as $info) { ?>
                                    <option data-minimumvalue="<?php echo $info['minimum_value']; ?>" data-transitreportid="<?php echo $info['id']?>"> <?php echo $info['transit_report_name'];;?> </option>
                                <?php } ?>

                            </select>
                                </form>
                        </div>

                    </div>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-6 col-xs-6">
                <!-- small box -->

                <div class="box box-success" id="loading-example">


                    <div class="box-header">
                        <p>
                        <h4>
                            Add Product In Transit
                        </h4>
                        </p>
                        <form class="form-inline" style="padding: 2px 0px;">
                            <div class="form-group">
                                <input type="text" class="form-control tor_form_scode" id="" placeholder="S. Code">
                                <input type="text" class="form-control tor_form_quantity" id="" placeholder="Quantity">
                                <button type="submit" class="btn btn-primary tor_form_add_product">Add Product</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div><!-- ./col -->
        </div>
        <div class="box box-primary" id="loading-example">
		
            <div class="box-header">
			<h4>Selected Product Action </h4>
                                    <button class="btn btn-warning"><i class="fa fa-times"></i> Delete Product</button>
                
            </div>
            </div>

        <div class="box box-danger" id="loading-example">
            <div class="box-header">
                <!-- tools box -->
                <!-- /. tools -->
                <i class="fa fa-th-list"></i>

                <h3 class="box-title">Transit Order Table</h3>
            </div><!-- /.box-header -->
            <div class="box">

                <div class="box-body table-responsive">
                    <table id="transitordertable1" class="table table-bordered table-hover">
                        <thead>
                         <tr class="headings">
                                <th><input type="checkbox"></th>
                                <th>S# </th>
                                <th>Product SKU</th>
                                <th>Supplier Product Name </th>
                                <th>Ordered/In Transit Quantity </th>
                                <th>Supplier Code </th>
                                <th>Supplier Price</th>
                                <th>Sub Total</th>
                                <th>VAT</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>


        <!-- small box -->
        <div class="box box-success" id="loading-example">

            <div class="box-header">
                <h4>Order Ready To Dispatch </h4>
                <button class="btn btn-success"><i class="fa fa-download"></i> Update Product</button>
                <button class="btn btn-primary"><i class="fa fa-arrow-circle-up"></i> Update All</button>

            </div>
        </div>


        <span class="clearfix"></span>
        <div class="box box-danger" id="loading-example">
            <div class="box-header">
                <!-- tools box -->
                <!-- /. tools -->
                <i class="fa fa-th-list"></i>

                <h3 class="box-title">Order Ready To Dispatch</h3>
            </div><!-- /.box-header -->
            <div class="box">
                <div class="box-body table-responsive">
                    <table id="transitordertable2" class="table table-bordered table-hover">
                        <thead>
                        <tr class="headings">
                           <tr class="headings">
                                <th>S# </th>
                                <th>
                                    Tick Box
                                </th>
                                <th>SKU </th>
                                <th>Marketplace (eBay/Amazon) </th>
                                <th>Product Supplier Name </th>
                                <th>Quantity </th>
                                <th>Market Product Name </th>
                            </tr>
                        </thead>

                        <tbody>
                        <tr class="even pointer" id="">
                            <td class="a-center ">
                                <input type="checkbox" class="tableflat">
                            </td>
                            <td class=" ">121000040</td>
                            <td class=" ">May 23, 2014 11:47:56 PM </td>
                            <td class=" ">121000210 <i class="success fa fa-long-arrow-up"></i>
                            </td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="" name="">gsg</td>

                        </tr>
                        <tr class="odd pointer" id="">
                            <td class="a-center ">
                                <input type="checkbox" class="tableflat">
                            </td>
                            <td class=" ">121000039</td>
                            <td class=" ">May 23, 2014 11:30:12 PM</td>
                            <td class=" ">121000208 <i class="success fa fa-long-arrow-up"></i>
                            </td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="" name="">dfs</td>
                        </tr>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>


@endsection
