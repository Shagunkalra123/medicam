@extends('layouts.master')


@section('content')
<style>
.required:after {color: #e32;content:'*';display:inline;}
#container_div {
    background:#FAFAFA;

}
#headername {
 background:#6495ed;
 color:white;
}
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">
<br>
<div class="card card-secondary" id="container_div">
              <div class="card-header" id="headername">
                <h3 class="card-title">Add Organization</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form id="client_form" >
                  <!-- text input -->
                    <div class="form-group row">
                      <div class="col-4">
                            <label for="contact_person_name" class="form-label required">Contact Person</label>
                            <input type="text" name="contact_person_name" id="contact_person_name" class="form-control" placeholder="Person Name" maxlength="180">
                        </div>
                        <div class="col-4">
                            <label for="contact_person_name_acc" class="form-label">Contact Person (Account)</label>
                            <input type="text" name="contact_person_name_acc" id="contact_person_name_acc" class="form-control" placeholder="Person Name (Account)" maxlength="180">
                        </div>
                        <div class="col-4">
                            <label for="organization_name" class="form-label required">Organization Name</label>
                            <input type="text" name="organization_name" id="organization_name" class="form-control" placeholder="Organization Name" maxlength="180">
                        </div>
                       
                      
                    </div>
                     <!-- text input -->
                     <div class="form-group row">
                      <div class="col-4">
                          <label>Organization Type</label>
                      <input list="organization_type" name="organization_type" id="organization_typeID" placeholder="Organization Type" class="form-control">
                                  <datalist id="organization_type">
                                  @foreach($organization_types as $organizationtype)
                                      <option  value="{{$organizationtype->OrganizationType_Name}}"></option>                    
                                   @endforeach
                                  </datalist>
                        </div>                      
                        <div class="col-4">
                           <label>Industry</label>
                            <input list="industry" name="industry" id="industryID" placeholder="Industry" class="form-control product">
                                  <datalist id="industry">                               
                                @foreach($industries as $industry)
                                      <option  value="{{$industry->Industry_Name}}">{{$industry->id}}</option>
                                  @endforeach
                                  </datalist>
                        </div>                        
                      <div class="col-4">
                            <label>Association with Medicam</label>
                            <input list="association_with_medicam" name="association_with_medicam" id="association_with_medicamID" placeholder="Association with Medicam" class="form-control">
                                  <datalist id="association_with_medicam">
                                  @foreach($association_with_medicams as $associationwithmedicam)
                                      <option  value="{{$associationwithmedicam->AssociationWithMedicam_Name}}"></option>                    
                                   @endforeach
                                  </datalist>             
                                </div>
                    </div>
                     <!-- text input -->
                     <div class="form-group row">
                       <div class="col-4">
                          <label>Mobile Number</label>
                          <input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile Number" maxlength="15" onkeypress="return Validate(event)">
                      </div>
                        <div class="col-4">
                            <label>Primary Phone</label>
                            <input type="text" name="primary_phone" id="primary_phone" class="form-control" placeholder="Primary Phone" maxlength="15" onkeypress="return Validate(event)">
                        </div>
                    <div class="col-4">
                          <label>Secondary Phone</label>
                          <input type="text" name="secondary_phone" id="secondary_phone"  class="form-control" placeholder="Secondary Phone" maxlength="15" onkeypress="return Validate(event)" >
                      </div>                      
                    </div>
                    <!-- text input -->
                     <div class="form-group row">                    
                         <div class="col-4">
                            <label>Email ID</label>
                            <input type="text" name="email_id" id="email_id" onblur="validate_email2()" class="form-control" placeholder="Email ID">
                        </div>
                         <div class="col-4">
                            <label>Secondary Email</label>
                            <input type="text" id="secondary_email" name="secondary_email" onblur="validate_email3()" class="form-control" placeholder="Secondary Email">
                        </div>                     
                         <div class="col-4">
                          <label>Fax</label>
                          <input type="text" name="fax" id="fax" class="form-control" placeholder="Fax" maxlength="50" onkeypress="return Validate(event)">
                      </div>                        
                    </div>
                     <!-- text input -->
                     <div class="form-group row">
                       <div class="col-4">
                            <label>Address</label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Address" maxlength="180">
                        </div>
                        <div class="col-4">
                            <label>City/Town</label>
                            <input type="text" name="city_town" id="city_town" class="form-control" placeholder="City/Town" maxlength="180">
                        </div>
                      <div class="col-4">
                            <label>Postal Code</label>
                            <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Postal Code" maxlength="15" onkeypress="return isNumber(event)">
                        </div>                                         
                    </div>
                     <!-- text input -->
                     <div class="form-group row">
                      <div class="col-4">
                              <label>State</label>
                              <input list="state" name="state" id="stateID" placeholder="State"  class="form-control product">
                                  <datalist id="state">                                 
                                  @foreach($states as $state)
                                      <option  value="{{$state->State_Name}}"></option>
                                  @endforeach
                                  </datalist>
                          </div>                        
                      <div class="col-4">
                      <label>Country</label>
                          <input list="country" name="country" id="countryID" placeholder="Country"  class="form-control">
                                  <datalist id="country">
                                  @foreach($countries as $country)
                                      <option  value="{{$country->Country_Name}}"></option>                    
                                   @endforeach
                                  </datalist>
                        </div>
                        <div class="col-4">
                           <label>Select Branch</label>
                            <input list="select_branch" name="select_branch" id="select_branchID" placeholder="Branch" class="form-control">
                                  <datalist id="select_branch">
                                  @foreach($branches as $branch)
                                      <option  value="{{$branch->Branch_Name}}"></option>                    
                                   @endforeach
                                  </datalist>                              
                          </div>
                    </div>
                     <!-- text input -->
                     <div class="form-group row">                                            
                        
                         
                                   <div class="col-4">        
                          <label>Data Source</label>
                          <input list="data_source" name="data_source" id="data_sourceID" placeholder="Data Source" class="form-control">
                                  <datalist id="data_source">
                                  @foreach($data_sources as $datasource)
                                      <option  value="{{$datasource->DataSource_Name}}"></option>
                                  @endforeach
                                  </datalist>
                        </div>  
                        <div class="col-4">
                            <label for="sel1">Sales Person</label>
                            <input list="sales_person" name="sales_person" id="sales_personID" placeholder="Sales Person" class="form-control product" onKeyPress="return ValidateAlpha(event);">
                                  <datalist id="sales_person" name="sales_person">
                                  @foreach($Assign_toID as $employee)
                                      <option value="{{$employee->first_name}}&nbsp;{{$employee->last_name}}">
                                  @endforeach
                                  </datalist>
                        </div>                        
                        <div class="col-4">
                            <label for="sel1">Assigned To</label>
                            <input list="Assign_To" name="Assign_To" id="Assign_toID" placeholder="Assigned To" class="form-control product" onKeyPress="return ValidateAlpha(event);">
                                  <datalist id="Assign_To" name="Assign_To">
                                  @foreach($Assign_toID as $employee)
                                      <option value="{{$employee->first_name}}&nbsp;{{$employee->last_name}}">
                                  @endforeach
                                  </datalist>
                      </div>                                                           
                    </div>
                     <!-- text input -->
                     <div class="form-group row">                                                                             
                     <div class="col-4">
                          <label>Area of Operations</label>
                          <input type="text" name="area" id="area" class="form-control" placeholder="Area" maxlength="40">
                          </div>
                          <div class="col-4">
                          <label>Landmark</label>
                          <input type="text" name="landmark" id="landmark" class="form-control" placeholder="Landmark" maxlength="180">
                      </div> 
                      <div class="col-4">
                            <label>Zone</label>
                            <input list="zone" name="zone" id="zoneID" placeholder="Zone" class="form-control">
                                  <datalist id="zone">
                                  @foreach($zones as $zone)
                                      <option  value="{{$zone->Zone_Name}}"></option>                    
                                   @endforeach
                                  </datalist>
                      </div>
                      
                                                                  
                                                     
                     </div>
                     <!-- text input -->
                     <div class="form-group row">
                     <div class="col-4">
                            <label for="sel1">Telecaller</label>
                             <input list="telecaller" name="telecaller" id="telecallerID" placeholder="Telecaller" class="form-control product" onKeyPress="return ValidateAlpha(event);">
                                  <datalist id="telecaller" name="telecaller">
                                  @foreach($Assign_toID as $employee)
                                      <option value="{{$employee->first_name}}&nbsp;{{$employee->last_name}}">
                                  @endforeach
                                  </datalist>
                        </div>           
                       
                      <div class="col-4">
                            <label>GSTIN/UIN</label>
                            <input type="text" name="gst" id="gst" class="form-control" placeholder="GSTIN/UIN" maxlength="50">
                        </div>
                        <div class="col-4">
                            <label>PAN NO</label>
                            <input type="text" name="pan_no" id="pan_no" class="form-control" placeholder="PAN NO" maxlength="30">
                        </div>  
                    </div>
                     <!-- text input -->
                     <div class="form-group row">                                                                       
                      
                                        
                        
                                <div class="col-4">
                          <label>Unique ID</label>
                          <input type="text" name="unique_id" id="unique_id" class="form-control" placeholder="Unique ID" maxlength="100">
                      </div>
                      <div class="col-4">
                            <label>Website</label>
           <input type="text" name="website" id="website" class="form-control" placeholder="Website" maxlength="100" onkeypress="return validateEmail(emailField)">
                       <input type="text" name="create_enq" id="create_enq" class="form-control" placeholder="" maxlength="100" hidden>
                        </div>                                                        
                    </div>  
                           
                                                                                     
           
                     <!-- text input -->
                     <div class="form-group row">                                                                     
                      </div>
                    <div class="col-12" style="align-items: center;">
                        <label>Description/Note</label>
                        <textarea class="form-control" name="description" rows="5" id="comment" maxlength="500"></textarea>
                    </div>
                    <br>
                    @if($id =="0")
                    <div class="form-group row">
                      <div class="col-5" > </div>
                      <div class="col-6">
                      <input type="submit" name="save" id="saveBtn" class="btn btn-success" />
                      <input type="button" name="Create_enq" value="Create Enquiry"  id="create_enquiry_uni" class="btn btn-success" />
                  </div>
                    </div>
                    @else
                  <div class="form-group row" style="align-items: right;">
                    <div class="col-5" ></div>
                      <div class="col-6" style="align-items: right;">
                          @can('isAdmin')
                        <input type="submit" name="Update" value="Update"  id="updateBtn" class="btn btn-success" />
                        @endcan
                  </div>
                   
                </div>
                @endif




                </form>
              </div>
              
            </div>
              <!-- /.card-body -->
           

