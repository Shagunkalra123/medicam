@extends('layouts.master')

@section('content')
<style>
#container_div {
    background:#FAFAFA;

}
#headername {
 background:#6495ed;
 color:white;
}
</style>
<br>


<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card card-secondary" id="container_div">
              <div class="card-header" id="headername"> 
                <h3 class="card-title">Set Reminder</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form id="followupform" name="followupform">
                  <!-- text input -->
                    <div class="form-group row">
                      <div class="col-6">
                            <label>Reminder Date</label>
                            <br>
                             <div class="input-group date1" data-provide="datepicker1">
                               <input type="date" id="rem_date" name="rem_date" placeholder="DD-MM-YYYY" class="form-control" >
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                                </div>
                             </div> 
                      </div>
                      <div class="col-6">
                            <label>Reminder Time</label>
                            <input type="time" id="rem_time" name="rem_time" class="form-control"  min="0:00" max="18:00"/>
                       </div>
                     </div>
                    <div class="form-group row">
                    <div class="col-6">
                            <label>Organization Name</label>
                              <input list="organization_name"  name="organization_name1" id="organization_name1" class="form-control populate" placeholder="Organization Name" maxlength="180"> 

                            <datalist id="organization_name" >
                           @foreach ($organisations as $organisation)
                            <option value="{{$organisation->organization_name}}" label="{{$organisation->id}}">{{$organisation->id}}</option>
                             @endforeach
                            </datalist>
                            <input type="text" id="hidden_orgid" name="hidden_orgid" value="" hidden />                    
                    </div>
                      <div class="col-6">
                            <label>Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" maxlength="100">
                        </div>
                        
                    </div>
                     <div class="form-group row">
                    <div class="col-6">
                       <label>Mobile</label>
                       <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Mobile"> 
                    </div>
                    <div class="col-6">
                         <label>Contact Persone Name</label>
                       <input type="text" id="Contact_Persone_Name" name="Contact_Persone_Name" class="form-control" placeholder="Contact Persone Name">

                    </div>

                    </div>

                    <div class="form-group row">
                            <div class='col-12'>
                            <label>Remark/Notes</label>
                            <textarea id="remark" name="remark" class="form-control" placeholder="Write Something..." maxlength="400"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-4">
                            <label>Nature</label>
                            <select class="form-control" id="nature" name="nature">
                            <option value="Cold" style="background-color:Blue; color:white;">Cold</option>
                            <option value="Warm" style="background-color:Orange; color:white;">Warm</option>
                            <option value="Hot" style="background-color:Red; color:white;">Hot</option>
                            <option value="Mature" style="background-color:Green; color:white;">Mature</option>
                            <option value="Not_Intersted" style="background-color:black; color:white;">Not Intersted</option>
                          </select>
                        </div>
                        <br>
<input class="btn btn-success" type="button" id="savebtn" name="savebtn" value="Save" >
                     <input class="btn btn-danger"
                     type="button"
                     value="Close">
                </form>
              </div>
              
            </div>
              <!-- /.card-body -->
            </div>
            

@endsection

@section('javascript')
<!-- CK Editor -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js">
  </script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js">
  </script>
  <script>
  /*toastr.success("You have 5 New Orders . <br/> <a class='close-toastr'> Ok </a>", "", {
    tapToDismiss: false
    , timeOut: 0
    , extendedTimeOut: 0
    , allowHtml: true
    , preventDuplicates: true
    , preventOpenDuplicates: true
    , newestOnTop: true
});

toastr.warning("You are warned2. <br/> <a class='close-toastr'> Ok </a>", "", {
    tapToDismiss: false
    , timeOut: 0
    , extendedTimeOut: 0
    , allowHtml: true
    , preventDuplicates: true
    , preventOpenDuplicates: true
    , newestOnTop: true
});*/


$('.close-toastr').on('click', function () {
    toastr.clear($(this).closest('.toast'));
});
   $(document).ready(function() {
//        toastr.options.hideMethod = 'noop';
//        toastr.options.timeOut = 0; 
//         toastr.options.extendedTimeOut = 0;
//         toastr.options.tapToDismiss = true;
      
      
//         //setInterval(function(){ toastr.success('You have a meeting today'); }, 3000);
//         toastr.success('You have a meeting today');
//         toastr.warning("You are warned. <br/> <a class='close-toastr'> Ok </a>", "", {
//     tapToDismiss: false
//     , timeOut: 0
//     , extendedTimeOut: 0
//     , allowHtml: true
//     , preventDuplicates: true
//     , preventOpenDuplicates: true
//     , newestOnTop: true
// });
// $('.close-toastr').on('click', function () {
//     toastr.clear($(this).closest('.toast'));
// });
     });
 
  </script>
<script>

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
   $('#savebtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..'); 
       // debugger;
        var myForm = document.getElementById('followupform');
        var formData = new FormData(myForm);
        var test=validate_form();
        
        if(test==true){

              
             $.ajax({
          data: formData,
          url: "/follow_ups/store",
          type: "POST",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
     
            swal("Follow Up Created successfully","","success");
            $('#followupform').trigger("reset");
          },
          
         
      });
        }
        
       
    });

    $(".populate").change(function(){
   debugger;
    var orgid=$("#organization_name option[value='" + $("#organization_name1").val() + "']").attr("label");
     
     $('#hidden_orgid').val(orgid);
     $.get("/proposals/edit/" + orgid, function (data){
       console.log(data);
          
        
          $('#EnquiryDataSource_NameID').val(data.contact_person_name);
          $('#mobile').val(data.mobile_number);
          $('#Contact_Persone_Name').val(data.contact_person_name);

     })
});

    function validate_form(){

      var rem_date = document.getElementById('rem_date').value;
    var rem_time = document.getElementById('rem_time').value;
    var org_name = document.getElementById('organization_name1').value;
    var subject = document.getElementById('subject').value;
    var remark = document.getElementById('remark').value;
    var nature = document.getElementById('nature').value;
    if(rem_date==""){
        swal("Enter Follow up date","","warning");
        return false;
    }
    else if(rem_time==""){
        swal("Enter Follow up time","","warning");
        return false;
    }
    else if(org_name==""){
        swal("Select Organisation Name","","warning");
        return false;
    }
    else if(subject==""){
        swal("Enter Follow up Subject","","warning");
        return false;
    }
    else if(remark==""){
        swal("Enter Follow up Remark","","warning");
        return false;
    }
    else if(nature==""){
        swal("Enter Follow yp Nature","","warning");
        return false;
    }
    else{

      return true;
    }
      
    }
    var timepicker = new TimePicker('rem_time', {
  lang: 'en',
  theme: 'dark'
});
timepicker.on('change', function(evt) {
  
  var value = (evt.hour || '00') + ':' + (evt.minute || '00');
  evt.element.value = value;

});


</script>
@endsection