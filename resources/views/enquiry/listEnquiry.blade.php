@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"/>    
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>    
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"/> 
<link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.5.1/css/colReorder.dataTables.min.css"/>    

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

/*.card {
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
/*}

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
*/


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
  top: 40%;
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
<div class="card" id="container_id">
<form name="order_form"  id="order_form" enctype="multipart/form-data">
<div class="card-header" id="headername" style="font-weight:solid">
    
<div class="row col-12">
      <div class="col-3">
          <h5>List of Enquiries</h5>
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
 </form>
<!--<div class="col-2">
 
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
<div class="col-2">
   <button class="btn btn-success" name="filter_date" id="filter_date" title="Filter"><i class="fa fa-filter"></i></button>

   <button class="btn btn-success" name="refresh" id="refresh" title="Refresh"><i class="fa fa-refresh"></i></button>
</div>-->

 </div>

<div class="card-body">
<div class="cc_wrapper">

    </div>
    <table class=" table nowrap data-table table-responsive display cell-border" style="width:100%" cellspacing="0"  id="data_table">
       
        <thead>
            
						<tr class="table_head">
            
              <th>Action</th>
			  <th>ID</th>
            <th>Nature</th>
              <th>Contact Person</th>
               <th>Mobile</th>
              <!--<th>Email</th>-->
             
              <th>Email</th>
               <th>Org Name</th>
               <th>Products</th>
               <th>Unit</th>
               <th>Assign to</th>
              <th>Data Source</th>
              <th>Referred By</th>
              <th>Type</th> 
               <th>Expected closed Date</th>
				<th>Created at</th>	
        <th>Updated at</th>		   
                     
						</tr>
        </thead>
        <thead class="theadx">
             <tr>
            
              <th>Action</th>
			  <th>ID</th>
            <th>Nature</th>
              <th>Contact Person</th>
               <th>Mobile</th>
              <th>Email</th>
               <th>Org Name</th>
               <th>Products</th>
               <th>Unit</th>
               <th>Assign to</th>
              <th>Data Source</th>
              <th>Referred By</th>
              <th>Type</th> 
               <th>Expected closed Date</th>
              <th>Created at</th>			 
              <th>Updated at</th>  
                     
		</tr>
        </thead>
        <tbody class="bodytable">
         
        </tbody>
      
       
        
    </table>
</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
             <form id="modal-form"> 
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                <div>
                    <label><h3>Change Nature</h3></label>     
                 </div>
                  <div >
                    <select class="form-control" name="nature2" id="nature2">
                               <option value="Cold" style="background-color: Blue;color: #FFFFFF;">Cold</option>
                               <option value="Warm" style="background-color: Orange;color: #FFFFFF;">Warm</option>        
                              <option value="Hot" style="background-color: Red; color: #FFFFFF;">Hot</option>
                              <option value="Not Interested" style="background-color: black;color: #FFFFFF;">Not Interested</option>
                              <option value="Mature" style="background-color:DarkGreen; color: #FFFFFF;">Mature</option>     
                    </select>               
                </div> 

                 <input type="text" id="nature_enq_id" name="nature_enq_id" hidden/> 



                </div>
                <div class="modal-footer" style="align:center;">
                    <button type="button" id="nature2_change" class="btn btn-primary">Save changes</button>
                </div>
             </form>
            </div>
        </div>
    </div>
</div>


