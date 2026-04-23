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
       /* cursor: pointer; */
   }
 
   #data_table tr.odd:hover {
       background-color: cadetblue;
       /* cursor: pointer; */
   }
</style>
<div class="card" id="container_div">
<form name="order_form"  id="order_form" enctype="multipart/form-data">
<div class="card-header" id="headername" style="font-weight:solid">
    
    <div class="row col-12">
      <div class="col-3">
          <h5>List of Quotations</h5>
          </div>
          <div class="col-2">
           <input list="view_name_list" id="view_name_list1" name="view_name_list1" class="form-control populate" placeholder="Select View"> 

                            <datalist id="view_name_list" >
                             @foreach ($view_names as $view_name)
                            <option value="{{$view_name->view_name}}"></option>
                             @endforeach
                            </datalist>
                             <input type="hidden" id="hidden_view_id" name="hidden_view_id" />
          </div>
<div class="col-1"></div>
<div class="col-1">|</div>

          <div class="col-2">
          <input type="text" name="view_name" id="view_name" class="form-control" placeholder="Enter New View Name" maxlength="150">            
          <input type="hidden" name="view_key" id="view_key" class="form-control" placeholder="" maxlength="150">
          <input type="hidden" name="view_code" id="view_code" class="form-control" placeholder="" maxlength="1500">            
          </div>
          <div class="col-2">
          <button class="btn btn-success" name="create_view" id="create_view" title="Create View"><i class="fa fa-plus"></i></button>
          </div>

      </div>
</div>
</form>
<div class="card-body">

    <table class=" table nowrap data-table table-responsive display cell-border" style="width:100%" cellspacing="0"  id="data_table">
       
        <thead class="table_head">
            <th>Action</th>
          <th> View PDF</th>
            <th>Id</th>
            <th>Subject</th>
            <th>Related To</th>
            <th>To</th>
            <th>Organization Name</th>
            <th>Address</th>
            <th>Status</th>
            <th>Assigned</th>
            <th>Date</th>
            <th>Open Till</th>
            <th>Currency</th>
           
            <th>City</th>
            <th>State</th>
            <th>Country</th>
            <th>Zip Code</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Product</th>
            <th>Quantity</th>
            
            <th>Sub Total</th>
          <th>Created at</th>
          <th>Updated at</th>
        </thead>
        <thead class="theadx">
            <th>Action</th>
          <th> View PDF</th>
        <th>Id</th>
            <th>Subject</th>
            <th>Related</th>
            <th>To</th>
            <th>Organization Name</th>
            <th>Address</th>
            <th>Status</th>
            <th>Assigned</th>
            <th>Date</th>
            <th>Open Till</th>
            <th>Currency</th>
           
            <th>City</th>
            <th>State</th>
            <th>Country</th>
            <th>Zip Code</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Product</th>
            <th>Quantity</th>
            
            <th>Sub Total</th>
          
          <th>Created at</th> 
          <th>Updated at</th>
            
        </thead>
        <tbody class="tbody">
        
        </tbody>
       
        
    </table>
