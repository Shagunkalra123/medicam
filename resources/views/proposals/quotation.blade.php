<!DOCTYPE html>
<html>
<body id="body1">

<?php
//print_r($pdfdata['product'][0]);
//echo pdfdata[

?>

    
<!--<h5 style="text-align:center; color:red;">Hemant's</h5>
<h1 style="text-align:center; color:red;">MEDICAM</h1>-->
<center><img src="http://crm.medicam.in/images/logo.jpg" alt="Medicam" height="90" width="151"></center>

<p style=" margin-left: 0%; align-content:=center; padding-top: 0px; padding-bottom: 0px;" align="center"><b>428, Milan Industrial Estate, Abhyudaya Nagar, Kalachowki, Cotton Green Mumbai-400033<br>Tel.:24700872/ 8767303439 8828340675, E-mail:info@hemantmedicam.com.<b></p>

<hr>
<?php
$real_date=$pdfdata['date'];
list($m, $d, $y) =array_pad(explode('/', $real_date, 3), 3, null);
?>
<p style="text-align:right;"><b>Date:{{$d}}-{{$m}}-{{$y}}</b></p>
<p style="">To<br>{{$pdfdata['to']}}, <br> {{$pdfdata['address']}}, <br>{{$pdfdata['state']}}, {{$pdfdata['city']}}, <br> {{$pdfdata['country']}} - {{$pdfdata['zip']}}. <br></p>

<p><b>Sub:&nbsp;{{$pdfdata['subject']}}</b></p>

<p>Respected Sir,</p>

<p>As per our decision, we are pleased to send you the below quotation, </p>


<style>
    div {
 
  padding-right: 0%;
  width: 100%;
  padding-left: 0%;
}
        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
      
          

        }
        p {
            padding-left: 0px;
            padding-top: 0px;
            padding-bottom: 0px;
        }
        </style>
<div id="table2"> 
<table>

    <tr>
      <th>Sr. No.</th>
      <th>Particulars</th>
      <th>Quantity</th>
      <th>Amount in Rs.</th>
      <th>Discount</th>
       <th>Discounted Amount</th>
      <th>SGST</th>
      <th>CGST</th>
      <th>IGST</th>
      <th>GST Amount</th>
      <th>Total amount in Rs.</th>
    </tr>
  <?php
      $srno=1;
      $true_tax=0;
      $discounted_amt=0;
      $tax_amt=0;
      $dental_dlx_val=0;
  ?>
    @foreach ($pdfdata['product']  as $key=>$value )
    <tr>
        @if($value=="DENTACAM DLX PLUS CAMERA")
           $dental_dlx_val++; 
        @endif
        
        <td align="center">&nbsp;{{$srno}}</td>         
        <td>&nbsp;{{$value}}  </td>
        <td align="center">&nbsp;{{$pdfdata['qty'][$key]}} </td>
        <td align="center">&nbsp;{{$pdfdata['price'][$key]}} </td>
        <td align="center">&nbsp;{{$pdfdata['discount'][$key]}} </td>

    <?php 
        $qty = $pdfdata['qty'][$key];
        $price = $pdfdata['price'][$key];
        $discount= $pdfdata['discount'][$key];
    $discounted_amt=($qty*$price)-$discount; 

    ?>

        <td align="center">&nbsp;<b>{{$discounted_amt}}</b> </td>
    <?php 
        $igst = $pdfdata['igst'][$key];
        $cgst = $pdfdata['cgst'][$key];
        $sgst= $pdfdata['sgst'][$key];
    $true_tax=$sgst+$igst+$cgst; 

    ?>
    <td align="center">&nbsp;{{$sgst}}% </td>
    <td align="center">&nbsp;{{$cgst}}% </td>
        <td align="center">&nbsp;{{$igst}}% </td>
    <?php 
    $tax_amt=$discounted_amt*($true_tax/100); 

    list($first, $last) =array_pad(explode('.', $tax_amt, 2), 2, null);
   
    $roundoff=(int)$last;

    if($roundoff>50)
    {
        $tax_amt=$first+1;

    }else{
          $tax_amt=$first;

    }
    $wopoint=$pdfdata['total'][$key];
    $wopoint=explode(".", $wopoint);
    $wopoint=$wopoint[0];
    ?>
        <td align="center">&nbsp;<b>{{$tax_amt}}</b> </td>
      
        <td align="center">&nbsp;<b>{{$wopoint}}</b> </td>
       
        
        
     

      </tr>
      <?php $srno++;?>
       @endforeach

     <tr>
      
        <td colspan="10" align="right"><b>Freight Amount</b></td>
        
       
        <td align="center">&nbsp;<b>{{$pdfdata['Fr_charges']}}</b></td>
      

      </tr>

      <tr>
      
        <td colspan="10" align="right"><b>Total Amount</b></td>
       
       
        <td align="center">&nbsp;<b>{{$pdfdata['grand_total']}}</b></td>
      

      </tr>

</table>   
</div> 
 
<?php
$if_denta="<p>* Warranty- 2 years against any manufacturing defects, for other products 1 year warranty.<br> ";
$general_condition="<p>* Warranty- 1 years against any manufacturing defects.<br>";
?>
@foreach ($pdfdata['product']  as $key=>$value )

@if(trim($value)==trim("DENTACAM DLX PLUS CAMERA"))
{!!$if_denta!!}

@else
{!!$general_condition!!}
@endif
@endforeach

* Payment- 100% advance with Purchase Order.<br>
* Delivery within 3-4 days from the date of receipt of purchase order</p>
<p>Awaiting your valued order at the earliest
<br>Thanking you,</p>
<!--<div style="padding-left: 600px;">-->
<p>Yours truely,
  <br>For <b>Medicam</b>,</p>

<img src="{{asset('/images/quostampsign_.jpg')}}" alt="Medicam" height="70" width="150">

<p><b>Hemant Palande</b><br><b>Proprietor</b></p>
<!--</div>-->
</body>
</html>