@extends('layouts.master')

@section('stylesheet')
    <!-- DataTables -->
    
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"/>       
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>    
<link rel="stylesheet" href="{{asset('css/datatableCutstom.css')}}"/>
<link rel="stylesheet" href="{{asset('css/swal.css')}}"/> 
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}"/> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<style>
    .cc_wrapper {
    text-align: right;
}

.button {
    position: absolute;
    top: 50%;
}

</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<style>
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

button.dt-button, div.dt-button, a.dt-button {
  background-image: linear-gradient(to bottom, #F08080   0%, #F08080 100%) !important;
  border-radius: 15px;
  color: white;
  font-size: 12px;
  margin: 10px 0px;
}
.card-body{
  padding:0;
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
#data_table tbody tr.even:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
 
   #data_table tr.odd:hover {
       background-color: cadetblue;
       cursor: pointer;
   }

   #data_table1 tbody tr.even:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
 
   #data_table1 tr.odd:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
     .bg-white {
    background-color: #1560ab!important;
}
</style>

<div class="modal fade" id="create_enquiry_form" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <h1>Create Order</h1>
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
                              <input type="text" class="form-control" name="org_enq_im" id="org_enq_im" placeholder="Organisation" maxlength="6" onkeypress="return isNumber(event)" />
                              <input type="text" class="form-control" name="org_enq_hidden" id="org_enq_hidden" placeholder="Price" maxlength="6" onkeypress="return isNumber(event)" hidden/>
                          </div>
                     
                    
                   
                  
                  </div>
                 
                  
                 <div class="form-group row">
                  
                          <div class="col-6">
                          <label class="form-label required">Products</label>
                                <input list="product"  name="pro_enq" id="pro_enq" placeholder="Products" class="form-control product">
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
                              <input type="number" class="form-control" name="price" id="price_true" placeholder="Price" maxlength="6"  />

                             

                          </div>
                          <div class="col-6">
                               <label>Assign to</label>
                              <input list="Assign_To" class="form-control" name="assign_to" id="assign_to" placeholder="Assign to" maxlength="60"  />
                               <datalist id="Assign_To" name="Assign_to[]">
                                  @foreach($Assign_toID as $employee)
                                      <option value="{{$employee->first_name}}&nbsp;{{$employee->last_name}}">
                                  @endforeach
                                  </datalist>
                                  </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-6">
                              <label>Coordinated With</label>
                              <input type="text" class="form-control" name="coo_Staff" id="coo_Staff" placeholder="Coordinated With" maxlength="6"  />
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
                          </div>
                  </div>
                 <div class="form-group row">
                     <div class="col-6">
                              <label>Mobile No</label>
                              <input type="number" class="form-control" name="ebay_mobile" id="ebay_mobile" placeholder="Mobile No" maxlength="12"  />

                             

                          </div>
                          <div class="col-6">
                               <label>Email</label>
                           <input type="text" class="form-control" name="ebay_email" id="ebay_email" placeholder="Email" maxlength="50"  />
                                <input type="text" class="form-control" name="ebay_total" id="ebay_total" placeholder="Email" maxlength="50" hidden  />
                                  </div>
                  </div>
                       <div class="form-group row">
                        <div class="col-12">
                              <label>Address</label>
                              <input type="textarea" class="form-control" name="ebay_address" id="ebay_address" placeholder="Address" maxlength="200"  />

                             

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

<div class="card" id="container_div">
<div class="card-header" id="headername" style="font-weight:solid">
  Ebay Orders
</div>
<div id="myModal1" class="modal1">
  <span class="close_modal">&times;</span>
  <img class="modal-content1" id="img01">
  <div id="caption1"></div>
</div>
<!--navigation tab-->
<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Pending</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Completed</a>
    </li>
    
  </ul>



<div class="tab-content">
    <div id="home" class="tab-pane active"><br>
       <div class="card-body">
    <div class="cc_wrapper">

</div>
   
    <table class=" table nowrap data-table table-responsive display cell-border dataTable no-footer" style="display:block;overflow-x: auto" cellspacing="0"  id="data_table">
       
        <thead class="table_head">
            <th>Action</th>
           <th>Id</th>
                
                <th>Order Time</th>
                <th>Item Title</th>
                <th>Buyer Name</th>
                <th>Buyer Email</th>
                <th>Image</th>
                 <th>Sale Record Id</th>
                <th>Price</th>
                 <th>Total Amount</th>
                 <th>Total Quantity</th>
                 <th>Order ID</th>
                 

             
               
                
        </thead>
        <thead class="theadx1">
            <th>Action</th>
       <th>Id</th>
                 <th>Order Time</th>
                <th>Item Title</th>
                <th>Buyer Name</th>
                <th>Buyer Email</th>
                <th>Image</th>
                <th>Sale Record Id</th>
                <th>Price</th>
                 <th>Total Amount</th>
                 <th>Total Quantity</th>
                 <th>Order ID</th>
                
        </thead>
        <tbody class="tbody">
        <?php $counter=0; ?>
        <?php $i=1;
        
        ?>
        @foreach($ebays as $ebay)
          @if ($ebay->completion_token=='0')
              
         
            <tr>
                <td align="center">
            
            <button class="btn btn-warning" data-ebayphone="{{$ebay->phone}}" data-addressuni="{{$ebay->address.','.$ebay->city_name.','.$ebay->country_name}}" data-total="{{$ebay->totalamount}}" data-buyeremail="{{$ebay->byer_email}}" data-buyername="{{$ebay->Buyer_name}}" onclick="create_ebay_order(this);" data-toggle="modal" data-target="#create_enquiry_form"  data-lists="{{$ebay->id}}" data-enqId="{{$ebay->completion_token}}"   name="transfer_to_order" title="Transfer to Order" ><i class="fas fa-notes-medical"></i></button>
            <button class="btn btn-success createOrder"  data-lists="{{$ebay->id}}" data-enqId="{{$ebay->completion_token}}" onclick="complete_orders(this)"  name="completeOrder" title="Complete Order" ><i class="fas fa-check-circle"></i></button>
            </td>
            
            <td>{{$i}}</td>
            <td> <?php $date_time= $ebay->order_date;
            $date= explode("T",$date_time);
             echo $date[0];
             echo "  ";
             $date = $date[1];
             $d = explode(".", $date);
             echo $d[0] ?></td>
            <td>{{$ebay->item_title}}</td>
            <td>{{$ebay->Buyer_name}}</td>
            <td>{{$ebay->byer_email}}</td>
         
            <td>
                
	            <img src="{{URL::to($ebay->image_url)}}" width="30" height="30" id="{{'img'.$counter}}" onclick="imagezoom(this);">
                <?php $counter++; ?>
            </td>
	           
         
            <td>{{$ebay->SaleRecordID}}</td>
            <td>{{$ebay->SalePrice}}</td>
            <td>{{$ebay->totalamount}}</td>
            <td>{{$ebay->totalquantity}}</td>
            <td>{{$ebay->order_id}}</td>
            </tr>
        <?php $i++; ?>
         @endif
        @endforeach
        </tbody>
       
        
    </table>
   

</div>
  </div>
    <div id="menu1" class="tab-pane fade"><br>
    <div class="card-body">
    <div class="cc_wrapper">

</div>
      <table class=" table nowrap data-table table-responsive display cell-border dataTable no-footer" style="display:inline-table; display:block;overflow-x: auto" cellspacing="0"  id="data_table1">
       
        <thead class="table_head">
           <th>Id</th>
                 <th>Order Date</th>
                <th>Item Title</th>
                <th>Buyer Name</th>
                <th>Buyer Email</th>
                <th>Image</th>
                 <th>Sale Record Id</th>
                <th>Price</th>
                 <th>Total Amount</th>
                 <th>Total Quantity</th>
                 <th>Order ID</th>
                 
             
               
                
        </thead>
        <thead class="theadx1">
       <th>Id</th>
                 <th>Order Date</th>
                <th>Item Title</th>
                <th>Buyer Name</th>
                <th>Buyer Email</th>
                <th>Image</th>
                 <th>Sale Record Id</th>
                <th>Price</th>
                 <th>Total Amount</th>
                 <th>Total Quantity</th>
                 <th>Order ID</th>
                 

                
        </thead>
        <tbody class="tbody">
        <?php $counter=0; ?>
        <?php $i=1;
        
        ?>
        @foreach($ebays as $ebay)
         @if ($ebay->completion_token=='1')
            <tr>
            <td>{{$i}}</td>
            <td> <?php $date_time= $ebay->order_date;
            $date= explode("T",$date_time);
             echo $date[0];
             echo "  ";
             $date = $date[1];
             $d = explode(".", $date);
             echo $d[0] ?></td>
            <td>{{$ebay->item_title}}</td>
            <td>{{$ebay->Buyer_name}}</td>
            <td>{{$ebay->byer_email}}</td>
            <td>    
	            <img src="{{URL::to($ebay->image_url)}}" width="30" height="30" id="{{'img'.$counter}}" onclick="imagezoom(this);">
                <?php $counter++; ?>
            </td>
	           
         
            <td>{{$ebay->SaleRecordID}}</td>
            <td>{{$ebay->SalePrice}}</td>
            <td>{{$ebay->totalamount}}</td>
            <td>{{$ebay->totalquantity}}</td>
             <td>{{$ebay->order_id}}</td>
            </tr>
        <?php $i++; ?>
          @endif
        @endforeach
        </tbody>
       
        
    </table>
   
    </div>
   </div>
  </div>
<!--ends-->
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


      $('#pro_enq').on('input', function() {
    //debugger;
    var val = $('#pro_enq').val()
    var xyz = $('#product option').filter(function() {
        return this.value == val;
    }).data('price');
     $("#price_true").val(xyz);
  });

      function create_ebay_order(context)
  {
    debugger;
    var total=context.getAttribute("data-total");
    var buyer_email=context.getAttribute("data-buyeremail");
    var buyer_name=context.getAttribute("data-buyername");
    var address=context.getAttribute("data-addressuni");
    var phone=context.getAttribute("data-ebayphone");
   
 
            
      $("#Contact_person").val(buyer_name);
      $("#org_enq_im").val(buyer_name);
      $("#ebay_mobile").val(phone);
      $("#ebay_email").val(buyer_email);
      $("#ebay_total").val(total);
      $("#ebay_address").val(address);
    
  }



     function complete_orders(data)
     {

        var order_id=data.getAttribute('data-lists');
        //alert(order_id);
        $.ajax({
            url:"/orders_complete/"+order_id,
            method:"get",
            //data:{id:order_id},
            //dataType:"json",
            cache:false,
            processData: true,
           // contentType:false,
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


  


  $('#data_table thead tr:eq(1) th').each( function (i) {
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

  $('#data_table1 thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text"/>' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( data_table1.column(i).search() !== this.value ) {
              data_table1
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );







  // $('#data_table thead.theadx th').each( function () {
  //       var title = $(this).text();
  //       $(this).html( '<input id="column_3_search" class="column_filter" type="text" />' );
  //   } );

     var test_url=window.location.href;
    var base_string="http://crm.medicam.in/";
    var key_value_for_state = test_url.replace(base_string,"DataTables_data_table_/");
    //console.log(key_value_for_state);
    if(localStorage.getItem(key_value_for_state)){
    console.log(localStorage.getItem(key_value_for_state));
    var localstored=localStorage.getItem(key_value_for_state);//
    var localstorage_parsed =  JSON.parse(localstored);
     //console.log(localstorage_parsed);
    //localStorage.removeItem(key_value_for_state);
    var localstore_coulumn=localstorage_parsed.columns;
    for(i=0;i<localstore_coulumn.length;i++)
    {
       
        
        //console.log(localstore_coulumn[i]["search"].search);
        //console.log(localstorage_parsed.columns[i]["search"].search);
        if(localstorage_parsed.columns[i]["search"].search != "")
        {
            console.log(i);
            localstorage_parsed.columns[i]["search"].search = "";
            console.log( localstorage_parsed.columns[i]["search"].search);
            
        }
    }
    console.log(localstorage_parsed);
    localStorage.removeItem(key_value_for_state);
     localStorage.setItem(key_value_for_state, JSON.stringify(localstorage_parsed));
    }
     
    var data_table=$('#data_table').DataTable({
  
  "order": [[ 1, "desc" ]],
  "paging":true,
  "lengthMenu": [10],
   "searching": true,
  columnDefs: [
            {
                render: function (data, type, full, meta) {
                  return "<div>" + data + "</div>";
                },
                targets: [ 1,3,4,5,6,7,8,9,10,11 ]
            },
            { orderable: false, targets: [-1,-2,-3,-4,-5,-6,-7,-8,-9,-10,-12] }
             
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

 var data_table1=$('#data_table1').DataTable({

   "order": [[ 0, "desc" ]],
   "paging":true,
   "lengthMenu": [10],
   "searching": true,
  
  columnDefs: [
            {
                render: function (data, type, full, meta) {
                  return "<div>" + data + "</div>";
                },
                targets: [ 1,2,3,4,5,6,7,8,9 ]
            },
            { orderable: false, targets: [-1,-2,-3,-4,-5,-6,-7,-8,-9] }
             
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


//saving orders here

  $('#enq_org').on('click', function(event){

        debugger;
        //alert('here');
        event.preventDefault();
        var form_data =document.getElementById('enquiry_form_true');
        var formdata=new FormData(form_data);
       
       
          $.ajax({
            url:"{{ route('true_order_saver') }}",
            method:"POST",
            data:formdata,
            dataType:"json",
            cache:false,
            processData: false,
            contentType:false,
            success:function(data)
            {   
                 swal("Order Saved successfully","","success");
              setTimeout(function() { location.reload(); }, 1000); 
                   
            }
        });
       
    });
     
    
    </script>
@endsection