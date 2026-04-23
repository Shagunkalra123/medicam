<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Medicam | Dashboard</title>
  <link rel = "icon" href = "admin-lte/dist/img/Logo_Trans.png" 
        type = "image/x-icon"> 

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin-lte/plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- font asw -->
<script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin-lte/dist/css/adminlte.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('admin-lte/plugins/iCheck/flat/blue.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('admin-lte/plugins/morris/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('admin-lte/plugins/datepicker/datepicker3.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('admin-lte/plugins/daterangepicker/daterangepicker-bs3.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"  >

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<style>
  .neon {
      color: #D0F8FF;
    
      font-size:35px;
      text-shadow: 0 0 5px #A5F1FF, 0 0 10px #A5F1FF,
                0 0 20px #A5F1FF, 0 0 30px #A5F1FF,
                0 0 40px #A5F1FF;
  }
  #dvLoading{
    left: 0%;
    top: 0%;
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: 1000;
    background: url('images/loading.gif') no-repeat center center;
    margin: -25px 0 0 -25px;
    opacity: .8;

}
#data_table td, #data_table1 td {
  vertical-align: middle;
  text-align: center;
}
/* #data_table, #data_table1 {
  display: inline-table;
} */
div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    display: none;
}
.bg-white {
    background-color: #1560ab!important;
}
  </style>
   <script type="text/javascript">
$(window).load(function() {
 // debugger;
  $('#dvLoading').fadeOut(1000);

});
</script>
  @yield('stylesheet')
</head>
<div id="dvLoading" ></div>
<div id="body_loader">