@endsection

@section('javascript')

<!-- CK Editor -->
<script src="{{asset('admin-lte/plugins/ckeditor/ckeditor.js')}}"></script>
<script>
/*
$( document ).ready(function() {
    document.getElementById("sub-Priority").disabled = true;
});*/

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
   
                          
function validate(){
    var name = document.getElementById('contact_person_name').value;
    

    if(name==""){
        swal("Enter Contact Person Name","","warning");
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

function Validate(event) {
        var regex = new RegExp("^[0-9-!+@#$%*?]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    }      

 
/*function validate_email()  
{  
var x=  document.getElementById('primary_email').value;
var atposition=x.indexOf("@");  
var dotposition=x.lastIndexOf(".");  
if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
  swal("Error", "Please enter valid email", "danger")
  return false;  
  }  
}  */
function validate_email2()  
{  
var x=  document.getElementById('email_id').value;
var atposition=x.indexOf("@");  
var dotposition=x.lastIndexOf(".");  
if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
  swal("Error", "Please enter valid email", "warning")  
  return false;  
  }  
}
function validate_email3()  
{  
var x=  document.getElementById('secondary_email').value;
var atposition=x.indexOf("@");  
var dotposition=x.lastIndexOf(".");  
if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
  swal("Error", "Please enter valid email", "warning") 
  return false;  
  }  
}


if({{$id}}=="0"){

  $("#saveBtn").show();
  $("#updateBtn").hide();

}else{
  $("#updateBtn").show();  
  $("#saveBtn").hide();
var organization ={{$id}}
$.get("/add_client/edit/" + organization, function (data) {
		 console.log(data.contact_person_name);
     debugger;
			document.getElementById('contact_person_name').value = data.contact_person_name;
			document.getElementById('contact_person_name_acc').value = data.contact_person_name_acc;
			document.getElementById('organization_name').value = data.organization_name;
			document.getElementById('fax').value = data.fax;
			document.getElementById('gst').value = data.gst;
			document.getElementById('industryID').value = data.industry;
			document.getElementById('landmark').value = data.landmark;
			document.getElementById('city_town').value = data.city_town;
			document.getElementById('postal_code').value = data.postal_code;
			document.getElementById('mobile_number').value = data.mobile_number;
			document.getElementById('primary_phone').value = data.primary_phone;
			//document.getElementById('primary_email').value = data.primary_email;
			document.getElementById('unique_id').value = data.unique_id;
      document.getElementById('data_sourceID').value = data.data_source;
    	document.getElementById('address').value = data.address;
			document.getElementById('select_branchID').value = data.select_branch;
			document.getElementById('organization_typeID').value = data.organization_type;
			document.getElementById('email_id').value = data.email_id;
			document.getElementById('secondary_phone').value = data.secondary_phone;
      document.getElementById('secondary_email').value = data.secondary_email;
      document.getElementById('telecallerID').value = data.telecaller;
      document.getElementById('zoneID').value = data.zone;
      document.getElementById('countryID').value = data.country;
      document.getElementById('pan_no').value = data.pan_no;
      document.getElementById('Assign_toID').value = data.Assign_To;
      document.getElementById('website').value = data.website;
      document.getElementById('sales_personID').value = data.sales_person;
      document.getElementById('association_with_medicamID').value = data.association_with_medicam;
      document.getElementById('area').value = data.area;
      document.getElementById('stateID').value = data.state;
     // document.getElementById('Priority').value = data.Priority;
     // document.getElementById('subpriorityID').value = data.subpriority;
      //document.getElementById('nature').value = data.nature;
      document.getElementById('comment').value = data.description;
      });
}

$('#updateBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        var test=validate_form();
        if(test==true){
        $.ajax({
          data: $('#client_form').serialize(),
          url: "/add_client/update/"+organization,
          type: "get",
          dataType: 'json',
          success: function (data) {
              //  $('#client_form').trigger("reset");
              
            swal("Organization  successfully updated","","success");
             setTimeout(function() { location.href="{{ url('/list_organization') }}";}, 2000); 
            }
        });
        }
        });

    

  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    ClassicEditor
      .create(document.querySelector('#editor1'))
      .then(function (editor) {
        // The editor instance
      })
      .catch(function (error) {
        console.error(error)
      })

      $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        var myForm = document.getElementById('client_form');
        var formData = new FormData(myForm);
        var test=validate_form();
        if(test==true)
        {
        $.ajax({
          data: formData,
          url: "/add_client/store",
          type: "POST",
          dataType: 'json',
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
              console.log(data.success);
              debugger;
            if(data.success=="done")
            {
                swal("Added", "Organization is Added", "success")
                 setTimeout(function() { location.href="{{ url('/list_organization') }}";}, 2000); 
             

            }
            else{
                swal("Duplicate Entry", "Duplicate Mobile or Email address", "error");
              
            }
             
           

         
     
            // setTimeout(function() { location.href="{{ url('/list_organization') }}";}, 2000); 
             
              
            
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
        }
    });
  });
  function validate_form()
  {
    var name = document.getElementById('contact_person_name').value;
    var organisation_name = document.getElementById('organization_name').value;
      var mobile = document.getElementById('mobile_number').value;
    if(name==""){
        swal("Required", "Please enter Contact Person name", "warning") 
        document.getElementById('contact_person_name').focus();
        return false;
    }else if(organisation_name==""){
        swal("Required", "Please enter Organisation name", "warning") 
        document.getElementById('organization_name').focus();
        return false;
    } else if(mobile.length>1 && mobile.length<12){
        swal("Warning", "Please enter Mobile number with Country code", "warning") 
        document.getElementById('mobile_number').focus();
        return false;
    }
  
   else{
        return true;
    }   

  }
    $('#create_enquiry_uni').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
      
      document.getElementById("create_enq").value = "1";
        var myForm = document.getElementById('client_form');
        var formData = new FormData(myForm);
        var test=validate_form();
        if(test==true)
        {
        $.ajax({
          data: formData,
          url: "/add_client/store",
          type: "POST",
          dataType: 'json',
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
              console.log(data.success);
              debugger;
              var org_id=data.success;
           
                swal("Added", "Organization is Added", "success")
                 setTimeout(function() { location.href="{{ url('/creatEnq_from_org/') }}"+"/"+org_id;}, 2000); 
             

            
            
             
           

         
     
            // setTimeout(function() { location.href="{{ url('/list_organization') }}";}, 2000); 
             
              
            
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
        }
    });
/*
  function DisableMenu(){
debugger;
  if(document.getElementById("Priority").value=="Primary"){
      document.getElementById("sub-Priority").disabled = true;
  } else {
    document.getElementById("sub-Priority").disabled = false;
  } 
                  
} */
var timer;
$("#organization_name").on('input', function (){

  clearTimeout(timer);
   timer = setTimeout(function(){ checker(); }, 1000);


});
function checker(){
var organisation_name = document.getElementById('organization_name').value;
 $.get("/add_client/check/" + organisation_name, function (data) {
        if (typeof data !== 'undefined' && data.length > 0) {
          swal("Organisation already exists!","","warning");
          document.getElementById("saveBtn").disabled = true;
        }
        else{

           document.getElementById("saveBtn").disabled = false;
        }
        
      
});

}

</script>
@endsection