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
  background-image: linear-gradient(to bottom, #F08080	 0%, #F08080 100%)!important ;
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
}div.dt-button-collection button.dt-button.active:not(.disabled) {
background-image: linear-gradient(to bottom, #9cbbc7 0%, #4CAF50 100%)!important;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<br>
<div class="card" id="container_div">
<div class="card-header" id="headername" style="font-weight:solid">
    Add/ Update Branch
</div>
<div class="card-body">
<div class="cc_wrapper">
<form id="branch_form" >
                  <!-- text input -->
                    <div class="form-group row">
                      <div class="col-4">
                            <label for="branch_name" class="form-label required">Branch Name</label>
                            <input type="text" name="branch_name" id="branch_name" class="form-control" placeholder="Branch Name" maxlength="180">
                        </div>
                        <div class="col-4">
                            <label for="branch_manager">Branch Manager</label>
                            <input type="text" name="branch_manager" id="branch_manager" class="form-control" placeholder="Branch Manager Name" maxlength="180">
                        </div>
                        <div class="col-4">
                          <label>Company</label>
                          <input type="text" name="company" id="company"  class="form-control" placeholder="Company" maxlength="50">
                      </div>
                    </div>
                     <!-- text input -->
                     <div class="form-group row">
                      <div class="col-4">
                            <label>Contact No</label>
                            <input type="text" name="contact_no" id="contact_no" class="form-control" placeholder="Contact No" maxlength="50" onkeypress="return Validate(event)">
                        </div>
                        <div class="col-4">
                            <label>GSTIN/UIN</label>
                            <input type="text" name="gst" id="gst" class="form-control" placeholder="GSTIN/UIN" maxlength="180">
                        </div>
                        <div class="col-4">
                          <label>Country</label>
                          <input type="text" name="country" id="country" class="form-control" placeholder="Country" maxlength="180">
                      </div>
                    </div>
                     <!-- text input -->
                     <div class="form-group row">
                      <div class="col-4">
                            <label>State</label>
                            <input type="text" name="state" id="state" class="form-control" placeholder="State" maxlength="180">
                        </div>
                        <div class="col-4">
                            <label>City</label>
                            <input type="text" name="city" id="city" class="form-control" placeholder="City" maxlength="15">
                        </div>
                        <div class="col-4">
                          <label>Contact Address</label>
                          <input type="text" name="contact_address" id="contact_address" class="form-control" placeholder="Contact Address" maxlength="15">
                      </div>
                    </div>


                     <!-- text input -->
                     <div class="form-group row">
                      <div class="col-4">
                            <label>Area</label>
                            <input type="text" name="area" id="area" class="form-control" placeholder="Area" maxlength="15">
                        </div>
                         <div class="col-4">
                              <label>Landmark</label>
                              <input type="text" name="landmark" id="landmark" class="form-control" placeholder="Landmark" maxlength="15" >
                              
                          </div>
                          </div><br>
                           <!-- text input -->
                           <div class="form-group row">
                          <div class="col-4"></div>

                          <div class="col-2">
                             <button class="form control btn btn-outline-success" type="button" title="Add branch" name="branch_create" id="add_branch" value="Create" > Create</button>
                          </div>
                          <div class="col-2">
                              <button class="form control btn btn-outline-success" type="button" title="Update branch" name="branch_update" id="update_branch" value="Update">Update </button>
                          </div>
                          </div>
                          </form>

               
            </div>
              <table class=" table nowrap data-table table-responsive display cell-border" style="width:100%" cellspacing="0"  id="data_table">
       
                <thead >
                    
                <tr class="table_head">
                  <th>Id</th>
                  <th>Branch Name</th>
                  <th>Branch Manager</th>
                  <th>Company</th>
                  <th>Contact No</th>
                  <th>GSTIN/UIN</th>
                  <th>Country</th>
                  <th>State</th>
                  <th>City</th>
                  <th>Contact Address</th>
                  <th>Area</th>
                  <th>Landmark</th>
                  <th>Created at</th>
                  <th>Is Active</th>
                  <th>Action</th>
                </thead>
                <thead class="theadx">
                    
                <tr>
                  <th>Id</th>
                  <th>Branch Name</th>
                  <th>Branch Manager</th>
                  <th>Company</th>
                  <th>Contact No</th>
                  <th>GSTIN/UIN</th>
                  <th>Country</th>
                  <th>State</th>
                  <th>City</th>
                  <th>Contact Address</th>
                  <th>Area</th>
                  <th>Landmark</th>
                  <th>Created at</th>
                  <th>Is Active</th>
                  </thead>
                    <tbody class="tbody">
                        <?php $sr_no = 1 ?>
                        @foreach ($branches as $branch)
                        <tr>
                          <td>{{$sr_no}}</td>
                          <td>{{$branch->Branch_Name}}</td>
                          <td>{{$branch->Branch_Manager}}</td>
                          <td>{{$branch->Company}}</td>
                          <td>{{$branch->Contact_No}}</td>
                          <td>{{$branch->GSTIN_UIN}}</td>
                          <td>{{$branch->Country}}</td>
                          <td>{{$branch->State}}</td>
                          <td>{{$branch->City}}</td>
                          <td>{{$branch->Contact_Address}}</td>
                          <td>{{$branch->Area}}</td>
                          <td>{{$branch->Landmark}}</td>
                          <td>{{$branch->created_at}}</td>
                          
                          
                          @if($branch->is_active == 1)
                          <td><label class="switch">
                              <input type="checkbox" branch-is_active="{{$branch->is_active}}" data-branchcre="{{$branch->id}}" value="{{$branch->is_active}}" class="active" checked>
                              <span class="slider round"></span>
                              </label>
                          </td>
                          @elseif($branch->is_active == 0)
                          <td>
                              <label class="switch">
                              <input type="checkbox" branch-is_active="{{$branch->is_active}}" data-branchcre="{{$branch->id}}" value="{{$branch->is_active}}" class="active">
                              <span class="slider round"></span>
                              </label>
                          </td>
                          @endif
                          <td>
                              <input type="hidden" name="id" value="{{$branch->id}}" id="branch_crea">
                            <button class="btn btn-success editbranch" name="edit" data-branchcre="{{$branch->id}}"><i class="fas fa-edit"></i></button>
                            
                            
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
                    targets: [ 1,2,3,4,5,6,7,8,9,10,11,12,13 ]
                }
             ],
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


   //number validation 
    function Validate(event) {
        var regex = new RegExp("^[0-9-!@#$%*?]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    }


var branch_iid = "";
$('#add_branch').click(function (e) {
        e.preventDefault();
        
        var myForm = document.getElementById('branch_form');
        var formData = new FormData(myForm);
        
             $.ajax({
          data: formData,
          url: "add_branch/store",
          type: "POST",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
     
              $('#branch_form').trigger("reset");
                  
                  Swal.fire({
                    title: 'Branch is created',
                    animation: false,
                    
                         });
            setTimeout(function() { location.reload(); }, 2000); 
         
          },
          
         
      });
        
        
       
    });


    $('button.editbranch').click(function()
        {
            
            branch_iid=$(this).attr("data-branchcre");
         
         $.get("/add_branch/edit/" + branch_iid, function (data) {

           $('#branch_name').val(data.Branch_Name);
            $('#branch_manager').val(data.Branch_Manager);
            $('#company').val(data.Company);
            $('#contact_no').val(data.Contact_No);
            $('#gst').val(data.GSTIN_UIN);
            $('#country').val(data.Country);
            $('#state').val(data.State);
            $('#city').val(data.City);
            $('#contact_address').val(data.Contact_Address);
            $('#area').val(data.Area);
            $('#landmark').val(data.Landmark);
            $("#add_branch").attr("disabled", true);
        });
        });
        
        $('#update_branch').click(function (e) {
        e.preventDefault();
        debugger;
        var myForm = document.getElementById('branch_form');
        var formData = new FormData(myForm);
        
             $.ajax({
          data: formData,
          url: "/add_branch/update/" + branch_iid,
          type: "POST",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
     
              $('#branch_form').trigger("reset");
              
              Swal.fire({
                  title: 'Branch is updated',
                  animation: false,
                 
                    });
            setTimeout(function() { location.reload(); }, 2000); 
         
          },
          
         
      });
        
        
       
    });

    

    $('.active').change(function (e) {
        var branch_iid=$(this).attr("data-branchcre");
        var active_id=$(this).attr("branch-is_active");
        if(active_id==1)
        {
          $.ajax({
          data: {'is_active':0},
          url: "/add_branch/branchactive/"+branch_iid,
          type: "get",
          dataType: 'json',
          success: function (data) {
            Swal.fire({
                title: 'Branch deactivated successfully',
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
          url: "/add_branch/branchactive/"+branch_iid,
          type: "get",
          dataType: 'json',
          success: function (data) {
            Swal.fire({
                title: 'Branch activated successfully',
                animation: false,
               
                  });
              setTimeout(function() { location.reload(); }, 3000); 
            }
        });
        }
     });

    


</script>
@endsection

