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
    List of Products
  </div>
  <div class="card-body">
    <div align="center">
      <button class="btn btn-success" id="createNewProduct"> Create New Product</button>

    </div>
    <table class="table nowrap data-table table-responsive display cell-border" style="width:100%" cellspacing="0"  id="data_table">

      <thead >
        <tr class="table_head">
            <th>Action</th>
          <th>Id</th>
          <th>Product Name</th>
          <th>Product Price</th>
          <th>Product Link</th>
          <th>Product Category</th>
          <th>Image</th>
          <th>Product Broucher</th>
          <th>Product Description</th>
          <th>Created at</th>
          <th>Updated at</th>
          <th>Status</th>
          
        </tr>
      </thead>
      <thead class="theadx">
       <tr>
           <th>Action</th>
         <th>Id</th>
         <th>Product Name</th>
         <th>Product Price</th>
         <th>Product Link</th>
         <th>Product Category</th>
         <th>Image</th>
         <th>Product Broucher</th>
         <th>Product Description</th>
         <th>Created at</th>
         <th>Updated at</th>
         <th>Status</th>
         
       </tr>
     </thead>
     <tbody class="bodytable">
  </tbody>


</table>
</div>
</div>

<!-- image modal -->

<div id="myModal1" class="modal1">
  <span class="close_modal">&times;</span>
  <img class="modal-content1" id="img01">
  <div id="caption1"></div>
</div>

<!--edit modal -->

<div class="modal fade" id="editModel" aria-hidden="true" style="margin-left:30%;" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modelHeading"></h4>
      </div>
      <div class="modal-body">
        <form id="productForm2" name="productForm2" class="form-horizontal">
          <div class="form-group row">
            {{csrf_field()}}
            <div class="col-6">
              <label>Product Name</label>
              <input type="text" class="form-control" name="product_name" id="product_name1" placeholder="Product Name" maxlength="100">
            </div>
            <div class="col-6">
              <label>Price</label>
              <input type="text" class="form-control" name="price" id="price1" placeholder="Price" maxlength="6" onkeypress="return isNumber(event)" />
            </div>
          </div>
          <div class="form-group row">

            <div class="col-6">
              <label>Link</label>
              <input type="text" class="form-control" name="link" id="link1" maxlength="100" placeholder="Link">
            </div>
            <div class="col-6">
              <label>Product Category</label>
              <input list="category" name="category" id="category1" placeholder="Select" class="form-control">
              <datalist id="category">
                @foreach($categories as $category) 
                <option  value="{{$category->Category_Name}}">{{$category->Category_Name}}</option>                       
                @endforeach
              </datalist>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
              <label>Upload Image</label>
              <input type="file" name="image" id="image1">
            </div>
            <div class="col-6">
              <label>Upload Brochure</label>
              <input type="file" name="broucher" id="broucher1">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
              <label>Description</label>
              <textarea name="description" class="form-control" id="description1" placeholder="Enter Product Description" maxlength="500"></textarea>
            </div>

          </div>
        </div>
        <div class="form-group row">

          <div class="col-4" ></div>
          <div class="col-6">
            <input type="submit" name="save" id="editBtn" class="btn btn-success" />
            <input type="button" name="close" id="closeBtn1" class="btn btn-success"  data-dismiss="modal"/>
            <div class="col-2" ></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<!--  whats app modal-->



