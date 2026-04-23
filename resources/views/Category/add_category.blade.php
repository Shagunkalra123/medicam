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

thead input {
        width: 100%;
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
    width:300px;
}div.dt-button-collection button.dt-button.active:not(.disabled) {
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
<br>
<div class="card" id="container_div">
<div class="card-header" id="headername" style="font-weight:solid">
    Add/ Update Category
</div>
<div class="card-body">
<div class="cc_wrapper">

                <center>
                    <form id="category_form">
                    <div class="form-group row justify-content-md-center" style="margin-top: 1rem;">
                    {{csrf_field()}}
                    <label for="category_name" class="col-2 col-form-label col-md-offset-2">Add Category : </label>
						          <div class="col-2">
                            <input class="form-control noerror" type="text" placeholder="Category Name" name="category_name" id="category_name">
                        </div>
                       
                         <div class="col-2">
                             <button class="form control btn btn-outline-success" type="button" title="Add category" name="category_create" id="add_category" value="Create"> Create</button>
                          </div>
                          <div>
                              <button class="form control btn btn-outline-success" type="button" title="Update category" name="category_update" id="update_category" value="Update">Update </button>
                          </div>
                    </div>
                    </form>
                  </center>
            </div>
              <table class=" table nowrap data-table table-responsive display " style="width:100%" cellspacing="0"  id="data_table">
       
                <thead >
                    
                <tr class="table_head">
                  <th>Id</th>
                  <th>Category Name</th>
                  <th>Date added</th>
                  <th>Is Active</th>
                  <th>Action</th>
                </thead>
                <thead class="theadx">
                    
                <tr>
                  <th>Id</th>
                  <th>Category Name</th>
                  <th>Date added</th>
                  <th>Is Active</th>
                </thead>
                    <tbody class="tbody">
                        <?php $sr_no = 1 ?>
                        @foreach ($categories as $category)
                        <tr>
                          <td>{{$sr_no}}</td>
                          <td>{{$category->Category_Name}}</td>
                          <td>{{$category->created_at}}</td>
                          
                          
                          @if($category->is_active == 1)
                          <td><label class="switch">
                              <input type="checkbox" category-is_active="{{$category->is_active}}" data-categorycre="{{$category->id}}" value="{{$category->is_active}}" class="active" checked>
                              <span class="slider round"></span>
                              </label>
                          </td>
                          @elseif($category->is_active == 0)
                          <td>
                              <label class="switch">
                              <input type="checkbox" category-is_active="{{$category->is_active}}" data-categorycre="{{$category->id}}" value="{{$category->is_active}}" class="active">
                              <span class="slider round"></span>
                              </label>
                          </td>
                          @endif
                          <td>
                              <input type="hidden" name="id" value="{{$category->id}}" id="category_crea">
                            <button class="btn btn-success editcategory" name="edit" data-categorycre="{{$category->id}}"><i class="fas fa-edit"></i></button>
                            
                            
            </td>
            </tr>
            <?php $sr_no++ ?>
            @endforeach



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
      "paging":true,
      "lengthMenu": [10],
      columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: [ 1,2,3 ]
                }
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
        ]
    });

} );


$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


//character validation
function ValidateAlpha(evt)
    {
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
         
        return false;
            return true;
    }


var category_iid = "";
$('#add_category').click(function (e) {
        e.preventDefault();
        
        var myForm = document.getElementById('category_form');
        var formData = new FormData(myForm);
        
             $.ajax({
          data: formData,
          url: "add_category/store",
          type: "POST",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
     
              $('#category_form').trigger("reset");
                  
                  Swal.fire({
                    title: 'Category is created',
                    animation: false,
                   
                         });
            setTimeout(function() { location.reload(); }, 2000); 
         
          },
          
         
      });
        
        
       
    });


    $('button.editcategory').click(function()
        {
            
          category_iid=$(this).attr("data-categorycre");
         
         $.get("/add_category/edit/" + category_iid, function (data) {
            $('#category_name').val(data.Category_Name);
            $("#add_category").attr("disabled", true);
        });
        });
        
        $('#update_category').click(function (e) {
        e.preventDefault();
        
        var myForm = document.getElementById('category_form');
        var formData = new FormData(myForm);
        
             $.ajax({
          data: formData,
          url: "/add_category/update/" + category_iid,
          type: "POST",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
     
              $('#category_form').trigger("reset");
              
              Swal.fire({
                  title: 'Category is updated',
                  animation: false,
                  
                    });
            setTimeout(function() { location.reload(); }, 2000); 
         
          },
          
         
      });
        
        
       
    });

//     $('button.deletecategory').click(function()
//     {
        
//          category_iid=$(this).attr("data-categorycre");
//         deletecategory(category_iid);
//     });
//     function deletecategory(category_iid)
// {
//     Swal.fire({
//         title: "Category Deletion",
//         text: "Are you absolutely sure you want to delete ? This action cannot be undone.", 
//         animation: false,
        
        
//     }).then((willDelete) => {
//         if (willDelete) {
          
//                      $.ajax({
//                         type: "get",
//                         url: "/add_category/destroy/"+category_iid,   
//                     })
//                         .done(function(data)
//                     {
//                       Swal.fire({
//                           title: 'Category is deleted',
//                           animation: false,
                          
//                             });
//                         setTimeout(function() { location.reload(); }, 2000); 
//                     });
//                 }
//          });
//     }


    $('.active').change(function (e) {
        var category_iid=$(this).attr("data-categorycre");
        var active_id=$(this).attr("category-is_active");
        if(active_id==1)
        {
          $.ajax({
          data: {'is_active':0},
          url: "/add_category/categoryactive/"+category_iid,
          type: "get",
          dataType: 'json',
          success: function (data) {
            Swal.fire({
                title: 'Category deactivated successfully',
                animation: false,
               
                  });
                setTimeout(function() { location.reload(); }, 2000); 
            }
        });
        }
        else if(active_id==0)
        {
            $.ajax({
          data: {'is_active':1},
          url: "/add_category/categoryactive/"+category_iid,
          type: "get",
          dataType: 'json',
          success: function (data) {
            Swal.fire({
                title: 'Category activated successfully',
                animation: false,
               
                  });
              setTimeout(function() { location.reload(); }, 3000); 
            }
        });
        }
     });

    


</script>
@endsection