<!--modal for follow up-->
<div class="modal fade" id="follow_up_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
             <form id="Follow_up_form"> 
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                <div>
                    <label><h3>Set Follow Up</h3></label>     
                 </div>
                  <div >
                  <div class="form-group row">
                  <div class="col-6">
                              <label>Date</label>
                              <input type="Date" class="form-control" name="rem_date" id="rem_date" placeholder="Product Name" maxlength="100">
                          </div>
                            <div class="col-6">
                              <label>Time</label>
                              <input type="Time" class="form-control" name="rem_time" id="rem_time" placeholder="Product Name" maxlength="100">
                          </div>
                            <div class="col-12">
                              <label>Note</label>
                              <input type="text" class="form-control" name="note" id="note" placeholder="Description" maxlength="100">
                          </div>
                           <div class="col-12">
                           <label>Nature</label>
                    <select class="form-control" name="nature_followup" id="nature_followup">
                               <option value="Cold" style="background-color: Blue;color: #FFFFFF;">Cold</option>
                               <option value="Warm" style="background-color: Orange;color: #FFFFFF;">Warm</option>        
                              <option value="Hot" style="background-color: Red; color: #FFFFFF;">Hot</option>
                              <option value="Not Interested" style="background-color: black; color: #FFFFFF;">Not Interested</option>
                              <option value="Mature" style="background-color:DarkGreen; color: #FFFFFF;">Mature</option>     

                    </select>   
                    </div>            
                </div> 
  </div>
                 <input type="text" id="enq_id" name="enq_id"  hidden/> 
                 <input type="text" id="enq_prop" name="enq_prop" hidden/> 



                </div>
                <div class="modal-footer" style="align:center;">
                    <button type="button" id="follow_setter" class="btn btn-primary">Save changes</button>
                </div>
             </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

<!-- DataTables -->
<script src="{{asset('admin-lte/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
 <script src="https://cdn.datatables.net/colreorder/1.5.1/js/dataTables.colReorder.min.js"></script>

<script>

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function get_nature(e){

  console.log(e);
 // var enq_id = e.getAttribute('data-nature');
//var nature1 = e.getAttribute('data-nature1');
  var enq_products = e.getAttribute('data-enq_products');
  //alert(enq_products);
  $('#myModal').modal('show');
 // document.getElementById("nature2").value = nature1;
  document.getElementById("nature_enq_id").value = enq_products;
  
}
function set_follow_up(e){
debugger;
  console.log(e);
  var enq_id = e.getAttribute('data-follow_up_id');
  var enq_prop = e.getAttribute('data-prop');
  var nature1 = e.getAttribute('data-nature1');
  var enq_id = e.getAttribute('data-enqtrueid');
  $('#follow_up_modal').modal('show');
  document.getElementById("nature_followup").value = nature1;
  document.getElementById("enq_prop").value = enq_prop;
  document.getElementById("enq_id").value = enq_id;
  
}
$( "#nature2_change" ).click(function( event ) { 
             
               event.preventDefault();     
        $.ajax({
          data: $('#modal-form').serialize(),
          url: "{{ route('update_nature') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            console.log(data);
            $('#myModal').modal('hide');
            Swal.fire({
            title: 'Nature updated successfully',
             animation: false,
           
               });
              
             
          setTimeout(function() { window.location.href="{{ url('/List_all_enquiry') }}";}, 2000); 
         
          },
      });


});
//follow up setter
$( "#follow_setter" ).click(function( event ) { 
             
               event.preventDefault();     
        $.ajax({
          data: $('#Follow_up_form').serialize(),
          url: "{{ route('update_follow_up') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            console.log(data);
            $('#follow_up_modal').modal('hide');
            Swal.fire({
            title: 'Follow up is Created',
             animation: false,
          
               });
              
             
          setTimeout(function() { window.location.href="{{ url('/List_all_enquiry') }}";}, 2000); 
         
          },
      });


});

// $('#data_table tbody').on('click', 'td.', function () {
 
//  var table = $('#data_table').DataTable();

//  alert( table.cell( this ).data() );
// });

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
 var date = new Date();

 

 //var _token = $('input[name="_token"]').val();
//   debugger;
//   var from_date = $('#from_date').val();
//   var to_date = $('#to_date').val();

//  if ( from_date!='' && to_date!='') {
//  fetch_data();
// }
//  function fetch_data(from_date = '', to_date = '')
//  {
 
//   $.ajax({
//   url:"/daterange/fetch_data_enq",
//   method:"GET",
//   data:{from_date:from_date, to_date:to_date},
//   dataType:"json",
//   success:function(data)
//   {
//     console.log(data);
//     var output = '';
//     $('#data_table_info').text(data.length+" Record(s) found");
//     for(var count = 0; count < data.length; count++)
//     {
//       var counts = count+1;
//      output += '<tr>';
//       output += '<td>' + counts + '</td>';
//      output += '<td>' + data[count].Select_Contact_person + '</td>';
//      output += '<td>' + data[count].organization_name + '</td>';
      
