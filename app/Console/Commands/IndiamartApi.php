<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\IndiaMart;
use Carbon\Carbon;

class IndiamartApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'IndiamartApi:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info("Indimart crone");
        try {
            $url="https://mapi.indiamart.com/wservce/crm/crmListing/v2/?glusr_crm_key=mR21Fr5l5HzJTfer5HKN7l6OpVXDmQ==";
            // $url="https://mapi.indiamart.com/wservce/crm/crmListing/v2/?glusr_crm_key=mR21Fr5l5HzJTfer5HKN7l6OpVXDmQ==&start_time=03-Oct-2022&end_time=05-Oct-2022";
            $response=json_decode(file_get_contents($url));
            Log::info(json_encode($response));
            Log::info($response->CODE);
            if($response->CODE==200){
                $responses=$response->RESPONSE;
                $data_arr=[];
                foreach ($responses as $res) {
                    $data=[
                        "byer_name"=>$res->SENDER_NAME,
                        "address"=>$res->SENDER_ADDRESS,
                        "mobile"=>$res->SENDER_MOBILE,
                        "email"=>$res->SENDER_EMAIL,
                        "description"=>$res->QUERY_PRODUCT_NAME,
                        "quantity"=>1,
                        "created_at"=>Carbon::now(),
                        "updated_at"=>Carbon::now()
                    ];
                    array_push($data_arr,$data);
                }
                IndiaMart::insert($data_arr);
            }
        } catch (\Exception $e) {
            Log::info("exception");
            Log::info($e);
            Log::info($e->getMessage());
        }
    }
}