<div class="modal fade" id="whatsappModal" aria-hidden="true" style="margin-left:10%; margin-top:10%;" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modelHeading">Select Organisation Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="waForm" name="waForm" enctype='multipart/form-data' class="form-horizontal">
          
                <div class="modal-body">
                <div>
                        
                 </div>
                  <div >
                  <div class="form-group row">
                      {{csrf_field()}}
                          <div class="col-6">
                              <label class="form-label required">Organization Name</label>
                              <input list="organization_name" class="form-control populate" name="org_name" id="org_name" placeholder="Organization Name" value="" maxlength="150">
                            <input type="text" id="hidden_orgid" name="hidden_orgid" value=""  hidden/>
                           <datalist id="organization_name" >
                           @foreach ($organaization as $organisation)
                            <option value="{{$organisation->organization_name}}" label="{{$organisation->id}}"></option>
                             @endforeach
                            </datalist>
                            
                          </div>
                          <div class="col-6">
                              <label class="form-label required">Contact Person Name</label>
                              <input type="text" class="form-control" name="cp_name" id="cp_name" placeholder="Contact Person Name" maxlength="150">
                          </div>
                      </div>
                      <div class="form-group row">
                        
                          <div class="col-6">
                              <label>Mobile Number</label>
                              <input type="text" class="form-control" name="mob_number" id="mob_number" placeholder="Mobile Number" onkeypress="return isNumber(event)">
                          </div>
                          <div class="col-6">
                              <label>Email Id</label>
                              <input type="text" class="form-control" name="cre_email" id="cre_email" placeholder="Email Id" onblur="">
                          </div>
                      </div>           
                </div> 
  </div>
                
        <div class="form-group row">

          <div class="col-4" ></div>
          <div class="col-6">
              
            <input type="submit" name="save" id="savemali_and_wa" class="btn btn-success send_whatsapp" />
            <input type="text" name="prd_name" value="" id="prd_name" hidden>
            <input type="text" name="quo_link" value="" id="quo_link" hidden>
            <input type="text" name="pro_link" value="" id="pro_link" hidden>
            <input type="text" name="pro_desc" value="" id="pro_desc" hidden>
            <input type="text" name="wa_token" value="" id="wa_token" hidden>
            <input type="text" name="prd_id" value="" id="prd_id" hidden>
             
          </div>
          <div class="col-2" ></div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Create modal -->
