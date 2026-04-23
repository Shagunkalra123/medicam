@extends('layouts.master')

@section('stylesheet')
    <!-- DataTables -->
    

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

@endsection
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
.bg-white {
    background-color: #1560ab!important;
}
</style>

    <span id="form_output"></span>
    <form role="form" id="order_form">
    <input type="text" name="enqid_hidden" id="enqid_hidden" value="{{$enqId}}" hidden/>
    <input type="text" name="entryLevelHidden" id="entryLevelHidden" value="{{$ProposalEntry}}" hidden/>
    <input type="text" name="proposalIDHidden" id="proposalIDHidden" value="{{$proID}}" hidden/>
   <div class="card card-secondary" id="container_div">
              <div class="card-header" id="headername">
                <h3 class="card-title" >Create Order</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                  <!-- text input -->
                     <div class="form-group row">
                      <div class="col-6">
                        <div class="row" id="myTooltips">
                          <div class="col-12">
                            <label class="form-label required">Organization Name</label>
                          </div>
                          <div class="col-11">
                           
                                {{csrf_field()}} 
                            <input list="organization_name" id="organization_name1" name="organization_name1" class="form-control populate" placeholder="Organization Name"> 

                            <datalist id="organization_name" >
                             @foreach ($organisations as $organisation)
                            <option value="{{$organisation->organization_name}}" label="{{$organisation->id}}">{{$organisation->id}}</option>
                             @endforeach
                            </datalist>
                           
                          </div>

                            <button class="btn btn-default" type="button" title="Create Organization" data-toggle="modal" data-target="#ajaxModel"><i class="fas fa-plus"></i></button>
                            <input type="hidden" id="hidden_orgid" name="hidden_orgid" />
                          </div>
                        </div>
                      <div class="col-6"  style="margin-right:-40px">
                            <label for="contact_person_name" class="form-label required">Contact Person Name</label>
                            <input type="text" name="contact_person_name" id="contact_person_name" class="form-control" placeholder="Person Name" maxlength="150">
                        </div>
                       
                    </div>
                    <div class="form-group row">
                      <div class="col-6">
                            <label for="mobile_num" class="form-label required">Mobile Number</label>
                            <input type="text" name="mobile_num" id="mobile_num" class="form-control" placeholder="Mobile Number" maxlength="10" onkeypress="return Validate(event)">
                        </div>
                        <div class="col-6">
                            <label>Email Id</label>
                            <input type="text" name="email_id" id="email_id" onblur= "validate_email()" class="form-control" placeholder="Email Id" maxlength="170" >
                        </div>
                    </div>
                    <div class="form-group row">
                       <div class="col-6">
                            <label for="prop_date" class="form-label required">Warranty Date</label>
                           
                            <div class="input-group date" data-provide="datepicker">
                               <input type="text" id="warranty_date" name="warranty_date" placeholder="Warranty Date" class="form-control">
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                                </div>
                             </div>                          
                        </div>

                        <div class="col-6">
                            <label for="pono" class="form-label">P.O. Number</label>
                            <input type="text" name="pono" id="pono" class="form-control" placeholder="P.O. Number" maxlength="150">                         
                        </div>

                    </div>
                     
                    <div class="form-group row">
                      <div class="col-12">
                            <label for="address" class="form-label required">Address</label>
                            <textarea name="address" id="address" class="form-control" placeholder="Address" maxlength="450"></textarea>
                        </div>
                       
                    </div>
                  </div>
       
    </div>