<body  class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom " >
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-1">
      <div class="input-group input-group-sm">
        <div class="input-group-append" style="align-content: center;">
          <h5 style="text-align: center; color: white; text-shadow: 3px 3px black;">Medicam - CRM</h5>
          </div>
      </div>
    </form>
 
    <!-- Log-out Button -->
     <ul class="navbar-nav ml-auto">
     <li class="nav-item">
     <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();" style="text-align: center; color: white; text-shadow: 3px 3px black;">
             Logout <i class="fas fa-power-off" style="text-align: center; color: white; text-shadow: 3px 3px black;" ></i>
              
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
              </form> 
              </li>  
              </ul>    
              
     
  </nav><br>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home" class="brand-link">     
          <img src="{{asset('admin-lte/dist/img/Medi_M.png')}}" alt="AdminLTE Logo" class="  brand-image"
          style="opacity: .8; width: 50px; height:100%; margin-top: 10px" >
          <span class="brand-text font-weight-light neon">Medicam</span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin-lte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              


        @can('isAdmin')
          <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link">
            <i class="fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @endcan
          <!-- starts-->
           
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-info-circle"></i>
              <p>
                IndiaMart Enquiries 
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          <ul class="nav nav-treeview">
              <li class="nav-item">
                    <a href="{{route('indiamart_list')}}" class="nav-link">
                    &nbsp;&nbsp; <i class="fas fa-list"></i>
                      <p>List of Enquires</p>
                    </a>
                  </li>
              
            </ul>
         </li>

          <!-- ends-->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="fas fa-building"></i>
              <p>
                Organization
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          <ul class="nav nav-treeview">
              <li class="nav-item">
                    <a href="{{route('addclient')}}" class="nav-link">
                    &nbsp;&nbsp; <i class="fas fa-plus-circle"></i>
                      <p>Create Organization</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('secondary')}}" class="nav-link">
                    &nbsp;&nbsp; <i class="fas fa-plus-circle"></i>
                      <p>Create Secondary Organization</p>
                    </a>
                  </li>
              <li class="nav-item">
                <a href="{{route('listorg')}}" class="nav-link">
                &nbsp;&nbsp;<i class="fas fa-list"></i>
                  <p>List Primary Organizations</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('listorg_sec')}}" class="nav-link">
                &nbsp;&nbsp;<i class="fas fa-list"></i>
                  <p>List Secondary Organizations</p>
                </a>
              </li>


              
              
             <!-- <li class="nav-item">
                <a href="{{route('createenquiry')}}" class="nav-link">
                <i class="fas fa-plus-square"></i>
                  <p>Update Organization</p>
                </a>
              </li>-->
            </ul>
         </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-pen-square"></i>
              <p>
                Enquiry
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{route('createenquiry')}}" class="nav-link">
                &nbsp;&nbsp; <i class="fas fa-plus-square"></i>
                  <p>Create Enquiry</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('listEnquiry')}}"ute class="nav-link">
                &nbsp;&nbsp; <i class="fas fa-list-ul"></i>
                  <p>List All Enquires</p>
                </a>
              </li>                         
            </ul>
            </li>
           
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
              <i class="fas fa-people-carry"></i>
                <p>
                Quotation
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/proposals/index/0" class="nav-link">
                  &nbsp;&nbsp;  <i class="fas fa-plus-circle"></i>
                    <p>Add Quotation</p>
                  </a>
                </li>
                </ul>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('list_proposals')}}" class="nav-link">
                  &nbsp;&nbsp;  <i class="fas fa-list"></i>
                    <p>List All Quotations</p>
                  </a>
                </li>
                </ul>
                </li>

            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-box-open"></i>
              <p>
             Orders
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/orders/0/0/0" class="nav-link">
                &nbsp;&nbsp;  <i class="fas fa-plus-circle"></i>
                  <p>Create Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('list_orders')}}" class="nav-link">
                &nbsp;&nbsp;  <i class="fas fa-list"></i>
                  <p>List All Orders</p>
                </a>
              </li>
              </ul>
              </li>
              @cannot('isSales')
              <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-file-invoice-dollar"></i>
              <p>
              Invoice
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('invoiceActive')}}" class="nav-link">
                &nbsp;&nbsp;   <i class="fas fa-list-ul"></i>
                  <p>List All Active Invoices</p>
                </a>
              </li>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('invoiceComplted')}}" class="nav-link">
                &nbsp;&nbsp;  <i class="fas fa-list-ul"></i>
                  <p>List All Completed Invoices</p>
                </a>
              </li>
              </ul>
              </li>
              
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fa fa-cart-arrow-down"></i>
                  <p>
                  Ebay
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">          
                  <li class="nav-item">
                    <a href="{{route('ebaylisting_page')}}" class="nav-link">
                    &nbsp;&nbsp; <i class="fas fa-list-ul"></i>
                      <p>List All Ebay Orders</p>
                    </a>
                  </li>
                </ul>
                  
              </li>
            @endcannot




             <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-pencil-ruler"></i>
              <p>
                Follow Ups
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('followup_cre')}}" class="nav-link">
                &nbsp;&nbsp;  <i class="fa fa-plus-circle nav-icon"></i>
                  <p>Create follow Up</p>
                </a>
              </li>
              </ul>-->
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('followup_meet')}}" class="nav-link">
                  &nbsp;&nbsp;  <i class="fa fa-handshake nav-icon"></i>
                    <p>Create meeting</p>
                  </a>
                </li>
                </ul>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('followup_list')}}" class="nav-link">
                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-list" aria-hidden="true"></i>
                    <p>List of follow ups</p>
                  </a>
                </li>
                </ul>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('meeting_list')}}" class="nav-link">
                  &nbsp;&nbsp; <i class="fa fa-list" aria-hidden="true"></i>
                    <p>Lists of Meetings</p>
                  </a>
                </li>
                </ul>
          </li>
 @cannot('isSales')
          <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-pie-chart"></i>
              <p>Product
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('ajaxproducts.index')}}" class="nav-link">
                &nbsp;&nbsp;  <i class="fas fa-plus-circle"></i>
                  <p>Create Product</p>
                </a>
              </li>
              </ul>
          </li>




          </li>
          
         <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-user-circle"></i>
              <p>
              Employee
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('add_newstaff')}}" class="nav-link">
                &nbsp;&nbsp;  <i class="fas fa-plus-circle"></i>
                  <p>Add New Staff</p>
                </a>
              </li>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('employees')}}" class="nav-link">
                &nbsp;&nbsp; <i class="fas fa-list"></i>
                  <p>List of Employees</p>
                </a>
              </li>
              </ul>
              </li>
         
         
              <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-database"></i>
              <p>
              Master
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
          
            <ul class="nav nav-treeview">
            
            <li class="nav-item has-treeview">
            
            <a href="#" class="nav-link">
            &nbsp;&nbsp;<i class="fa fa-file"></i>
              <p>
              Organization Form
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('industry')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-plus-circle"></i>
                  <p>Industry</p>
                </a>
              </li>
              </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('state')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-plus-circle"></i>
                  <p>State</p>
                </a>
              </li>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('datasource_cre')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-plus-circle"></i>
                  <p>Data Source</p>
                </a>
              </li>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('branch')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp;  <i class="fas fa-plus-circle"></i>
                  <p>Branch</p>
                </a>
              </li>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('organizationtype')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-plus-circle"></i>
                  <p>Organization Type</p>
                </a>
              </li>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('country')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-plus-circle"></i>
                  <p>Country</p>
                </a>
              </li>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('zone')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-plus-circle"></i>
                  <p>Zone</p>
                </a>
              </li>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('associationwithmedicam')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-plus-circle"></i>
                  <p>Association With Medicam</p>
                </a>
              </li>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('subpriority')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-plus-circle"></i>
                  <p>Sub Priority</p>
                </a>
              </li>
              </ul>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            &nbsp;&nbsp;<i class="fa fa-file"></i>
              <p>
              Enquiry Form
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('enquirydatasource')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-plus-circle"></i>
                  <p>Enquiry Data Source</p>
                </a>
              </li>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('enquirytype')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-plus-circle"></i>
                  <p>Enquiry Type</p>
                </a>
              </li>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('referredby')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-plus-circle"></i>
                  <p>Referred By</p>
                </a>
              </li>
              </ul>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            &nbsp;&nbsp;<i class="fa fa-file"></i>
              <p>
              Product Form
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('category_cre')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-plus-circle"></i>
                  <p>Product Category</p>
                </a>
              </li>
              </ul>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            &nbsp;&nbsp;<i class="fa fa-file"></i>
              <p>
              Quotation Form
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('relation')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp;  <i class="fas fa-plus-circle"></i>
                  <p>Related</p>
                </a>
              </li>
              </ul>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('currency')}}" class="nav-link">
                &nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-plus-circle"></i>
                  <p>Currency</p>
                </a>
              </li>
              </ul>
              </ul>
         @endcannot    
            
              
    
              
              {{-- <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="fa fa-cog"></i>
              <p> {{ __('Logout') }}</p>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
              </form>      
              </li> --}}
 <br><br><br><br><br>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <!-- Main content -->
    <section class="content">
   
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy;2019 <a href="https://www.darstek.com">darstek.com</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="{{asset('admin-lte/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Morris.js')}} charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('admin-lte/plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('admin-lte/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin-lte/plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{asset('admin-lte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('admin-lte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('admin-lte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('admin-lte/plugins/fastclick/fastclick.js')}}"></script>
<script src="{{asset('admin-lte/plugins/chartjs-old/Chart.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin-lte/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin-lte/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin-lte/dist/js/demo.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js">
  
  </script>
