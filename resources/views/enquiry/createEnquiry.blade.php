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

body {
  font-family: 'Lato', sans-serif;
}

.overlay {
  height: 100%;
  width: 100%;
  display: none;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0, 0.9);
}

.overlay-content {
  position: relative;
  top: 25%;
  width: 100%;
  text-align: center;
  margin-top: 30px;
}

.overlay a {
  padding: 8px;
  text-decoration: none;
  font-size: 36px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.overlay a:hover, .overlay a:focus {
  color: #f1f1f1;
}

.overlay .closebtn {
  position: absolute;
  top: 20px;
  right: 45px;
  font-size: 60px;
}

@media screen and (max-height: 450px) {
  .overlay a {font-size: 20px}
  .overlay .closebtn {
  font-size: 40px;
  top: 15px;
  right: 35px;
  }
  .containeryz{
    width: 100px;
  }
}

.card-title1 {
    font-size: 14px;
}
.card-body {
    padding: 1px;
}
.card-header {
    padding: 5px;
}
.card-footer {
    padding: 5px;
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
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<form role="form" id="enquiry_form">
<div class="card card-secondary" id="container_div">
              <div class="card-header" id="headername" >
                <h3 class="card-title">Add Enquiry 
                &nbsp;&nbsp;&nbsp;&nbsp;
                
                </h3> 

              </div><br>
              <!-- /.card-header -->
      
              <div class="card-body">
          
                  <!-- text input -->
                  
                 
                    <div class="form-group row">
                         <div class="col-2">
                            <label class="form-label required">Organization Name</label>
                          </div>
                        <div class="col-sm-4">
                           <input list="organization_name"  name="organization_name1" id="organization_name1" class="form-control populate" placeholder="Organization Name" maxlength="180"> 

                            <datalist id="organization_name" >
                           @foreach ($Select_Contact_personID as $organisation)
                            <option value="{{$organisation->organization_name}}" label="{{$organisation->id ?? ''}}">{{$organisation->id ?? ''}}</option>
                             @endforeach
                            </datalist>
                            <input type="text" id="hidden_orgid" name="hidden_orgid" value=""  hidden/>
                        
                        
                    </div>
                      <div class="col-sm-2">
                            <label class="form-label required">Contact Person</label>
                        </div>
                        <div class="col-sm-4">
                          
                        <input list="Select_Contact_person" name="Select_Contact_person" id="Select_Contact_personID" placeholder="Contact Person" class="form-control" value="">
                        <datalist id="Select_Contact_person" >
                             
                              @foreach($Select_Contact_personID as $client)
                             <option data-og_name="{{$client->organization_name}}" data-og_id="{{$client->id ?? ''}}"  value="{{$client->contact_person_name}}"></option>
                               @endforeach                                
                        </datalist>
                        </div> 
                       
                    </div>
                    
                    <div class="form-group row">
                         <div class="col-2">
                            <label class="form-label">Mobile</label>
                          </div>
                        <div class="col-sm-4">
                           <input list="mobile"  name="mobile1" id="mobile1" class="form-control" placeholder="Mobile Number" maxlength="180"> 

                            <datalist id="mobile" >
                           @foreach ($Select_Contact_personID as $organisation)
                            <option value="{{$organisation->mobile_number}}" label="{{$organisation->id ?? ''}}">{{$organisation->id ?? ''}}</option>
                             @endforeach
                            </datalist>
                            <input type="text" id="hidden_orgid" name="hidden_orgid" value=""  hidden/>
                        
                        
                    </div>
                      <div class="col-sm-2">
                            <label class="form-label ">Email</label>
                        </div>
                        <div class="col-sm-4">
                        <input list="email" name="email" id="emailid" placeholder="Email ID" class="form-control" value="">
                        <datalist id="email" >
                             
                              @foreach($Select_Contact_personID as $client)
                             <option data-og_name="{{$client->primary_email}}" data-og_id="{{$client->id ?? ''}}"  value="{{$client->primary_email}}"></option>
                               @endforeach                                
                        </datalist>
                        </div> 
                       
                    </div>
                    
                    
                    <div class="form-group row">
                      <div class="col-sm-2">

                            <label class="form-label required">Data Source</label>
                        </div>
                        
                            <div class="col-sm-4">                    
                            <input list="EnquiryDataSource_Name" name="EnquiryDataSource_Name" id="EnquiryDataSource_NameID" placeholder="Data Source" class="form-control">
                                  <datalist id="EnquiryDataSource_Name">
                                  @foreach($enquiry_data_sources as $enquirydatasource)
                                      <option  value="{{$enquirydatasource->EnquiryDataSource_Name}}"></option>
                                  @endforeach                                 
                                  </datalist>
                        </div>
                        <div class="col-sm-2">
                            <label class="form-label">Referred By</label>
                        </div>
                        <div class="col-sm-4">
                        <input list="ReferredBy_Name" name="ReferredBy_Name" id="ReferredBy_NameID" placeholder="Referred By" class="form-control">
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
                            <input list="EnquiryType_Name" name="EnquiryType_Name" id="EnquiryType_NameID" placeholder="Enquiry Type" class="form-control ">
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
                               <input type="text" id="Expected_closed_Date" name="Expected_closed_Date" placeholder="Expected closed Date" class="form-control" >
                                <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                                </div>
                             </div>  
                          </div>
                        </div>                                                     
                        @if($id==0)
                        <div class="form-group row" id="hide"> 
                          <div class="col-sm-6" >
                              <label>Comment</label>
                              <textarea class="form-control" rows="5" id="Description_Note" name="Description_Note" maxlength="500"></textarea>
                          </div>
                          <div class="col-sm-2">
                              <label>Nature</label>
                              <input list="browser"  name="nature_comment" id="nature_comment" placeholder='Select' class="form-control">
                                <datalist id="browser"  name="nature_comment">
                                    <option value="Cold" style="background-color: Blue;color: #FFFFFF;">Cold</option>
                               <option value="Warm" style="background-color: Orange;color: #FFFFFF;">Warm</option>        
                              <option value="Hot" style="background-color: Red; color: #FFFFFF;">Hot</option>
                              <option value="Not Interested" style="background-color: black; color: #FFFFFF;">Not Interested</option>
                              <option value="Mature" style="background-color:DarkGreen; color: #FFFFFF;">Mature</option> 

                                </datalist>      
                        

                            </div>
                        </div>
                        @endif
                          

                    <br>

                    
               
                  
                       
       

                 

                  
      
                    <!-- dynaamic row -->
         
            <br>
                   
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
                                 <td></td>
                                  <td><input type="checkbox" name="record"></td>
                                  <td>
                                  <input list="products"  onchange="" name="product[]" id="productID" placeholder='Select'  class="form-control product">
                                  <datalist id="products" name="product[]">
                                  @foreach($productID as $product)
                                      <option data-price="{{$product->price}}" value="{{$product->product_name}}">{{$product->price}}</option>
                                  @endforeach
                                  </datalist>
                                  </td>
                                  <td><input type="number" id="Unit" name='Unit[]' placeholder='Unit' class="form-control Unit" onkeyuo="return Validate()"  min="1"/></td>
                                  <td><input type="number" id="price" name='price[]' placeholder='Price' class="form-control Price" onkeyuo="return Validate()"  min="1"/></td>
                                  <td>
                                  <input list="Assign_To" name="Assign_to[]" id="Assign_toID"  placeholder='Assign To' class="form-control " onKeyPress="return ValidateAlpha(event);">
                                  <datalist id="Assign_To" name="Assign_to[]">
                                  @foreach($Assign_toID as $employee)
                                      <option value="{{$employee->first_name}}&nbsp;{{$employee->last_name}}">
                                  @endforeach
                                  </datalist>
                                  </td>
                                  <td><input type="number" name='Requested_Quantity[]' placeholder='Quantity' class="form-control Requested_Quantity" id="Requested_Quantity" onkeyuo="return Validate()" min="1"/></td>
                                  <td>
                                  <input type="text" name="Co_ordinated_with[]" id="Co_ordinated_withID"  placeholder='Co-ordinated with' class="form-control Co_ordinated_withID" onKeyPress="return ValidateAlpha(event);">
                                 
                                  </td> 
                                  <td>
                                    <input list="browser"  name="nature[]" id="nature" placeholder='Select' class="form-control">
                                        <datalist id="browser"  name="nature[]">
                                           <option value="Cold" style="background-color: Blue;color: #FFFFFF;">Cold</option>
                               <option value="Warm" style="background-color: Orange;color: #FFFFFF;">Warm</option>        
                              <option value="Hot" style="background-color: Red; color: #FFFFFF;">Hot</option>
                              <option value="Not Interested" style="background-color: black; color: #FFFFFF;">Not Interested</option>
                              <option value="Mature" style="background-color:DarkGreen; color: #FFFFFF;">Mature</option> 
                              
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
                     
                      <div class="col-5">
                      </div>
                      <div class="col-6">
                      <input type="submit" name="Update" value="Update"  id="updateBtn" class="btn btn-success" />
                      
                      @if($id!=0)
                      <button title="Make Qoutation!" class="btn btn-warning " id="proposal_uni" name="proposal" ><i class="fas fa-people-carry"></i>Create Quotation</button>
                      @endif
                 
                   </div>

                </form>
              </div><hr>
            
              <!-- /.card-body -->

               @if($id!=0)
         
          <form role="form" id="form_comment" onsubmit="return false">
            <div class="form-group row">
                <div class="col-sm-4">
                  <label>Comment</label>
                  <textarea class="form-control" rows="6" id="comment" name="comment" maxlength="190"></textarea>
                  <br>
                  <button type="button" name="comment_btn" id="comment_btn" class="btn btn-success" value="">Submit</button>
                  <button title="Follow up Enquiry!" data-toggle="modal" data-target="#follow_up_modal" data-enq_id_follow_up="{{$id}}"  class="btn btn-info followenquiry" name="FollowUp" data-nature1="" data-follow_up_id=""><i class="fas fa-phone-square"></i></button>


               </div>
              <div class="col-sm-2">
                <label>Nature</label>
                  <input list="comment_modal"  name="browser_modal" id="browser_modal" placeholder='Select' class="form-control">
                    <datalist id="comment_modal"  name="browser_modal">
                        <option value="Cold" style="background-color: Blue;">Cold</option>
                        <option value="Warm" style="background-color: DarkGreen;color: #FFFFFF;">Warm</option>        
                        <option value="Hot" style="background-color: Red;">Hot</option>
                        <option value="Not Interested" style="background-color: White;">Not Interested</option>
                        <option value="Mature" style="background-color:#FFD933;">Mature</option>
          
                    </datalist> 
                  
                  
              </div>
              <?php
                            //print_r($data);
                           // echo $user['email'] ?>
                <div class="col-sm-6">
                   @if($id!=0)
                    
                      <input type="text" name="enq_id" id="enq_id" hidden>    
                       <div id="show">
                        <div class="show">
                            
                          @foreach ($data as $row )
                          @foreach ($user as $u )
                          @if($row->useremail == $u->email )
                          
                         
                            @if($row->nature=="Cold")
                            <div class="containeryz">
                              <div class="card " style="max-width: 95%;">
                                <div class="card-header text-white bg-primary mb-3">{{$row->username}}</div>
                                  <div class="card-body">
                                    <h5 class="card-title">
                                      {{$row->comments}}
                                    </h5>
                                  </div>
                                  <div class="card-footer">
                                  {{$row->created_at}}
                            </div>

                           
                            </div>
                            @endif 
                            @if($row->nature=="Hot")
                            <div class="containeryz">
                              <div class="card " style="max-width: 95%;">
                                <div class="card-header text-white bg-danger mb-3">{{$row->username}}</div>
                                  <div class="card-body">
                                    <h5 class="card-title">
                                      {{$row->comments}}
                                    </h5>
                                  </div>
                            <div class="card-footer">
                                  {{$row->created_at}}
                            </div>

                            </div>
                            @endif 
                            @if($row->nature=="Mature")
                            <div class="containeryz">
                              <div class="card " style="max-width: 95%;">
                                <div class="card-header text-white bg-success mb-3">{{$row->username}}</div>
                                  <div class="card-body">
                                    <h5 class="card-title">
                                      {{$row->comments}}
                                    </h5>
                                  </div>
                                  <div class="card-footer">
                                  {{$row->created_at}}
                            </div>

                           
                            </div>
                            @endif 
                            @if($row->nature=="Not Interested")
                            <div class="containeryz">
                              <div class="card " style="max-width: 95%;">
                                <div class="card-header text-white bg-dark mb-3">{{$row->username}}</div>
                                  <div class="card-body">
                                    <h5 class="card-title">
                                      {{$row->comments}}
                                    </h5>
                                  </div>
                                  <div class="card-footer">
                                  {{$row->created_at}}
                            </div>

                           
                            </div>
                            @endif 
                            @if($row->nature=="Warm")
                            <div class="containeryz">
                              <div class="card " style="max-width:95%;">
                                <div class="card-header text-white bg-warning mb-3">{{$row->username}}</div>
                                  <div class="card-body">
                                    <h5 class="card-title">
                                      {{$row->comments}}
                                    </h5>
                                  </div>
                                  <div class="card-footer">
                                  {{$row->created_at}}
                            </div>

                           
                            </div>
                            @endif
                            
                         
                      
                            @endif
                          @endforeach
                          @endforeach
                        </div>
                      </div>
                    
                                 
                  @endif               
              </div>    
            </div>
                <div class="form-group row">
                      <div class="col-sm-6">
                      </div>
                </div>
             </form> 
             </div>
             @endif  
         
          </div>    
 </div>
                    </div>
                    </div>
                    </div>
                    </div>

                    <!--modal for follow up-->
<div class="modal fade" id="follow_up_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
             <form id="Follow_up_form"> 
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                <div>
                    <label><h3>Set Follow Up</h3></label>     
                 </div>
                  <div >
                  <div class="form-group row">
                  <div class="col-6">
                              <label>Date</label>
                              <input type="Date" class="form-control" name="rem_date" id="rem_date" placeholder="Product Name" maxlength="100">
                          </div>
                            <div class="col-6">
                              <label>Time</label>
                              <input type="Time" class="form-control" name="rem_time" id="rem_time" placeholder="Product Name" maxlength="100">
                          </div>
                            <div class="col-12">
                              <label>Note</label>
                              <input type="text" class="form-control" name="note" id="note" placeholder="Description" maxlength="100">
                          </div>
                           <div class="col-12">
                           <label>Nature</label>
                    <select class="form-control" name="nature_followup" id="nature_followup">
                              <option value="Cold" style="background-color: Blue;color: #FFFFFF;">Cold</option>
                               <option value="Warm" style="background-color: Orange;color: #FFFFFF;">Warm</option>        
                              <option value="Hot" style="background-color: Red; color: #FFFFFF;">Hot</option>
                              <option value="Not Interested" style="background-color: black; color: #FFFFFF;">Not Interested</option>
                              <option value="Mature" style="background-color:DarkGreen; color: #FFFFFF;">Mature</option>     
                    </select>   
                    </div>            
                </div> 
  </div>
                 <input type="text" id="enq_id_follow" name="enq_id_follow"/>
                 <input type="text" id="organization_name1z" name="organization_name1z"/>
                 <input type="text" id="Contact_Persone_Namez" name="Contact_Persone_Namez"/>
                 <input type="text" id="hidden_orgidz"  name="hidden_orgidz"/>
                 <input type="text" id="mobilez" name="mobilez"/>
                 <input type="text" id="hidden_product" name="hidden_product"/>
                 



                </div>
                <div class="modal-footer" style="align:center;">
                    <button type="button" id="follow_setter" class="btn btn-primary">Save changes</button>
                </div>
             </form>
            </div>
        </div>
    </div>
</div>
                    

                   

                   
  


@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
var arra_prices=[];

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


     $('#comment_btn').on ('click', function (event) {
       debugger;
   event.preventDefault();
  
  //alert(c);
   var comment_data= document.getElementById('form_comment');
        var form_Data = new FormData(comment_data);
        //console.log(form_Data);
           $.ajax({
          data: form_Data,
          url: "/getcomment",
          type: "POST",
          dataType: 'json',
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
            $('#comment').val('');
            $('input[name=browser_modal').val('');
             
             
             
             console.log(data);
             app_row(data);
            //$('#out').append(data); 
            
         }
      });
   
 });



});

