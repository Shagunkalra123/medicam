@extends('layouts.master')

@section('content')

<style>
.required:after {color: #e32;content:'*';display:inline;}
#container_div {
    background:#FAFAFA;
w
}
#headername {
 background:#6495ed;
 color:white;
}
#tab_logic tbody tr.even:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
 
   #tab_logic tr.odd:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">
<form role="form" id="enquiry_form">
<div class="card card-secondary" id="container_div">
              <div class="card-header" id="headername" >
                <h3 class="card-title">Add Enquiry</h3>
              </div>
              <!-- /.card-header -->
      
              <div class="card-body">
          
                  <!-- text input -->
                  
                 
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label class="form-label required">Organization Name</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="organization_name1" value="{{$organization_details->organization_name}}" id="organization_name1" class="form-control" placeholder="Organization Name" maxlength="180" >
                             <input type="text" id="hidden_orgid" name="hidden_orgid" value="{{$organization_details->id}}" hidden/>
                        </div>
                        
                        
                      <div class="col-sm-2">
                            <label class="form-label required">Contact person</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="Select_Contact_person" value="{{$organization_details->contact_person_name}}" id="Select_Contact_personID" class="form-control" placeholder="Contact Person Name" maxlength="180" >
                            
                        </div>
                        
                    </div>
                    
                     <div class="form-group row">
                        <div class="col-sm-2">
                            <label class="form-label required">Mobile</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="mobile1" value="{{$organization_details->mobile_number}}" id="mobile1" class="form-control" placeholder="Mobile Number" maxlength="180" >
                             <input type="text" id="hidden_orgid" name="hidden_orgid" value="{{$organization_details->id}}" hidden/>
                        </div>
                        
                        
                      <div class="col-sm-2">
                            <label class="form-label required">Email</label>
                        </div>
                        <div class="col-sm-4">
                        <input type="text" name="email" value="{{$organization_details->primary_email}}" id="emailid" class="form-control" placeholder="Email Id" maxlength="180" >
                            </div>
                        
                    </div>
                    
                    <div class="form-group row">
                      <div class="col-sm-2">

                            <label class="form-label required">Data Source</label>
                        </div>
                        
                            <div class="col-sm-4">                    
                            <input list="EnquiryDataSource_Name" value="{{$organization_details->data_source}}" name="EnquiryDataSource_Name" placeholder="Data Source" class="form-control">
                                  <datalist id="EnquiryDataSource_Name">                                 
                                
                                  
                                      <option  value="{{$organization_details->data_source}}"></option>
                                                                
                                  </datalist>

                        </div>
                        <div class="col-sm-2">
                            <label class="form-label">Referred By</label>
                        </div>
                        <div class="col-sm-4">
                        <input list="ReferredBy_Name" name="ReferredBy_Name" placeholder="Referred By" class="form-control">
                                  <datalist id="ReferredBy_Name">
                                  @foreach($referred_bies as $referredby)
                                      <option  value="{{$referredby->ReferredBy_Name}}"></option>                    
                                   @endforeach
                                   </datalist>
                                                
                        </div>
                        </div>

                        <div class="form-group row">
                        <div class="col-sm-2">
                            <label class="form-label">Enquiry Type</label>     
                            </div>
                            <div class="col-sm-4">
                            <input list="EnquiryType_Name" name="EnquiryType_Name" placeholder="Enquiry Type" class="form-control ">
                                  <datalist id="EnquiryType_Name">                                 
                                  @foreach($enquiry_types as $enquirytype)
                                      <option  value="{{$enquirytype->EnquiryType_Name}}"></option>
                                  @endforeach
                                  </datalist>               
                                </div> 
                               
                         
                                    
                        
                      
                      <div class="col-sm-2">
                            <label>Expected closed Date</label>
                      </div>
                         <div class="col-sm-4">
                            <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" name="Expected_closed_Date" id="Expected_closed_Date" placeholder="Expected closed Date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                          </div>                      
                        </div>
                        </div>
                        

 
                          

                      <div class="form-group row" id="hide"> 
                          <div class="col-sm-6" >
                              <label>Comment</label>
                              <textarea class="form-control" rows="5" id="Description_Note" name="Description_Note" maxlength="500"></textarea>
                          </div>
                          <div class="col-sm-2">
                              <label>Nature</label>
                              <input list="browser"  name="nature_comment" id="nature_comment" placeholder='Select' class="form-control">
                                <datalist id="browser"  name="nature_comment">
                                    <option value="Cold" style="background-color: Blue;">Cold</option>
                                    <option value="Warm" style="background-color: DarkGreen;color: #FFFFFF;">Warm</option>        
                                    <option value="Hot" style="background-color: Red;">Hot</option>
                                    <option value="Not Interested" style="background-color: White;">Not Interested</option>
                                    <option value="Mature" style="background-color:#FFD933;">Mature</option>

                                </datalist>      
                        

                            </div>
                        </div>
                       

                    </div>
                    <br>
               
                  
                       
       

                 

                  
      
                    <!-- dynaamic row -->
          <div class="card card-secondary">
            <br>
                    <div class="container">
                        <div class="row clearfix">
                          <div class="col-md-12">
                            <table class="table table-bordered table-hover" id="tab_logic">
                              <thead>
                                <tr>
                                 <th class="text-center" id=sr>  </th>
                                  <th class="text-center"> Select </th>
                                  <th class="text-center"> Product </th>
                                  <th class="text-center"> Unit </th>
                                  <th class="text-center"> Price </th>
                                  <th class="text-center"> Assign To </th>
                                  <th class="text-center"> Requested Quantity </th>
                                  <th class="text-center"> Co-ordinated with </th>
                                  <th class="text-center"> Nature </th>
                                </tr>
                              </thead>
                              <tbody>
                             
                                   
                             
                                <tr id="addr0">
                                  <td>1</td>
                                  <td><input type="checkbox" name="record"></td>
                                  <td>
                                  <input list="products" name="product[]" id="productID" class="form-control product" placeholder="Select">
                                  <datalist id="products" name="product[]">
                                  @foreach($productID as $product)
                                      <option data-price="{{$product->price}}" value="{{$product->product_name}}"></option>
                                  @endforeach
                                  </datalist>
                                  </td>
                                  <td><input type="number" id="Unit" name='Unit[]' id="Unit" placeholder="Unit" class="form-control Unit" onkeyuo="return Validate()"  min="1"/></td>
                                  <td><input type="number" id="price" name='price[]' placeholder='Price' class="form-control Price" onkeyuo="return Validate()"  min="1"/></td>

                                  <td>
                                  <input list="Assign_To" name="Assign_to[]" id="Assign_toID" class="form-control " placeholder="Assign to" onKeyPress="return ValidateAlpha(event);">
                                  <datalist id="Assign_To" name="Assign_to[]">
                                  @foreach($Assign_toID as $employee)
                                      <option value="{{$employee->first_name}}&nbsp;{{$employee->last_name}}">
                                  @endforeach
                                  </datalist>
                                  </td>
                                  <td><input type="number" name='Requested_Quantity[]' placeholder='Quantity' class="form-control total" id="Requested_Quantity" onkeyuo="return Validate()" min="1"/></td>
                                  <td>
                                  <input type="text" name="Co_ordinated_with[]" id="Co_ordinated_withID" class="form-control" placeholder="Coordinated with" onKeyPress="return ValidateAlpha(event);">
                                  <!--<datalist id="Co_ordinated_with" name="Co_ordinated_with[]">
                                  @foreach($Assign_toID as $employee1)
                                      <option value="{{$employee1->first_name}}&nbsp;{{$employee1->last_name}}">
                                  @endforeach
                                  </datalist>-->
                                  </td>  
                                  <td>
                                    <input list="browser"  name="nature[]" id="nature" placeholder="Select" class="form-control">
                                        <datalist id="browser"  name="nature[]">
                                            <option value="Cold" style="background-color: Blue;">Cold</option>
                                            <option value="Warm" style="background-color: DarkGreen;color: #FFFFFF;">Warm</option>        
                                            <option value="Hot" style="background-color: Red;">Hot</option>
                                            <option value="Not Interested" style="background-color: White;">Not Interested</option>
                                            <option value="Mature" style="background-color:#FFD933;">Mature</option>
                              
                                    </datalist>      

                                

                                  </td> 
                                </tr>
                               
                              </tbody>
                            </table>
                          </div>
                        </div>
                        
                        <div class="row clearfix">
                          <div class="col-md-12">
                            <button id="addrow" type="button" class="btn btn-default pull-left addrow">Add Row</button>
                            <button id="delete_row" type="button" class="btn btn-default pull-right remove">Delete Row</button>
                           
                          </div>
                        </div>
                        
                      </div>
                      <div class="form-group row">
                        <div class="col-5" ></div>
                        <div class="col-6">
                        <button type="button" name="save" id="saveBtn" class="btn btn-success" >Submit</button>
                    </div>
                    </div>
                    
                </form>
              </div>
             
              <!-- /.card-body -->
            </div>
          </div>    
 </div>
                    </div>
