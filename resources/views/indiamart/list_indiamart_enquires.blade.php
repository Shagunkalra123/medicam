@extends('layouts.master')
@section('stylesheet')
    <!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"/>    
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>    
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"/>    

<link rel="stylesheet" href="{{asset('css/datatableCutstom.css')}}"/>
<link rel="stylesheet" href="{{asset('css/swal.css')}}"/> 
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}"/> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<style>
 
 .card-body {
    padding: 0.25rem !important;
}

.card-header {
    padding: 0rem 0rem !important;
}

.navbar {
    padding: 0rem 0rem;
}

table.dataTable tbody th, table.dataTable tbody td {
    padding: 2px 2px !important;
}

.button {
    position: absolute;
    top: 50%;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 26px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 26px;
  left: 2px;
  bottom: 3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
img {
  border-radius: 50%;
}

/*image css*/

body {font-family: Arial, Helvetica, sans-serif;}

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal1 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content1 {
  margin: auto;
  display: block;
  width: 80%;
  left:5%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content1, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close_modal {
  position: absolute;
  top: 15px;
  align:center;
  right: 15%;
  z-index:1;
  margin-top:40px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close_modal:hover,
.close_modal:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content1 {
    width: 100%;
  }
}

#container_div {
    background:#FAFAFA;

}
#headername {
 background:#6495ed;
 color:white;
}

.modal {
  position: absolute;
  top: 57%;
  left: 60%;
  transform: translate(-50%, -60%);
}

button.dt-button, div.dt-button, a.dt-button {
  background-image: linear-gradient(to bottom, #F08080   0%, #F08080 100%)!important;
  border-radius: 15px;
  color: white;
  font-size: 12px;
  margin: 10px 0px;
}
.text-wrap{
    white-space:normal;
}
.width-200{
    width:110px;
}
div.dt-button-collection button.dt-button.active:not(.disabled) {
background-image: linear-gradient(to bottom, #9cbbc7 0%, #4CAF50 100%)!important;
}
#data_table1 tbody tr.even:hover {
       background-color: cadetblue;
   }
 
   #data_table1 tr.odd:hover {
       background-color: cadetblue;
   }

  .bg-white {
    background-color: #1560ab !important;
}
#data_table tr td {
  height: 10px !important;
  padding :0;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')


<div class="card" id="container_div">
<div class="card-header" id="headername" style="font-weight:solid">
 <div class="row col-12">
    <div class="col-3">
        IndiaMart Enquiries
    </div>
    <div class="col-2"></div>
    <div class="col-2">
        <div class="input-group date input_date" data-provide="datepicker">
            <input type="text" id="from_date" name="from_date" placeholder="From" readonly class="form-control" >
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="input-group date input_date" data-provide="datepicker">
            <input type="text" id="to_date" name="to_date" placeholder="To" readonly class="form-control" >
               <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
        </div> 
    </div>
        <div class="col-1">
            <button class="btn btn-success" name="filter_date" id="filter_date" title="Filter"><i class="fa fa-filter"></i></button>
           
        </div>
    </div>
    
 </div>


<!--navigation tab-->
<!--
<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#menu1">Pending</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#">Completed</a>
    </li>
    
  </ul>-->


  
   <!--
 <div id="menu1" class="container tab-pane fade">-->
  <div class="card-body">
<div class="cc_wrapper">