function app_row(data)
{
  var nat = data.data.nature;
  //alert(nat);
  if(nat=="Cold")
  {
  var tr='<div class="containeryz">'+
  '<div class="card " style="max-width: 95%;">'+
  '<div class="card-header text-white bg-primary mb-3">'+data.data.username+'</div>'+
  '<div class="card-body">'+
  '<h5 class="card-title">'+
    data.data.comments+
   '</h5>'+
  '</div>'+

  '<div class="card-footer">'+
    data.date+
  '</div>'+
  '</div>'+
'</div>'

  }
else if(nat=="Hot")
{
  var tr='<div class="containeryz">'+
  '<div class="card " style="max-width: 95%;">'+
  '<div class="card-header text-white bg-danger mb-3">'+data.data.username+'</div>'+
  '<div class="card-body">'+
  '<h5 class="card-title">'+
   data.data.comments+
   '</h5>'+
  '</div>'+

'<div class="card-footer">'+
    data.date+
  '</div>'+
  '</div>'+
'</div>'
}
else if(nat=="Mature")
{
  var tr='<div class="containeryz">'+
  '<div class="card " style="max-width: 95%;">'+
  '<div class="card-header text-white bg-success mb-3">'+data.data.username+'</div>'+
  '<div class="card-body">'+
  '<h5 class="card-title">'+
   data.data.comments+
   '</h5>'+
  '</div>'+
'<div class="card-footer">'+
    data.date+
  '</div>'+
  '</div>'+
'</div>'}
else if(nat=="Not Interested")
{
  var tr='<div class="containeryz">'+
  '<div class="card " style="max-width:  95%;">'+
  '<div class="card-header text-white bg-dark mb-3">'+data.data.username+'</div>'+
  '<div class="card-body">'+
  '<h5 class="card-title">'+
   data.data.comments+
   '</h5>'+
  '</div>'+
'<div class="card-footer">'+
    data.date+
  '</div>'+
  '</div>'+
'</div>'}
else if(nat=="Warm")
{
  var tr='<div class="containeryz">'+
  '<div class="card " style="max-width:  95%;">'+
  '<div class="card-header text-white bg-warning mb-3">'+data.data.username+'</div>'+
  '<div class="card-body">'+
  '<h5 class="card-title">'+
   data.data.comments+
   '</h5>'+
  '</div>'+
'<div class="card-footer">'+
    data.date+
  '</div>'+
  '</div>'+
'</div>'}
else{
  swal("Please select nature","","warning");
}


 $('#show').find('.show').prepend(tr);
 
 
}
  
  $('button.followenquiry').click(function()
        { 
debugger;
  
  var v =$(this).attr("data-enq_id_follow_up");
  //alert(v);
  document.getElementById('enq_id_follow').value = v;
 
  
  
  
});

