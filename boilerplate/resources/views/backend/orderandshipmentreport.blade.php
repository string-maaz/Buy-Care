@extends('backend.layouts.master')

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
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('strings.backend.WELCOME') }} {!! auth()->user()->name !!}!</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body" style="margin: 20px">
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Order and shipment<small>Report</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row " style="text-align: center">
                            <div id="equalheight" style="padding: 10px">
                            <div class="col-md-3 demo" style="border-right: 1px solid black; background-color: rgba(49, 92, 255, 0.33)">
                                <h4 style="float: left;">Search</h4>
                                <span class="clearfix"></span>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" aria-label="..." placeholder="By Order#/By SKU" id="orderandshipmentbyorder">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="#">By Order#</a></li>
                                                <li><a href="#">By SKU</a></li>
                                            </ul>
                                        </div><!-- /btn-group -->
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                            </div>
                            <div class="col-md-3 demo" style="border-right: 1px solid black; background-color: rgba(49, 92, 255, 0.33)"><h4 style="float: left;">By MarketPlace</h4>
                                <span class="clearfix"></span>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" aria-label="..." placeholder="By Amazon/By eBay/Customer Name" id="orderandshipmentamazon">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary"  aria-haspopup="true" aria-expanded="false">Search</button>

                                        </div><!-- /btn-group -->
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                            </div>
                            <div class="col-md-2 demo" style="border-right: 1px solid black; background-color: rgba(49, 92, 255, 0.33)"><h4 style="float: left;">Selected Order Action</h4>
                                <span class="clearfix"></span>

                                <button type="submit" class="btn btn-primary">Re-Send</button>
                                <br/>
                                &nbsp;
                                <br/>
                                <button type="submit" class="btn btn-primary">Refund</button>
                            </div>
                            <div class="col-md-1 demo" style="border-right: 1px solid black; background-color: rgba(49, 92, 255, 0.33)"><h4 style="float: left;">Order Count</h4>
                            <p>
                                <span><h1>23</h1></span>
                            </p>
                            </div>
                            <div class="col-md-3 demo" style="border-right: 1px solid black; background-color: rgba(49, 92, 255, 0.33)"><h4 style="float: left;">Finanace Summary</h4>
                                <span class="clearfix"></span>
                                <span style="float: left; text-align: left">

                                <p style="color: red; font-size: 15px">Total Expenses:<span>&nbsp;<i class="fa fa-gbp"></i> 120.9</span></p>
                                <p style="color: blue; font-size: 15px">Total Value:<span>&nbsp;<i class="fa fa-gbp"></i> 20.9</span></p>
                                <p style="color: green; font-size: 15px">Total Saving:<span>&nbsp;<i class="fa fa-gbp"></i> 100</span></p>
                                    </span>


                            </div>
                                </div>
                        </div>
                        <div class="x_content">
                            <table id="orderandshipmenttable" class="table table-striped responsive-utilities jambo_table">
                                <thead>
                                <tr class="headings">

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
                                </tr>
                                </thead>

                                <tbody>
                                <tr class="even pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="tableflat">
                                    </td>
                                    <td class=" ">121000040</td>
                                    <td class=" ">May 23, 2014 11:47:56 PM </td>
                                    <td class=" ">121000210</td>
                                    <td class=" ">John Blank L</td>
                                    <td class=" ">Paid</td>
                                    <td class="a-right a-right ">$7.45</td>
                                    <td class=" last">asd</td>
                                    <td class=" ">asdaf</td>
                                    <td class=" ">45</td>
                                    <td class=" ">sdg</td>
                                    <td class=" ">4353</td>
                                    <td class=" ">433</td>
                                    <td class=" ">29%</td>
                                    <td class=" ">23425</td>
                                </tr>
                                <tr class="odd pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="tableflat">
                                    </td>
                                    <td class=" ">121000039</td>
                                    <td class=" ">May 23, 2014 11:30:12 PM</td>
                                    <td class=" ">121000208 <i class="success fa fa-long-arrow-up"></i>
                                    </td>
                                    <td class=" ">John Blank L</td>
                                    <td class=" ">Paid</td>
                                    <td class="a-right a-right ">$741.20</td>
                                    <td class=" last">asd</td>
                                    <td class=" ">asdaf</td>
                                    <td class=" ">45</td>
                                    <td class=" ">sdg</td>
                                    <td class=" ">4353</td>
                                    <td class=" ">433</td>
                                    <td class=" ">29%</td>
                                    <td class=" ">23425</td>
                                </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                <br />
                <br />
                <br />

            </div>
        </div><!-- /.box-body -->
    </div><!--box box-success-->


@endsection