//      output += '<td>' +  + '</td>';
//      output += '<td>' +  + '</td>';
//       output += '<td>' +  + '</td>';
// output += '<td>' + data[count].EnquiryDataSource_Name + '</td>';
// output += '<td>' + data[count].ReferredBy_Name + '</td>';
// output += '<td>' + data[count].EnquiryType_Name + '</td>';

//      output += '<td>' + data[count].Expected_closed_Date + '</td>';
//      output += '<td>' + data[count].created_at + '</td></tr>';
//     }
//     $('tbody').html(output);
//   }
//   })
//  }



//  $('#filter_date').click(function(){
//   debugger;
//   var from_date = $('#from_date').val();
//   var to_date = $('#to_date').val();
//   if(from_date != '' &&  to_date != '')
//   {
//   fetch_data(from_date, to_date);
//   }
//   else
//   {
//     swal("Both Date is required","", "warning");
//   }
//  });

//  $('#refresh').click(function(){
//   setTimeout(function() { location.reload(); }, 1000); 
//  });

	$('#data_table thead tr:eq(1) th').each( function (i) {
		var title = $(this).text();
		$(this).html( '<input type="text"/>' );

		$( 'input', this ).on( 'keyup change', function () {
			if ( data_table.column(i).search() !== this.value ) {
			  data_table.column(i).search( this.value ).draw();
			}
		} );
	});
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
			url: "{{route('listEnquiryAjax')}}",
			type: 'POST',
		},
		buttons: [
          'colvis',
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
        ],
		columns: [
			{ data: 'id',render: function ( data, type, row ) {
				let html = '<input type="hidden" name="id" value="'+row.enquiry_id+'"id="delete_id">';
				 @can('isAdmin')html +='<button  title="Edit Enquiry!" class="btn btn-success editenquiry" name="edit" data-enquiry_id="'+row.enquiry_id+'"><i class="fas fa-edit"></i></button><button title="Delete Enquiry!" class="btn btn-danger deleteenquiry" data-enquiry_id="'+row.enquiry_id+'" name="delete"><i class="fas fa-trash-alt"></i></button>';
				@endcan
		      html += '<button title="Create Follow up!" data-prop="'+row.Product+'" data-enqtrueid="'+row.enquiry_id+'" onclick="set_follow_up(this);" class="btn btn-info followenquiry" name="FollowUp" data-nature1="'+row.nature+'" data-follow_up_id="'+row.enquiry_id+'"><i class="fas fa-phone-square"></i></button>';
				  
               html += '<button title="Create Quotation!" class="btn btn-warning proposalenquiry" id="proposal" name="proposal" data-proposal_up_id="'+row.enquiry_id+'"><i class="fas fa-people-carry"></i></button>';
          
      return html;
			},orderable: false},
			{ data: 'id' ,render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+row.enquiry_id+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true},
			{ data: 'nature',render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true},
			{ data: 'Select_Contact_person',render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true},
			{ data: 'mobile_number',render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true},
			{ data: 'primary_email',render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true},
			{ data: 'organization_name',render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true},
			{ data: 'Product',render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true},
			{ data: 'Unit',render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true},
			{ data: 'Assign_To',render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true},
			{ data: 'EnquiryDataSource_Name',render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true},
			{ data: 'ReferredBy_Name',render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true},
			{ data: 'EnquiryType_Name',render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true},
			{ data: 'Expected_closed_Date',render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true},
			{ data: 'enquiry_created_at',render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true},
      { data: 'enquiry_updated_at',render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.enquiry_id+'"" onclick="First_edit('+row.enquiry_id+')"></span>';
			},orderable: true}
		],
		'rowCallback': function(row, data, index){ 
		if(data.nature == "Hot"){
		$(row).find('td:eq(2)').css('background-color', 'Red').css('color', '#FFFFFF');
		}
		if(data.nature == "Cold"){
		  $(row).find('td:eq(2)').css('background-color', 'Blue').css('color', '#FFFFFF');
		}
		if(data.nature == "Warm"){
		  $(row).find('td:eq(2)').css('background-color', 'Orange').css('color', '#FFFFFF');

		}
		if(data.nature == "Not Interested"){

		  $(row).find('td:eq(2)').css('background-color', 'black').css('color', '#FFFFFF');
		}
		if(data.nature == "Mature"){
			$(row).find('td:eq(2)').css('background-color', 'DarkGreen').css('color', '#FFFFFF');
		}
	   },
    "initComplete": function(settings, json) {
      $("#data_table td, #data_table1 td").each(function(i,v){
          let id = $(this).find('input').val() ?? $(this).find('span').data('id');
          if(i > 0){
            $(this).not("#data_table td, #data_table1 td").attr('onclick','First_edit('+id+')'); 
          }
      });
    }
	});
});

