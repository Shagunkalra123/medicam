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

.text-wrap{
    white-space:normal;
}
.width-200{
    width:110px;
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
       cursor: pointer;
   }
 
   #data_table tr.odd:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
</style>
<div class="card" id="container_div">
<div class="card-header" id="headername" style="font-weight:solid">
    Follow Ups
</div>
<div class="card-body">
<div class="cc_wrapper">


</div>
    <table class=" table nowrap data-table table-responsive display cell-border" style="width:100%;" cellspacing="0"  id="data_table">
       
        <thead>
            <tr class="table_head">
                <th>Id</th>
                <th>Enquiry For</th>
                <th>Date</th>              
                <th>Time</th>
                 <th>Organization Name</th>
                <th>Contact Person Name</th>
                <th>Mobile</th>
                <th>Note</th>
                <th>Nature</th>
               <!-- @cannot('isManager')
                <th>Action</th>
                @endcannot-->
               </tr>
        </thead>
        <thead class="theadx">
            <tr>
                <th>Id</th>
                 <th>Enquiry For</th>
                <th>Date</th>                
                <th>Time</th>
                <th>Organization Name</th>
                <th>Contact Person Name</th>
                <th>Mobile</th>
                <th>Note</th>
                <th>Nature</th>
               <!--<th>Action</th>-->
            </tr>
        </thead>
        <tbody>

        </tbody>
       
        
    </table>
</div>
</div>

<!-- image modal -->


<!-- Create modal -->

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



function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}


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
    });

  // $('#data_table thead.theadx th').each( function () {
  //       var title = $(this).text();
  //       $(this).html( '<input id="column_3_search" class="column_filter" type="text" />' );
  //   } );

     var data_table=$('#data_table').DataTable({
		"order": [[ 0, "desc" ]],
    "dom" : "Bfrtip",
		bFilter: false,
		"processing": true,
		"serverSide": true,
		paging: true,
		"searching": true,
		pageLength:10,
		ajax: {
			url: "{{route('listFollowUpsAjax')}}",
			type: 'POST',
		},
     "searching": true,
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
			if(data != null){
				return '<span>'+data+'</span>';
			}
			return '';
		  },orderable:true},
		  { data: 'product',render: function ( data, type, row ) {
			if(data != null){
				return '<span>'+data+'</span>';
			}
			return '';
		  },orderable:true},
		  { data: 'rem_date',render: function ( data, type, row ) {
			if(data != null){
				return '<span>'+data+'</span>';
			}
			return '';
		  },orderable:true},
		  { data: 'rem_time',render: function ( data, type, row ) {
			if(data != null){
				return '<span>'+data+'</span>';
			}
			return '';
		  },orderable:true},
		  { data: 'organization_name',render: function ( data, type, row ) {
			if(data != null){
				return '<span>'+data+'</span>';
			}
			return '';
		  },orderable:false},
		  { data: 'contact_person_name',render: function ( data, type, row ) {
			if(data != null){
				return '<span>'+data+'</span>';
			}
			return '';
		  },orderable:false},
		  { data: 'mobile_number',render: function ( data, type, row ) {
			if(data != null){
				return '<span>'+data+'</span>';
			}
			return '';
		  },orderable:false},
		  { data: 'note',render: function ( data, type, row ) {
			if(data != null){
				return '<span>'+data+'</span>';
			}
			return '';
		  },orderable:false},
		  { data: 'nature',render: function ( data, type, row ) {
			if(data != null){
				return '<span>'+data+'</span>';
			}
			return '';
		  },orderable:false},
		 ],
		 
        'rowCallback': function(row, data, index){ 

			if(data[7] == "Hot"){
			$(row).find('td:eq(7)').css('background-color', 'red').css('color', 'white');
			}
			if(data[7] == "Cold"){
			  $(row).find('td:eq(7)').css('background-color', '#1e90ff').css('color', 'white');
			}
			if(data[7] == "Warm"){
			  $(row).find('td:eq(7)').css('background-color', 'DarkGreen').css('color', 'white');
			}
			if(data[7] == "Not_Interested"){
				$(row).find('td:eq(7)').css('background-color', 'White').css('color', 'black');
			}
			if(data[7] == "Mature"){
				$(row).find('td:eq(7)').css('background-color', '#FFD933').css('color', 'black');
			}
   
		}
    });

} );

  $('button.deleteproductModal').click(function()
{
   
    var productId=$(this).attr("data-product_id");
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
                        url: "/ajaxproducts/destroy/"+productId,   
                    })
                        .done(function(data)
                    {
                        swal({
                            title: "Deleted",
                            text:"Window Product Deleted! Window Product was successfully delete.",
                            type:"success"
                        })
                        setTimeout(function() { location.reload(); }, 2000); 
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
         var followup_id=$(this).attr("data-product_id");
         window.location.href="{{ url('/UpdateForm/display') }}"+'/' + followup_id ;
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
     
    
    </script>
@endsection