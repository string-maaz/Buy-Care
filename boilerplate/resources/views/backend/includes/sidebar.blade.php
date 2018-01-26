          <!-- Left side column. contains the logo and sidebar -->
          <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel">
                <div class="pull-left image">
                  <img src="{!! access()->user()->picture !!}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                  <p>{{ access()->user()->name }}</p>
                  <!-- Status -->
                  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
              </div>

              <!-- search form (Optional) -->

              <!-- /.search form -->

              <!-- Sidebar Menu -->
              <ul class="sidebar-menu">
                <li class="header">{{ trans('menus.general') }}</li>

                <!-- Optionally, you can add icons to the links -->
                <li class="{{ Active::pattern('admin/print-label-invoice') }}"><a href="{!!url('admin/print-label-invoice')!!}"><span>{{ trans('Print Label & invoice') }}</span></a></li>
                <li class="{{ Active::pattern('admin/order-shipment-report') }}"><a href="{!!url('admin/order-shipment-report')!!}"><span>{{ trans('Order & Shipment Report') }}</span></a></li>
                <li class="{{ Active::pattern('admin/todays-final-order') }}"><a href="{!!url('admin/todays-final-order')!!}"><span>{{ trans('Today`s Final order') }}</span></a></li>
                <li class="{{ Active::pattern('admin/transit-order-report') }}"><a href="{!!url('admin/transit-order-report')!!}"><span>{{ trans('Transit Order Report') }}</span></a></li>
                <li class="{{ Active::pattern('admin/import-inventory') }}"><a href="{!!url('admin/import-inventory')!!}"><span>{{ trans('Import Inventory') }}</span></a></li>




              </ul><!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
          </aside>