<div class="modal fade" id="ajaxModel" aria-hidden="true" style="margin-left:30%;margin-right:20%;margin-top:5%;" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modelHeading">Create Product</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data">
          <div class="form-group row">
            {{csrf_field()}}
            <div class="col-6">
              <label>Product Name</label>
              <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name" value="" maxlength="100">
            </div>
            <div class="col-6">
              <label>Price</label>
              <input type="text" class="form-control" name="price" id="price" placeholder="Price" maxlength="6" onkeypress="return isNumber(event)">
            </div>
          </div>
          <div class="form-group row">

            <div class="col-6">
              <label>Link</label>
              <input type="text" class="form-control" name="link" id="link" placeholder="link" maxlength="100">
            </div>
            <div class="col-6">
              <label>Product Category</label>                              
              <input list="category" name="category"  class="form-control">
              <datalist id="category">
                @foreach($categories as $category)
                <option  value="{{$category->Category_Name}}">{{$category->Category_Name}}</option>                    
                @endforeach
              </datalist>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
              <label>Upload Image</label>
              <input type="file" name="image" id="image">
            </div>
            <div class="col-6">
              <label>Upload Brochure</label>
              <input type="file" name="broucher" id="broucher">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
              <label>Description</label>
              <textarea name="description" class="form-control" id="description" placeholder="Enter Product Description" maxlength="500"></textarea>
            </div>

          </div>
        </div>
        <div class="form-group row">
          <div class="col-3" ></div>
          <div class="col-6">
            <input type="submit" name="save" id="saveBtn" class="btn btn-success" />
            <input type="button" name="close" id="closeBtn" class="btn btn-success"  data-dismiss="modal"/>
            <div class="col-3" ></div>
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
  <script src="{{asset('admin-lte/plugins/datatables/dataTables.bootstrap4.js')}}"></script>

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

    function validate(){
      var name = document.getElementById('product_name').value;
      var price = document.getElementById('price').value;
      var link = document.getElementById('link').value;
      var category = document.getElementById('category').value;
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
      }
      else if(link ==""){
        swal("Enter Product Link","","warning");
        return false;
      }
      else if(category ==""){
        swal("Enter Product Category","","warning");
        return false;
      }
      else if(broucher==""){
        swal("Select Product Brochure","","warning");
        return false;
      }
      else if(description==""){
        swal("Enter Product Description","","warning");
        return false;
      }
      else{
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
            data_table.column(i)
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
			url: "{{route('ajaxProducts')}}",
			type: 'POST',
		},
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
			return '<input type="hidden" name="id" value="'+row.id+'" id="delete_id"><button class="btn btn-success whatsappModal" name="whatsapp" data-token="1" data-pro_name="'+row.product_name+'" data-bro_pdf="'+row.broucher+'" data-link="'+row.link+'" data-desc="'+row.description+'"  title="Send proposal on Whatsapp"><i class="fab fa-whatsapp"></i></button><button class="btn btn-success whatsappModal" data-token="0" data-lists="'+row.id+'" data-pro_name="'+row.product_name+'" data-bro_pdf="'+row.broucher+'" data-link="'+row.link+'" data-desc="'+row.description+'" name="mail" title="Send mail"><i class="fas fa-envelope-square"></i></button><button class="btn btn-success editproductModal" name="edit" data-product_id="'+row.id+'" data-product_image="'+row.image+'" data-product_broucher="'+row.broucher+'"><i class="fas fa-edit"></i></button><button class="btn btn-danger deleteproductModal" data-product_id="'+row.id+'" name="delete"><i class="fas fa-trash-alt"></i></button>';
		  },orderable:false},
		  { data: 'id',render: function ( data, type, row ) {
			if(data != null){
				return data;
			}
			return '';
		  },orderable:true},
		  { data: 'product_name',render: function ( data, type, row ) {
			if(data != null){
				return data;
			}
			return '';
		  },orderable:false},
		  { data: 'price',render: function ( data, type, row ) {
			if(data != null){
				return data;
			}
			return '';
		  },orderable:false},
		  { data: 'link',render: function ( data, type, row ) {
			if(data != null){
				return data;
			}
			return '';
		  },orderable:false},
		  { data: 'category',render: function ( data, type, row ) {
			if(data != null){
				return data;
			}
			return '';
		  },orderable:false},
		  { data: 'image',render: function ( data, type, row ) {
			if(data != null){
				return '<img src="'+window.location.origin+'/images/'+row.image+'" width="30" height="30" id="img'+row.id+'" onclick="imagezoom(this);">';
			}
			return '';
		  },orderable:false},
		  { data: 'broucher',render: function ( data, type, row ) {
			if(data != null){
				return '<a href="brochure/'+row.broucher+'" target="_blank">'+row.broucher+'</a>';
			}
			return '';
		  },orderable:false},
		  { data: 'description',render: function ( data, type, row ) {
			return data;
		  },orderable:false},
		  { data: 'created_at',render: function ( data, type, row ) {
			return data;
		  },orderable:true},
      { data: 'updated_at',render: function ( data, type, row ) {
			return data;
		  },orderable:true},
		  { data: 'is_active',render: function ( data, type, row ) {
			if(row.is_active == 1){
				return '<label class="switch"><input type="checkbox" data-is_active="'+row.is_active+'" data-product_id="'+row.id+'" value="'+row.id+'" class="active" checked><span class="slider round"></span></label>';
			} else {
				return '<label class="switch"><input type="checkbox" data-is_active="'+row.is_active+'" data-product_id="'+row.id+'" value="'+row.id+'" class="active"><span class="slider round"></span></label>';
			}
		  },orderable:false}
		 ]
    });


});
    $(document).on('click','button.deleteproductModal',function()
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
      $('#saveBtn').val("Create Product");
      $('#closeBtn').val("Close");
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
          swal("Product Successfully Created.","","success");
          setTimeout(function() { location.reload(); }, 2000); 

        },


      });
     }


   });


 $(document).on('click','button.whatsappModal',function()
    {
     var productId=$(this).attr("data-product_id");
      var pdf_link=$(this).attr('data-bro_pdf');
  var quo_link="crm.medicam.in/brochure/"+pdf_link;
  var product_name=$(this).attr('data-pro_name');
  var product_link=$(this).attr('data-link');
  var product_desc=$(this).attr('data-desc');
  var wa_token=$(this).attr('data-token');
  var prd_id=$(this).attr('data-lists');
  //alert(quo_link);
  //alert(product_name);
     $.get("/ajaxproducts/edit/" + productId, function (data) {
      $('#modelHeading').html("Select Organization Details");
    $('#prd_name').val(product_name);
    $('#quo_link').val(quo_link);
    $('#pro_link').val(product_link);
    $('#pro_desc').val(product_desc);
    $('#wa_token').val(wa_token);
    $('#prd_id').val(prd_id);
      $('#closeBtn1').val("Close");
      $('#whatsappModal').modal('show');
      })

   });
   
   