@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

  $('#saveBtn').on ('click', function (event) {
        debugger;
        event.preventDefault();
        //$(this).html('Sending..');
        var myForm = document.getElementById('enquiry_form');
        var formData = new FormData(myForm);
        var test=validateForm();
        if(test==true)
        {
          debugger;
        $.ajax({
          data: formData,
          url: "{{route('enquiry_save')}}",
          type: "POST",
          dataType: 'json',
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
             swal("Enquiry added successfully","","success")
           

              $('#enquiry_form').trigger("reset");
          setTimeout(function(){ window.location.href="{{ url('/List_all_enquiry') }}";}, 2000); 
         
     
              $('#enquiry_form').trigger("reset");
               debugger;
              
            
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
        }
    });



});


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
   





var i=1;
 
$(".addrow").click(function(){
  debugger;
  event.preventDefault();
  addrow();
});

function addrow(){
  b=i-1;
  debugger;
    $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
  var addrow ='<tr id="addr0">'+
  '<td id=sr></td>'+
         
          '<td><input type="checkbox" name="record"></td>'+
          '<td>'+
          '<input list="products" onchange="" name="product[]"  placeholder="Select" class="form-control product">'+
          '<datalist id="products" name="product[]">'+
         ' @foreach($productID as $product)'+
          '<option data-price="{{$product->price}}" value="{{$product->product_name}}">{{$product->price}}</option>'+
          '@endforeach'+
          '</datalist>'+
          '</td>'+
          '<td><input type="number" id="Unit" name="Unit[]" placeholder="Unit" class="form-control Unit" onkeyuo="return Validate()"  min="1"/></td>'+
          '<td><input type="number" id="price" name="price[]" placeholder="Price" class="form-control Price" onkeyuo="return Validate()"  min="1"/></td>'+
          '<td>'+
          '<input list="Assign_To" name="Assign_to[]" id="Assign_toID" placeholder="Assign To" class="form-control " onKeyPress="return ValidateAlpha(event);">'+
          '<datalist id="Assign_To" name="Assign_to[]">'+
          '@foreach($Assign_toID as $employee)'+
              '<option value="{{$employee->first_name}}&nbsp;{{$employee->last_name}}">'+
          '@endforeach'+
         '</datalist>'+
          '</td>'+
          '<td><input type="number" name="Requested_Quantity[]" placeholder="Quantity" class="form-control total" id="Requested_Quantity" onkeyuo="return Validate()" min="1"/></td>'+
         '<td>'+
          '<input type="text" name="Co_ordinated_with[]" placeholder="Co-ordinated with" class="form-control Co_ordinated_withID" onKeyPress="return ValidateAlpha(event);">'+
          
          '</td>'+ 
          '<td>'+
       
          '<input list="browser"  name="nature[]" id="nature" placeholder="Select" class="form-control">'+
        
        '<datalist id="browser"  name="nature[]">'+
        '<option value="Cold" style="background-color: Blue;">Cold</option>'+
        '<option value="Warm" style="background-color: DarkGreen;color: #FFFFFF;">Warm</option>'+
        '<option value="Hot" style="background-color: Red;">Hot</option>'+
        '<option value="Not Interested" style="background-color: White;">Not Interested</option>'+
        '<option value="Mature" style="background-color:#FFD933;">Mature</option> </datalist>'+
        
        '</td> '+
        '</tr>';
        document.getElementById('sr').innerHTML = i;
  $('#tab_logic').find('tbody').append(addrow);
  i++;

}

