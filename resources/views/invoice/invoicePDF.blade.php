<html>
<head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<style type="text/css">
span.cls_002{font-family:Cambria,;font-size:11px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_002{font-family:Cambria;font-size:6.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_003{font-family:Cambria;font-size:24px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_003{font-family: Cambria;font-size:19.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_004{font-family:Cambria;font-size:10.0px;color:rgb(0,0,0);font-weight:normal;font-style:italic;text-decoration: none}
span.cls_005{font-family:Cambria;font-size:10.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_005{font-family: Cambria;font-size:6.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_006{font-family:Cambria;font-size:9.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_006{font-family: Cambria;font-size:9.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_007{font-family:Cambria;font-size:5.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_007{font-family: Cambria;font-size:5.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_010{font-family:Cambria;font-size:5.0px;color:rgb(0,0,0);font-weight:bold;font-style:italic;text-decoration: none}
div.cls_010{font-family: Cambria;font-size:5.0px;color:rgb(0,0,0);font-weight:bold;font-style:italic;text-decoration: none}
span.cls_008{font-family:Cambria;font-size:5.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_008{font-family: Cambria;font-size:5.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_009{font-family:Cambria;font-size:8.1px;color:rgb(0,0,0);font-weight:bold;font-style:italic;text-decoration: none}
div.cls_009{font-family: Cambria;font-size:8.1px;color:rgb(0,0,0);font-weight:bold;font-style:italic;text-decoration: none}
table.cls_010{font-family:Cambria;font-size: 11px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none;text-align: center;}
th,td{
    border: solid 1px black;
    padding-left:2px;
}
</style>
<script type="text/javascript" src="wz_jsgraphics.js"></script>
</head>
<body>
    <?php $inv_true_date=explode(" ",$pdfdata->created_at);
            $format_changer=$inv_true_date[0];
               $format_changer= explode("-",$format_changer);
               $year_splitter=$format_changer[0];
               $format_changer=$format_changer[2]."-".$format_changer[1]."-".$format_changer[0];
                $number_true=1;

               //year changer
                $year_splitter=substr($year_splitter,2);
                $year_splitter = (int)$year_splitter;
                $year_splitter_incr = (int)$year_splitter+1;
                //$curr_year=$year_splitter."-".$year_splitter;
              $inv_id=(int)$inv_id+1;
    ?>
<div  style="position:absolute;left:50%;margin-left:-380px;top:0px;width:760px;height:100%;border-style:outset;border:solid;overflow:hidden">
<div style="position:absolute;left:560.44px;top:10px" class="cls_002"><span class="cls_002" style="font-weight:bolder">ORIGIONAL FOR RECEIPEINT</span></div>
<div style="position:absolute;left:560.88px;top:30px" class="cls_002"><span class="cls_002">INVOICE No:
{{"MC/".$year_splitter."-".$year_splitter_incr."/".$inv_id}}</span></div>
<div style="position:absolute;left:55px;top:33px" class="cls_003"><span class="cls_003">MEDICAM</span></div>
<div style="position:absolute;left:560.88px;top:44px" class="cls_004"><span class="cls_002" style="right:-30px">DATE OF ISSUE: {{$format_changer}}</span></div>
<!--<div style="position:absolute;left:490;top:44px" class="cls_002"><span class="cls_002"><?php echo date("d/m/Y"); ?></span></div>-->
<div style="position:absolute;left:560.24px;top:60px" class="cls_002"><span class="cls_002">P.0 No:
@foreach($org_true as $single_org)
 
        @if($pdfdata->org_id == $single_org->id)
 {{$pdfdata->pono}}
        @endif
 
 @endforeach
</span></div>
<div style="position:absolute;left:560.64px;top:75px" class="cls_002"><span class="cls_002">GSTIN : 27AAEPP6429Q1ZY</span></div>
<div style="position:absolute;left:05px;top:80px" class="cls_002"><span class="cls_002">SH.N0.20, BHIWANDIWALA BLDG; DR.B.AMBEDKAR ROAD, KALACHOWKI, MUMBAI - 400033.</span></div>
<div style="position:absolute;left:560.88px;top:90px" class="cls_002"><span class="cls_002">STATE :Maharashtra</span></div>
<div style="position:absolute;left:05px;top:93px" class="cls_002"><span class="cls_002">MAHARASHTRA, INDIA.PH.NO. 022-24700872 .Email : info@hemantmedicam.com</span></div>
<div style="position:absolute;top:100px"  >__________________________________________________________________________________________________</div>
<div style="position:absolute;left:10px;top:135px" class="cls_005"><span class="cls_005">RECEIVER (BILL TO)</span></div>
           
<div style="position:absolute;left:10px;top:153px" class="cls_005"><span class="cls_005">Name :
 @foreach($org_true as $single_org)
 
        @if($pdfdata->org_id == $single_org->id)
 {{$single_org->contact_person_name}}
        @endif
 
 @endforeach
</span></div>


<div style="position:absolute;left:10px;top:170px" class="cls_005"><span class="cls_005">Billing Address :
   @foreach($org_true as $single_org)
 
        @if($pdfdata->org_id == $single_org->id)
 {{$single_org->address}}
        @endif
 
 @endforeach

</span></div>
<div style="position:absolute;left:347.52px;top:170px" class="cls_005"><span class="cls_005">Delivery Address :
  @foreach($org_true as $single_org)
 
        @if($pdfdata->org_id == $single_org->id)
 {{$single_org->address}}
        @endif
 
 @endforeach
</span></div>
<div style="position:absolute;left:10px;top:185px" class="cls_005"><span class="cls_005">
     @foreach($org_true as $single_org)
 
        @if($pdfdata->org_id == $single_org->id)
 {{$single_org->landmark.",".$single_org->city_town}}
        @endif
 
 @endforeach 
</span></div>
<div style="position:absolute;left:347.52px;top:185px" class="cls_005"><span class="cls_005">
       @foreach($org_true as $single_org)
 
        @if($pdfdata->org_id == $single_org->id)
 {{$single_org->landmark.",".$single_org->city_town}}
        @endif
 
 @endforeach 
</span></div>
<div style="position:absolute;left:10px;top:198px" class="cls_005"><span class="cls_005">
         @foreach($org_true as $single_org)
 
        @if($pdfdata->org_id == $single_org->id)
 {{$single_org->state.",".$single_org->postal_code.",".$single_org->country}}
        @endif
 
 @endforeach
</span></div>

<div style="position:absolute;left:347.52px;top:198px" class="cls_005"><span class="cls_005">
         @foreach($org_true as $single_org)
 
        @if($pdfdata->org_id == $single_org->id)
 {{$single_org->state.",".$single_org->postal_code.",".$single_org->country}}
        @endif
 
 @endforeach
</span></div>
    
<div style="position:absolute;left:10px;top:255px" class="cls_005"><span class="cls_005">GSTIN/UNIQUE ID :
    @foreach($org_true as $single_org)
 
        @if($pdfdata->org_id == $single_org->id)
 {{$single_org->gst}}
        @endif
 
 @endforeach
 </span></div>


<div style="position:absolute;top:294.72px" class="cls_005">
    <table class="cls_010" style="border: solid 1px black;border-collapse: collapse;" cellpadding="5">
        <thead>
        <tr>
            <th>Sr.no</th>
            <th>HSN/ACS</th>
            <th>Name of Goods or/ and Services Supplied</th>
            <th>UOM</th>
            <th>QTY</th>
            <th>RATE</th>
            <th>VALUE</th>
            <th>DISCO UNIT</th>
           <th>TAX (%)</th>
            <th>SGST VALUE</th>
            <th>CGST VALUE</th>
            <th>IGST VALUE</th>
            <th>TOTAL VALUE</th>
            </tr>
        </thead> 
        <tbody>
      <?php $true_price_all=0;
                $true_quantity=0;
                $true_discount=0;
                $true_tax=0;
                $true_value=0;
                $true_sgst=0;
                $true_cgst=0;
                $true_igst=0;
           // $main_true_price=array();
            $srno=1;
      ?>
      @foreach ($finaldata as $singleorders )
          
      
            <tr>
                <td>{{$srno}}</td>
                <td>-</td>
                <td>{{$singleorders->products}}</td>
                <td>NOS</td>
                <td>{{$singleorders->qty}}</td>
                <td>{{$singleorders->price}}</td>
                <td>{{$singleorders->price * $singleorders->qty}}</td>
                <td>{{$singleorders->discount}}</td>
                <?php $true_price_all=$true_price_all+$singleorders->price * $singleorders->qty; ?>
                <?php $true_quantity=$true_quantity+$singleorders->qty; ?>
                <?php $true_discount=$true_discount+$singleorders->discount; ?>
                <?php
                    if($singleorders->igst=="0")
                    {
                        $true_tax="6"; 
                      
                      }else
                     {
                        $true_tax="12";
                    }
                ?> 
                <?php $true_value=$singleorders->price * $singleorders->qty; ?> 
                <?php $true_sgst=($true_value-$singleorders->discount)*($singleorders->sgst/100); ?>
                <?php $true_cgst=($true_value-$singleorders->discount)*($singleorders->cgst/100); ?>
                <?php $true_igst=($true_value-$singleorders->discount)*($singleorders->igst/100); ?>
                <td>{{$true_tax}}</td>
                <td>{{$true_sgst}}</td>
                <td>{{$true_cgst}}</td>
                <td>{{$true_igst}}</td>

                <td>{{$singleorders->total}}</td>
            </tr>
                <?php $srno++;?>
      @endforeach
            
       <tr>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
               <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
              <td height="20"></td>
                <td height="20"></td>
              <td height="20"></td>
            </tr>
               <tr>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
               <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
              <td height="20"></td>
                <td height="20"></td>
              <td height="20"></td>
            </tr>
            <tr>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
               <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
              <td height="20"></td>
                <td height="20"></td>
              <td height="20"></td>
            </tr>
            <tr>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
               <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
                <td height="20"></td>
              <td height="20"></td>
                <td height="20"></td>
              <td height="20"></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:center;font-weight: bold;">Total</td>
                <td></td>
                <td style="text-align:center;font-weight: bold;">{{$true_quantity}}</td>
                <td></td>
                <td style="text-align:center;font-weight: bold;">{{$true_price_all}}</td>
                <td style="text-align:center;font-weight: bold;">{{$true_discount}}</td>
               <td></td>
                <td></td>
                <td></td>
                <td></td>
              <td style="text-align:center;font-weight: bold;">{{$pdfdata->subtotal}}</td>
            </tr>

            <tr>
                <td colspan="9" style="text-align:right">Freight Charges:</td>
                <td colspan="4" style="text-align:right;font-weight: bold;">
                    {{$pdfdata->grand_total-$pdfdata->subtotal}}

                </td>
            </tr>
            <tr>
                <td colspan="9" style="text-align:left;">Total Amount Payable Inclusive of GST tax(SGST/UGST/CGST/IGST/Freight)</td>
                <td colspan="4" style="text-align:right;font-size: 20px;font-weight: bold;">{{$pdfdata->grand_total}}</td>
            </tr>
           <!-- <tr>
                <td colspan="9" style="text-align:left;">Amount Due</td>
                <td colspan="4" style="text-align:right;font-size: 20px;font-weight: bold"></td>
            </tr>-->
            <tr>
              <td colspan="7" style="text-align:left;"><!--Total Invoice Amount in Words:<span></span><br>-->
                    Bank Details: A/c Name : Medicam, Bank Name : Canara Bank,<br>
                    A/c No. 0131261011711, Branch Name: Mahim, IFSC Code: CNRB0000132
                </td>
                <td colspan="6" rowspan="2" style="text-align:right;font-size: 20px;font-weight: bold"><center><img src="{{asset('/images/stampsign.jpg')}}" alt="Medicam" height="90" width="192"></center></td>
            </tr>
            <tr>
                <td colspan="7" rowspan="1" style="text-align:left;">&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;</td>
            </tr>
      
        </tbody> 
        
        
    </table>
</div>

</div>

</body>
</html>