<script>
$( document ).ready(function() {
  


  ///order count for notification
    
    //setInterval(function(){ enquiry_count_count(); }, 40000);
     //////ebay order notification
  $.ajax({
          
          url: "/order_count",
          type: "GET",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data_count) {
            console.log(data_count);
           show_ebay_notification(data_count);
            //document.getElementById("ebay_orders").innerHTML = data_count;

            //setTimeout(function() { location.reload(); }, 2000);
          }, 
      });

  $.ajax({
          
          url: "/indiamart",
          type: "GET",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data_count) {
            
          }, 
      });
      
        $.ajax({
          
          url: "/followup/showall/",
          type: "GET",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data_count) {
            console.log("done");
              show_follow_up_notification(data_count);
          }, 
      });
      
        $.ajax({
          
          url: "/meetings/showall/",
          type: "GET",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data_count) {
            console.log("done");
              show_meeting_notification(data_count);
          }, 
      });
      /////////indiamart enquiries notification
// debugger;
      $.ajax({
          
          url: "/indiamart",
          type: "GET",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
              // debugger;
          console.log(data);
          if(data!=0){
            //document.getElementById("im_enq").innerHTML = data;


          }
          
           

            //setTimeout(function() { location.reload(); }, 2000); 
         
         },
          
         
      });
  
          $.ajax({
          
          url: "/followup_counter",
          type: "GET",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
				// var json=JSON.parse(data);
               var d = new Date();
               var Hours = d.getHours();
               var minutes = d.getMinutes();
               var time=Hours+":"+minutes;

         //  show_followup_notification(json,time);
                        
         
         },
          
         
      });
  

    });