</div>
</div>
</form>

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
              data_table.column(i).search( this.value ).draw();
            }
        } );
    } );








  // $('#data_table thead.theadx th').each( function () {
  //       var title = $(this).text();
  //       $(this).html( '<input id="column_3_search" class="column_filter" type="text" />' );
  //   } );

     var data_table=$('#data_table').DataTable({
        "order": [[ 1, "desc" ]],
        "dom" : "Bfrtip",
		bFilter: false,
		"processing": true,
		"serverSide": true,
		paging: true,
		"searching": true,
		pageLength:10,
		ajax: {
			url: "{{route('listProposalAjax')}}",
			type: 'POST',
		},
       "searching": true,
       dom: 'Bfrtip',

        buttons: [
            @can('isAdmin')
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
            @endcan
            'colvis'
        ],
        columns: [
          { data: 'id',render: function ( data, type, row ) {
             let html = '<input type="hidden" name="id" value="'+data+'"id="delete_id"> ';
             @if( Gate::check('isAdmin'))
                html +='<button class="btn btn-danger deleteproposal" data-lists="'+data+'" name="delete" title="Delete Proposal"><i class="fas fa-trash-alt"></i></button>';
              @endif
              
                html +=' <button class="btn btn-success sendmail" onclick="sendmail(this)" data-lists="'+data+'" name="mail" title="Send mail"><i class="fas fa-envelope-square"></i></button>  <button class="btn btn-success" onclick="send_whatsapp(this)" data-lists2="'+row.phone+'" data-lists_pdf="'+row.path+'" data-lists_name="'+row.to+'" name="createOrder" title="Send proposal on Whatsapp"><i class="fab fa-whatsapp"></i></button>              <button class="btn btn-info sendsms" onclick="sendsms(this)" data-lists="'+row.id+'" name="sms" title="Send SMS"><i class="fas fa-sms"></i></button><button class="btn btn-warning createOrder"  data-lists2="'+row.id+'" data-enqId="'+row.enqid_hidden+'"  data-entryLevel="'+row.entryLevelHidden+'" name="createOrder" title="Create Order"><i class="fas fa-notes-medical"></i></button>';             
               
              return html;
          },orderable: false},
          { data: 'id',render: function ( data, type, row ) {
            if(row.path != null && row.path.includes('pdf/')){
              var path = row.path.replace('pdf/','');
            } else {
              var path = row.path.replace('f','');
            }
            let html = '';
            
                    html += '<a href='+window.location.origin+'/pdf/'+path+' target="_blank"><button class="btn btn-default" name="view" title="View Proposal"><i class="fas fa-eye"></i></button></a>';
            
            return html;
          },orderable: true},
          { data: 'id',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'subject',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'related',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'to',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'organization_name',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'address',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'status',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'assigned',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'date',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'open_till',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'currency',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'city',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'state',render: function ( data, type, row ) {
            if(data!=null){
              return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
          }
          return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'country',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'zipcode',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'email',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'phone',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'particulars',render: function ( data, type, row ) {
            if(row.particulars != null){
            var str = row.particulars;
            var str_array = str.split(', ');
            var counter = 1;
            var html = "<ul>";
            for(var i = 0; i < str_array.length; i++) {
              html += '<b>'+counter+'</b>. '+str_array[i]+'<br>';
              counter++
            }
            html += "</ul>";
            html +='<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
            return html;
          }
			    return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'qty',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'sub_total',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				  return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'created_at',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				  return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true},
          { data: 'updated_at',render: function ( data, type, row ) {
            if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				  return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
          },orderable: true}
      ],
      "fnRowCallback": function (nRow, aData) {
        var $nRow = $(nRow);
        // $nRow.find("td").not().first().attr('onclick');
        $nRow.find("td").each(function(i,v){
            let id = $(this).find('input').val() ?? $(this).find('span').data('id');
            if(i > 0){
              $(this).attr('onclick','First_edit('+id+')'); 
            }
        });
        return nRow;
      }
    });

} );
function first_click()
{




  
}