<div class="card card-secondary">
<div class="container">
  <div class="row clearfix">
    <div class="col-md-12">
    <br>
      <table class="table table-bordered table-hover" id="tab_logic">
        <thead>
          <tr>
            
            <th class="text-center"> Select </th>
            <th class="text-center"> Product </th>
            <th class="text-center"> Qty </th>
            <th class="text-center"> Price </th>
            <th class="text-center"> Discount </th>
            <th class="text-center"> SGST </th>
            <th class="text-center"> CGST </th>
            <th class="text-center"> IGST </th>
            
            <th class="text-center"> Total </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="checkbox" name="record"></td>
            <td>
             {{-- <select name='product[]' class="form-control product">  --}}
              <input list="browsers" name="product[]" id="product" class="form-control product" autocomplete="off">
              <datalist id="browsers">
              <option value="0" selected="true" disabled="true">Select Product </option>
              @foreach (  $products as $product )
              
              <option data-price="{{$product->price}}" value="{{$product->product_name}}" >{{$product->price}}</option> 
               
             @endforeach
             </datalist>
            </td>
            {{-- <td><input type="text" name='product[]' id="product" placeholder='Product' class="form-control product"/></td> --}}
            <td><input type="number" name='qty[]' id="qty" placeholder='Qty' class="form-control qty" step="0" min="0"/></td>
            <td>
            
           
            <input type="number" name='price[]' id="price" value="" placeholder='Unit Price' class="form-control Price" step="0.00" min="0">
           
            </td>

             <td>         
            <input type="number" name='discount[]' id="discount" value="" placeholder='Discount' class="form-control discount" step="0.00" min="0">
             </td>
            <td>
            
           
            <input type="number" name='tax_sgst[]' id="tax_sgst" value="" placeholder='SGST' class="form-control sgst" step="0.00" min="0">
           
            </td>
            
            <td>
            
           
            <input type="number" name='tax_cgst[]' id="tax_cgst" value="" placeholder='CGST' class="form-control cgst" step="0.00" min="0">
           
            </td>

             <td>
            
           
            <input type="number" name='tax_igst[]' id="tax_igst" value="" placeholder='IGST' class="form-control igst" step="0.00" min="0">
           
            </td>
             
            <td><input type="number" name='total[]' class="form-control total" readonly/></td>
            
          </tr>
         
        </tbody>
      </table>
    </div>
  </div>
  
  <div class="row clearfix">
    <div class="col-md-12">
      <button id="add_row" class="btn btn-default pull-left addrow">Add Row</button>
      <button id="delete_row" type="button" class="btn btn-default pull-right remove">Delete Row</button>
     
    </div>
  </div>
  <div class="row clearfix pull-right" style="margin-top:20px">
    <div class="pull-right col-md-12">
      <table class="table table-bordered table-hover" id="tab_logic_total">
        <tbody>
          <tr>
            <th class="text-center">Sub Total</th>
            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
          </tr>
          <tr>
            <th class="text-center">Freight</th>
            <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                <input type="number" class="form-control" name="Fr_charges" id="Fr_charges" placeholder="Freight">
                <div class="input-group-addon"></div>
              </div></td>
          </tr>
		  <tr>
            <th class="text-center">GST</th>
            <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                <input type="number" class="form-control" name="gst" id="gst" placeholder="">
                <div class="input-group-addon"></div>
              </div></td>
          </tr>
          
          <tr>         
            <th class="text-center">Grand Total</th>
            <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
          </tr>
        </tbody>
      </table>
      
    </div>
      
  </div>
 
</div>
    </div>
    <center>
         <button type="button" class="btn btn-success text-center" id="order_save" name="order_save" value="Submit">Place Order</button>
    </center>
   
 
    <br>  
     </form>
     <div class="modal fade" id="ajaxModel" aria-hidden="true" style="margin-left:30%;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Create Organization</h4>
            </div>
            <div class="modal-body">
                <form id="orgForm" name="orgForm" class="form-horizontal" enctype="multipart/form-data">
                  <div class="form-group row">
                      {{csrf_field()}}
                          <div class="col-6">
                              <label class=>Organization Name</label>
                              <input type="text" class="form-control" name="org_name" id="org_name" placeholder="Organization Name" value="" maxlength="150">
                          </div>
                          <div class="col-6">
                              <label class="form-label required">Contact Person Name</label>
                              <input type="text" class="form-control" name="cp_name" id="cp_name" placeholder="Contact Person Name" maxlength="150">
                          </div>
                      </div>
                      <div class="form-group row">
                        
                          <div class="col-6">
                              <label>Mobile Number</label>
                              <input type="text" class="form-control" name="mob_number" id="mob_number" placeholder="Mobile Number" onkeypress="return Validate(event)" maxlength="15">
                          </div>
                          <div class="col-6">
                              <label>Email Id</label>
                              <input type="text" onblur= "validate_email()" class="form-control" name="cre_email" id="cre_email" placeholder="Email Id">
                          </div>
                      </div>
                       <div class="form-group row">
                      <div class="col-12">
                            <label class="form-label required">Address</label>
                            <textarea name="cre_address" id="cre_address" class="form-control" placeholder="Address" maxlength="450"></textarea>
                        </div>
                       
                    </div>
                  </div>
                    <div class="form-group row">
                      <div class="col-5" ></div>
                      <div class="col-6">
                      <button type="button" name="save" id="saveBtn" class="btn btn-success">save</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
  <script>
  
$('.datepicker').datepicker({
    format: 'yyyy/mm/dd',
   
});


 $('#discount').on('keyup change',function(){
   selectedOption = $('option:selected:true', this);
    $('input[name=price]').val( selectedOption.data('price') );

 });
</script>               

@endsection

@section('javascript')
<script type="text/javascript">

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

