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
#tab_logic tbody tr.even:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
 
   #tab_logic tr.odd:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
</style>


<br>
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
                            <label class="form-label required">Select Contact person</label>
                        </div>
                        <div class="col-sm-4">
                        <input type="text" value="{{$indiamart->byer_name}}" name="Select_Contact_person" id="Select_Contact_personID" class="form-control product populate" >
                        
                        </div> 
                        <div class="col-2">
                            <label class="form-label ">Organization Name</label>
                          </div>
                        <div class="col-sm-4">
                           <input list="organization_name"  name="organization_name1" id="organization_name1" class="form-control populate" placeholder="Organization Name" maxlength="180"> 

                            <datalist id="organization_name" >
                          
                            <option value=""" label=""></option>
                            
                            </datalist>
                            <input type="text" id="hidden_orgid" name="hidden_orgid" value=""  />
                        
                        
                    </div>
                    </div>
                    
                    <div class="form-group row">
                      <div class="col-sm-2">

                            <label class="form-label required">Data Source</label>
                        </div>
                        
                            <div class="col-sm-4">                    
                            <input list="EnquiryDataSource_Name" name="EnquiryDataSource_Name" id="EnquiryDataSource_NameID" class="form-control product">
                                  <datalist id="EnquiryDataSource_Name">                                 
                                
                                  @foreach($enquiry_data_sources as $enquirydatasource)
                                      <option  value="{{$enquirydatasource->EnquiryDataSource_Name}}"></option>
                                  @endforeach                                 
                                  </datalist>

                        </div>
                        <div class="col-sm-2">
                            <label class="form-label required">Referred By</label>
                        </div>
                        <div class="col-sm-4">
                        <input list="ReferredBy_Name" name="ReferredBy_Name" id="ReferredBy_NameID" class="form-control">
                                  <datalist id="ReferredBy_Name">
                                  @foreach($referred_bies as $referredby)
                                      <option  value="{{$referredby->ReferredBy_Name}}"></option>                    
                                   @endforeach
                                   </datalist>
                                                
                        </div>
                        </div>
                       <div class="form-group row">
                          <div class="col-sm-2">
                            <label class="form-label required">Enquiry Type</label>     
                            </div>
                            <div class="col-sm-4">
                            <input list="EnquiryType_Name" name="EnquiryType_Name" id="EnquiryType_NameID" class="form-control product">
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
                               <input type="text" id="enq_date" name="enq_date" class="form-control" >
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                                </div>
                             </div>  
                          </div>
                        </div>                                                     
                    
                        
                        <div class="col-12" style="align-items: center;">
                            <label>Description/Note</label>
                            <textarea class="form-control" rows="5" id="Description_Note" name="Description_Note" maxlength="500"></textarea>
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
                                  <th class="text-center"> Assign To </th>
                                  <th class="text-center"> Requested Quantity </th>
                                  <th class="text-center"> Co-ordinated with </th>
                                  <th class="text-center"> Nature </th>
                                </tr>
                              </thead>
                              <tbody>
                               
                                <tr id="addr0">
                                 <td></td>
                                  <td><input type="checkbox" name="record"></td>
                                  <td>
                                  <input list="products" value="{{$indiamart->description}}" oninput='onInput(this)'  name="product[]" id="productID" class="form-control product">
                                  <datalist id="products" name="product[]">
                                  @foreach($productID as $product)
                                      <option data-price="{{$product->price}}" value="{{$product->product_name}}">{{$product->price}}</option>
                                  @endforeach
                                  </datalist>
                                  </td>
                                  <td><input type="number" id="Unit" name='Unit[]' id="Unit" placeholder='Enter Unit' class="form-control Unit" onkeyuo="return Validate()"  min="1"/></td>
                                  <td>
                                  <input list="Assign_To" name="Assign_to[]" id="Assign_toID" class="form-control product" onKeyPress="return ValidateAlpha(event);">
                                  <datalist id="Assign_To" name="Assign_to[]">
                                  @foreach($Assign_toID as $employee)
                                      <option value="{{$employee->first_name}}&nbsp;{{$employee->last_name}}">
                                  @endforeach
                                  </datalist>
                                  </td>
                                  <td><input type="number" name='Requested_Quantity[]' placeholder='Quantity' class="form-control total" id="Requested_Quantity" onkeyuo="return Validate()" min="1"/></td>
                                  <td>
                                  <input type="text" name="Co_ordinated_with[]" id="Co_ordinated_withID" class="form-control product" onKeyPress="return ValidateAlpha(event);">
                                 
                                  </td> 
                                  <td>
                                    <input list="browser"  name="nature[]" id="nature" class="form-control">
                                        <datalist id="browser"  name="nature[]">
                                            <option value="Cold" style="background-color:Blue; color:white;">Cold</option>
                            <option value="Warm" style="background-color:Orange; color:white;">Warm</option>
                            <option value="Hot" style="background-color:Red; color:white;">Hot</option>
                            <option value="Mature" style="background-color:Green; color:white;">Mature</option>
                            <option value="Not_Intersted" style="background-color:black; color:white;">Not Intersted</option>
                              
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
                     <div class="form-group row" id="updateDiv">
                      <div class="col-5" ></div>
                      <div class="col-6">
                      <input type="submit" name="Update" value="Update"  id="updateBtn" class="btn btn-success" />
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
             swal("Enquiry is Added", "success")
           

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


$(".populate").change(function(){
   debugger;
    var orgid=$("#organization_name option[value='" + $("#organization_name1").val() + "']").attr("label");
     
     $('#hidden_orgid').val(orgid);
     $.get("/proposals/edit/" + orgid, function (data){
       console.log(data);
          
        
          $('#EnquiryDataSource_NameID').val(data.contact_person_name);
          //$('#prop_email').val(data.email_id);
          //$('#prop_address').val(data.address);

     })
});


$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});



 

if({{$id}}=="0"){
  var enq = {{$id}};
  $("#saveBtn").show();
  $("#updateBtn").hide();
  
}else{
  $("#updateBtn").show();  
  $("#saveBtn").hide();
  debugger;

    var enq = {{$id}};
  
   $.get("/createEnquiry/edit/"+ enq, function (data,data2) {
      debugger;
       console.log(data.enquiry_products.length);
        console.log(data2);
   debugger;
    document.getElementById('Select_Contact_personID').value = data.enquiries.Select_Contact_person;
    document.getElementById('enq_date').value = data.enquiries.Expected_closed_Date;
    document.getElementById('EnquiryDataSource_NameID').value = data.enquiries.EnquiryDataSource_Name;
    document.getElementById('organization_name').value = data.enquiries.organization_name;
    document.getElementById('ReferredBy_NameID').value = data.enquiries.ReferredBy_Name;
    document.getElementById('EnquiryType_NameID').value = data.enquiries.EnquiryType_Name;
    document.getElementById('Description_Note').value = data.enquiries.Description_Note;
    document.getElementById('nature').value = data.enquiries.nature;
    

    document.getElementById('productID').value = data.enquiry_products[0].Product;
    document.getElementById('Unit').value = data.enquiry_products[0].Unit;
    document.getElementById('Assign_toID').value = data.enquiry_products[0].Assign_To;
    document.getElementById('Requested_Quantity').value = data.enquiry_products[0].Requested_Quantity;
    document.getElementById('Co_ordinated_withID').value = data.enquiry_products[0].Co_ordinated_with;
    document.getElementById('nature').value = data.enquiry_products[0].nature;

 for (j = 1; j < data.enquiry_products.length; j++) { 
        
  var addrow ='<tr id="addr0">'+
  
        '<td><input type="checkbox" name="record"></td>'+
        '<td><input list="product" name="product[]" id="productID" class="form-control product" value="'+data.enquiry_products[j].Product+'"><datalist id="product" name="product[]><option value="1"><option value="2"><option value="3"><option value="4"><option value="5"></datalist>'+
        '<td><input type="number" id="Unit" name="Unit[]" value="'+data.enquiry_products[j].Unit+'" placeholder="Enter Unit"  class="form-control qty" min="1"/></td>'+
        '<td> <input list="Assign_to" name="Assign_to[]" id="Assign_toID" class="form-control product"  value="'+data.enquiry_products[j].Assign_To+'"><datalist id="Assign_to" name="Assign_to[]" ><option value="1"><option value="2"><option value="3"><option value="4"><option value="5"></datalist>'+
        '<td><input type="number" id="Requested_Quantity" name="Requested_Quantity[]" value="'+data.enquiry_products[j].Requested_Quantity+'" placeholder="Quantity" class="form-control total"/></td>'+
        '<td><input list="Co_ordinated_with" name="Co_ordinated_with[]" id="Co_ordinated_withID" class="form-control product" value="'+data.enquiry_products[j].Co_ordinated_with+'"><datalist id="Co_ordinated_with" name="Co_ordinated_with[]"><option value="1"><option value="2"><option value="3"><option value="4"><option value="5"></datalist>'+
        '<td><input list="browser"  name="nature[]" id="nature" class="form-control">'+
        '<datalist id="browser"  name="nature[]">'+
        '<option value="Cold" style="background-color: Blue;">Cold</option>'+
        '<option value="Warm" style="background-color: DarkGreen;color: #FFFFFF;">Warm</option>'+
        '<option value="Hot" style="background-color: Red;">Hot</option>'+
        '<option value="Not Interested" style="background-color: White;">Not Interested</option>'+
        '<option value="Mature" style="background-color:#FFD933;">Mature</option> </datalist>'+
        
        '</td> '+
        '</tr>';
        
  $('#tab_logic').find('tbody').append(addrow);
  
}
 
    });
}

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
        '<td><input list="product" name="product[]" id="productID" class="form-control product" value=""><datalist id="product" name="product[]><option value="1"></datalist>'+
        '<td><input type="number" id="Unit" name="Unit[]" value="" placeholder="Enter Unit"  class="form-control qty" step="0" min="0"/></td>'+
        '<td> <input list="Assign_to" name="Assign_to[]" id="Assign_toID" class="form-control product" value=""><datalist id="Assign_to" name="Assign_to[]" ><option value="1"></datalist>'+
        '<td><input type="number" id="Requested_Quantity" name="Requested_Quantity[]"  value=""placeholder="Quantity" class="form-control total"/></td>'+
        '<td><input list="Co_ordinated_with" name="Co_ordinated_with[]" id="Co_ordinated_withID" class="form-control product" value=""><datalist id="Co_ordinated_with" name="Co_ordinated_with[]"><option value="1"></datalist>'+
        '<td><input list="browser"  name="nature[]" id="nature" class="form-control">'+
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
            swal("Enquiry  successfully updated")
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
              swal('Invalid Number, Please enter the number again');
              return false;
            }
        }



function validateForm() {
        var Select_Contact_person = document.getElementById('Select_Contact_person').value;
        var Expected_closed_Date = document.getElementById('enq_date').value;
        var EnquiryDataSource_Name = document.getElementById('EnquiryDataSource_NameID').value;
        var organization_name = document.getElementById('organization_name').value;
        var ReferredBy_Name = document.getElementById('ReferredBy_NameID').value;
        var EnquiryType_Name = document.getElementById('EnquiryType_NameID').value;
        var nature = document.getElementById('nature').nature;
        // var Description_Note = document.getElementById('Description_Note').value;
        var productID = document.getElementById("productID").value;
        var Unit = document.getElementById("Unit").value;
        var Assign_toID = document.getElementById("Assign_toID").value;
        var Requested_Quantity = document.getElementById("Requested_Quantity").value;
        var Co_ordinated_withID = document.getElementById("Co_ordinated_withID").value;
        
        if (Select_Contact_person == "" ) {
            swal("Enter Contact person");
            $("#Select_Contact_person").focus();
            return false;
          }
          else if(organization_name ==""){
            swal("Enter Organization Name");
            $("#organization_name").focus();
            return false;
          }
            else if(EnquiryDataSource_NameID ==""){
            swal("Enter Data Source");
            $("#EnquiryDataSource_NameID").focus();
            return false;
          }
          else if(ReferredBy_NameID ==""){
            swal("Enter Referred By");
            $("#ReferredBy_NameID").focus();
            return false;
          }
           else if(EnquiryType_NameID ==""){
            swal("Select Enquiry Type ");
            $("#EnquiryType_NameID").focus();
            return false;
          }
          else if(nature ==""){
            swal("Select Nature ");
            $("#nature").focus();
            return false;
          }
          else if(productID ==""){
            swal("Enter Product Id");
            $("#productID").focus();
            return false;
          }
          else if(Unit ==""){
            swal("Enter Unit");
            $("#Unit").focus();
            return false;
          }
          else if(Assign_toID ==""){
            swal("Enter Assign To");
            $("#Assign_toID").focus();
            return false;
          }
          else if(Requested_Quantity ==""){
            swal("Enter Requested Quantity");
            $("#Requested_Quantity").focus();
            return false;
          }
          else if(Co_ordinated_withID ==""){
            swal("Enter Co-Ordinated With");
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
//         $(".populate").change(function(){
//     var contactid=$("#Select_Contact_person option[value='" + $("#Select_Contact_personID").val() + "']").attr("label");
     
    
//      $.get("/createEnquiry/edit/" + contactid, function (data){
//        console.log(data);
//           debugger;
//          $('#organization_name').val(data['organization_name']);
          

//      })
// });


  $('#Select_Contact_personID').on('input', function() {
    //debugger;
    var val = $('#Select_Contact_personID').val()
    var xyz = $('#Select_Contact_person option').filter(function() {
        return this.value == val;
    }).data('og_name');
     var og1_id = $('#Select_Contact_person option').filter(function() {
        return this.value == val;
    }).data('og_id');
    /* if value doesn't match an option, xyz will be undefined*/
    var msg = xyz;

    $('#organization_name').val(msg);
    $('#hidden_orgid').val(og1_id);
    
    //alert(msg);





  });


function onInput(context)
{
  var elem=context;
 var val = elem.value;
var xyz = $('#products option').filter(function() {
        return this.value == val;
    }).data('price');
   // alert(xyz);
}




</script>

@endsection