$('#proposal_uni').click(function()
        { 
          event.preventDefault();
         debugger;
        
         var x = $('#enq_id').val();
         
          var EnqId = x;

        console.log(EnqId);
       
      window.location.href="/proposals/index/"+EnqId;
        });

$(".populate").change(function(){
   debugger;
    var orgid=$("#organization_name option[value='" + $("#organization_name1").val() + "']").attr("label");
     
     $('#hidden_orgid').val(orgid);
     $.get("/proposals/edit/" + orgid, function (data){
       console.log(data);
          
        
          $('#Select_Contact_personID').val(data.contact_person_name);
           $('#mobile1').val(data.mobile_number);
          $('#emailid').val(data.primary_email);
         
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
  $("#add_comment").hide();
  
  
  
}else{
  $("#updateBtn").show();  
  $("#add_comment").show(); 
  $("#saveBtn").hide();
  
  

  debugger;

    var enq = {{$id}};
  
   $.get("/createEnquiry/edit/"+ enq, function (data,data2) {
      debugger;
       console.log(data.enquiry_products.length);
        console.log(data2);
   debugger;
    document.getElementById('Select_Contact_personID').value = data.enquiries.Select_Contact_person;
    document.getElementById('mobile1').value = data.enquiries.mobile_number;
    document.getElementById('emailid').value = data.enquiries.primary_email;
    document.getElementById('organization_name1').value = data.enquiries.organization_name;
    document.getElementById('Expected_closed_Date').value = data.enquiries.Expected_closed_Date;
    document.getElementById('EnquiryDataSource_NameID').value = data.enquiries.EnquiryDataSource_Name;
    document.getElementById('organization_name').value = data.enquiries.organization_name;
    document.getElementById('ReferredBy_NameID').value = data.enquiries.ReferredBy_Name;
    document.getElementById('EnquiryType_NameID').value = data.enquiries.EnquiryType_Name;
    document.getElementById('nature').value = data.enquiries.nature;
    //this is for hidden field folllowup
    document.getElementById('organization_name1z').value = data.enquiries.organization_name;
    document.getElementById('Contact_Persone_Namez').value = data.enquiries.Select_Contact_person;
    document.getElementById('hidden_orgidz').value = data.enquiries.organisation_id;
    document.getElementById('mobilez').value = data.enquiries.organisation_id;
    document.getElementById('hidden_product').value = data.enquiry_products[0].Product;

 
                 
                 
    document.getElementById('productID').value = data.enquiry_products[0].Product;
    document.getElementById('Unit').value = data.enquiry_products[0].Unit;
    document.getElementById('Assign_toID').value = data.enquiry_products[0].Assign_To;
    document.getElementById('price').value = data.enquiry_products[0].Price;
    document.getElementById('Requested_Quantity').value = data.enquiry_products[0].Requested_Quantity;
    document.getElementById('Co_ordinated_withID').value = data.enquiry_products[0].Co_ordinated_with;
    document.getElementById('nature').value = data.enquiry_products[0].nature;
    document.getElementById('enq_id').value = enq;

 for (j = 1; j < data.enquiry_products.length; j++) { 
        
  var addrow ='<tr id="addr0">'+
  '<td></td>'+
        '<td><input type="checkbox" name="record"></td>'+
        '<td>'+
        '<input list="products"  value="'+data.enquiry_products[j].Product+'" onchange="" name="product[]" id="productID" class="form-control product">'+
        '<datalist id="products" name="product[]">'+
        '@foreach($productID as $product)'+
        '<option data-price="{{$product->price}}" value="{{$product->product_name}}">{{$product->price}}</option>'+
        '@endforeach'+
        '</datalist>'+
        '</td>'+
        '<td><input type="number" value="'+data.enquiry_products[j].Unit+'" id="Unit" name="Unit[]" placeholder="Enter Unit" class="form-control Unit" onkeyuo="return Validate()"  min="1"/></td>'+
        '<td><input type="number" id="price" name="price[]" value="'+data.enquiry_products[j].Price+'"  placeholder="Enter Price" class="form-control Price" onkeyuo="return Validate()"  min="1"/></td>'+
        '<td>'+
        '<input list="Assign_To" name="Assign_to[]" id="Assign_toID" value="'+data.enquiry_products[j].Assign_To+'" class="form-control" onKeyPress="return ValidateAlpha(event);">'+
        '<datalist id="Assign_To" name="Assign_to[]">'+
       ' @foreach($Assign_toID as $employee)'+
      '<option value="{{$employee->first_name}}&nbsp;{{$employee->last_name}}">'+
       '@endforeach'+
        '</datalist>'+
        '</td>'+
       '<td><input type="number" name="Requested_Quantity[]" value="'+data.enquiry_products[j].Requested_Quantity+'" placeholder="Quantity" class="form-control total" id="Requested_Quantity" onkeyuo="return Validate()" min="1"/></td>'+
        '<td>'+
        '<input type="text" name="Co_ordinated_with[]" value="'+data.enquiry_products[j].Co_ordinated_with+'" id="Co_ordinated_withID" class="form-control " onKeyPress="return ValidateAlpha(event);">'+
        
        '</td>'+
        '<td><input list="browser" value="'+data.enquiry_products[0].nature+'" name="nature[]" id="nature" class="form-control">'+
        '<datalist id="browser"  name="nature[]">'+
        '<option value="Cold" style="background-color: Blue; color: #FFFFFF;">Cold</option>'+
        '<option value="Warm" style="background-color: DarkGreen; color: #FFFFFF;">Warm</option>'+
        '<option value="Hot" style="background-color: Red; color: #FFFFFF;">Hot</option>'+
        '<option value="Not Interested" style="background-color: White; color: #FFFFFF;">Not Interested</option>'+
        '<option value="Mature" style="background-color:#FFD933; color: #FFFFFF;">Mature</option> </datalist>'+
        
        '</td> '+
        '</tr>';
        
  $('#tab_logic').find('tbody').append(addrow);
  
}
 
    });
}

$('#tab_logic tbody').on('keyup change',function(){
		calc();
	});

  function calc(){
    debugger;
    $('#tab_logic tbody tr').each(function(i, element) {
    
   var pro= $(this).find('.product').val();
    
    var xyz = $('#products option').filter(function() {
        return this.value == pro;
   }).data('price');
    $(this).find('.Price').val(xyz);
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
          '<td>'+
          '<input list="products" onchange="" name="product[]" id="productID" placeholder="Select" class="form-control product">'+
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
        '<option value="Cold" style="background-color: Blue;color: #FFFFFF;">Cold</option>'+
        '<option value="Warm" style="background-color: Orange;color: #FFFFFF;">Warm</option>'+
        '<option value="Hot" style="background-color: Red; color: #FFFFFF;">Hot</option>'+
        '<option value="Not Interested" style="background-color: black; color: #FFFFFF;">Not Interested</option>'+
        '<option value="Mature" style="background-color:DarkGreen; color: #FFFFFF;">Mature</option>'+
        
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
            swal("Enquiry updated successfully","","success")
               $('#enquiry_form').trigger("reset");
            debugger;
               setTimeout(function(){ window.location.href="{{ url('/List_all_enquiry') }}";}, 2000); 
            }
        });
        });

      $( "#follow_setter" ).click(function( event ) { 
             
               event.preventDefault();     
        $.ajax({
          data: $('#Follow_up_form').serialize(),
          url: "{{ route('update_follow') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            console.log(data);
            
            swal("Follow Up created Successfully","","success");
            setTimeout(function() { location.reload(); }, 2000);
             
         
         
          },
      });


});



    function Validate()
        {
          var e=document.getElementById('Unit').value;
          if(e=='' || e>0)
            {
              swal('Invalid Number, Please enter the number again',"","warning");
              return false;
            }
        }