</div>
      <!-- <table class="table nowrap data-table table-responsive display cell-border dataTable no-footer" style="display:inline-table" cellspacing="0" id="data_table1">-->
          
          <table class="table nowrap data-table table-responsive display cell-border" style="width:100%" cellspacing="0"  id="data_table1">
           
        <thead class="table_head">
           <th>Id</th>
           <th>Buyer Name</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Description	</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Action</th>
                
        </thead>
        <thead class="theadx1">
       <th>Sr nO</th>
                <th>Buyer Name</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Description	</th>
                <th>Quantity</th>
                <th>Date</th>
                
                 
                
        </thead>
        <tbody class="tbody">
        <?php $i=1; ?>
        @foreach($indiamart_datas as $indiamart_data)
            <tr>
            <td>{{$i}}</td>
            <td>{{$indiamart_data->byer_name}}</td>
            <td>{{$indiamart_data->address}}</td>
            <td>{{$indiamart_data->mobile}}</td>
            <td>{{$indiamart_data->email}}</td>
            <td>{{$indiamart_data->description}}</td>
            <td>{{$indiamart_data->quantity}}</td>
            <td>{{$indiamart_data->created_at}}</td>
           <td>
           <button class="btn btn-info" onclick="create_true_org(this);" data-orgemail="{{$indiamart_data->email}}" data-toggle="modal" data-target="#myModal" data-orgnumber="{{$indiamart_data->mobile}}" data-orgname="{{$indiamart_data->byer_name}}" data-address="{{$indiamart_data->address}}" name="create_organisation_true" title="Create Organisation"><i class="fas fa-notes-medical"></i></button>
           </td>
       
            
            </tr>
        <?php $i++; ?>
         
        @endforeach
        </tbody>
       
        
    </table>
    </div>
    </div>
   
  
<!--ends-->
</div>
</div>
<div class="modal fade" id="myModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <h1>Create organisation</h1>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
        <form id="org_form" name="org_form" class="form-horizontal">
                  <div class="form-group row">
                      {{csrf_field()}}
                          <div class="col-6">
                              <label>Organisation Name</label>
                              <input type="text" class="form-control" name="true_org" id="true_org" placeholder="Organisation Name" maxlength="100">
                              
                          </div>
                          <div class="col-6">
                              <label>Contact Person Name</label>
                              <input type="text" class="form-control" name="Contact_person_true" id="Contact_person_true" placeholder="Contact Person Name" maxlength="60" onkeypress="return isNumber(event)" />
                          </div>
                     
                    
                   
                  
                  </div>
                  <div class="form-group row">
                     
                          <div class="col-6">
                              <label>Mobile Number</label>
                              <input type="text" class="form-control" name="Mob_true" id="Mob_true" placeholder="Mobile Number" maxlength="100">
                          </div>
                          <div class="col-6">
                              <label>Email ID</label>
                              <input type="text" class="form-control" name="email_true" id="email_true" placeholder="Email ID" maxlength="60" onkeypress="return isNumber(event)" />
                          </div>
                     
                   
                   
                  
                  </div>
               
                
                   <div class="form-group row">
                     
                          <div class="col-12">
                              <label>Address </label>
                              <input type="text" class="form-control" name="address_true" id="address_true" placeholder="Address" maxlength="100">
                          </div>
                         
                     
                    
                   
                  
                  </div>
                   <div class="col-2">
                     
                     <button name="create_org" id="create_org" class="btn btn-success">Submit</button>
                    </div>
                </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    <!--modal for create_enquiry_form-->

