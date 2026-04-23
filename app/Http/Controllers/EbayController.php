<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\MainOrder;
use App\Ebay;
use App\client;
use App\Product;
use App\Employee;
use App\OrderParticular;
class EbayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $counter_temp=0;
        $salerecord1 = array();
        $SaleRecordID_checks=Ebay::all('SaleRecordID');
        foreach($SaleRecordID_checks as $SaleRecordID_check){
        $sr= $SaleRecordID_check['SaleRecordID'];
            array_push($salerecord1, $sr) ;
        }
        $headers = array (
            //Regulates versioning of the XML interface for the API
            'X-EBAY-API-SITEID:203',
            //set the keys'
            'X-EBAY-API-COMPATIBILITY-LEVEL:967',
            'X-EBAY-API-CALL-NAME:GetSellingManagerSoldListings'
              );
      
          $urlserver="https://api.ebay.com/ws/api.dll";
      
          $requestBody='<?xml version="1.0" encoding="utf-8"?><GetSellingManagerSoldListingsRequest xmlns="urn:ebay:apis:eBLBaseComponents">
        <!-- Selling Manager API calls are only available to Selling Manager Pro subscribers -->
        <RequesterCredentials>
          <eBayAuthToken>v^1.1#i^1#r^1#f^0#p^3#I^3#t^Ul4xMF8xMDpDMDU0NUZEM0JFOTM2MDI2MzAxOUEzN0I1NjJFM0I4Ml8yXzEjRV4yNjA=</eBayAuthToken>
        </RequesterCredentials>
        <ErrorLanguage>en_US</ErrorLanguage>
        <WarningLevel>High</WarningLevel>
      </GetSellingManagerSoldListingsRequest>';
      /*AgAAAA**AQAAAA**aAAAAA**Pnh3XA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6ABkYehAJmBpQ6dj6x9nY+seQ**MN8FAA**AAMAAA**AF71BWJFPNhC/O5uJBLdTFUGySRahNIoSZNlMAD3nopLqfyacH7K11x+6XkKan3lSQ9NHixMbnvfgh63ZdL1+PD44ALxxD770UTldrsR8GY1P+wLfhWlybFeEn/O5WS9jTQ4u2EZJSGZEnBuTTGLjtcHFVSVd29ssi6TceDamZahNIgWiBBv+4sYHigAsC4stoHo2kP5lxLDKnrdPyvSzxdSpRZd4oR0iV+J2j8G7CJYdglS+VV4ZCMZrjlqvwrgFVnyR71+M6ZnooTSe1HjB8UR92SG57/s8V9SSjMpVPz0zvdFo5nECRxnmDTNtFuw2PO/WRrF2XHzxv7Up2luAuWlGGUf27zEAFCj3Kmqb/lrKCl1LOi//TS+l5C7xY2l7jyCMYQ4czEzdMGp1g3WMFt+Dx0h/ImsZzfeH1edrHgR7cSoagp4ZBOaZrD7DKK8Z43LIu95Ja6sFKizFf3tyJJWA41cMq5Iyq3aMix7JDX/9+WMbOkEiU6qJ71TBYWRLT9jfZEIAT+O7p5nyomnYtpE1R+jRh+HG/6mIKpyy7yQbRMpzrohoflOj7AGYhdrHgtjtjemyV6WLydNXiBvvp07JBmFFwOWjV8o1gKfBULoBe0zDEN0jqYeoAZsWtn/sCQctUPhaWR0RkNV/EJGLcGm77skM8u5OIoP0czudJJ+oyS1kmTz3JSk3yxP2YeKV0rzTM+SmGYnic7+JRljRPlVKcfmiO0DtOg86eGMmq8vwo16TmcJS8tfIBtz8Goh*/
      
      /*AgAAAA**AQAAAA**aAAAAA**pUMgXQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wDk4uhAZKFqAmdj6x9nY+seQ**y94FAA**AAMAAA**9gnBMjR4rn2IRSrZa4haIuJB0e8WoYo2QLbQeYZ/IKt4Ev2hbdybQfeSct9KUrhStFIbj/hbmxiytqIWD1aPC370jqGXfXmEBztnkTup1cU7MW2cX27Px9Y2mpu+ydyU2ACnht6BkViZngBybzVr05/4oO3h9MNgEWvq+pnZ/FTXSv1DCXAlXhROKOd0ORrEwWbpxN0hbnT/n3odn28ZwbGmK0TL2QZDQmm8tok/pN8ZHSna8teYTvbOUb2uXPYqTtxo25FXJFawUC++YL2T5w9TuHNbVrSbcM8iSYMSjJbyR7d1mudIhDDq2Uqqsh58yxeevaTXMqqCUEmRcT0OKBWz4wG0CSDS84J7ZPJKiJhWrhJwNmajRh+CA4QaI/rqxUtbfHhc3zOuksZ512c7Pun/9yWF0z1J9uhq8+XUhHnH4IRFDCoIawJ6jDidXfKK2QsXpWH5VP1ILOT94dkzc2ToRot2zVB4GwFG7Yfoqym7j0OAyfpoio04DW4S6vagIi5wHD/DdLmu/i4XM/p9xKJ/ZadJjauwOcchSqtSv9L4x7wkq42EjDpHhQ6ckmB/+sdPyCyh13RhVQIcPZ3zuC8KXryDF/XaWCIWrVYfpEWbg+99CM/C4COeE0jbSAkeKSh7FtSyrDhxTaUfdBalehikUzQlowTQd5sC39gAytqUmMs2zAqgUjqjLqCcNmNemq0fAZPvDfb/UKxIxidOAfkukLMEeDyzgEkyc6JHqQmCRmuRENUYXmYTZkWG+X/c*/
          //initialise a CURL session
          $connection = curl_init();
      
          //set the server we are using (could be Sandbox or Production server)
          curl_setopt($connection, CURLOPT_URL, $urlserver);
          
          //stop CURL from verifying the peer's certificate
          curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);
          
          //set the headers using the array of headers
          curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
          
          //set method as POST
          curl_setopt($connection, CURLOPT_POST, 1);
          
          //set the XML body of the request
          curl_setopt($connection, CURLOPT_POSTFIELDS, $requestBody);
      
          //set it to return the transfer as a string from curl_exec
          curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
         
          //Send the Request
          $response = curl_exec($connection);
          //close the connection
          curl_close($connection);
        $xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA);
        $all_shipment = json_decode(json_encode((array) $xml), true);
        $arr=json_encode($xml);
        $salerecords=$all_shipment['SaleRecord'];
  foreach($salerecords as $salerecord)
  {
    $paid_status=$salerecord['OrderStatus']['PaidStatus'];
    $SaleRecordID=$salerecord['SaleRecordID'];
    if (!in_array($SaleRecordID, $salerecord1))
    {   
    if($paid_status=="Paid"){
        $order_date=$salerecord['OrderStatus']['PaidTime'];        
        $item_title=$salerecord['SellingManagerSoldTransaction']['ItemTitle'];
        $item_id=$salerecord['SellingManagerSoldTransaction']['ItemID'];
        $order_id=$salerecord['SellingManagerSoldTransaction']['OrderLineItemID'];
        $Buyer_id=$salerecord['BuyerID'];
        $byer_email=$salerecord['BuyerEmail'];        
        $SalePrice=$salerecord['SalePrice'];
        $order_status_CheckoutStatus=$salerecord['OrderStatus']['CheckoutStatus'];
        $totalamount=$salerecord['TotalAmount'];
        $totalquantity=$salerecord['TotalQuantity'];
        
        $payment_method=$salerecord['OrderStatus']['PaymentMethodUsed'];
       
            
        //2nd api call
        $headers = array (
            //Regulates versioning of the XML interface for the API
            'X-EBAY-API-SITEID:203',
            
            //set the keys'
            'X-EBAY-API-COMPATIBILITY-LEVEL:967',
            'X-EBAY-API-CALL-NAME:GetOrderTransactions'
            
        );
        
        $urlserver="https://api.ebay.com/ws/api.dll";
        
        $requestBody='<?xml version="1.0" encoding="utf-8"?>
        <GetOrderTransactionsRequest xmlns="urn:ebay:apis:eBLBaseComponents">
        <!-- Note that GetOrders might be the better Trading call to use when it comes to retrieve order data. GetOrders has all of the capabilities that GetOrderTransactions has, plus more capabilities, including date/time filters, pagination control, and the ability to only retrieve orders of a specific listing type (e.g., auction or fixed-price) -->
        <RequesterCredentials>
        <eBayAuthToken>v^1.1#i^1#r^1#f^0#p^3#I^3#t^Ul4xMF8xMDpDMDU0NUZEM0JFOTM2MDI2MzAxOUEzN0I1NjJFM0I4Ml8yXzEjRV4yNjA=</eBayAuthToken>
        </RequesterCredentials>
        <ErrorLanguage>en_US</ErrorLanguage>
        <WarningLevel>High</WarningLevel>
        <OrderIDArray>
        
        <OrderID>'.$order_id.'</OrderID>
        
        </OrderIDArray>
        </GetOrderTransactionsRequest>';
        
        /*AgAAAA**AQAAAA**aAAAAA**EP95XA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6ABkYehAJmBpQ6dj6x9nY+seQ**y94FAA**AAMAAA**F2OxYxfMeW/laXTyP79v0NPZbrKaWKVBGcWVkV0jRppJ8/VQVliskPdLMzCt6bVnoHydoU/Mmbv89aR9baROKJeY+3OkDpJvyz+8kkk3MM2aIlCRYPVnlrxUA2x7135MlGlhhDGnzIlUbAf88n8Cw+BruAKkZxyKVZcIldeAGK0Ds7HyuwP/MQOLIUY2faz3eWLgveDAE27ZS4WkgYEWXxLGJHGaA1o6mA95xANyEKdDnJMQq5RI1a5OiMUl41NDuv3y9C40JWW9u4x3W0ACis91qtuOaZ4789kPS9aq4fL2Kao5dK+pc/WocZoYiWpIqQvfFECR/R7ZBAfA28N9jDJWwSZpjp/l+I6djYfKCVKG2hGYlQRpvRQYOgfD8EYSW+WRsGrrOF+wL9NBVZO5mJLEkuhzUmlFOESfhJWbjECijoTRKBcf3+oskckEWRzwE7yOb3QMvKwIXuVha4n/9eUOITqqZGAHLBcaP//wyJjWXR/bShT/mhOE50B1FBU79kvIXVB7OdjlS5xScmwsZWcJo3FCHUku8ShWvT1P1LC2+G2tETv5oQY1gn6oFn/bZUmPa7Mkl/1smrUIlSrAHxVDaEroN1SfgJ07ui4BY6koA8hnGPqNl5qwP3rXn+4Iyy6odbB07NyWmhDl0Ejhb40HoXGSCEUMgCNyR3ENfif/gD3/YVYvkebDVgYFH1kj0NlspWux0/rxCmk7f6ocw4WI57M1LbZahvx6VDfVHilZNxT4ZFN0/rFy4mtgB66Z*/
        //initialise a CURL session
        $connection = curl_init();
        //set the server we are using (could be Sandbox or Production server)
        curl_setopt($connection, CURLOPT_URL, $urlserver);
        
        //stop CURL from verifying the peer's certificate
        curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);
        
        //set the headers using the array of headers
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        
        //set method as POST
        curl_setopt($connection, CURLOPT_POST, 1);
        
        //set the XML body of the request
        curl_setopt($connection, CURLOPT_POSTFIELDS, $requestBody);
        
        //set it to return the transfer as a string from curl_exec
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        
        //Send the Request
        $response_2nd_api = curl_exec($connection);
        
        //close the connection
        curl_close($connection);
        $xml_2nd_api = simplexml_load_string($response_2nd_api, "SimpleXMLElement", LIBXML_NOCDATA);
        $all_shipment_2nd_api = json_decode(json_encode((array) $xml_2nd_api), true);
      // $arr=json_encode($xml);
        //echo $arr;
        //if($counter_temp==0)
       // {
    //print_r($all_shipment_2nd_api);
      //  }
      //echo  $all_shipment_2nd_api['OrderArray']['Order']['ShippingAddress']['Name']."||";
       // $order
        //$counter_temp++;
        $data_2nd_api=$all_shipment_2nd_api['OrderArray']['Order'];
        
            $byer_name=$data_2nd_api['ShippingAddress']['Name'];
            $street1=$data_2nd_api['ShippingAddress']['Street1'];
            if(!is_array($street1)){
                $street1=$data_2nd_api['ShippingAddress']['Street1'];
              
            }else{
                $street1="";
            }
            $street2=$data_2nd_api['ShippingAddress']['Street2'];
            if(!is_array($street2)){
                $street2=$data_2nd_api['ShippingAddress']['Street2'];
               
            }else{
                $street2="";
            }
            $address= $street1." ".$street2;
            $city_name=$data_2nd_api['ShippingAddress']['CityName'];
            $country_name=$data_2nd_api['ShippingAddress']['CountryName'];
            $phone=$data_2nd_api['ShippingAddress']['Phone'];
            $postalcode=$data_2nd_api['ShippingAddress']['PostalCode'];
            $amountpaid=$data_2nd_api['TransactionArray']['Transaction']['AmountPaid'];
            //$address="asdsa";
            
            $headers = array (
                //Regulates versioning of the XML interface for the API
                'X-EBAY-API-SITEID:203',
                
                //set the keys'
                'X-EBAY-API-COMPATIBILITY-LEVEL:967',
                'X-EBAY-API-CALL-NAME:GetItem'
    
                
                //the name of the call we are requesting
                
                
                //SiteID must also be set in the Request's XML
                //SiteID = 0  (US) - UK = 3, Canada = 2, Australia = 15, ....
                //SiteID Indicates the eBay site to associate the call with
                
            );
    
            $urlserver="https://api.ebay.com/ws/api.dll";
    
            $requestBody='<?xml version="1.0" encoding="utf-8"?>
    <GetItemRequest xmlns="urn:ebay:apis:eBLBaseComponents">
      <RequesterCredentials>
        <eBayAuthToken>v^1.1#i^1#r^1#f^0#p^3#I^3#t^Ul4xMF8xMDpDMDU0NUZEM0JFOTM2MDI2MzAxOUEzN0I1NjJFM0I4Ml8yXzEjRV4yNjA=</eBayAuthToken>
      </RequesterCredentials>
        <ErrorLanguage>en_US</ErrorLanguage>
        <WarningLevel>High</WarningLevel>
          <!--Enter an ItemID-->
      <ItemID>'.$item_id.'</ItemID>
      <IncludeItemSpecifics>True</IncludeItemSpecifics>
      </GetItemRequest>';
    
    
            //initialise a CURL session
            $connection = curl_init();
            //set the server we are using (could be Sandbox or Production server)
            curl_setopt($connection, CURLOPT_URL, $urlserver);
            
            //stop CURL from verifying the peer's certificate
            curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);
            
            //set the headers using the array of headers
            curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
            
            //set method as POST
            curl_setopt($connection, CURLOPT_POST, 1);
            
            //set the XML body of the request
            curl_setopt($connection, CURLOPT_POSTFIELDS, $requestBody);
            
            //set it to return the transfer as a string from curl_exec
            curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
            
            //Send the Request
            $response_3rd_apicall = curl_exec($connection);
            
            //close the connection
            curl_close($connection);
            
    
            //echo $response;
            //echo htmlentities($response);
            $xml_3rd_api_call=simplexml_load_string($response_3rd_apicall, "SimpleXMLElement", LIBXML_NOCDATA);
            $myArray = json_decode(json_encode($xml_3rd_api_call), true);
         //if($counter_temp==0)
        //{
        //print_r($myArray['Item']['PictureDetails']);
        //}
        //$counter_temp++;
        $image_url= end($myArray['Item']['PictureURL']);
        $completion_token=0;
        $ebay = new Ebay;
        $ebay->order_date =$order_date;
        $ebay->item_title =$item_title;
        $ebay->item_id =$item_id;
        $ebay->order_id =$order_id;
        $ebay->Buyer_name =$byer_name;
        $ebay->byer_email =$byer_email;
        $ebay->SaleRecordID =$SaleRecordID;
        $ebay->SalePrice =$SalePrice;
        $ebay->order_status_CheckoutStatus =$order_status_CheckoutStatus;
        $ebay->totalamount =$totalamount;
        $ebay->totalquantity =$totalquantity;
        $ebay->paid_status =$paid_status;
        $ebay->payment_method =$payment_method;
        $ebay->Buyer_id =$Buyer_id;
        $ebay->address =$address;
        $ebay->city_name =$city_name;
        $ebay->country_name =$country_name;
        $ebay->phone =$phone;
        $ebay->postalcode =$postalcode;
        $ebay->amountpaid =$amountpaid;
        $ebay->image_url =$image_url;
        $ebay->completion_token =$completion_token;

        $ebay->save();
            
}
    }
}