function show_follow_up_notification(data)
{
      for (i = 0; i < data.length; i++) { 
 var date_in_loop= data[i]['rem_date'];
 var subject=data[i]['subject'];
 var date=data[i]['rem_date'];
 var time=data[i]['rem_time'];
 var enq_id=data[i]['enquiry_id'];
 var unique_local=subject+enq_id;
 //console.log(test);
 var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
var time = today.getHours() + ":" + today.getMinutes();
var hours=today.getHours();
today = yyyy + '-' + mm + '-' + dd;
if(today==date_in_loop)
{
   var time_in_loop= data[i]['rem_time'];
   
   var splitter=time_in_loop.split(":");
   if(hours>splitter[0])
   {
     //alert("time right is greater");

   }
   else
   {
     // debugger;
    var hour_diff= parseInt(splitter)-parseInt(hours);
     if(hour_diff<=1)
     {
        if (localStorage.getItem(unique_local) === null)
        {
            localStorage.setItem(unique_local, "Set");
        
                  toastr.success("You have follow up call regarding <br/> <b>Subject: </b>"+subject+" <br/> <b>Date: </b>"+date+" <br/> <b>Time: </b>"+time+" <br/> <a class='close-toastr'> <center>Close</center> </a>", "", {
            tapToDismiss: false
            , timeOut: 0
            , extendedTimeOut: 0
            , allowHtml: true
            , preventDuplicates: true
            , preventOpenDuplicates: true
            , newestOnTop: true
        }); 
                        $('.close-toastr').on('click', function () {
                toastr.clear($(this).closest('.toast'));
            });
     }

     }
   }


}
}
   
}
function show_meeting_notification(data)
{
      for (i = 0; i < data.length; i++) { 
 var date_in_loop= data[i]['meeting_date'];
 var subject=data[i]['subject'];
 var date=data[i]['meeting_date'];
 var time=data[i]['meeting_time'];
 var enq_id=data[i]['meeting_with'];
 var unique_local=subject+enq_id;
 //console.log(test);
 var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
var time = today.getHours() + ":" + today.getMinutes();
var hours=today.getHours();
today = yyyy + '-' + mm + '-' + dd;
if(today==date_in_loop)
{
   var time_in_loop= data[i]['meeting_time'];
   
   var splitter=time_in_loop.split(":");
   if(hours>splitter[0])
   {
     //alert("time right is greater");

   }
   else
   {
     // debugger;
    var hour_diff= parseInt(splitter)-parseInt(hours);
     if(hour_diff<=1)
     {
        if (localStorage.getItem(unique_local) === null)
        {
            localStorage.setItem(unique_local, "Set");
        
                  toastr.success("You have Meeting call regarding "+subject+" <br/> <a class='close-toastr'> <center>Close</center> </a>", "", {
            tapToDismiss: false
            , timeOut: 0
            , extendedTimeOut: 0
            , allowHtml: true
            , preventDuplicates: true
            , preventOpenDuplicates: true
            , newestOnTop: true
        }); 
                        $('.close-toastr').on('click', function () {
                toastr.clear($(this).closest('.toast'));
            });
     }

     }
   }


}
}
   
}

    function show_ebay_notification(data_count)
    {
      if(data_count!=0)
      {
      toastr.success("There are "+data_count+" new Orders in Ebay <br/> <a class='close-toastr'> Ok </a>", "", {
    tapToDismiss: false
    , timeOut: 0
    , extendedTimeOut: 0
    , allowHtml: true
    , preventDuplicates: true
    , preventOpenDuplicates: true
    , newestOnTop: true
});
      }

$('.close-toastr').on('click', function () {
    toastr.clear($(this).closest('.toast'));
});

    }


      function show_followup_notification(data_count,time)
    {

      if(data_count!=0)
      {
      toastr.success("There are "+data_count+" new Orders in Ebay <br/> <a class='close-toastr'> Ok </a>", "", {
    tapToDismiss: false
    , timeOut: 0
    , extendedTimeOut: 0
    , allowHtml: true
    , preventDuplicates: true
    , preventOpenDuplicates: true
    , newestOnTop: true
});
      }

$('.close-toastr').on('click', function () {
    toastr.clear($(this).closest('.toast'));
});

    }



function enquiry_count_count()
{
    $.ajax({
          
          url: "/indiamart",
          type: "GET",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
          console.log(data);
           show_indiamart_notification(data);
            //document.getElementById("ebay_orders").innerHTML = data_count;

            //setTimeout(function() { location.reload(); }, 2000); 
         
         },
          
         
      });
}

function show_indiamart_notification(data_count)
    {
      if(data_count!=0)
      {
      toastr.success("There are "+data_count+" new IndiaMart Enquiries <br/> <a class='close-toastr'> Ok </a>", "", {
    tapToDismiss: false
    , timeOut: 0
    , extendedTimeOut: 0
    , allowHtml: true
    , preventDuplicates: true
    , preventOpenDuplicates: true
    , newestOnTop: true
});
      }

$('.close-toastr').on('click', function () {
    toastr.clear($(this).closest('.toast'));
});

    }
     
   
</script>


@yield('javascript')
</body>
<div>
</html>