//Email validation
    function validate_email()  
{  
var x=  document.getElementById('email_id').value;
var atposition=x.indexOf("@");  
var dotposition=x.lastIndexOf(".");  
if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
  swal("Error", "Please enter valid email", "danger")
  return false;  
  }  
}  

    var i=1;
  
    $('.addrow').on ('click', function(){
      event.preventDefault();
      addrow();
    });
  
    function addrow(){
      b=i-1;
      debugger;
      	$('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
         var addrow ='<tr id="addr0">'+
            '<td><input type="checkbox"  name="record"></td>'+
            '<td>'+            
                    '<input list="browsers" name="product[]" id="product" data-attri_id="" class="form-control product" autocomplete="off">'+
                    '<datalist id="browsers">'+
                    '<option value="0" selected="true" disabled="true">Select Product </option>'+
                    '@foreach ($products as $product )'+
                    
                    '<option data-price="{{$product->price}}" value="{{$product->product_name}} label="{{$product->id}}" data-attri_id="{{$product->id}}" >{{$product->product_name}}</option>' +
                    
                  '@endforeach'+
                  '</datalist>'+
            '</td>'+            
            '<td><input type="number" name="qty[]" placeholder="Enter Qty" class="form-control qty" step="0" min="0"/></td>'+
            
            '<td><input type="number" name="price[]" placeholder="Enter Unit Price" class="form-control Price" step="0.00" min="0"/></td>'+
            '<td>'+
            
           
            '<input type="number" name="discount[]" id="discount" value="" placeholder="Discount" class="form-control discount" step="0.00" min="0">'+
           
            '</td>'+
            '<td>'+
            
           
            '<input type="number" name="tax_sgst[]" id="tax_sgst" value="" placeholder="SGST" class="form-control sgst" step="0.00" min="0">'+
           
            '</td>'+
            '<td>'+
            
           
            '<input type="number" name="tax_igst[]" id="tax_igst" value="" placeholder="IGST" class="form-control igst" step="0.00" min="0">'+
           
            '</td>'+
            '<td>'+
            
           
            '<input type="number" name="tax_cgst[]" id="tax_cgst" value="" placeholder="CGST" class="form-control cgst" step="0.00" min="0">'+
           
            '</td>'+
            '<td><input type="number" name="total[]" placeholder="0.00" class="form-control total" readonly/></td>'+
            '</tr>';
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
  
	

      $('#order_form')[0].reset();
      $('#form_output').html('');
      $('#button_action').val('insert');
      //$('#action').val('Add');



  $('#order_save').on('click', function(event){

        debugger;
        //alert('here');
        event.preventDefault();
        var form_data =document.getElementById('order_form');
        var formdata=new FormData(form_data);
        var test=validate_form();
        
        if(test==true){
          $.ajax({
            url:"{{ route('SaveOrders') }}",
            method:"POST",
            data:formdata,
            cache:false,
            processData: false,
            contentType:false,
            success:function(data)
            {   
                console.log(data);
                
                    swal("Order Placed","", "success")
                    $('#order_form').trigger("reset");
                    setTimeout(function() { window.location.href="{{ url('/list_all_orders') }}";}, 2000); 
                  
            }
        });
        }
        
    });

  $('#saveBtn').click(function(event){

        debugger;
        //alert('here');
        event.preventDefault();
        var form_data =document.getElementById('orgForm');
        var formdata=new FormData(form_data);
        var test=validate_form();
        
        if(test==true){
          $.ajax({
            url:"{{ route('create_org') }}",
            method:"POST",
            data:formdata,
            cache:false,
            processData: false,
            contentType:false,
            success:function(data)
            {   
                console.log(data);
                
                    $('#orgForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                      swal("Organization successfully Created.","","success");
                     document.getElementById('organization_name1').value=data.organization_name;
                     document.getElementById('contact_person_name').value=data.contact_person_name;
                     document.getElementById('mobile_num').value=data.mobile_number;
                     document.getElementById('email_id').value=data.email_id;
                     document.getElementById('address').value=data.address;
                     document.getElementById('hidden_orgid').value=data.id;
                   
            }
        });
        }
        
    });


 function validate_form(){

      var organization_name1 = document.getElementById('organization_name1').value;
    var contact_person_name = document.getElementById('contact_person_name').value;
    var mobile_num = document.getElementById('mobile_num').value;
    
    var warranty_date = document.getElementById('warranty_date').value;
   
    var product = document.getElementById('product').value;
    var qty = document.getElementById('qty').value;
    var discount=document.getElementById("discount").value;
        var tax_sgst=document.getElementById("tax_sgst").value;
        var tax_cgst=document.getElementById("tax_cgst").value;
        var tax_igst=document.getElementById("tax_igst").value;
        var Freight=document.getElementById("Fr_charges").value;
    if(organization_name1==""){
        swal("Select Organization Name","","warning");
        return false;
    }
    else if(contact_person_name==""){
        swal("Enter Contact Person name","","warning");
        return false;
    }
    else if(mobile_num==""){
        swal("Enter Mobile Number","","warning");
        return false;
    }
    
    else if(warranty_date==""){
        swal("Select warranty date","","warning");
        return false;
    }
    else if(address==""){
        swal("Enter Address","","warning");
        return false;
    }
    else if(product ==""){
            swal("Please Select Atleast One Product","Required","warning");
            $("#product").focus();
            return false;
          }
          else if(qty =="" ){
            swal("Please Enter Quantity","Required","warning");
            $("#qty").focus();
            return false;
          }
          else if(discount =="" ){
            swal("Please Enter Discount amount or enter 0","Required","warning");
            $("#discount").focus();
            return false;
          }
          else if(tax_sgst =="" ){
            swal("Please Enter SGST(%) or enter 0","Required","warning");
            $("#sgst").focus();
            return false;
          }
          else if(tax_cgst =="" ){
            swal("Please Enter CGST(%) or enter 0","Required","warning");
            $("#cgst").focus();
            return false;
          }
          else if(tax_igst =="" ){
            swal("Please Enter IGST(%) or enter 0","Required","warning");
            $("#igst").focus();
            return false;
          }
          else if(Freight =="" ){
            swal("Please Enter Freight amount or enter 0","Required","warning");
            $("#Fr_charges").focus();
            return false;
          }
    else{

      return true;
    }
      
    }

 $("#prop_sub").keypress(function(e) {
   
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                });

  $("#prop_city").keypress(function(e) {

   var key = e.keyCode;
   if (key >= 48 && key <= 57) {
       e.preventDefault();
   }
   });

   $("#prop_state").keypress(function(e) {

   var key = e.keyCode;
   if (key >= 48 && key <= 57) {
       e.preventDefault();
   }
   });

   $("#prop_country").keypress(function(e) {

   var key = e.keyCode;
   if (key >= 48 && key <= 57) {
       e.preventDefault();
   }
   });             



  

 function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

 
$('#tab_logic tbody').on('keyup change',function(){
		calc();
	});
  
 

  
$('#Fr_charges, #gst').on('keyup change',function(){
  
  calc_total();
});


  

function calc()
{ 
  
	$('#tab_logic tbody tr').each(function(i, element) {
    
    	var q = $(this).find('.qty').val();
			var p = $(this).find('.Price').val();
			var cgst = $(this).find('.cgst').val();
			var sgst = $(this).find('.sgst').val();
			var igst = $(this).find('.igst').val();
			var d = $(this).find('.discount').val();
			var pro = $(this).find('.product').val();

     
    
    

			
    cgst= parseInt(cgst);
    dis= parseInt(d);

    sgst= parseInt(sgst);
    igst= parseInt(igst);
    var qty = parseInt(q);
    var price = parseInt(p);
		var html = $(this).html();
    
		if(html!='')
		{ 
      var xyz = $('#browsers option').filter(function() {
        return this.value == pro;
   }).data('price');
    $(this).find('.Price').val(xyz);
      var amt = qty*price-dis;
      var tax  = sgst+cgst+igst;
      var tax_ttl = tax/100;
      var ttl = amt*tax_ttl;
      var fin = amt+ttl;

			
			$(this).find('.total').val((fin).toFixed(2));
      
			calc_total();
		}
    });
}

function calc_total()
{
  var total=0;
  var tax = 0;
  let newTotal = 0;
  Fr_charges= parseInt($('#Fr_charges').val() > 0 ? $('#Fr_charges').val() :  '0');
  gst= parseInt($('#gst').val() > 0 ? $('#gst').val() :  '0');
 

	$('.total').each(function() {
        total += parseInt($(this).val() > 0 ? $(this).val() :  '0');
        
    });
    $('#sub_total').val(total);
	total += Fr_charges;
	tax = (Fr_charges / 100) * gst;
	total += tax;
   $('#total_amount').val((total).toFixed(2));
}

 
$(".populate").change(function(){
    var orgid=$("#organization_name option[value='" + $("#organization_name1").val() + "']").attr("label");
     
     $('#hidden_orgid').val(orgid);
     $.get("/orders/edit/" + orgid, function (data){
       console.log(data);
          
         $('#contact_person_name').val(data.contact_person_name);
          $('#mobile_num').val(data.mobile_number);
          $('#email_id').val(data.email_id);
          $('#address').val(data.address);

     })
});





</script>
@endsection