$('#tab_logic tbody').on('keyup change',function(){
		calc();
	});

  function calc(){
    
    $('#tab_logic tbody tr').each(function(i, element) {
    debugger;
   var pro= $(this).find('.product').val();
    
    var xyz = $('#products option').filter(function() {
        return this.value == pro;
   }).data('price');
    $(this).find('.Price').val(xyz);
    });
    
  }

   $("#delete_row").click(function(){
     debugger;
        $("table tbody").find('input[name="record"]').each(function(){
        if($(this).is(":checked")){
         
              $(this).parents("tr").remove();
            
            }
        });
        });

   $('#updateBtn').click(function (e) {
     debugger;
        e.preventDefault();
        // $(this).html('Sending..');
        var enqId = {{$id}};
        $.ajax({
          data: $('#enquiry_form').serialize(),
          url: "/createEnquiry/update/"+ enqId,
          type: "get",
          dataType: 'json',
          success: function (data) {
            swal("Enquiry updated successfully","","success")
               $('#enquiry_form').trigger("reset");
            debugger;
               setTimeout(function(){ window.location.href="{{ url('/List_all_enquiry') }}";}, 2000); 
            }
        });
        });

    function Validate()
        {
          var e=document.getElementById('Unit').value;
          if(e=='' || e>0)
            {
              swal("Invalid Number, Please enter the number again","","warning");
              return false;
            }
        }



