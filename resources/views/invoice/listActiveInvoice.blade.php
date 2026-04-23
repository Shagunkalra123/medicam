@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"/>    
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>    
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"/>    

<link rel="stylesheet" href="{{asset('css/datatableCutstom.css')}}"/>
<link rel="stylesheet" href="{{asset('css/swal.css')}}"/> 
<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}"/> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>


<style>
    .cc_wrapper {
    text-align: right;
    margin:20px;
}

.button {
    position: absolute;
    top: 50%;
}

</style>
<style>
a {
  -webkit-transition: .25s all;
  transition: .25s all;
}

.card {
  overflow: hidden;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -webkit-transition: .25s box-shadow;
  transition: .25s box-shadow;
}

.card:focus,
.card:hover {
  box-shadow: 0 5px 11px 0 rgba(0, 0, 0, 0.18), 0 4px 15px 0 rgba(0, 0, 0, 0.15);
}

.card-inverse .card-img-overlay {
  background-color: rgba(51, 51, 51, 0.85);
  border-color: rgba(51, 51, 51, 0.85);
}
.accord{
		width: -webkit-fill-available;
		width:100%;
		border-radius: 0px;}
#accordion .panel{padding:5 0 5 0;}
#accordion .panel-body{padding:5px;border-style: none ridge none ridge;margin: 0 8 0 8;}
#accordion .panel-body-last{padding:5px;border-style: none ridge ridge ridge;margin: 0 8 0 8;}

.panel-default>.panel-heading a:after {
  content: "";
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: 'Glyphicons Halflings';
  font-style: normal;
  font-weight: 400;
  line-height: 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  float: right;
  transition: transform .25s linear;
  -webkit-transition: -webkit-transform .25s linear;
}

.panel-default>.panel-heading a[aria-expanded="true"] {
  /*background-color: #eee;*/
}

.panel-default>.panel-heading a[aria-expanded="true"]:after {
  content: "\2212";
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.panel-default>.panel-heading a[aria-expanded="false"]:after {
  content: "\002b";
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}



.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
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
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
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

/* data tabel css */

.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

/* color for header name */
#container_div {
    background:#FAFAFA;

}
#headername {
 background:#6495ed;
 color:white;
}
/* modal css */

