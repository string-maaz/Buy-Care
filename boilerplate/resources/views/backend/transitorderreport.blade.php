@extends('backend.layouts.master')

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
                        <h3>
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
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green-active">
                    <div class="inner">
                        <h3>
                            120 <i class="fa fa-gbp"></i>
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
                        <h3>
                            20 <i class="fa fa-gbp"></i>
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
                        <h3>
                            140 <i class="fa fa-gbp"></i>
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
                        <div class="form-group" style="padding: 0px 0px;">
                            <select class="form-control" id="sel1">
                                <option selected>Select Transit ID</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                            </select>
                        </div>
                        <p><h4>Select Order In Transit ID</h4></p>
                    </div>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-6 col-xs-6">
                <!-- small box -->

                <div class="box box-success" id="loading-example">

                    <div class="box-header">
                        <form class="form-inline" style="padding: 2px 0px;">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail3" placeholder="S. Code">
                                <input type="text" class="form-control" id="exampleInputPassword3" placeholder="Quantity">
                                <button type="submit" class="btn btn-primary">Add Product</button>
                            </div>


                        </form>
                        <p>
                        <h4>
                            Add Product In Transit
                        </h4>
                        </p>


                    </div>
                </div>
            </div><!-- ./col -->
        </div>
        <div class="box box-primary" id="loading-example">
		
            <div class="box-header">
			<h4>Selected Product Action </h4>
			                        <button class="btn btn-info"><i class="fa fa-download"></i> Update Product</button>
                                    <button class="btn btn-warning"><i class="fa fa-times"></i> Delete Product</button>
                
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

                <h3 class="box-title">Transit Order Table</h3>
            </div><!-- /.box-header -->
            <div class="box">

                <div class="box-body table-responsive">
                    <table id="transitordertable1" class="table table-bordered table-hover">
                        <thead>
                         <tr class="headings">
                                <th>S# </th>
                                <th>
                                    Tick Box
                                </th>
                                <th>Product SKU</th>
                                <th>Supplier Product Name </th>
                                <th>Ordered/In Transit Quantity </th>
                                <th>Supplier Code </th>
                            </tr>
                        </thead>
                        <tbody>
                        <tfoot>
                        <tr>
                            <td>Trident</td>
                            <td>Internet
                                Explorer 4.0</td>
                            <td>Win 95+</td>
                            <td> 4</td>
                            <td>X</td>
                            <td>Win 95+</td>
                            
                        </tr>
                        <tr>
                            <td>Trident</td>
                            <td>Internet
                                Explorer 5.0</td>
                            <td>Win 95+</td>
                            <td>5</td>
                            <td>C</td>
                            <td>Win 95+</td>
                            
                        </tr>
                        <tr>
                            <td>Trident</td>
                            <td>Internet
                                Explorer 5.5</td>
                            <td>Win 95+</td>
                            <td>5.5</td>
                            <td>A</td>
                            <td>Win 95+</td>
                            
                        </tr>
                        <tr>
                            <td>Trident</td>
                            <td>Internet
                                Explorer 6</td>
                            <td>Win 98+</td>
                            <td>6</td>
                            <td>A</td>
                            <td>Win 95+</td>
                          
                        </tr>
                        <tr>
                            <td>Trident</td>
                            <td>Internet Explorer 7</td>
                            <td>Win XP SP2+</td>
                            <td>7</td>
                            <td>A</td>
                            <td>Win 95+</td>
                            
                        </tr>
                        <tr>
                            <td>Trident</td>
                            <td>AOL browser (AOL desktop)</td>
                            <td>Win XP</td>
                            <td>6</td>
                            <td>A</td>
                            <td>Win 95+</td>
                            
                        </tr>
                        <tr>
                            <td>Gecko</td>
                            <td>Firefox 1.0</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.7</td>
                            <td>A</td>
                            <td>Win 95+</td>
                           
                        </tr>
                        <tr>
                            <td>Gecko</td>
                            <td>Firefox 1.5</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                            <td>Win 95+</td>
                           
                        </tr>
                        <tr>
                            <td>Gecko</td>
                            <td>Firefox 2.0</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                            <td>Win 95+</td>
                           
                        </tr>
                        <tr>
                            <td>Gecko</td>
                            <td>Firefox 3.0</td>
                            <td>Win 2k+ / OSX.3+</td>
                            <td>1.9</td>
                            <td>A</td>
                            <td>Win 95+</td>
                          
                        </tr>
                        <tr>
                            <td>Gecko</td>
                            <td>Camino 1.0</td>
                            <td>OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                            <td>Win 95+</td>
                           
                        </tr>
                        <tr>
                            <td>Gecko</td>
                            <td>Camino 1.5</td>
                            <td>OSX.3+</td>
                            <td>1.8</td>
                            <td>A</td>
                            <td>Win 95+</td>
                            
                        </tr>
                        <tr>
                            <td>Gecko</td>
                            <td>Netscape 7.2</td>
                            <td>Win 95+ / Mac OS 8.6-9.2</td>
                            <td>1.7</td>
                            <td>A</td>
                            <td>Win 95+</td>
                            
                        </tr>
                        <tr>
                            <td>Gecko</td>
                            <td>Netscape Browser 8</td>
                            <td>Win 98SE+</td>
                            <td>1.7</td>
                            <td>A</td>
                            <td>Win 95+</td>
                            
                        </tr>
                        <tr>
                            <td>Gecko</td>
                            <td>Netscape Navigator 9</td>
                            <td>Win 98+ / OSX.2+</td>
                            <td>1.8</td>
                            <td>A</td>
                            <td>Win 95+</td>
                            
                        </tr>
                        <tr>
                            <td>Gecko</td>
                            <td>Mozilla 1.0</td>
                            <td>Win 95+ / OSX.1+</td>
                            <td>1</td>
                            <td>A</td>
                            <td>Win 95+</td>
                           
                        </tr>
                        <tr>
                            <td>Gecko</td>
                            <td>Mozilla 1.1</td>
                            <td>Win 95+ / OSX.1+</td>
                            <td>1.1</td>
                            <td>A</td>
                            <td>Win 95+</td>
                            
                        </tr>
                        <tr>
                            <td>Gecko</td>
                            <td>Mozilla 1.2</td>
                            <td>Win 95+ / OSX.1+</td>
                            <td>1.2</td>
                            <td>A</td>
                            <td>Win 95+</td>
                           
                        </tr>

                        </tfoot>
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
                <div class="pull-right box-tools">
                    <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /. tools -->
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
                        <tr class="even pointer" id="1">
                            <td class="a-center ">
                                <input type="checkbox" class="tableflat">
                            </td>
                            <td class=" ">121000040</td>
                            <td class=" ">May 23, 2014 11:47:56 PM </td>
                            <td class=" ">121000210 <i class="success fa fa-long-arrow-up"></i>
                            </td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="addabove" name="1"><button>add above</button></td>

                        </tr>
                        <tr class="odd pointer" id="2">
                            <td class="a-center ">
                                <input type="checkbox" class="tableflat">
                            </td>
                            <td class=" ">121000039</td>
                            <td class=" ">May 23, 2014 11:30:12 PM</td>
                            <td class=" ">121000208 <i class="success fa fa-long-arrow-up"></i>
                            </td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">Paid</td>
                            <td class="addabove" name="2"><button>add above</button></td>
                        </tr>

                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>


@endsection
