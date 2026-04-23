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

<div class="card" id="container_div">
<div class="card-header" id="headername">
    <h5 >List of Completed Invoices</h5>
</div>
<div class="card-body">
<div class="cc_wrapper">

</div>
    <table class=" table nowrap data-table table-responsive display cell-border" style="width:100%;display: inline-table;" cellspacing="0"  id="data_table">
       
        <thead>
            
						<tr class="table_head">
             
              <th>Id</th>
              <th>Organization Name</th>
              <th>Date Of Invoice completion</th> 
              <th>Amount Of Invoice</th>
              <th>Balance</th>
              <th>Action</th>
            
						</tr>
        </thead>
        <thead class="theadx">
             <tr>
             <th>Id</th>
              <th>Organization Name</th>
              <th>Date Of Invoice completion</th> 
              <th>Amount Of Invoice</th>
              <th>Balance</th>
              <th>Action</th>
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
                               <option value="Cold" style="background-color: Blue;">Cold</option>
                               <option value="Warm" style="background-color: DarkGreen;color: #FFFFFF;">Warm</option>        
                              <option value="Hot" style="background-color: Red;">Hot</option>
                              <option value="Not Interested" style="background-color: White;">Not Interested</option>
                                  
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
        "dom" : "Bfrtip",
		bFilter: false,
		"processing": true,
		"serverSide": true,
		paging: true,
		"searching": true,
		pageLength:10,
		ajax: {
			url: "{{route('listinvoiceActiveAjax')}}",
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
			if(row.created_at != null){
				let $inv_true_date = row.created_at.split(" ");
				var $format_changer=$inv_true_date[0];
				$format_changer= $format_changer.split("-");
				let $year_splitter = parseInt($format_changer[0].substring(2));
                let $year_splitter_incr = $year_splitter+1;
				return '<span>MC/'+$year_splitter+'-'+$year_splitter_incr+'/'+row.id+'</span>';
			}
			return ''; 
		  },orderable:true},
		  { data: 'organization_name',render: function ( data, type, row ) {
			if(data != null){
				return '<span>'+data+'</span>';
			}
			return '';
		  },orderable:false},
		  { data: 'created_at',render: function ( data, type, row ) {
			if(data != null){
				return '<span>'+data+'</span>';
			}
			return '';
		  },orderable:false},
		  { data: 'grand_total',render: function ( data, type, row ) {
			if(data != null){
				return '<span>'+data+'</span>';
			}
			return '';
		  },orderable:false},
		  { data: 'balance',render: function ( data, type, row ) {
			if(data != null){
				return '<span>0</span>';
			}
			return '';
		  },orderable:false},
		  { data: 'id',render: function ( data, type, row ) {
return '<input type="hidden" name="id" value="" id="delete_id"><a href='+window.location.origin+'/'+'InvoicePDF/'+row.path+' target="_blank"><button class="btn btn-default" name="view" title="View Invoice"><i class="fas fa-eye"></i></button></a>';
		  },orderable:true}
		]
    });





} );


$('button.proposalenquiry').click(function()
        { 
      
        
         var x = $(this).attr("data-proposal_up_id");
          var EnqId = btoa(x);

        console.log(EnqId);
       
      window.location.href="{{ url('/add_proposalEnqid') }}"+'/'+EnqId;
        });


 $('button.deleteenquiry').click(function()
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




  $('button.editenquiry').click(function()
        {

//           Swal.fire({
//             title: 'Custom animation with Animate.css',
//              animation: false,
//            
// })

          debugger;
         var EnqId=$(this).attr("data-enquiry_id");
       
      window.location.href="{{ url('/createEnquiry') }}"+'/'+EnqId;
        });

 $('button.deleteOrganisation').click(function()
    {
      
        var orgId=$(this).attr("data-organisation_id");
        deleteorg(orgId);
    });
    function deleteorg(orgId)
{
    swal.fire({
        title: "Window Organization Deletion",
        animation: false,
        
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


 $('.active').change(function (e) {
        var emp_id=$(this).attr("data-organisation_id");
        var active_id=$(this).attr("data-is_active");
        if(active_id==1)
        {
          $.ajax({
          data: {'is_active':0},
          url: "/organisations/organisationactive/"+org_id,
          type: "get",
          dataType: 'json',
          success: function (data) {
                swal("Organisation Deactivated Successfully");
                 setTimeout(function() { location.reload(); }, 2000); 
            }
        });
        }
        else if(active_id==0)
        {
            $.ajax({
          data: {'is_active':1},
          url: "/organisations/organisationactive/"+emp_id,
          type: "get",
          dataType: 'json',
          success: function (data) {
              swal("Organisation Activated Successfully");
              setTimeout(function() { location.reload(); }, 3000); 
            }
        });
        }
     });


</script>
@endsection