<div class="modal fade" id="create_enquiry_form" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <h1>Create Enquiry</h1>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
        <form id="enquiry_form_true" name="enquiry_form_true" class="form-horizontal">
                  <div class="form-group row">
                      {{csrf_field()}}
                          <div class="col-6">
                              <label>Select Contact person</label>
                              <input type="text" class="form-control" name="Contact_person" id="Contact_person" placeholder="Contact person" maxlength="100">
                          </div>
                          <div class="col-6">
                              <label>Organisation</label>
                              <input type="text" class="form-control" name="org_enq_im" id="org_enq_im" placeholder="Organisation" maxlength="60" onkeypress="return isNumber(event)" />
                              <input type="text" class="form-control" name="org_enq_hidden" id="org_enq_hidden" placeholder="Organisation" maxlength="60" onkeypress="return isNumber(event)" hidden />
                          </div>
                     
                    
                   
                  
                  </div>
                 
                  
                 <div class="form-group row">
                  
                          <div class="col-6">
                          <label class="form-label required">Products</label>
                                <input list="product" oninput="onInput(this);" name="pro_enq" id="pro_enq" placeholder="Select" class="form-control product">
                                  <datalist id="product" name="pro_enq">
                                  @foreach($productID as $product)
                                      <option  data-price="{{$product->price}}" value="{{$product->product_name}}"></option>
                                  @endforeach
                                  </datalist>
                          </div>
                           <div class="col-6">
                              <label>Quantity</label>
                              <input type="text" class="form-control" name="quantity_true" id="quantity_true" placeholder="Quantity" maxlength="6" onkeypress="return isNumber(event)" />
                          </div>
                     
                    
                   
                  
                  </div>
                  <div class="form-group row">
                     <div class="col-6">
                              <label>Price</label>
                              <input type="text" class="form-control" name="price_true" id="price_true" placeholder="Price" maxlength="9"  />
                          </div>
                          <div class="col-6">
                              <label>Assign to</label>
                              <input list="assign_to" class="form-control" name="assign_to" id="Assign_toID" placeholder="Assign to" maxlength="60"  />
                          
                                  <datalist id="assign_to" name="assign_to">
                                  @foreach($Assign_toID as $employee)
                                      <option value="{{$employee->first_name}}&nbsp;{{$employee->last_name}}"></option>
                                  @endforeach
                                  </datalist>
                                 
                          </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-6">
                              <label>Coordinated With</label>
                              <input type="text" class="form-control" name="coo_Staff" id="coo_Staff" placeholder="Coordinated With" maxlength="60"  />
                          </div>
                          <div class="col-6">
                           <label>Nature</label>
                              <input list="browser"  name="enq_nature" id="enq_nature" placeholder="Select" class="form-control">
                                        <datalist id="browser"  name="nature_true">
                                            <option value="Cold" style="background-color: Blue;">Cold</option>
                                            <option value="Warm" style="background-color: DarkGreen;color: #FFFFFF;">Warm</option>        
                                            <option value="Hot" style="background-color: Red;">Hot</option>
                                            <option value="Not Interested" style="background-color: White;">Not Interested</option>
                                            <option value="Mature" style="background-color:#FFD933;">Mature</option>
                                            </datalist>
                          </div>
                  </div>
                
                   <div class="col-2">
                     
                     <button class="btn btn-success" name="save" id="enq_org">Submit</button>
                    </div>
                </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


    
@endsection
@section('javascript')
<!-- DataTables -->
<script src="{{asset('admin-lte/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin-lte/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
   
    <script>



      $(document).ready(function(){

  $('#data_table1 thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text"/>' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( data_table.column(i).search() !== this.value ) {
              data_table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );

 var date = new Date();
   var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

 if ( from_date!='' && to_date!='') {
 fetch_data();
}
 function fetch_data(from_date = '', to_date = '')
 {
 
  $.ajax({
   url:"/daterange/fetch_data",
   method:"GET",
   data:{from_date:from_date, to_date:to_date},
   dataType:"json",
   success:function(data)
   {
    console.log(data);
    var output = '';
    $('#data_table1_info').text(data.length+" Record(s) found");
    for(var count = 0; count < data.length; count++)
    {
      var counts = count+1;
     output += '<tr>';
      output += '<td>' + counts + '</td>';
     output += '<td>' + data[count].byer_name + '</td>';
     output += '<td>' + data[count].address + '</td>';
     output += '<td>' + data[count].mobile + '</td>';
     output += '<td>' + data[count].email + '</td>';
     output += '<td>' + data[count].description + '</td>';
     output += '<td>' + data[count].quantity + '</td>';
     output += '<td>' + data[count].created_at + '</td></tr>';
    }
    $('tbody').html(output);
   }
  })
 }



 $('#filter_date').click(function(){
  debugger;
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
   fetch_data(from_date, to_date);
  }
  else
  {
    swal("Both Date are required","", "warning");
  }
 });

 $('#refresh').click(function(){
   console.log("refresh");
  setTimeout(function() { location.reload(); }, 1000); 
 });


});

  $("#create_org").click(function(){
   event.preventDefault();
    var myForm = document.getElementById('org_form');
        var formData = new FormData(myForm);
      
         $.ajax({
          data: formData,
          url: "/create_true_org",
          type: "POST",
          dataType: 'json',
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
         
              swal("Organisation created successfully","","success");
              setTimeout(function(){ window.location.href="{{ url('/list_organization') }}";}, 2000); 
              // setTimeout(function() { location.reload(); }, 1000); 
            
          },
          
         
         
      });
        

  });

    $("#enq_org").click(function(){
   event.preventDefault();
    var myForm = document.getElementById('enquiry_form_true');
        var formData = new FormData(myForm);
         $.ajax({
          data: formData,
          url: "/create_enq_im",
          type: "POST",
          dataType: 'json',
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
         
              swal("IndiaMart Enquiry Converted Successfully!","","success");
              setTimeout(function() { location.reload(); }, 1000); 
            
          },
         
      });

  });

