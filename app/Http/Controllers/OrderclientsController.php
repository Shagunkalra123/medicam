<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\client;
use App\MainOrder;
use App\OrderParticular;
use App\Invoice;
use App\InvoiceParticular;
use App\ViewList;
use DB;


class OrderclientsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $org = client::find($id);
        return response()->json($org);
    }


 public function editsetview(Request $request,$view_name)
    {
        $uri = $request->path();
       $uri= $request->header('referer');
       $domainname="http://crm.medicam.in/";
      $referername = explode($domainname,$uri);
      $page_name="DataTables_data_table_/".$referername[1];
       //$request->header('Host');
        //dd($page_name);
        
        $view_name = ViewList::where('view_name',$view_name)->where('page_name', '=',$page_name)->get();
        return response()->json($view_name);
    }
    
    
    public function saveOrg(Request $request)
    {
                $org = new client;
                $org->contact_person_name = $request->cp_name;
                $org->organization_name = $request->org_name;
                $org->mobile_number = $request->mob_number;
                $org->email_id = $request->cre_email;
                $org->address = $request->cre_address;
                if($org->save()){
                    return response()->json($org);
                }

                  
    }

    public function display()
    {
       
        $mainorders = MainOrder::all();
        $orderparticulars = OrderParticular::all();
        $view_names = ViewList::where('page_name','=','DataTables_data_table_/list_all_orders')->get();
       // dd($view_names);
        return view('Orders/list_all_orders',compact('mainorders','orderparticulars','view_names'));
    }
	
	public function display1()
    {
        // $mainorders = MainOrder::all();
        // $orderparticulars = OrderParticular::all();
        $view_names = ViewList::where('page_name','=','DataTables_data_table_/list_all_orders')->get();
       // dd($view_names);
        return view('Orders/list_all_orders_ajax',compact('view_names'));
    }
	
	public function prepareSearchColumns($value){
		$searchColumns['main_orders.id'][] = $value;
		$searchColumns['main_orders.contact_person_name'][] = $value;
		$searchColumns['main_orders.mobile_number'][] = $value;
		$searchColumns['main_orders.email_id'][] = $value;
		$searchColumns['main_orders.organization_name'][] = $value;
		$searchColumns['main_orders.org_id'][] = $value;
		$searchColumns['main_orders.grand_total'][] = $value;
		$searchColumns['main_orders.is_active'][] = $value;
		$searchColumns['main_orders.created_at'][] = $value;
		$searchColumns['main_orders.updated_at'][] = $value;
		return $searchColumns;
	}
	
	public function displayAjax(Request $request){
		$dir = $request->input('order.0.dir');
		$draw = $request->get('draw');
		$start = $request->get("start");
		$rowperpage = $request->get("length"); // Rows display per page
		$columnIndex_arr = $request->get('order');
		$columnName_arr = $request->get('columns');
		$search_arr = $request->get('search');
		$searchColumnsJoin = array('products');
		if(!empty($search_arr['value'])){
			$searchColumns = $this->prepareSearchColumns($search_arr['value']);
		}else{
            foreach($columnName_arr as $key => $value){
                if(!empty($value['search']['value'])){
                    if(!in_array($value['data'],$searchColumnsJoin)){
                        $search_arr['value'] = $value['search']['value'];
                        $searchColumns['main_orders.'.$value['data']][] = $value['search']['value'];
                    }else{
                        $search_arr['value'] = $value['search']['value'];
                        $searchColumns['order_particulars.'.$value['data']][] = $value['search']['value'];
                    }
                }
            }
        }
		$order_arr = $request->get('order');
		$columnIndex = $columnIndex_arr[0]['column']; // Column index
		$columnName = 'main_orders.'.$columnName_arr[$columnIndex]['data']; // Column name
		$columnSortOrder = $order_arr[0]['dir']; // asc or desc
		$searchValue = $search_arr['value']; // Search value
		$totalRecordswithFilter = 0;

		$totalRecords = MainOrder::leftJoin('order_particulars', function($join) {
							$join->on('order_particulars.orders_id', '=', 'main_orders.id');
						})
						->select('count(*) as allcount')
						->count();
		
		if(!empty($search_arr['value'])) {
			$totalRecordswithFilter = MainOrder::leftJoin('order_particulars', function($join) {
											$join->on('order_particulars.orders_id', '=', 'main_orders.id');
										})->select('main_orders.*');
			if(!empty($searchColumns)){
				$totalRecordswithFilter = $totalRecordswithFilter->where(function($query) use ($searchColumns) {
					foreach($searchColumns as $k => $column){
						$query->where($k,'like','%'.$column[0].'%');
					}
				});
			}
			$totalRecordswithFilter = $totalRecordswithFilter->count();
	
			$records = MainOrder::leftJoin('order_particulars', function($join) {
							$join->on('order_particulars.orders_id', '=', 'main_orders.id');
						})->select('main_orders.updated_at','main_orders.id','main_orders.contact_person_name','main_orders.mobile_number','main_orders.organization_name','main_orders.grand_total','main_orders.is_active','main_orders.created_at','main_orders.button_disable',DB::raw("group_concat(order_particulars.products SEPARATOR', ') as products"));
			if(!empty($searchColumns)){
                $records = $records->where(function($query) use ($searchColumns) {
                    foreach($searchColumns as $k => $column){
                        $query->orWhere($k,'like','%'.$column[0].'%');
                    }
                });
			}
			$records = $records->groupBy('main_orders.updated_at','main_orders.id','main_orders.contact_person_name','main_orders.mobile_number','main_orders.organization_name','main_orders.grand_total','main_orders.is_active','main_orders.created_at','main_orders.button_disable')
						->orderBy($columnName,$columnSortOrder)
						->limit($rowperpage)
						->offset($start)
						->get();
		} else {
			$totalRecordswithFilter = $totalRecords;
			$records = MainOrder::leftJoin('order_particulars', function($join) {
							$join->on('order_particulars.orders_id', '=', 'main_orders.id');
						})
						->select('main_orders.updated_at','main_orders.id','main_orders.contact_person_name','main_orders.mobile_number','main_orders.organization_name','main_orders.grand_total','main_orders.is_active','main_orders.created_at','main_orders.button_disable',DB::raw("group_concat(order_particulars.products  SEPARATOR', ') as products"))
						->groupBy('main_orders.updated_at','main_orders.id','main_orders.contact_person_name','main_orders.mobile_number','main_orders.organization_name','main_orders.grand_total','main_orders.is_active','main_orders.created_at','main_orders.button_disable')
						->orderBy($columnName,$columnSortOrder)
						->limit($rowperpage)
						->offset($start)
						->get();
		}
		
		$response = array(
			"draw" => intval($draw),
			"recordsTotal" => $totalRecords,
			"recordsFiltered" => $totalRecordswithFilter,
			"data" => $records
		);
		echo json_encode($response);
		exit();
	}
}
