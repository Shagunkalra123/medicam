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
    margin:0px;
}

.button {
    position: absolute;
    top: 50%;
}
a {
  -webkit-transition: .25s all;
  transition: .25s all;
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
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
#container_div {
    background:#FAFAFA;

}
#headername {
 background:#6495ed;
 color:white;
}

button.dt-button, div.dt-button, a.dt-button {
  background-image: linear-gradient(to bottom, #F08080	 0%, #F08080 100%) !important;
  border-radius: 15px;
  color: white;
  font-size: 12px;
  margin: 10px 0px;
}

table.dataTable tbody th, table.dataTable tbody td {
    padding: 3px 3px;
}
div.dt-buttons {
    position: relative;
    float: right;
}
div.dataTables_wrapper div.dataTables_filter label {
Display: none;
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
<form name="org_form"  id="org_form" enctype="multipart/form-data">

<div class="card-header" id="headername" style="font-weight:solid">
    <div class="row col-12">
      <div class="col-3">
          <h5>List of Primary Organizations</h5>
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


<div class="tab-content">
    <div id="home" class="tab-pane active">

<div class="cc_wrapper">

</div>
    <table class="table nowrap data-table table-responsive display cell-border" style="width:100%;" cellspacing="0"  id="data_table" >
        {{csrf_field()}}
        <thead >
            
			<tr class="table_head">
						   
			  <th>Action</th>
                         
			  <th>ID</th>
				<th>Contact Person</th>
              <th>Organization Name</th>
              <th>Mobile Number</th>
              <th>Email ID</th>
              <th>Data Source</th>
              <th>Sales Person</th>
              <th>City</th>
              <th>Organization Type</th>
              <th>Industry</th>
              <th>Association with</th>
              <th>Primary Phone</th>
              <th>Secondary Phone</th>
              <th>Secondary Email</th>
              <th>Fax</th>
              <th>Address</th>
              <th>Postal Code</th>
              <th>State</th>
			        <th>Country</th>
              <th>Select Branch</th>
              <th>Assign To</th>
              <th>Area of Operations</th>
              <th>Landmark</th>
              <th>Zone</th>
              <th>Telecaller</th>
              <th>Website</th>
              <th>POC Accounts</th>
              <th>GSTIN</th>
              <th>Pan No</th>
              <th>Unique ID</th>
              <!--<th>Is Enquiry</th>-->
              <th>Description</th>
              <th>Created at</th>
              <th>Updated at</th>
              <th>Is Active</th>
						</tr>
        </thead>
        <thead >
            
						<tr class="theadx">
						    <th>Action</th>
						    <th>ID</th>
							<!--<th>Id</th>-->
							<th>Contact Person</th>
              <th>Organization Name</th>
              <th>Mobile Number</th>
              <th>Email ID</th>
              <th>Data Source</th>
              <th>Sales Person</th>
              <th>City</th>
              <th>Organization Type</th>
              <th>Industry</th>
              <th>Association with</th>
              <th>Primary Phone</th>
              <th>Secondary Phone</th>
              <th>Secondary Email</th>
              <th>Fax</th>
              <th>Address</th>
              <th>Postal Code</th>
              <th>State</th>
							<th>Country</th>
              <th>Select Branch</th>
              <th>Assign To</th>
              <th>Area of Operations</th>
              <th>Landmark</th>
              <th>Zone</th>
              <th>Telecaller</th>
              <th>Website</th>
              <th>POC Accounts</th>
              <th>GSTIN</th>
              <th>Pan No</th>
              <th>Unique ID</th>
              <!--<th>Is Enquiry</th>-->
              <th>Description</th>
              <th>Created at</th>
              <th>Updated at</th>
              <th>Is Active</th>
						</tr>
        </thead>
        <tbody class="bodytable">
        </tbody>
       
        
    </table>

</div>
<div id="menu1" class="tab-pane fade"><br>
<div class="card-body">
<div class="cc_wrapper">

</div>
<table class="table nowrap data-table table-responsive display cell-border" style="width:100%" cellspacing="0"  id="data_table1" >
       
        <thead >
            
						<tr class="table_head">
						    
					        	<th>Action</th>
                            
						    <th>ID</th>
            <!--<th>ID</th>-->
							<th>Contact Person</th>
              <th>Organization Name</th>
              <th>Organization Type</th>
              <th>Industry</th>
							<th>Mobile Number</th>
							<th>Email ID</th>
              <th>Address</th>
							<th>City</th>
              <th>Postal Code</th>
              <th>Sub-Priority 1</th>
              <th>Sub-Priority 2</th>
              <th>Unique ID</th>
               <th>Created at</th>
              <!--<th>Is Enquiry</th>-->
              <th>Is Active</th>
               
						</tr>
        </thead>
        <thead >
            
						<tr class="theadx ">
						    <th>Action</th>
						    <th>ID</th>
            <!--<th>ID</th>-->
							<th>Contact Person</th>
              <th>Organization Name</th>
              <th>Organization Type</th>
              <th>Industry</th>
							<th>Mobile Number</th>
							<th>Email ID</th>
              <th>Address</th>
							<th>City</th>
              <th>Postal Code</th>
              <th>Sub-Priority 1</th>
              <th>Sub-Priority 2</th>
              <th>Unique ID</th>
               <th>Created at</th>
              <!--<th>Is Enquiry</th>-->
              <th>Is Active</th>
					
						</tr>
        </thead>
        
    </table>
</div>
</div>
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
	let data_table = $('#data_table').DataTable({
		"order": [[ 1, "desc" ]],
		"paging":true,
		"searching": true,
		"dom" : "Bfrtip",
		"processing": true,
		"serverSide":true,
		bFilter: false,
		ajax: {
			url: "{{route('listorgAjax')}}",
			data: {'preference_token':'1'},
			type: 'POST',
		},
		"pageLength":10,
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
				let html = '<input type="hidden" name="id" value="'+data+'"id="delete_id"> <button class="btn btn-info newenquiry" data-organisation_id="'+data+'" name="newenquiry" title="Create Enquiry"><i class="fa fa-file-text"></i></button>';
				return @can('isAdmin')
						html +='<button class="btn btn-success editOrganisation" name="edit" data-organisation_id="'+data+'" title="Edit"><i class="fas fa-edit"></i></button> <button class="btn btn-danger deleteOrganisation" data-Organisation_id="'+data+'" name="delete" title="delete"><i class="fas fa-trash-alt"></i></button>';
            @endcan
						html += '';
			},orderable: false},
			{ data: 'id' ,render: function ( data, type, row ) {
				if(data!=null){
					return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: true},
			{ data: 'contact_person_name',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'organization_name',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'mobile_number' ,render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'email_id' ,render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'data_source' ,render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'sales_person',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'city_town',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'organization_type',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'industry',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'association_with_medicam',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'primary_phone',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'secondary_phone',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'secondary_email',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'fax',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'address',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'postal_code',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'state',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'country',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'select_branch',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'Assign_To',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'area',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'landmark',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'zone',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'telecaller',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'website',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'contact_person_name_acc',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'gst',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'pan_no',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'unique_id',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: false},
			{ data: 'description',render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			}},
      { data: 'created_at' ,render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: true},
			{ data: 'updated_at' ,render: function ( data, type, row ) {
				if(data!=null){
						return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '<span data-id="'+row.id+'"" onclick="First_edit('+row.id+')"></span>';
			},orderable: true},
			{ data: 'is_active' ,render: function ( data, type, row ) {
				if(row.is_active == 1){
					return '<label class="switch"><input type="checkbox" data-is_active="'+row.is_active+'" data-organisation_id="'+row.id+'" value="'+row.is_active+'" class="active" checked><span class="slider round"></span></label>';
				} else {
					return '<label class="switch"><input type="checkbox" data-is_active="'+row.is_active+'" data-organisation_id="'+row.id+'" value="'+row.is_active+'" class="active"><span class="slider round"></span></label>';
				}
			}},
		],
    "initComplete": function(settings, json) {
      $("#data_table td, #data_table1 td").each(function(i,v){
          let id = $(this).find('span').data('id');
          if(i > 0){
            $(this).attr('onclick','First_edit('+id+')'); 
          }
      });
    }
	});
	
	let data_table1 = $('#data_table1').DataTable({
		"dom" : "Bfrtip",
		bFilter: false,
		"processing": true,
		"serverSide": true,
		paging: true,
		"searching": true,
		pageLength:10,
		ajax: {
			url: "{{route('listorgAjax')}}",
			data: {'preference_token':'0'},
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
				let html = '<input type="hidden" name="id" value="'+data+'"id="delete_id"> <button class="btn btn-info newenquiry" data-organisation_id="'+data+'" name="newenquiry" title="Create Enquiry"><i class="fa fa-file-text"></i></button>';
				return @can('isAdmin')
						html +='<button class="btn btn-success editOrganisation" name="edit" data-organisation_id="'+data+'" title="Edit"><i class="fas fa-edit"></i></button> <button class="btn btn-danger deleteOrganisation" data-Organisation_id="'+data+'" name="delete" title="delete"><i class="fas fa-trash-alt"></i></button>';
            @endcan
						html += '<button class="btn btn-info" title="Please change to Primary first" data-lists="'+data+'" onclick="change_to_primary(this);"><i class="fa fa-file-text"></i></button>';
			},orderable: false},
			{ data: 'id',orderable: true},
			{ data: 'contact_person_name',render: function ( data, type, row ) {
				if(data!=null){
					return '<span onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '';
			}},
			{ data: 'organization_name',render: function ( data, type, row ) {
				if(data!=null){
					return '<span onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '';
			},orderable: false},
			{ data: 'organization_type',render: function ( data, type, row ) {
				if(data!=null){
					return '<span onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '';
			},orderable: false},
			{ data: 'industry',render: function ( data, type, row ) {
				if(data!=null){
					return '<span onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '';
			},orderable: false},
			{ data: 'mobile_number',render: function ( data, type, row ) {
				if(data!=null){
					return '<span onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '';
			},orderable: false},
			{ data: 'primary_email',render: function ( data, type, row ) {
				if(data!=null){
					return '<span onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '';
			},orderable: false},
			{ data: 'address',render: function ( data, type, row ) {
				if(data!=null){
					return '<span onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '';
			},orderable: false},
			{ data: 'city_town',render: function ( data, type, row ) {
				if(data!=null){
					return '<span onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '';
			},orderable: false},
			{ data: 'postal_code',render: function ( data, type, row ) {
				if(data!=null){
					return '<span onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '';
			},orderable: false},
			{ data: 'sub_Priority_1',render: function ( data, type, row ) {
				if(data!=null){
					return '<span onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '';
			},orderable: false},
			{ data: 'sub_Priority_2',render: function ( data, type, row ) {
				if(data!=null){
					return '<span onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '';
			},orderable: false},
			{ data: 'unique_id',render: function ( data, type, row ) {
				if(data!=null){
					return '<span onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '';
			},orderable: false},
			{ data: 'created_at',render: function ( data, type, row ) {
				if(data!=null){
					return '<span onclick="First_edit('+row.id+')">'+data+'</span>';
				}
				return '';
			},orderable: false},
			{ data: 'is_active' ,render: function ( data, type, row ) {
				if(row.is_active == 1){
					return '<label class="switch"><input type="checkbox" data-is_active="'+row.is_active+'" data-organisation_id="'+row.id+'" value="'+row.is_active+'" class="active" checked><span class="slider round"></span>;</label>';
				} else {
					return '<label class="switch"><input type="checkbox" data-is_active="'+row.is_active+'" data-organisation_id="'+row.id+'" value="'+row.is_active+'" class="active"><span class="slider round"></span>;</label>';
				}
			}},
		]
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
	});
	$('#data_table1 thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text"/>' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( data_table1.column(i).search() !== this.value ) {
                setTimeout(function() { data_table1
                    .column(i)
                    .search( this.value )
                    .draw();
				},500);
            }
        } );
    });
});
function First_edit(content)
{
 //alert(content);
 if(content != undefined){
    window.location.href="{{ url('/add_client/') }}"+'/'+content;
 }

}
// $('#data_table').on('click', 'tbody td', function(){
//    window.location =$(this).closest('tr').find('td:eq(0) a').attr('href');
// });


$(document).on('click','button.editOrganisation',function()
        {
         var orgId=$(this).attr("data-organisation_id");
       
      window.location.href="{{ url('/add_client/') }}"+'/'+orgId;
        });

$(document).on('click','button.newenquiry',function()
        {

         var orgId=$(this).attr("data-organisation_id");
        //alert(orgId);
       
        window.location.href="{{ url('/creatEnq_from_org/') }}"+'/'+orgId;
        });

 $(document).on('click','button.deleteOrganisation',function()
    {
      debugger;
        var orgId=$(this).attr("data-organisation_id");
        deleteorg(orgId);
    });
    function deleteorg(orgId)
{    
  debugger;
    swal({
        title: "Window Organization Deletion",
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
                        url: "/add_client/destroy/"+orgId,   
                    })
                        .done(function(data)
                    {
                        swal({
                            title: "Deleted",
                            text:"Window Organization Deleted! Window Product was successfully delete.",
                            type:"success"
                        })
                        setTimeout(function() { location.reload(); }, 2000); 
                    });
                }
         });
    }


 $(document).on('change','label.switch .active',function (e) {
        var orgId=$(this).attr("data-organisation_id");
        var active_id=$(this).attr("data-is_active");
        if(active_id==1)
        {
          $.ajax({
          data: {'is_active':0},
          url: "/list_organization/organisationactive/"+orgId,
          type: "get",
          dataType: 'json',
          success: function (data) {
                swal("Organisation Deactivated Successfully","","success");
                setTimeout(function() { location.reload(); }, 2000); 
            }
        });
        }
        else if(active_id==0)
        {
            $.ajax({
          data: {'is_active':1},
          url: "/list_organization/organisationactive/"+orgId,
          type: "get",
          dataType: 'json',
          success: function (data) {
              swal("Organisation Activated Successfully","","success");
              setTimeout(function() { location.reload(); }, 3000); 
            }
        });
        }
     });
function change_to_primary(data){
  debugger;
  var secondary_id =data.getAttribute("data-lists");
  //alert(secondary_id);
  $.ajax({
         
          url:"/organization/secondary/"+secondary_id,
          type:"get",
          cache:false,
            processData: true,
          //dataType: 'json',
          success: function (data) {
               swal("The Secondory oragnization is converted to Primary","","success");
                setTimeout(function() { window.location.href= "{{ route('listorg') }}"; }, 2000); 
            }
        });
 


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
     setTimeout(function() { window.location.href="{{ url('/list_organization') }}";}, 100); 
                  
});
 $('#create_view').on('click', function(event){
var view_data= localStorage.getItem("DataTables_data_table_/list_organization");
var view_key="DataTables_data_table_/list_organization";
console.log(view_data);
document.getElementById('view_code').value=view_data;
document.getElementById('view_key').value=view_key;

        // debugger;
        //alert('here');
        event.preventDefault();
        var form_data =document.getElementById('org_form');
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
                // debugger;
                console.log(data);
                
             if(data.success=="success")
            {
                 swal("New View Created","", "success")
                  $('#view_name').trigger("reset");
                    setTimeout(function() { window.location.href="{{ url('/list_organization') }}";}, 2000);
             
            }
            else{
                swal("Duplicate Entry", "", "error")
              
            }
            }
        });
        
    });
</script>
@endsection