function onInput(context)
{  var elem=context;
 var val = elem.value;
var xyz = $('#product option').filter(function() {
        return this.value == val;
    }).data('price');
   
     $("#price_true").val(xyz); 
}

 function create_im_enquiry(context)
  {
    debugger;
    var name=context.getAttribute("data-orgname");
    var email=context.getAttribute("data-orgemail");
    var email=context.getAttribute("data-orgemail");
    var org_true_id=context.getAttribute("data-orgid");
   
    var address=context.getAttribute("data-address");
   
    var mobile_number=context.getAttribute("data-orgnumber");
     
    var org_id=context.getAttribute("data-orgid");
   
      $("#Contact_person").val(name);
      $("#org_enq_im").val(name);
      $("#org_enq_hidden").val(org_true_id);
      
      $("#quantity_true").val("1");
    
      
      
   
   
  }

  function create_true_org(context)
  {
    
    // debugger;
    var name=context.getAttribute("data-orgname");
    name=$.trim(name);
    var address=context.getAttribute("data-address");
    address=$.trim(address);
    address = address.replace(/\s+/g, " ");
    console.log(this);
    var mobile_number=context.getAttribute("data-orgnumber");
     mobile_number=$.trim(mobile_number);
    var email=context.getAttribute("data-orgemail");
     email=$.trim(email);
      // $("#true_org").val(name);
      // console.log("name");
      // console.log(name);
      $("#Contact_person_true").val(name);
      console.log("name");
      console.log(name);
      $("#email_true").val(email);
      console.log("email");
      console.log(email);
      $("#Mob_true").val(mobile_number);
      console.log("mobile_number");
      console.log(mobile_number);
      $("#address_true").val(address);
      console.log("address");
      console.log(address);
   
  }


      function complete_orders(data)
     {

        var order_id=data.getAttribute('data-lists');
        alert(order_id);
        $.ajax({
            url:"/orders_complete/"+order_id,
            method:"get",
            cache:false,
            processData: true,
            success:function(data)
            {   
              swal("Order completed successfully","","success");
              setTimeout(function() { location.reload(); }, 1000); 

            }
        });
     }

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});



  $('#data_table thead.theadx th').each( function () {
        var title = $(this).text();
        $(this).html( '<input id="column_3_search" class="column_filter" type="text" />' );
    } );

     var data_table=$('#data_table1').DataTable({
      "order": [[ 0, "desc" ]],
      "paging":true,
      "lengthMenu": [10],
       "searching": true,
       columnDefs: [
                {
                    render:                                                                                               function (data, type, full, meta) {
                        return "<div>" + data + "</div>";
                    },
                    targets: [ 1,2,3,4,5,6 ]
                },
                { orderable: false, targets: [-1,-2,-3,-4,-5,-6,-7,-8] }
             ],
       dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            'colvis'
        ]
      
    });

function imagezoom(evt){
    var modal = document.getElementById("myModal1");
    var img = evt.id;
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption1");
    modal.style.display = "block";
    modalImg.src = evt.src;
 

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close_modal")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
    modal.style.display = "none";
    }
}
     
   
    
    </script>
@endsection
     