function validate(){
    var name = document.getElementById('product_name').value;
    var price = document.getElementById('price').value;
    var link = document.getElementById('link').value;
    var image = document.getElementById('image').value;
    var broucher = document.getElementById('broucher').value;
    var description = document.getElementById('description').value;
    
    if(name==""){
        swal("Enter Product Name","","warning");
        return false;
    }
    else if(price==""){
        swal("Enter Product Price","","warning");
        return false;
    }else if(link ==""){
        swal("Enter Product Link","","warning");
        return false;
    }else if(broucher==""){
        swal("Select Product Brochure","","warning");
        return false;
    }else if(description==""){
        swal("Enter Product Description","","warning");
        return false;
    }else{
        return true;
    }
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

  function sendmail(data1)
  {
    debugger;
    var maildata=data1.getAttribute('data-lists');
    
   // var maildata='maildata='+data1;
       $.ajax({
            url:"/list_proposals/sendemail",
            method:"POST",
            data:{id:maildata},
            //dataType:"json",
            cache:false,
            processData: true,
           // contentType:false,
            success:function(data)
            {   
              swal("E-mail successfully sent","","success");

            }
        });

       
  }


  function sendsms(data2)
  {
    debugger;
    var maildata=data2.getAttribute('data-lists');
   // alert(maildata);
   // var maildata='maildata='+data1;
       $.ajax({
            url:"/list_proposals/sendsms",
            method:"POST",
            data:{id:maildata},
            //dataType:"json",
            cache:false,
            processData: true,
           // contentType:false,
            success:function(data)
            {   
              swal("SMS successfully sent","","success");

            }
        });

       
  } 
function send_whatsapp(content)
{
  var phone_number=content.getAttribute('data-lists2');
  var pdf_link=content.getAttribute('data-lists_pdf');
  var quo_link="crm.medicam.in/"+pdf_link;
  var name=content.getAttribute('data-lists_name');
  //alert(phone_number);
 var message="Hi "+name+",\n\n"+"Greetings from Medicam !!!\n\nPlease find below is the link for requested Quotation link.\n" +quo_link+" \n\nWe look forward to your positive response. \n\nThank you,\nMedicam ";
 var res = encodeURI(message);
  window.open("https://api.whatsapp.com/send?phone="+phone_number+"&text="+res+"&source=&data=");
}
$(document).on('click','button.createOrder',function()
        {  
     debugger;
         var x = $(this).attr("data-lists2");
         var y = $(this).attr("data-enqId");
         var z =$(this).attr("data-entryLevel"); 
        //alert(x);
          var propId = x;
          var enqid = y;
           var entLevel = z;

        console.log(propId);
       
      window.location.href="{{ url('/orders') }}"+'/'+ enqid +'/'+ propId +'/'+ entLevel;

  });


  $(document).on('click','button.deleteproposal',function()
{
   
    var productId=$(this).attr("data-lists");
    deleteproduct(productId);
});

function deleteproduct(productId)
{
    swal({
        title: "Window product Deletion",
        text: "Are you absolutely sure you want to delete ? This action cannot be undone." +
        "This will permanently delete , and remove all collections and materials associations.",
        type: "warning",
        buttons: true,
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Delete ",
        confirmButtonColor: "#ec6c62"
    }).then((willDelete) => {
        if (willDelete) {
                     $.ajax({
                        type: "get",
                        url: "/list_proposals/destroy/"+productId,   
                    })
                        .done(function(data)
                    {
                        swal({
                            title: "Deleted",
                            text:"Window Product Deleted! Window Product was successfully delete.",
                            type:"success"
                        })
                       setTimeout(function() { location.reload(); }, 1000); 
                    });
                }
         });
    }



$('#createNewProduct').click(function () {
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Create New Product");
        $('#ajaxModel').modal('show');
    });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..'); 
        debugger;
        var myForm = document.getElementById('productForm');
        var formData = new FormData(myForm);
        var test=validate();
        
        if(test==true){

              
             $.ajax({
          data: formData,
          url: "/ajaxproducts/store",
          type: "POST",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
     
              $('#productForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              swal("Product successfully Created.");
            //setTimeout(function() { location.reload(); }, 2000); 
         
          },
          
         
      });
        }
        
       
    });


    $('button.editproductModal').click(function()
        {
         var productId=$(this).attr("data-product_id");
        $.get("/ajaxproducts/edit/" + productId, function (data) {
          $('#modelHeading').html("Edit Product");
          $('#editBtn').val("edit-product");
          $('#editModel').modal('show');
          $('#product_name1').val(data.product_name);
          $('#price1').val(data.price);
          $('#link1').val(data.link);
          $('#image1').val(data.image);
          $('#broucher1').val(data.broucher);
          $('#description1').val(data.description);

      })

        editproduct(productId);
        });

    function editproduct(productId)
    {
        $('#editBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
          data: $('#productForm2').serialize(),
          url: "/ajaxproducts/update/"+productId,
          type: "get",
          dataType: 'json',
          success: function (data) {
               $('#productForm2').trigger("reset");
              $('#editModel').modal('hide');
            swal("Product successfully updated.");
              setTimeout(function() { location.reload(); }, 2000); 
            }
        });
        });
            
  
    }

     $('.active').change(function (e) {
        var productId=$(this).attr("data-product_id");
        var active_id=$(this).attr("data-is_active");
        if(active_id==1)
        {
          $.ajax({
          data: {'is_active':0},
          url: "/ajaxproducts/productactive/"+productId,
          type: "get",
          dataType: 'json',
          success: function (data) {
                swal("product Deactivated Successfully");
                 setTimeout(function() { location.reload(); }, 2000); 
            }
        });
        }
        else if(active_id==0)
        {
            $.ajax({
          data: {'is_active':1},
          url: "/ajaxproducts/productactive/"+productId,
          type: "get",
          dataType: 'json',
          success: function (data) {
              swal("product Activated Successfully");
              setTimeout(function() { location.reload(); }, 3000); 
            }
        });
        }
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
     
    function First_edit(context)
{
//  var url="{{URL('')}}";
//  var real_url=url+"/"+context;
//  if(context != undefined){
//     window.location.href="{{ url('/add_client/') }}"+'/'+context;
//  }

}

 $(".populate").change(function(){
  debugger;
   // var view_id=$("#view_name_list option[value='" + $("#view_name_list1").val() + "']").attr("label");
    var view_name = document.getElementById('view_name_list1').value;
     console.log(view_name);
    // $('#hidden_view_id').val(view_name);
     $.get("/orders/setview/" +view_name, function (data){
       console.log(data);
          
        var tru_key=data[0].page_name;
         var json =data[0].view_code;
           localStorage.setItem(tru_key,json);
     })
     setTimeout(function() { window.location.href="{{ url('/list_proposals') }}";}, 100); 
                  
});
 $('#create_view').on('click', function(event){
var view_data= localStorage.getItem("DataTables_data_table_/list_proposals");
var view_key="DataTables_data_table_/list_proposals";
console.log(view_data);
document.getElementById('view_code').value=view_data;
document.getElementById('view_key').value=view_key;

        debugger;
        //alert('here');
        event.preventDefault();
        var form_data =document.getElementById('order_form');
        var formdata=new FormData(form_data);
          $.ajax({
            url:"{{ route('SaveTableView') }}",
            method:"POST",
            data:formdata,
            cache:false,
            processData: false,
            contentType:false,
            success:function(data)
            {   
                debugger;
                console.log(data);
                
             if(data.success=="success")
            {
                 swal("New View Created","", "success")
                  $('#view_name').trigger("reset");
                    setTimeout(function() { window.location.href="{{ url('/list_proposals') }}";}, 2000);
             
            }
            else{
                swal("Duplicate Entry1", "", "error")
              
            }
            }
        });
        
    });
    </script>
@endsection