function validateForm() {
        var Select_Contact_person = document.getElementById('Select_Contact_personID').value;
        var Expected_closed_Date = document.getElementById('Expected_closed_Date').value;
        var EnquiryDataSource_Name = document.getElementById('EnquiryDataSource_NameID').value;
        var organization_name = document.getElementById('organization_name1').value;
        var ReferredBy_Name = document.getElementById('ReferredBy_NameID').value;
        var EnquiryType_Name = document.getElementById('EnquiryType_NameID').value;
        var nature = document.getElementById('nature').nature;
        // var Description_Note = document.getElementById('Description_Note').value;
        var productID = document.getElementById("productID").value;
        var Unit = document.getElementById("Unit").value;
        var Assign_toID = document.getElementById("Assign_toID").value;
        var Requested_Quantity = document.getElementById("Requested_Quantity").value;
        var Co_ordinated_withID = document.getElementById("Co_ordinated_withID").value;
        
        if (Select_Contact_person =="" ) {
            swal("Enter Contact person","","warning");
            document.getElementById("Select_Contact_personID").focus();
            return false;
          }
          else if(organization_name ==""){
            swal("Enter Organization Name","","warning");
           document.getElementById("organization_name1").focus();
            return false;
          }
            else if(EnquiryDataSource_Name ==""){
            swal("Enter Data Source","","warning");
            document.getElementById("EnquiryDataSource_Name").focus();
            return false;
          }
          else if(ReferredBy_Name ==""){
            swal("Enter Referred By","","warning");
            document.getElementById("ReferredBy_Name").focus();
            return false;
          }
           else if(EnquiryType_Name ==""){
            swal("Select Enquiry Type","","warning");
            document.getElementById("EnquiryType_Name").focus();
            return false;
          }
          else if(nature ==""){
            swal("Select Nature","","warning");
            document.getElementById("nature").focus();
            return false;
          }
          else if(productID ==""){
            swal("Select Product Name","","warning");
            document.getElementById("productID").focus();
            return false;
          }
          else if(Unit ==""){
            swal("Enter Unit","","warning");
            document.getElementById("Unit").focus();
            return false;
          }
          else if(Assign_toID ==""){
            swal("Enter Assign To","","warning");
            document.getElementById("Assign_toID").focus();
            return false;
          }
          else if(Requested_Quantity ==""){
            swal("Enter Requested Quantity","","warning");
           document.getElementById("Requested_Quantity").focus();
            return false;
          }
          else if(Co_ordinated_withID ==""){
            swal("Enter Co-Ordinated With","","warning");
            document.getElementById("Co_ordinated_withID").focus();
            return false;
          }
          else{
          swal("Enquiry added successfully","","success");
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


//function onInput(context)
//{
//  var elem=context;
// var val = elem.value;
//var xyz = $('#products option').filter(function() {
//        return this.value == val;
//    }).data('price');
//    alert(xyz);
//}




</script>

@endsection