.modal {
  position: absolute;
  top: 50%;
  left: 60%;
  transform: translate(-50%, -60%);
}
button.dt-button, div.dt-button, a.dt-button {
  background-image: linear-gradient(to bottom, #F08080	 0%, #F08080 100%)!important;
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
#data_table tbody tr.even:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
 
   #data_table tr.odd:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="card" id="container_div">
<div class="card-header" id="headername">
    <h5 >List of Active Invoices</h5>
</div>
<div class="card-body">
<div class="cc_wrapper">

</div>
    <table class=" table nowrap data-table table-responsive display cell-border" style="width:100%;display:inline-table;" cellspacing="0"  id="data_table">
       
        <thead>
            
						<tr class="table_head">
             
              <th>Id</th>
              <th>Organization Name</th>
              <th>Date Of Invoice</th> 
              <th>Amount Of Invoice</th>
              <th>Balance</th>
              <th>Status</th>
              <th>Action</th>
            
						</tr>
        </thead>
        <thead class="theadx">
             <tr>
             <th>Id</th>
              <th>Organization Name</th>
              <th>Date Of Invoice</th> 
              <th>Amount Of Invoice</th>
              <th>Balance</th>
              <th>Status</th>
              <th hidden>Action</th>
              
            </tr>
        </thead>
        <?php $date = date('Y-m-d');?>
        <tbody class="bodytable">
        @foreach ($Invoices as $Invoice)
              <tr>     
              <td>{{$Invoice->id}}</td>
              <td>{{$Invoice->organization_name}}</td>
              <td>{{$Invoice->created_at}}</td>
              <td>{{$Invoice->grand_total}}</td>
              <td>{{$Invoice->balance}}</td>
              @if($Invoice->status=="1")
              <?php $warranty= strtotime($Invoice->exp_date);
              $warranty= date('Y-m-d', $warranty); 
              ?>
              @if($warranty >  $date )
              <td align="center" bgcolor="#FF0000">Unpaid</td>
              @else
              <td align="center" bgcolor="#ffbf00">Overdue</td>
              @endif
              @else
                <td align="center" bgcolor="#00FF00">Paid</td>
              @endif
               <td>
                <input type="hidden" name="id" value="" id="delete_id">
               <a href="{{ URL::to( 'InvoicePDF/'.$Invoice->path) }}" target="_blank"><button class="btn btn-default" name="view" title="View Invoice">
                <i class="fas fa-eye"></i></button></a>
                <button  title="Complete Invoice" onclick="move_to_completed(this)" class="btn btn-dark payment" name="edit" data-invoice_id="{{$Invoice->id}}" data-invoice_pdf="{{$Invoice->path}}" data-order_id="{{$Invoice->orderID}}"><i class="fas fa-check"></i></button>
               
                
               </td>  
              </tr>
                
         @endforeach 
        </tbody>
      
      
        
    </table>
</div>
</div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Payment Record for <span id="inv_id"></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="paymentForm" name="paymentForm" class="form-horizontal" enctype="multipart/form-data">
                  <div class="form-group row">
                      {{csrf_field()}}
                          <div class="col-6">
                              <label>Amount Received</label>
                              <input type="text" class="form-control" name="amount_recieved" id="amount_recieved" placeholder="Amount Recieved" value="">
                          </div>
                          <div class="col-6">
                              <label>Transaction ID</label>
                              <input type="text" class="form-control" name="transaction_id" id="transaction_id" placeholder="Transaction ID" onkeypress="return isNumber(event)">
                          </div>
                      </div>
                      <div class="form-group row">
                        
                          <div class="col-6">
                              <label>Payment Date</label>
                              <input type="date" class="form-control" name="payment_date" id="payment_date" placeholder="Payment Date">
                          </div>
                           <div class="col-6">
                              <label>Payment Mode</label>
                              <input type="text" class="form-control" name="payment_mode" id="payment_mode" placeholder="Payment Mode">
                          </div>
                      </div>
                      <div class="form-group row">
                        
                          <div class="col-6">
                              <input type="text" class="form-control" name="hidden_inv_id" id="hidden_inv_id" placeholder="Payment Date">
                          </div>
                           <div class="col-6">
                              <input type="text" class="form-control" name="hidden_inv_pdf" id="hidden_inv_pdf" placeholder="Payment Mode">
                          </div>
                      </div>
                      <div class="form-group row">
                          <input type="text" class="form-control" name="hidden_order_id" id="hidden_order_id" placeholder="Payment Mode">
                        <div class="col-6">
                              <label>Leave Note</label>
                              <textarea name="leave_note" class="form-control" id="leave_note" placeholder="Leave Note"></textarea>
                          </div>
                          
                      </div>
                  </div>
                    <div class="form-group row">
                      <div class="col-5" ></div>
                      <div class="col-6">
                      <input type="submit" name="save" id="saveBtn" class="btn btn-success" />
                  </div>
                </form>

                
            </div>
            <table id="table1" style="display:none;"> 
                  <thead>
                      <tr>
                        <th>payment</th>
                        <th>Payment Mode</th>
                        <th>Date</th>
                        <th>Amount</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
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

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function get_nature(e){
  debugger;
  console.log(e);
  var enq_id = e.getAttribute('data-nature');
  var nature1 = e.getAttribute('data-nature1');
  $('#myModal').modal('show');
  document.getElementById("nature2").value = nature1;
  document.getElementById("nature_enq_id").value = enq_id;
  
}
function move_to_completed(context)
{
 var inv_id = context.getAttribute('data-invoice_id');
//alert(inv_id);
 move_inv(inv_id);
}
function move_inv(inv_id)
{
  
      debugger;
                     $.ajax({
                        type: "get",
                        url: "/invoice/completed/"+inv_id,   
                    })
                        .done(function(data)
                    {
                      console.log(data);
                        swal("Completed Invoice","Invoice Status changed as completed succesfully.","success"
                        )
                        setTimeout(function() { location.reload(); }, 1000); 
                    });
              
      



}
$( "#nature2_change" ).click(function( event ) { 
               debugger;
               event.preventDefault();     
        $.ajax({
          data: $('#modal-form').serialize(),
          url: "{{ route('update_nature') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            console.log(data);
            $('#myModal').modal('hide');
            swal("Updated", "Nature is Updated", "success")   
          setTimeout(function() { window.location.href="{{ url('/List_all_enquiry') }}";}, 2000); 
         
          },
      });


});

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        debugger;
        var myForm = document.getElementById('paymentForm');
        var formData = new FormData(myForm);
        
              
        $.ajax({
          data: formData,
          url: "{{ route('transaction_store') }}",
          type: "POST",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
           var invoiceid = document.getElementById('hidden_inv_id').value;
           var invoicePdf = document.getElementById('hidden_inv_pdf').value;
           var order_id = document.getElementById('hidden_order_id').value;

               $.ajax({
                url: "/invoice/invoiceTransPdf/"+invoiceid+'/'+invoicePdf+'/'+order_id,
                type: "get",
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                  }
              });
             
         
          },
          
         
      });   
    });
    
$(document).ready(function() {
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








  // $('#data_table thead.theadx th').each( function () {
  //       var title = $(this).text();
  //       $(this).html( '<input id="column_3_search" class="column_filter" type="text" />' );
  //   } );

     var data_table=$('#data_table').DataTable({
  
      "order": [[ 0, "desc" ]],
      "paging":true,
      "lengthMenu": [10],
       "searching": true,
      columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: [ 1,2,3,4 ]
                },
                { orderable: false, targets: [-1,-2,-3,-4,-5,-6] }
                 
             ],
       "searching": true, 
       dom: 'Bfrtip',
        stateSave: true,
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
        ],
       'rowCallback': function(row, data, index){
	console.log(data)
    if(data[3] == "Hot"){
    $(row).find('td:eq(3)').css('background-color', 'red').css('color', 'white');
    }
    if(data[3] == "Cold"){
      $(row).find('td:eq(3)').css('background-color', '#1e90ff').css('color', 'white');
    }
    if(data[3] == "Warm"){
      $(row).find('td:eq(3)').css('background-color', 'DarkGreen').css('color', 'white');

    }
    if(data[3] == "Not_Interested"){

      $(row).find('td:eq(3)').css('background-color', 'White').css('color', 'black');
    }
   }

  
    });





} );


</script>
@endsection