$(document).on('click','button.proposalenquiry',function()
        { 
          
        
         var x = $(this).attr("data-proposal_up_id");
          var EnqId = x;

        console.log(EnqId);
       
      window.location.href="{{ url('/proposals/index') }}"+'/'+EnqId;
        });


 $(document).on('click','button.deleteenquiry',function()
        {
          swal({
        title: "Window Enquiry Deletion",
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
            var x =$(this).attr("data-enquiry_id");
            var EnqId=btoa(x);
            window.location.href="{{ url('/deleteenquiry') }}"+'/'+EnqId;
                        
                        // swal({
                        //     title: "Deleted",
                        //     text:"Window Enquiry Deleted!",
                        //     type:"success"
                        // })
                        swal(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    );
                         
                    
                }
         });

        
        });

function First_edit(content)
{
 //alert(content);
 if(content != undefined){
    // window.location.href="{{ url('/add_client/') }}"+'/'+content;
    window.location.href="{{ url('/createEnquiry') }}"+'/'+content;
 }

}



  $(document).on('click','button.editenquiry, button.newenquiry',function()
        {
          //alert("here");
         

          debugger;
         var EnqId=$(this).attr("data-enquiry_id");
         
         
         
       
      window.location.href="{{ url('/createEnquiry') }}"+'/'+EnqId;
        });

//  $('button.deleteOrganisation').click(function()
//     {
      
//         var orgId=$(this).attr("data-organisation_id");
//         deleteorg(orgId);
//     });
//     function deleteorg(orgId)
// {
//     swal.fire({
//         title: "Window Organization Deletion",
//         animation: false,

//         text: "Are you absolutely sure you want to delete ? This action cannot be undone." +
//         "This will permanently delete , and remove all collections and materials associations.",
//         type: "warning",
//         buttons: true,
//         showCancelButton: true,
//         closeOnConfirm: false,
//         confirmButtonText: "Delete ",
//         confirmButtonColor: "#ec6c62"
//     }).then((willDelete) => {
//         if (willDelete) {
//                      $.ajax({
//                         type: "get",
//                         url: "/add_client/destroy/"+orgId,   
//                     })
//                         .done(function(data)
//                     {
//                         swal({
//                             title: "Deleted",
//                             text:"Window Organization Deleted! Window Product was successfully delete.",
//                             type:"success"
//                         })
//                         setTimeout(function() { location.reload(); }, 2000); 
//                     });
//                 }
//          });
//     }


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
     setTimeout(function() { window.location.href="{{ url('/List_all_enquiry') }}";}, 100); 
                  
});
 $('#create_view').on('click', function(event){
var view_data= localStorage.getItem("DataTables_data_table_/List_all_enquiry");
var view_key="DataTables_data_table_/List_all_enquiry";
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
                    setTimeout(function() { window.location.href="{{ url('/List_all_enquiry') }}";}, 2000);
             
            }
            else{
                swal("Duplicate Entry1", "", "error")
              
            }
            }
        });
        
    });

</script>
@endsection
