@extends('backend.layouts.master')

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
                            <h2>Import Inventory <small>Report</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row" style="text-align: center">
                            <div id="equalheight" style="padding: 10px">
                                <div class="col-md-4 demo" style="border-right: 1px solid black; background-color: rgba(49, 92, 255, 0.33)">
                                    <h4 style="float: left;">Select Supplier</h4><h4 style="float: right;">Min. Value:&nbsp;<span style="color: red">150</span></h4>

                                    <p></p>
                                    <div class="form-group">
                                        <select class="form-control" id="sel1">
                                            <option>Rainbow Cosmetic</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 demo" style="border-right: 1px solid black; background-color: rgba(49, 92, 255, 0.33)">
                                    <h4 style="float: left;">Update Option</h4>
                                    <span class="clearfix"></span>
                                    <form>

                                    <div class="fileupload fileupload-new" data-provides="fileupload" style="float: left">
                                        <label> Import file:</label>
                                    <span class="btn btn-primary btn-file"><span class="fileupload-new">Select file</span>
                                     <span class="fileupload-exists">Change</span>         <input type="file" /></span>
                                        <span class="fileupload-preview"></span>
                                    </div>
                                        <button type="submit" class="btn btn-primary" style="float: right">Update Inventory</button>

                                    </form>
                                    <button type="button" class="btn btn-primary">Update Live</button>
                                    &nbsp;
                                    &nbsp;
                                    &nbsp;
                                    <button type="button" class="btn btn-primary">Settings</button>



                                </div>
                                <div class="col-md-4 demo" style="border-right: 1px solid black; background-color:rgba(49, 92, 255, 0.33)"><h4 style="float: left;">Last Update Selected Supplier Summary </h4>
                                    <span class="clearfix"></span>


                                            <p style="color: red; font-size: large; float: left">Total Products:<span>&nbsp;<i class="fa fa-gbp"></i> 120.9</span></p>
                                            <span class="clearfix"></span>
                                            <p style="color: blue; font-size: large; float: left">Update Products:<span>&nbsp;<i class="fa fa-gbp"></i> 20.9</span></p>
                                            <span class="clearfix"></span>
                                            <p style="color: blue; font-size: large; float: left">New Products:<span>&nbsp;<i class="fa fa-gbp"></i> 20.9</span></p>
                                            <span class="clearfix"></span>
                                            <p style="color: blue; font-size: large; float: left">Zero Inventory Products:<span>&nbsp;<i class="fa fa-gbp"></i> 20.9</span></p>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="x_content">
                        <table id="importinventorytable1" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                            <tr class="headings">
                                <th>
                                    S#
                                </th>
                                <th>Select</th>

                                <th>Magento Attribute</th>
                                <th>Supplier Attribute Name</th>


                            </tr>
                            </thead>

                            <tbody>
                            <tr class="even pointer">
                                <td class=" ">121000040</td>

                                <td class="a-center ">
                                    <input type="checkbox" class="tableflat">
                                </td>
                                <td class=" ">121000040</td>
                                <td class=" ">May 23, 2014 11:47:56 PM </td>

                            </tr>
                            <tr class="even pointer">
                                <td class=" ">121000040</td>

                                <td class="a-center ">
                                    <input type="checkbox" class="tableflat">
                                </td>
                                <td class=" ">121000040</td>
                                <td class=" ">May 23, 2014 11:47:56 PM </td>

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
    <div class="box-body" style="margin: 20px">
        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Order Ready To Dispatch  <small>Report</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row" style="text-align: center">
                        <div id="equalheight" style="padding: 10px">
                            <div class="col-md-2 demo" style=" background-color: rgba(49, 92, 255, 0.33)">
                                <br>
                                <button type="button" class="btn btn-primary">Remove Selected</button>

                            </div>
                            <div class="col-md-8 demo" style=" background-color: rgba(49, 92, 255, 0.33)">
                                <h3>New Product Report(Selected Supplier)</h3>

                            </div>
                            <div class="col-md-2 demo" style=" background-color:rgba(49, 92, 255, 0.33)">
                                <br>
                                <button type="button" class="btn btn-primary">Remove All</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="x_content">
                    <table id="importinventorytable2" class="table table-striped responsive-utilities jambo_table">
                        <thead>

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
                            <td>1</td>
                            <td class="a-center ">
                                <input type="checkbox" class="tableflat"><span>Changeable</span>
                            </td>
                            <td class=" ">gsgdsfg</td>
                            <td class=" ">100ml </td>
                            <td class=" ">Adidas</td>
                            <td class=" ">men ss L</td>
                            <td class=" ">wt5363</td>
                            <td class=" ">231345</td>
                            <td class=" ">353354</td>
                            <td class=" ">535</td>
                            <td class=" ">image</td>
                            <td class=" "><button>add to magento</button></td>


                        </tr>
                        <tr class="odd pointer">
                            <td>2</td>
                            <td class="a-center ">
                                <input type="checkbox" class="tableflat">
                            </td>
                            <td class=" ">121000039</td>
                            <td class=" ">May 23, 2014 11:30:12 PM</td>
                            <td class=" ">121000208 <i class="success fa fa-long-arrow-up"></i>
                            </td>
                            <td class=" ">John Blank L</td>
                            <td class=" ">wt5363</td>
                            <td class=" ">231345</td>
                            <td class=" ">353354</td>
                            <td class=" ">535</td>
                            <td class=" ">image</td>
                            <td class=" "><button>add to magento</button></td>



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
    </div><!--box box-success-->



@endsection