$ebays=Ebay::all();
$productID = Product::all();
$Assign_toID = Employee::all();
return view('ebay/list_all_orders',compact('productID','Assign_toID'))->with('ebays',$ebays);
///////2nd api call

  
         
    }
    
    
    public function index_home() {
        $counter_temp=0;
        $sales_count_for_dash=array();
        $salerecord1 = array();
        $SaleRecordID_checks=Ebay::all('SaleRecordID');
        foreach($SaleRecordID_checks as $SaleRecordID_check){
        $sr= $SaleRecordID_check['SaleRecordID'];

            array_push($salerecord1, $sr) ;
            
        }
        
        //print_r($salerecord);

        $headers = array (
            //Regulates versioning of the XML interface for the API
            'X-EBAY-API-SITEID:203',
            
            //set the keys'
            'X-EBAY-API-COMPATIBILITY-LEVEL:967',
            'X-EBAY-API-CALL-NAME:GetSellingManagerSoldListings'
              );
      
          $urlserver="https://api.ebay.com/ws/api.dll";
      
          $requestBody='<?xml version="1.0" encoding="utf-8"?><GetSellingManagerSoldListingsRequest xmlns="urn:ebay:apis:eBLBaseComponents">
        <!-- Selling Manager API calls are only available to Selling Manager Pro subscribers -->
        <RequesterCredentials>
          <eBayAuthToken>AgAAAA**AQAAAA**aAAAAA**pUMgXQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wDk4uhAZKFqAmdj6x9nY+seQ**y94FAA**AAMAAA**9gnBMjR4rn2IRSrZa4haIuJB0e8WoYo2QLbQeYZ/IKt4Ev2hbdybQfeSct9KUrhStFIbj/hbmxiytqIWD1aPC370jqGXfXmEBztnkTup1cU7MW2cX27Px9Y2mpu+ydyU2ACnht6BkViZngBybzVr05/4oO3h9MNgEWvq+pnZ/FTXSv1DCXAlXhROKOd0ORrEwWbpxN0hbnT/n3odn28ZwbGmK0TL2QZDQmm8tok/pN8ZHSna8teYTvbOUb2uXPYqTtxo25FXJFawUC++YL2T5w9TuHNbVrSbcM8iSYMSjJbyR7d1mudIhDDq2Uqqsh58yxeevaTXMqqCUEmRcT0OKBWz4wG0CSDS84J7ZPJKiJhWrhJwNmajRh+CA4QaI/rqxUtbfHhc3zOuksZ512c7Pun/9yWF0z1J9uhq8+XUhHnH4IRFDCoIawJ6jDidXfKK2QsXpWH5VP1ILOT94dkzc2ToRot2zVB4GwFG7Yfoqym7j0OAyfpoio04DW4S6vagIi5wHD/DdLmu/i4XM/p9xKJ/ZadJjauwOcchSqtSv9L4x7wkq42EjDpHhQ6ckmB/+sdPyCyh13RhVQIcPZ3zuC8KXryDF/XaWCIWrVYfpEWbg+99CM/C4COeE0jbSAkeKSh7FtSyrDhxTaUfdBalehikUzQlowTQd5sC39gAytqUmMs2zAqgUjqjLqCcNmNemq0fAZPvDfb/UKxIxidOAfkukLMEeDyzgEkyc6JHqQmCRmuRENUYXmYTZkWG+X/c</eBayAuthToken>
        </RequesterCredentials>
        <ErrorLanguage>en_US</ErrorLanguage>
        <WarningLevel>High</WarningLevel>
      </GetSellingManagerSoldListingsRequest>';
      /*AgAAAA**AQAAAA**aAAAAA**Pnh3XA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6ABkYehAJmBpQ6dj6x9nY+seQ**MN8FAA**AAMAAA**AF71BWJFPNhC/O5uJBLdTFUGySRahNIoSZNlMAD3nopLqfyacH7K11x+6XkKan3lSQ9NHixMbnvfgh63ZdL1+PD44ALxxD770UTldrsR8GY1P+wLfhWlybFeEn/O5WS9jTQ4u2EZJSGZEnBuTTGLjtcHFVSVd29ssi6TceDamZahNIgWiBBv+4sYHigAsC4stoHo2kP5lxLDKnrdPyvSzxdSpRZd4oR0iV+J2j8G7CJYdglS+VV4ZCMZrjlqvwrgFVnyR71+M6ZnooTSe1HjB8UR92SG57/s8V9SSjMpVPz0zvdFo5nECRxnmDTNtFuw2PO/WRrF2XHzxv7Up2luAuWlGGUf27zEAFCj3Kmqb/lrKCl1LOi//TS+l5C7xY2l7jyCMYQ4czEzdMGp1g3WMFt+Dx0h/ImsZzfeH1edrHgR7cSoagp4ZBOaZrD7DKK8Z43LIu95Ja6sFKizFf3tyJJWA41cMq5Iyq3aMix7JDX/9+WMbOkEiU6qJ71TBYWRLT9jfZEIAT+O7p5nyomnYtpE1R+jRh+HG/6mIKpyy7yQbRMpzrohoflOj7AGYhdrHgtjtjemyV6WLydNXiBvvp07JBmFFwOWjV8o1gKfBULoBe0zDEN0jqYeoAZsWtn/sCQctUPhaWR0RkNV/EJGLcGm77skM8u5OIoP0czudJJ+oyS1kmTz3JSk3yxP2YeKV0rzTM+SmGYnic7+JRljRPlVKcfmiO0DtOg86eGMmq8vwo16TmcJS8tfIBtz8Goh*/
      
          //initialise a CURL session
          $connection = curl_init();
          //set the server we are using (could be Sandbox or Production server)
          curl_setopt($connection, CURLOPT_URL, $urlserver);
          
          //stop CURL from verifying the peer's certificate
          curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);
          
          //set the headers using the array of headers
          curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
          
          //set method as POST
          curl_setopt($connection, CURLOPT_POST, 1);
          
          //set the XML body of the request
          curl_setopt($connection, CURLOPT_POSTFIELDS, $requestBody);
          
          //set it to return the transfer as a string from curl_exec
          curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
          
          //Send the Request
          $response = curl_exec($connection);
          
          //close the connection
          curl_close($connection);
   //       print_r($response);
   $xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA);
   $all_shipment = json_decode(json_encode((array) $xml), true);
   //$arr=json_encode($xml);
  // print_r($array) ;   
   //echo $arr;

  // $a=
  $salerecords=$all_shipment['SaleRecord'];
    //print_r($salerecords);
        // print_r($sr);     
  foreach($salerecords as $salerecord)
  {
    $paid_status=$salerecord['OrderStatus']['PaidStatus'];
    $SaleRecordID=$salerecord['SaleRecordID'];
    
    if (in_array($SaleRecordID, $salerecord1))
    {

    }else{    
    if($paid_status=="Paid"){
        array_push($sales_count_for_dash,$SaleRecordID);
        $order_date = $salerecord['OrderStatus']['PaidTime'];
        $item_title=$salerecord['SellingManagerSoldTransaction']['ItemTitle'];
        $item_id=$salerecord['SellingManagerSoldTransaction']['ItemID'];
        $order_id=$salerecord['SellingManagerSoldTransaction']['OrderLineItemID'];
        $Buyer_id=$salerecord['BuyerID'];
        $byer_email=$salerecord['BuyerEmail'];
        
        $SalePrice=$salerecord['SalePrice'];
        $order_status_CheckoutStatus=$salerecord['OrderStatus']['CheckoutStatus'];
        $totalamount=$salerecord['TotalAmount'];
        $totalquantity=$salerecord['TotalQuantity'];
        
        $payment_method=$salerecord['OrderStatus']['PaymentMethodUsed'];
       
        //2nd api call
        $headers = array (
            //Regulates versioning of the XML interface for the API
            'X-EBAY-API-SITEID:203',
            
            //set the keys'
            'X-EBAY-API-COMPATIBILITY-LEVEL:967',
            'X-EBAY-API-CALL-NAME:GetOrderTransactions'
            
        );
        
        $urlserver="https://api.ebay.com/ws/api.dll";
        
        $requestBody='<?xml version="1.0" encoding="utf-8"?>
        <GetOrderTransactionsRequest xmlns="urn:ebay:apis:eBLBaseComponents">
        <!-- Note that GetOrders might be the better Trading call to use when it comes to retrieve order data. GetOrders has all of the capabilities that GetOrderTransactions has, plus more capabilities, including date/time filters, pagination control, and the ability to only retrieve orders of a specific listing type (e.g., auction or fixed-price) -->
        <RequesterCredentials>
        <eBayAuthToken>AgAAAA**AQAAAA**aAAAAA**pUMgXQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wDk4uhAZKFqAmdj6x9nY+seQ**y94FAA**AAMAAA**9gnBMjR4rn2IRSrZa4haIuJB0e8WoYo2QLbQeYZ/IKt4Ev2hbdybQfeSct9KUrhStFIbj/hbmxiytqIWD1aPC370jqGXfXmEBztnkTup1cU7MW2cX27Px9Y2mpu+ydyU2ACnht6BkViZngBybzVr05/4oO3h9MNgEWvq+pnZ/FTXSv1DCXAlXhROKOd0ORrEwWbpxN0hbnT/n3odn28ZwbGmK0TL2QZDQmm8tok/pN8ZHSna8teYTvbOUb2uXPYqTtxo25FXJFawUC++YL2T5w9TuHNbVrSbcM8iSYMSjJbyR7d1mudIhDDq2Uqqsh58yxeevaTXMqqCUEmRcT0OKBWz4wG0CSDS84J7ZPJKiJhWrhJwNmajRh+CA4QaI/rqxUtbfHhc3zOuksZ512c7Pun/9yWF0z1J9uhq8+XUhHnH4IRFDCoIawJ6jDidXfKK2QsXpWH5VP1ILOT94dkzc2ToRot2zVB4GwFG7Yfoqym7j0OAyfpoio04DW4S6vagIi5wHD/DdLmu/i4XM/p9xKJ/ZadJjauwOcchSqtSv9L4x7wkq42EjDpHhQ6ckmB/+sdPyCyh13RhVQIcPZ3zuC8KXryDF/XaWCIWrVYfpEWbg+99CM/C4COeE0jbSAkeKSh7FtSyrDhxTaUfdBalehikUzQlowTQd5sC39gAytqUmMs2zAqgUjqjLqCcNmNemq0fAZPvDfb/UKxIxidOAfkukLMEeDyzgEkyc6JHqQmCRmuRENUYXmYTZkWG+X/c</eBayAuthToken>
        </RequesterCredentials>
        <ErrorLanguage>en_US</ErrorLanguage>
        <WarningLevel>High</WarningLevel>
        <OrderIDArray>
        
        <OrderID>'.$order_id.'</OrderID>
        
        </OrderIDArray>
        </GetOrderTransactionsRequest>';
        
        /*AgAAAA**AQAAAA**aAAAAA**EP95XA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6ABkYehAJmBpQ6dj6x9nY+seQ**y94FAA**AAMAAA**F2OxYxfMeW/laXTyP79v0NPZbrKaWKVBGcWVkV0jRppJ8/VQVliskPdLMzCt6bVnoHydoU/Mmbv89aR9baROKJeY+3OkDpJvyz+8kkk3MM2aIlCRYPVnlrxUA2x7135MlGlhhDGnzIlUbAf88n8Cw+BruAKkZxyKVZcIldeAGK0Ds7HyuwP/MQOLIUY2faz3eWLgveDAE27ZS4WkgYEWXxLGJHGaA1o6mA95xANyEKdDnJMQq5RI1a5OiMUl41NDuv3y9C40JWW9u4x3W0ACis91qtuOaZ4789kPS9aq4fL2Kao5dK+pc/WocZoYiWpIqQvfFECR/R7ZBAfA28N9jDJWwSZpjp/l+I6djYfKCVKG2hGYlQRpvRQYOgfD8EYSW+WRsGrrOF+wL9NBVZO5mJLEkuhzUmlFOESfhJWbjECijoTRKBcf3+oskckEWRzwE7yOb3QMvKwIXuVha4n/9eUOITqqZGAHLBcaP//wyJjWXR/bShT/mhOE50B1FBU79kvIXVB7OdjlS5xScmwsZWcJo3FCHUku8ShWvT1P1LC2+G2tETv5oQY1gn6oFn/bZUmPa7Mkl/1smrUIlSrAHxVDaEroN1SfgJ07ui4BY6koA8hnGPqNl5qwP3rXn+4Iyy6odbB07NyWmhDl0Ejhb40HoXGSCEUMgCNyR3ENfif/gD3/YVYvkebDVgYFH1kj0NlspWux0/rxCmk7f6ocw4WI57M1LbZahvx6VDfVHilZNxT4ZFN0/rFy4mtgB66Z*/
        //initialise a CURL session
        $connection = curl_init();
        //set the server we are using (could be Sandbox or Production server)
        curl_setopt($connection, CURLOPT_URL, $urlserver);
        
        //stop CURL from verifying the peer's certificate
        curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);
        
        //set the headers using the array of headers
        curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
        
        //set method as POST
        curl_setopt($connection, CURLOPT_POST, 1);
        
        //set the XML body of the request
        curl_setopt($connection, CURLOPT_POSTFIELDS, $requestBody);
        
        //set it to return the transfer as a string from curl_exec
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
        
        //Send the Request
        $response_2nd_api = curl_exec($connection);
        
        //close the connection
        curl_close($connection);
        $xml_2nd_api = simplexml_load_string($response_2nd_api, "SimpleXMLElement", LIBXML_NOCDATA);
        $all_shipment_2nd_api = json_decode(json_encode((array) $xml_2nd_api), true);
      // $arr=json_encode($xml);
        //echo $arr;
        //if($counter_temp==0)
       // {
      //print_r($all_shipment_2nd_api);
      //  }
      //echo  $all_shipment_2nd_api['OrderArray']['Order']['ShippingAddress']['Name']."||";
       // $order
        //$counter_temp++;
        $data_2nd_api=$all_shipment_2nd_api['OrderArray']['Order'];
        
            $byer_name=$data_2nd_api['ShippingAddress']['Name'];
            $street1=$data_2nd_api['ShippingAddress']['Street1'];
            if(!is_array($street1)){
                $street1=$data_2nd_api['ShippingAddress']['Street1'];
              
            }else{
                $street1="";
            }
            $street2=$data_2nd_api['ShippingAddress']['Street2'];
            if(!is_array($street2)){
                $street2=$data_2nd_api['ShippingAddress']['Street2'];
               
            }else{
                $street2="";
            }
            $address= $street1." ".$street2;
            $city_name=$data_2nd_api['ShippingAddress']['CityName'];
            $country_name=$data_2nd_api['ShippingAddress']['CountryName'];
            $phone=$data_2nd_api['ShippingAddress']['Phone'];
            $postalcode=$data_2nd_api['ShippingAddress']['PostalCode'];
            $amountpaid=$data_2nd_api['TransactionArray']['Transaction']['AmountPaid'];
            //$address="asdsa";
            
            $headers = array (
                //Regulates versioning of the XML interface for the API
                'X-EBAY-API-SITEID:203',
                
                //set the keys'
                'X-EBAY-API-COMPATIBILITY-LEVEL:967',
                'X-EBAY-API-CALL-NAME:GetItem'
    
                
                //the name of the call we are requesting
                
                
                //SiteID must also be set in the Request's XML
                //SiteID = 0  (US) - UK = 3, Canada = 2, Australia = 15, ....
                //SiteID Indicates the eBay site to associate the call with
                
            );
    
            $urlserver="https://api.ebay.com/ws/api.dll";
    
            $requestBody='<?xml version="1.0" encoding="utf-8"?>
    <GetItemRequest xmlns="urn:ebay:apis:eBLBaseComponents">
      <RequesterCredentials>
        <eBayAuthToken>AgAAAA**AQAAAA**aAAAAA**pUMgXQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wDk4uhAZKFqAmdj6x9nY+seQ**y94FAA**AAMAAA**9gnBMjR4rn2IRSrZa4haIuJB0e8WoYo2QLbQeYZ/IKt4Ev2hbdybQfeSct9KUrhStFIbj/hbmxiytqIWD1aPC370jqGXfXmEBztnkTup1cU7MW2cX27Px9Y2mpu+ydyU2ACnht6BkViZngBybzVr05/4oO3h9MNgEWvq+pnZ/FTXSv1DCXAlXhROKOd0ORrEwWbpxN0hbnT/n3odn28ZwbGmK0TL2QZDQmm8tok/pN8ZHSna8teYTvbOUb2uXPYqTtxo25FXJFawUC++YL2T5w9TuHNbVrSbcM8iSYMSjJbyR7d1mudIhDDq2Uqqsh58yxeevaTXMqqCUEmRcT0OKBWz4wG0CSDS84J7ZPJKiJhWrhJwNmajRh+CA4QaI/rqxUtbfHhc3zOuksZ512c7Pun/9yWF0z1J9uhq8+XUhHnH4IRFDCoIawJ6jDidXfKK2QsXpWH5VP1ILOT94dkzc2ToRot2zVB4GwFG7Yfoqym7j0OAyfpoio04DW4S6vagIi5wHD/DdLmu/i4XM/p9xKJ/ZadJjauwOcchSqtSv9L4x7wkq42EjDpHhQ6ckmB/+sdPyCyh13RhVQIcPZ3zuC8KXryDF/XaWCIWrVYfpEWbg+99CM/C4COeE0jbSAkeKSh7FtSyrDhxTaUfdBalehikUzQlowTQd5sC39gAytqUmMs2zAqgUjqjLqCcNmNemq0fAZPvDfb/UKxIxidOAfkukLMEeDyzgEkyc6JHqQmCRmuRENUYXmYTZkWG+X/c</eBayAuthToken>
      </RequesterCredentials>
        <ErrorLanguage>en_US</ErrorLanguage>
        <WarningLevel>High</WarningLevel>
          <!--Enter an ItemID-->
      <ItemID>'.$item_id.'</ItemID>
      <IncludeItemSpecifics>True</IncludeItemSpecifics>
      </GetItemRequest>';
    
    
            //initialise a CURL session
            $connection = curl_init();
            //set the server we are using (could be Sandbox or Production server)
            curl_setopt($connection, CURLOPT_URL, $urlserver);
            
            //stop CURL from verifying the peer's certificate
            curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);
            
            //set the headers using the array of headers
            curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
            
            //set method as POST
            curl_setopt($connection, CURLOPT_POST, 1);
            
            //set the XML body of the request
            curl_setopt($connection, CURLOPT_POSTFIELDS, $requestBody);
            
            //set it to return the transfer as a string from curl_exec
            curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
            
            //Send the Request
            $response_3rd_apicall = curl_exec($connection);
            
            //close the connection
            curl_close($connection);
            
    
            //echo $response;
            //echo htmlentities($response);
            $xml_3rd_api_call=simplexml_load_string($response_3rd_apicall, "SimpleXMLElement", LIBXML_NOCDATA);
            $myArray = json_decode(json_encode($xml_3rd_api_call), true);
         //if($counter_temp==0)
        //{
        //print_r($myArray['Item']['PictureDetails']);
        //}
        //$counter_temp++;
        $image_url= $myArray['Item']['PictureDetails']['GalleryURL'] ?? '';
      
        //echo "<br>".$item_id." ".$item_title." ||".$order_id."||".$Buyer_name."|| ".$byer_email."|| ".$SaleRecordID."|| ".$SalePrice." ||".$order_status_CheckoutStatus." ||".$totalamount." ||".$totalquantity;
        $completion_token=0;
        $ebay = new Ebay;

        $ebay->order_date =$order_date;
        $ebay->item_title =$item_title;
        $ebay->item_id =$item_id;
        $ebay->order_id =$order_id;
        $ebay->Buyer_name =$byer_name;
        $ebay->byer_email =$byer_email;
        $ebay->SaleRecordID =$SaleRecordID;
        $ebay->SalePrice =$SalePrice;
        $ebay->order_status_CheckoutStatus =$order_status_CheckoutStatus;
        $ebay->totalamount =$totalamount;
        $ebay->totalquantity =$totalquantity;
        $ebay->paid_status =$paid_status;
        $ebay->payment_method =$payment_method;
        $ebay->Buyer_id =$Buyer_id;
        $ebay->address =$address;
        $ebay->city_name =$city_name;
        $ebay->country_name =$country_name;
        $ebay->phone =$phone;
        $ebay->postalcode =$postalcode;
        $ebay->amountpaid =$amountpaid;
        $ebay->image_url =$image_url;
        $ebay->completion_token =$completion_token;

        $ebay->save();
            
        }

    }
}
        $sales_count_today=count($sales_count_for_dash);
        return response()->json($sales_count_today);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $ebays=Ebay::where(['completion_token'=>'0']);
        $Assign_toID = Employee::all();
                    $productID = Product::all();
        return view('ebay/list_all_orders',compact('productID'))->with('ebays',$ebays);
    }

    public function display()
    {
        $ebay=Ebay::whereDate('created_at', Carbon::today())->get();
        //return response()->json($ebay);
        return response()->json($ebay);

    }

    public function completed_orders(Request $request, $completeion_id)
    {
        $ebay = Ebay::where('id', $completeion_id)->update(['completion_token'=>'1']);
        return response()->json(['success']);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
      public function ebay_order_saver(Request $request)
    {
            $unique_check = client::where('email_id',$request->ebay_email)->get();
           // print_r($unique_check);
            $count=0;
            $orgid_true="";
           foreach($unique_check as $singlevalue)
            {
               $count++;
                $orgid_true=$singlevalue->id;
            }
        if($count==0){
         $organisation=new client;
         $organisation->contact_person_name=$request->Contact_person;
         $organisation->contact_person_name_acc=$request->Contact_person;
         $organisation->organization_name=$request->Contact_person;
         $organisation->mobile_number=$request->ebay_mobile;
         $organisation->primary_email=$request->ebay_email;
         $organisation->address=$request->ebay_address;
         $organisation->email_id=$request->ebay_email;
             $organisation->preference_token="1";
         $organisation->save();
                    
             $orgid_true=$organisation->id;  
             
             
             
               $order = new MainOrder;
                $order->contact_person_name = $request->Contact_person;
                $order->org_id = $orgid_true;
                $order->organization_name = $request->Contact_person;
                $order->mobile_number = $request->ebay_mobile;
                $order->email_id = $request->ebay_email;
                $order->address = $request->ebay_address;
                $order->subtotal = $request->ebay_total;
               
                $order->Warranty_date =" ";
                $order->grand_total = $request->ebay_total;
                $order->enqid_hidden = "0";
                $order->entryLevelHidden ="3";
                $order->proposalIDHidden = "0";
                $order->exp_date =" ";

                if($order->save()){

                    
                        $data = array(
                            'products' =>$request->pro_enq ,
                            'qty' => "1",
                            'sgst'=> "0",
                            'igst' => "0",  
                            'cgst' => "0",  
                            'discount' => "0",  
                            'price' =>  $request->ebay_total,
                            'total' => $request->ebay_total,
                            'orders_id' => $order->id
                        );
                        OrderParticular::insert($data);  
                    return response()->json(['success']);
                }
             
        
                    
        }
        else{
            
             $order = new MainOrder;
                $order->contact_person_name = $request->Contact_person;
                $order->org_id = $orgid_true;
                $order->organization_name = $request->Contact_person;
                $order->mobile_number = $request->ebay_mobile;
                $order->email_id = $request->ebay_email;
                $order->address = $request->ebay_address;
                $order->subtotal = $request->ebay_total;
               
                $order->Warranty_date =" ";
                $order->grand_total = $request->ebay_total;
                $order->enqid_hidden = "0";
                $order->entryLevelHidden ="3";
                $order->proposalIDHidden = "0";
                $order->exp_date =" ";

                if($order->save()){

                    
                        $data = array(
                            'products' =>$request->pro_enq ,
                            'qty' => "1",
                            'sgst'=> "0",
                            'igst' => "0",  
                            'cgst' => "0",  
                            'discount' => "0",  
                            'price' =>  $request->ebay_total,
                            'total' => $request->ebay_total,
                            'orders_id' => $order->id
                        );
                        OrderParticular::insert($data);  
                    return response()->json(['success']);
                }
            
            
        }
        
       
    }
    
    
    
}
