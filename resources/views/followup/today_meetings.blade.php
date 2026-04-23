@extends('layouts.master')

@section('stylesheet')
    <!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"/>    
<link rel="stylesheet" href="{{asset('css/datatableCutstom.css')}}"/>
<link rel="stylesheet" href="{{asset('css/swal.css')}}"/> 
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
#data_table tbody tr.even:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
 
   #data_table tr.odd:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
</style>
<br>
<div class="container">
<div class="card" id="container_div">
<div class="card-header" id="headername" style="font-weight:solid">
    Meetings
</div>
<div class="card-body">
<div class="cc_wrapper">


</div>
    <table class=" table nowrap data-table table-responsive display " style="width:100%" cellspacing="0"  id="data_table">
       
        <thead >
            <tr class="table_head">
                <th>SR NO</th>
                <th>Subject</th>
                <th>Meeting with</th>
                <th>Date</th>
                <th>Time</th>
                <th>Assigned To</th>
                <th>Remark</th>
                <th>Nature</th>
                <th>Action</th>

               
               
            </tr>
        </thead>
         <thead class="theadx">
            <tr >
                <th>SR NO</th>
                <th>Subject</th>
                <th>Meeting with</th>
                <th>Date</th>
                <th>Time</th>
                <th>Assigned To</th>
                <th>Remark</th>
                <th>Nature</th>
                <th>Action</th>

               
               
            </tr>
        </thead class="thead">
        <tbody>
        <?php $counter=1; ?>
        <?php 
         date_default_timezone_set("Asia/Kolkata");
        $dt = new DateTime();
$today_date= $dt->format('Y-m-d');?>
      @foreach($meetings as $meeting)
      @if($today_date==$meeting->meeting_date)
       <tr>
       <td>{{$meeting->id}}</td>
       <td>{{$meeting->subject}}</td>
       <td>{{$meeting->meeting_with}}</td>
       <td>{{$meeting->meeting_date}}</td>
       <td>{{$meeting->meeting_time}}</td>
       <td>{{$meeting->assgin_to}}</td>
       <td>{{$meeting->remark}}</td>
       <td>{{$meeting->nature}}</td>
       <td>  <button class="btn btn-success editproductModal" name="edit" data-product_id="{{$meeting->id}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button>
         <button class="btn btn-danger deleteproductModal" name="edit" data-product_id="{{$meeting->id}}"> <i class="fa fa-ban" aria-hidden="true"></i> Delete</button>
       </td>

       
   
       </tr>
       @endif
       @endforeach
        </tbody>
       
        
    </table>
</div>
</div>
</div>
<!-- image modal -->


<!-- Create modal -->

@endsection
@section('javascript')
<!-- DataTables -->
<script src="{{asset('admin-lte/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin-lte/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    
    <script>
       
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});




 $(document).ready(function() {


  


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
       "paging":false,
       "searching": true,
      
    });

} );

  $('button.deleteproductModal').click(function()
{
   
    var delete_meeting=$(this).attr("data-product_id");
    deleteproduct(delete_meeting);
});

function deleteproduct(delete_meeting)
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
                        url: "/meetings_scheduler/destory/"+delete_meeting,   
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
         var meeting_id=$(this).attr("data-product_id");
         window.location.href="{{ url('/Update_meeting/display_meeting/') }}"+'/' + meeting_id ;
      });

    function editproduct(productId)
    {
      debugger;
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