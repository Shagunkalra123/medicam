@extends('layouts.master')

@section('content')
<br>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card card-secondary">
              <div class="card-header">
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
                             <div class="input-group date" data-provide="datepicker">
                               <input type="text" id="meeting_date" name="meeting_date" class="form-control">
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                                </div>
                             </div> 
                      </div>
                      <div class="col-6">
                            <label>Meeting Time</label>
                            <input type="time" id="meeting_time" name="meeting_time" class="form-control">
                       </div>
                     </div>
            
                    <div class="form-group row">
                      <div class="col-6">
                            <label>Meeting With</label>
                              
                             
                                <input list="Meeting_with" name="meeting_with" id="meeting_with"  placeholder='Meeting With' class="form-control">
                                  <datalist id="Meeting_with" name="meeting_with">
                                  @foreach($Contact_person as $client)
                                      <option value="{{$client->contact_person_name}}">
                                  @endforeach
                                  </datalist>
                                  
                           </div>
                        <div class="col-6">
                            <label>Assign To</label>
                            
                            <input list="Assign_To" name="assign_to" id="assign_to"  placeholder='Assign To' class="form-control">
                                  <datalist id="Assign_To" name="assign_to">
                                  @foreach($Assign_toID as $employee)
                                      <option value="{{$employee->first_name}}&nbsp;{{$employee->last_name}}">
                                  @endforeach
                                  </datalist>
                                  
                         </div>
                    </div>
            <div class="form-group row">
             <div class="col-12">
                 <label>Subject</label>
                 <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject">
             </div>
                        
                    </div>
                    <div class="form-group row">
                            <div class='col-12'>
                            <label>Remark/Notes</label>
                            <textarea id="remark" name="remark" class="form-control" placeholder="Write Something..."></textarea>
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

                        <input class="btn btn-success" type="button" id="savebtn" name="savebtn" value="Update" >
                    
                     
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
   $(document).ready(function() {
      // toastr.options.hideMethod = 'noop';
      // toastr.options.timeOut = 0; 
      //  toastr.options.extendedTimeOut = 0;
      // toastr.options.closeButton = true;
      //  setInterval(function(){ toastr.success('You have a meeting today'); }, 3000);

     });

    
  </script>
<script>

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

var meetingid={{$id}};
	//console.log(followupid);

$.get("/meeting/edit/" + meetingid , function (data) {

         document.getElementById('meeting_date').value = data.meeting_date;
         document.getElementById('meeting_time').value = data.meeting_time;
         document.getElementById('meeting_with').value = data.meeting_with;
         document.getElementById('assign_to').value = data.assgin_to;
         document.getElementById('subject').value = data.subject;
         document.getElementById('remark').value = data.remark;
         document.getElementById('nature').value = data.nature;
        });


   $('#savebtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..'); 
       // debugger;
        var myForm = document.getElementById('followupform');
        var formData = new FormData(myForm);
       // var test=validate_form();
        var test=true;
        if(test==true){

              
             $.ajax({
          data: formData,
          url: "/Meeting/update/"+ meetingid,
          type: "POST",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
     
            swal("Meeting Updated successfully","","success");
           // $('#followupform').trigger("reset");
          },
          
         
      });
        }
        
       
    });
    function validate_form(){

      var rem_date = document.getElementById('rem_date').value;
    var rem_time = document.getElementById('rem_time').value;
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
    else if(subject==""){
        swal("Enter Product Price","","warning");
        return false;
    }
    else if(remark==""){
        swal("Enter Product Price","","warning");
        return false;
    }
    else if(nature==""){
        swal("Enter Product Price","","warning");
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