function validateForm() {
        var Select_Contact_person = document.getElementById('Select_Contact_personID').value;
        var Expected_closed_Date = document.getElementById('Expected_closed_Date').value;
        var EnquiryDataSource_Name = document.getElementById('EnquiryDataSource_Name').value;
        var organization_name = document.getElementById('organization_name1').value;
        var ReferredBy_Name = document.getElementById('ReferredBy_Name').value;
        var EnquiryType_Name = document.getElementById('EnquiryType_Name').value;
        var nature = document.getElementById('nature').nature;
        // var Description_Note = document.getElementById('Description_Note').value;
        var productID = document.getElementById("productID").value;
        var Unit = document.getElementById("Unit").value;
        var Assign_toID = document.getElementById("Assign_toID").value;
        var Requested_Quantity = document.getElementById("Requested_Quantity").value;
        var Co_ordinated_withID = document.getElementById("Co_ordinated_withID").value;
        
        if (Select_Contact_person == "" ) {
            swal("Enter Contact person","","warning");
            $("#Select_Contact_person").focus();
            return false;
          }
          else if(organization_name ==""){
            swal("Enter Organization Name","","warning");
            $("#organization_name1").focus();
            return false;
          }
            else if(EnquiryDataSource_Name ==""){
            swal("Enter Data Source","","warning");
            $("#EnquiryDataSource_Name").focus();
            return false;
          }
          /*else if(ReferredBy_Name ==""){
            swal("Enter Referred By","","warning");
            $("#ReferredBy_Name").focus();
            return false;
          }
           else if(EnquiryType_Name ==""){
            swal("Select Enquiry Type","","warning");
            $("#EnquiryType_Name").focus();
            return false;
          }*/
          else if(nature ==""){
            swal("Select Nature","","warning");
            $("#nature").focus();
            return false;
          }
          else if(productID ==""){
            swal("Enter Product Id","","warning");
            $("#productID").focus();
            return false;
          }
          else if(Unit ==""){
            swal("Enter Unit","","warning");
            $("#Unit").focus();
            return false;
          }
          else if(Assign_toID ==""){
            swal("Enter Assign To","","warning");
            $("#Assign_toID").focus();
            return false;
          }
          else if(Requested_Quantity ==""){
            swal("Enter Requested Quantity","","warning");
            $("#Requested_Quantity").focus();
            return false;
          }
          else if(Co_ordinated_withID ==""){
            swal("Enter Co-Ordinated With","","warning");
            $("#Co_ordinated_withID").focus();
            return false;
          }
          else{
          swal("success");
          return true;
          } 

      }

      
         

        

        function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
            return true;
    }
        }
        $(".populate").change(function(){
    var contactid=$("#Select_Contact_person option[value='" + $("#Select_Contact_personID").val() + "']").attr("label");
     
    //  $('#hidden_orgid').val(orgid);
     $.get("/add_client/" + contactid, function (data){
       console.log(data);
          debugger;
         $('#organization_name1').val(data['organization_name1']);
          // $('#mobile_num').val(data.mobile_number);
          // $('#email_id').val(data.email_id);
          // $('#address').val(data.address);

     })
});





</script>

@endsection