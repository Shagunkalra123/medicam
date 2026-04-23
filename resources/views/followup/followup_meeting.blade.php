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
                <h3 class="card-title">Schedule Meeting</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form" id="followupform" name="followupform">
                  <!-- text input -->
                    <div class="form-group row">
                      <div class="col-6">
                            <label>Meeting Date</label>
                            <br>
                             

                               <div class="input-group date1" data-provide="datepicker1">
                               <input type="date" id="meeting_date" name="meeting_date" class="form-control">
                                <div class="input-group-addon1">
                                <span class="glyphicon glyphicon-th1"></span>
                                </div>
                             </div> 
                                
                              
                      </div>
                      <div class="col-6">
                            <label>Meeting Time</label>
                            <input type="time" id="meeting_time" name="meeting_time" class="form-control" min="0:00" max="18:00">

                       </div>
                     </div>
                     
                    <div class="form-group row">
                      <div class="col-6">
                            <label>Meeting With</label>
                            <input list="meeting_with" name="meeting_with" id="meeting_withID"  class="form-control product">
                                  <datalist id="meeting_with">
                                  @foreach($clients as $client)
                                      <option  value="{{$client->organization_name}}">{{$client->contact_person_name}}</option>
                                  @endforeach
                                  </datalist>
                        </div>
                  
                        <div class="col-6">
                            <label>Assign To</label>
                            <input list="assign_to" name="assign_to" id="assign_toID" class="form-control product">
                                  <datalist id="assign_to">
                                  @foreach($employees as $employee)
                                      <option  value="{{$employee->emp_username}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                                  @endforeach
                                  </datalist>
                        </div>
                    </div>
            <div class="form-group row">
             <div class="col-12">
                 <label>Subject</label>
                 <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" maxlength="100">
             </div>
                        
                    </div>
                    <div class="form-group row">
                            <div class='col-12'>
                            <label>Remark/Notes</label>
                            <textarea id="remark" name="remark" class="form-control" placeholder="Write Something..." maxlength="500"></textarea>
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


$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


function validate_form(){

      var meet_date = document.getElementById('meeting_date').value;
    var meeting_time = document.getElementById('meeting_time').value;
    var meeting_withID = document.getElementById('meeting_withID').value;
    var assign_toID = document.getElementById('assign_toID').value;
    var subject = document.getElementById('subject').value;
    var nature = document.getElementById('nature').value;
    if(meet_date==""){
        swal("Enter Meeting date","","warning");
        return false;
    }
    else if(meeting_time==""){
        swal("Enter Meeting time","","warning");
        return false;
    }
    else if(meeting_withID==""){
        swal("Select Meeting with","","warning");
        return false;
    }
    else if(assign_toID==""){
        swal("Enter Assign to","","warning");
        return false;
    }
    else if(subject==""){
        swal("Enter Meeting Subject","","warning");
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


 var timepicker = new TimePicker('meeting_time', {
  lang: 'en',
  theme: 'dark'
});
timepicker.on('change', function(evt) {
  
  var value = (evt.hour || '00') + ':' + (evt.minute || '00');
  evt.element.value = value;

});




$('#savebtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..'); 
       // debugger;
        var myForm = document.getElementById('followupform');
        var formData = new FormData(myForm);
        var test=validate_form();
        //var test=true;
        if(test==true){

              
             $.ajax({
          data: formData,
          url: "meetings_scheduler/store",
          type: "POST",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
     
            swal("Meeting Created Successfully","","success");
            $('#followupform').trigger("reset");
          },
          
         
      });
        }
        
       
    });
</script>
@endsection