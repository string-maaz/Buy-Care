@extends('backend.orders.layouts.master')

@section('page-header')
    <h1>
        Todays Final Order
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
            <div id="fade" style="display: none;position:absolute;top: 0%;left: 0%;width: 100%;height: 100%;background-color: #ababab;z-index: 1001;-moz-opacity: 0.8;opacity: .70;filter: alpha(opacity=80);"></div>
            <div id="modal" style="display: none;position: absolute;top: 45%;left: 45%;padding:30px 15px 0px;border: 3px solid #ababab;box-shadow:1px 1px 10px #ababab;border-radius:20px;background-color: white;z-index: 1002;text-align:center;overflow: auto;">
                {{--<img id="loader" src="..\resources\assets\css\loading.gif" />--}}
                hello
            </div>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua-active">
                <div class="inner">
                    <h3 class="todaysminimumvalue">
                        0 <i class='fa fa-gbp'></i>

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
                    <i class="ion ion-android-attach"></i>
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
                    <i class="ion ion-podium"></i>
                </div>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red-active">
                <div class="inner" >
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
        <div class="col-lg-6 col-xs-12">
            <!-- small box -->
            <div class="box box-primary" id="loading-example" style="height: 140px">

                <div class="box-header">
                    <p><h4>Select Supplier</h4></p>
                    <div class="form-group" style="padding: 16px 0px;">
                        <select class="form-control" id="todaysfinalselectsupp">

                            <?php foreach($supplierinfo as $supplier){
                                ?>
                                <option data-minimumvalue="<?php echo $supplier['minimun_value']; ?>" data-supplierid="<?php echo $supplier['supplier_code']?>"> <?php echo $supplier['supplier_name'];?> </option>
                              <?php
                            } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-6 col-xs-12">
            <!-- small box -->
            <div class="box box-primary" id="loading-example" style="height: 140px">

                <div class="box-header">
                    <p>
                    <h4>
                        Supplier Selected Action
                    </h4>
                    </p>
                    <form>

                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                        <div> <h5 style="float: left;">Auto Reservation:</h5><span class=""  style="float:left; font-size: 16px">
                                            <label for="one" style="margin: 7px">
                                                <input type="radio" class="flat-red" name="exampleRadios" id="exampleRadios1" value="option1" checked>ON / &nbsp;<input type="radio"  class="flat-red" name="exampleRadios" id="exampleRadios2" value="option1">OFF</label>

                                        </span></div>
                    <div class="clearfix"></div>
                    <button type="button" class="btn btn-primary todaysgenratefinal"><i class="fa fa-file-excel-o"></i> Genrate Final</button>
                    {{--<button type="button" class="btn btn-primary"><i class="fa fa-cloud-download"></i> Update Report</button>--}}
                    <button type="button" class="btn btn-primary todaysgenratereserv"><i class="fa fa-cubes"></i> Reservation</button>

                        </form>
                </div>
            </div>
        </div><!-- ./col -->
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
                <table id="todaysfinaltable1" class="table table-bordered table-hover">
                    <thead>
                    <tr class="headings">
                        <th> <input type="checkbox" class="tableflat"> </th>
                        <th>
                            S#
                        </th>
                        <th>Supplier Product Name </th>
                        <th>Quantity</th>
                        <th>Product Id</th>
                        <th>SKU</th>
                        <th>Supplier Code </th>
                        <th>Supplier Price </th>
                        <th>Sub Total </th>
                        <th> VAT</th>
                        <th>Action</th>
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

                    <p><h4>Last 14 Day Report </h4></p>

                </div>
            </div>

    <span class="clearfix"></span>
    <div class="box box-danger" id="loading-example">
        <div class="box-header">
            <!-- tools box -->
            <!-- /. tools -->
            <h3 style="width: 25%;display: inline-block; font-size: 18px; font-weight: 500;margin: 0px"><div class="form-group">
                    <label for="sort" class="col-md-6 control-label"><i class="fa fa-th-list"></i>  Select No. of Days </label>
                    <div class="col-md-6">
                        <select class="form-control" id="todaysfinalselectdays">
                            <option value="7" selected>7</option>
                            <option value="14">14</option>
                            <option value="21">21</option>
                        </select>
                    </div>
                </div></h3>
        </div><!-- /.box-header -->
        <div class="box">
            <div class="box-body table-responsive">
                <table id="todaysfinaltable2" class="table table-bordered table-hover">
                    <thead>
                    <tr class="headings">
                        <th>
                            S#
                        </th>
                        <th>Supplier Product Name </th>
                        <th>Sold Quantiy(Sort by most selling) </th>
                        <th>Product Id</th>
                        <th>SKU </th>
                        <th>Supplier Code </th>
                        <th> Supplier Price </th>
                        <th>Action </th>
                    </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
        </div>
@endsection