$(".populate").change(function(){
   debugger;
    var orgid=$("#organization_name option[value='" + $("#org_name").val() + "']").attr("label");
     
     $('#hidden_orgid').val(orgid);
     $.get("/proposals/edit/" + orgid, function (data){
       console.log(data);
          
        
          $('#cp_name').val(data.contact_person_name);
          $('#cre_email').val(data.email_id);
          $('#mob_number').val(data.mobile_number);

     })
});


    $(document).on('click','button.editproductModal',function()
    {
     var productId=$(this).attr("data-product_id");
     var product_image = $(this).attr("data-product_image");
     var product_broucher = $(this).attr("data-product_broucher");
     $.get("/ajaxproducts/edit/" + productId, function (data) {
      $('#modelHeading').html("Edit Product");
      $('#editBtn').val("Update");
      $('#closeBtn1').val("Close");
      $('#editModel').modal('show');
      $('#product_name1').val(data.product_name);
      $('#price1').val(data.price);
      $('#link1').val(data.link);
      $('#category1').val(data.category);
      $('#description1').val(data.description);


    })

     editproduct(productId,product_image,product_broucher);
   });

    function editproduct(productId,product_image,product_broucher)
    {
      $('#editBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        var myForm = document.getElementById('productForm2');
        var formData = new FormData(myForm);
        $.ajax({
          data: formData,
          url: "/ajaxproducts/update/"+productId+'/'+product_image+'/'+product_broucher,
          type: "post",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
           $('#productForm2').trigger("reset");
           $('#editModel').modal('hide');
           swal("Product Successfully Updated.","","success");
           setTimeout(function() { location.reload(); }, 2000); 
         }
       });
      });


    }

    $(document).on('change','.active',function (e) {
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
            swal("Product Deactivated Successfully","","success");
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
            swal("product Activated Successfully","","success");
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
  
  function validate_form()
  {
    var org_name = document.getElementById('org_name').value;
    var mob_number = document.getElementById('mob_number').value;
      var cre_email = document.getElementById('cre_email').value;
    if(org_name==""){
        swal("Required", "Please Select Organisation Name", "warning") 
        document.getElementById('org_name').focus();
        return false;
    }else if(mob_number==""){
        swal("Required", "Please enter Mobile Number", "warning") 
        document.getElementById('mob_number').focus();
        return false;
    } else if(cre_email==""){
        swal("Warning", "Please enter Email Id", "warning") 
        document.getElementById('cre_email').focus();
        return false;
    }
  
   else{
        return true;
    }   

  }

$('#savemali_and_wa').click( function(event)
{
    var true_token=document.getElementById('wa_token').value;
    if(true_token=="1")
    {
         debugger;
 var contact_name=document.getElementById('cp_name').value;
  var phone_number=document.getElementById('mob_number').value;
 var prd_name=document.getElementById('prd_name').value;
 var quo_link=document.getElementById('quo_link').value;
 var pro_link=document.getElementById('pro_link').value;
 var pro_desc=document.getElementById('pro_desc').value;

   //alert(contact_name);
  //alert(phone_number);
 var message="Hi "+contact_name+",\n\n"+"Greetings from Medicam !!!\n\nPlease find below is the product details for your refrence.\n\nProduct Name: " +prd_name+" \nBrochure: " +quo_link+" \nProduct Description: " +pro_desc+"\nMore Details: " +pro_link+" \n\nWe look forward to your positive response. \n\nThank you,\nMedicam ";
 var res = encodeURI(message);
  window.open("https://api.whatsapp.com/send?phone="+phone_number+"&text="+res+"&source=&data=");
  
            setTimeout(function() { location.reload(); }, 2000); 
    }
    else{
        debugger;
     event.preventDefault();
    var maildata=document.getElementById("prd_id").value;
     var prd_name=document.getElementById('prd_name').value;
 var quo_link=document.getElementById('quo_link').value;
 var pro_link=document.getElementById('pro_link').value;
 var pro_desc=document.getElementById('pro_desc').value;
    //alert(maildata);
   // var maildata='maildata='+data1;
   var form_data =document.getElementById('waForm');
        var formdata=new FormData(form_data);
    var test=validate_form();
        if(test==true)
        {
    $.ajax({
            url:"/list_products/sendemail",
            method:"POST",
            data:formdata,
            //dataType:"json",
            cache:false,
            processData: false,
            contentType:false,
            success:function(data)
            {   
              swal("E-mail successfully sent","","success");
            setTimeout(function() { location.reload(); }, 2000); 
            }
        });
      

    }
    }
});

  function sendmail(data1)
  {
    debugger;
    var maildata=data1.getAttribute('data-lists');
    
   // var maildata='maildata='+data1;
       $.ajax({
            url:"/list_products/sendemail",
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

</script>
@endsection