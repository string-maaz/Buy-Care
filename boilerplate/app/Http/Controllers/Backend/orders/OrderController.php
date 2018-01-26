<?php namespace App\Http\Controllers\Backend\orders;
use App\Http\Controllers\Controller;
use App\Newgenray\Magento;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;



class OrderController extends Controller {

    /**
     * @return \Illuminate\View\View
     */
    public function getAllOrders()
    {
        $orderitems =\ DB::table('order_items')->where('is_removed', 0)->get();
        return view('backend.orders.PrintLabelInvoice')->with('orderitems', $orderitems);
    }
    public function orderShipment(){
        $orderitems =\ DB::table('order_items')->where('tracking_number', '!=', 'NULL')->get();
        return view('backend.orders.orderandshipmentreport')->with('orderitems', $orderitems);
    }
    public function  todayFinalOrder(){
        $mage = new Magento();
       $supplierinfo= $mage->getSupplierName();

        return view('backend.orders.todaysfinalorder')->with('supplierinfo',$supplierinfo);
    }
    public function transitOrderReport(){
        $reportinfo = \DB::table('transit_final_reports')->select('transit_report_name','id','minimum_value')->where('inventory_updated',0)->get();

        $arr= $array = json_decode(json_encode($reportinfo), true);
        return view('backend.orders.transitorderreport')->with('arr',$arr);
    }
    public function importInventory(){
        $suppliername =\DB::table('import_inventory_updates')->groupBy('supplier_name')->get();
        $info= array();
        foreach($suppliername as $row){
            foreach($row as $key=> $value){
                $temp= array();
                $total_products=0;
                $updated_products=0;
                $new_products=0;
                $zero_inventory_products=0;
                $minimum_value=0;
                $supp_id=0;
                if($key=="supplier_name"){
                    $result = \DB::table('import_inventory_updates')->select('total_products','updated_products','new_products','zero_inventory_products','minimum_value','supplier_id')->where('supplier_name',$value)->get();
                    $temp[]=$value;
                    foreach($result as $inventory){

                        foreach($inventory as $key=> $inv){
                            if($key=='total_products'){
                                $total_products= $total_products + $inv;
                            }
                            if($key=='updated_products'){
                                $updated_products= $updated_products + $inv;
                            }
                            if($key=='new_products'){
                                $new_products= $new_products + $inv;
                            }
                            if($key=='zero_inventory_products'){
                                $zero_inventory_products= $zero_inventory_products + $inv;
                            }
                            if($key=='minimum_value'){
                                $minimum_value=$inv;
                            }
                            if($key=='supplier_id'){
                                $supp_id=$inv;

                            }
                        }


                    }
                }
               // $info= $result;
                $temp[]=$minimum_value;
                $temp[]=$total_products;
                $temp[]=$updated_products;
                $temp[]=$new_products;
                $temp[]=$zero_inventory_products;
                $temp[]=$supp_id;


          if(!empty($temp[0])){
                $info[]=$temp;
             }
            }
        }
        return view('backend.orders.importinventory')->with('info', $info);

    }
public function importinventory1data(){
    try{
        $v = Validator::Make(Input::all(),
            [
                '_token' => 'required',
                'supplier_id' =>'required'
            ]
        );
        if ($v->fails()) {
            return redirect()->back()->withInput()->withErrors($v->errors());
        } else {
            $data = Input::all();
            $supplier_id = $data['supplier_id'];
            $result= \DB::table('attribute_mapping')->select('id','magento_attribute','supplier_attribute')->where('supplier_id',$supplier_id)->get();
            $brr= array();
            foreach($result as $row){
                $arr= array();
                foreach($row as $key => $value){
                    $arr[]= $value;
                }
                $arr[]= "<button class='btn btn-primary imptable1remove'>Remove</button>";
                $brr[]=$arr;
            }


        }
    }
    catch(EntityNotValidException $e) {
        return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
    } catch(Exception $e) {
        return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
    }
    return json_encode($brr);

}
    public function importattributeupdate(){
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'magentoattr' =>'required',
                    'supplierattr'=> 'required',
                    'supplier_id'=>'required',
                    'supplier_name'=>'required'
                ]
            );
            if ($v->fails()) {
                return redirect()->back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                $supplier_id = $data['supplier_id'];
                $magentoattr= $data['magentoattr'];
                $supplierattr= $data['supplierattr'];
                $supplier_name =$data['supplier_name'];
                $j=0;
                $result= \DB::table('attribute_mapping')->where('supplier_id', $supplier_id)->delete();
                if(count($magentoattr)== count($supplierattr)){
                    $len= count($magentoattr);
                    for($i=0;$i<$len;$i++){
                    $newatttr =    \DB::table('attribute_mapping')->insert(array('supplier_id' => $supplier_id,'supplier_name'=>$supplier_name,'magento_attribute'=>$magentoattr[$i],'supplier_attribute'=>$supplierattr[$i]));
                        $j=1;

                    }
                }


            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        return $j ;
    }
    public function tortable1(){
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'report_id' =>'required'
                ]
            );
            if ($v->fails()) {
                return redirect()->back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                $report_id = $data['report_id'];
                $result= \DB::table('transit_final_products')->select('id','sku','supplier_product_name','qty','supplier_code','supplier_price','subtotal','vat')->where('transit_report_id',$report_id)->get();
               // $result = json_decode(json_encode($result), true);
                $brr= array();
                foreach($result as $row){
                    $arr= array();
                    $arr[]= "<input type='checkbox' class='todayscheckbox'/>";
                    foreach($row as $key => $value){
                        $arr[]= $value;
                    }
                    $brr[]=$arr;
                }


            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
      return json_encode($brr);
        //echo 'success';
    }

    public function holdOrder(){
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'hold_order_id' =>'required'
                ]
            );
            if ($v->fails()) {
                return redirect()->back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                print_r($data);
                $order_id = $data['hold_order_id'];
                foreach($order_id as $id)
                {
                    \ DB::table('order_items')
                        ->where('id', $id)
                        ->update(array('status' => 2));
                    $update_result=\ DB::table('order_items')->get();
                }


            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        echo 'success';
    }
    public function unholdOrder(){


        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'hold_order_id' =>'required'
                ]
            );
            if ($v->fails()) {
                return redirect()->back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                print_r($data);
                $order_id = $data['hold_order_id'];
                foreach($order_id as $id)
                {
                    \ DB::table('order_items')
                        ->where('id', $id)
                        ->update(array('status' => 1));
                    $update_result=\ DB::table('order_items')->get();
                }


            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        echo 'success';

    }
    public function cancelInvoice(){

        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'hold_order_id' =>'required'
                ]
            );
            if ($v->fails()) {
                return redirect()->back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                print_r($data);
                $order_id = $data['hold_order_id'];
                foreach($order_id as $id)
                {
                    \ DB::table('order_items')
                        ->where('id', $id)
                        ->update(array('print_count' => 0));
                    $update_result=\ DB::table('order_items')->get();
                }


            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        echo 'success';



    }
    public function removeOrder()
    {
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'hold_order_id' =>'required'
                ]
            );
            if ($v->fails()) {
                return redirect()->back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                print_r($data);
                $order_id = $data['hold_order_id'];
                foreach($order_id as $id)
                {
                    \ DB::table('order_items')
                        ->where('id', $id)
                        ->update(array('is_removed' => 1));
                    $update_result=\ DB::table('order_items')->get();
                }


            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        echo 'success';



    }

    public function cancelLabel()
    {
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'hold_order_id' =>'required'
                ]
            );
            if ($v->fails()) {
                return redirect()->back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                print_r($data);
                $order_id = $data['hold_order_id'];
                foreach($order_id as $id)
                {
                    \ DB::table('order_items')
                        ->where('id', $id)
                        ->update(array('label' => 1));
                    $update_result=\ DB::table('order_items')->get();
                }


            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        echo 'success';



    }

    public function trackOrder()
    {
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'hold_order_id' =>'required',
                    'track_no' => 'required'
                ]
            );
            if ($v->fails()) {
                return redirect()->back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                print_r($data);
                $order_id = $data['hold_order_id'];
                $tracking_number=$data['track_no'];
                $mytime = Carbon::now();
                $expected_date=Carbon::now();
                $expected_date= $expected_date->addDays(3);
                foreach($order_id as $id)
                {
                    \ DB::table('order_items')
                        ->where('id', $id)
                        ->update(array('tracking_number' => $tracking_number));
                    \ DB::table('order_items')
                        ->where('id', $id)
                        ->update(array('is_removed' => 1));

                }


            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        echo 'success';



    }

    public function updateThirdpartyOrder()

    {

        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'hold_order_id' =>'required',
                    'track_no' =>'required',
                    'orderfrom' =>'required',
                    'ordervalue' => 'required'
                ]
            );
            if ($v->fails()) {
                return redirect()->back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                print_r($data);
                $order_id = $data['hold_order_id'];
                $orderplacefrom=$data['orderfrom'];
                $ordervalue=$data['ordervalue'];
                $tracking_number=$data['track_no'];
                $created_time=date('d/m/Y == H:i:s');
                $updated_time=date('d/m/Y == H:i:s');

                foreach($order_id as $id)
                {
                    \ DB::table('order_items')
                        ->where('id', $id)
                        ->update(array('is_removed' => 1));
                    \ DB::table('order_from_third_parties')->insert([
                        ['order_item_id'=>$id,'order_place_from'=>$orderplacefrom,'order_value'=>$ordervalue,'tracking_number'=>$tracking_number,'created_at'=>$created_time,'updated_at'=>$updated_time]
                    ]);
                }


            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        echo 'success';



    }


    public function printInvoice(){
        $order_itemid=Array();
        $pdf='';
        $csv='';
        $labelhtml=null;
        $order_sku_id=Array();
        $response_data=Array();
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'item_id' =>'required',
                    'item_sku' =>'required',
                    'order_id' =>'required',
                    'invoice_action' =>'required',
                    'print_invoice' =>'required',
                ]
            );
            if ($v->fails()) {
                return redirect()->back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                //  print_r($data);
                $order_id = $data['order_id'];
                $item_id=$data['item_id'];
                $sort_order=$data['invoice_action'];
                $invoice_email=$data['print_invoice'];
                // var_dump($invoice_email);die;
                //var_dump($sort_order);
                foreach($item_id as $id)
                {
                    $itemid =\ DB::table('order_items')->where('id', $id)->value('order_item_id');
                    $orderid =\ DB::table('order_items')->where('id', $id)->value('order_id');
                    $sku =\ DB::table('order_items')->where('id', $id)->value('sku');
                    $printcount =\ DB::table('order_items')->where('id', $id)->value('print_count');
                    $printcount=$printcount+1;
                    \ DB::table('order_items')
                        ->where('id', $id)
                        ->update(array('print_count' => $printcount));

                    $order_itemid[$itemid]=$orderid;
                    $order_sku_id[$sku]=$orderid;
                }
                $order_itemid;
                //var_dump($order_itemid);
                $magento=new Magento;
                $pdf=  $magento->printActionLAravel($order_itemid,$sort_order,$invoice_email);
                $order_sku_id = array_unique($order_sku_id);
                if($sort_order=='order') {

                    $csv = $magento->printCsv($order_sku_id,$invoice_email);
                }
                else
                {

                    ksort($order_sku_id);
                    $csv= $magento->printCsv($order_sku_id,$invoice_email);
                }
                if($invoice_email=='Email')
                {
                    $magento->SendPrintEmail($pdf,$csv,$labelhtml);
                    // var_dump('here test');
                }
                //return PDF::loadFile(public_path().'/myfile.html')->save('app')->stream('download.pdf');
                // $pdf = PDF::loadView('pdf.invoice', $pdf);
                // return $pdf->download('invoice.pdf');
                //return $pdf;
                if($invoice_email=='Email')
                {
                    // var_dump('here');
                    return null;
                }
                else {
                    $response_data[0] = $pdf;
                    $response_data[1] = $csv;
                    echo json_encode($response_data);
                }}
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }


    }
    public function downloadAction(){
        var_dump('here');
        $pdf = $_POST['pdf'];
        $fileName = 'invoice' . date('m-d-y').'.pdf';
        var_dump($pdf);
        return response($pdf)
            ->header('Pragma', 'public')
            ->header('Content-Type', 'application/pdf')
            ->header('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
            ->header('Content-Length', strlen($pdf))
            ->header('Content-Disposition', 'attachment; filename="'.$fileName.'"', true);
        //->haeder('Last-Modified', date('r'), true);
    }


    public function resend(){
        var_dump('here');
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'order_id' =>'required'
                ]
            );
            if ($v->fails()) {
                return redirect()>back()->withInput()->withErrors($v->errors());
           } else {
                $data = Input::all();
                print_r($data);
                $order_id = $data['order_id'];

                foreach($order_id as $id)
                {
                    \DB::table('order_items')
                        ->where('id', $id)
                        ->update(array('label_color' => 'orange','tracking_number' =>'NULL','dispacted_date'=> 'NULL'));
                    $update_result=\ DB::table('order_items')->get();
                }


            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
       } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
       }
        echo 'success';

    }
    public function refund(){
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'order_id' =>'required'
                ]
            );
            if ($v->fails()) {
                return redirect()>back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                print_r($data);
                $order_id = $data['order_id'];

                foreach($order_id as $id)
                {
                    \DB::table('order_items')
                        ->where('id', $id)
                        ->update(array('is_refunded'=> '1'));
                    $update_result=\ DB::table('order_items')->get();
                }


            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        echo 'success';

    }
    public function genratefinal(){
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'product_id' =>'required',
                    'data_row'=>'required',
                    'type' =>'required',
                    'supplierid'=>'required',
                    'supplier_name'=>'required',
                    'minimumvalue' =>'required'
                ]
            );
            if ($v->fails()) {
                return redirect()>back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                $productid = $data['product_id'];
                $type =$data['type'];
                $supplierid =$data['supplierid'];
                $suppliername=$data['supplier_name'];
                $transitid=$suppliername."-".date('y/m/d');
                $rowdata=$data['data_row'];
                $minimumvalue= $data['minimumvalue'];
                  \DB:: table('transit_final_reports')->insert(array('transit_report_name'=> $transitid,'supplier_id'=> $supplierid,'supplier_name'=>$suppliername,'minimum_value'=> $minimumvalue,'inventory_updated'=>0));
                $result= \DB::table('transit_final_reports')->select('id')->where('transit_report_name',$transitid)->get();
               // $result =  (array)$result;
                $array = json_decode(json_encode($result), true);
                foreach($rowdata as $data_toinsert)
                {
                            \DB::table('transit_final_products')->insert(array('transit_report_id' => $array[0]['id'], 'supplier_product_name' => $data_toinsert[1], 'sku' => $data_toinsert[2], 'product_id' => $data_toinsert[0], 'supplier_code' => $data_toinsert[4], 'qty' => $data_toinsert[3], 'supplier_price' => $data_toinsert[5], 'subtotal' => $data_toinsert[6], 'vat' => $data_toinsert[7]));
                }


                $mage = new Magento();
                $mail= $mage->emailOrderReservation($productid,$type,$supplierid);




            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        return "success";


    }
    public function importTrackingFile()
    {
        // var_dump($_POST);
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'file'=>'required'
                ]
            );
            if ($v->fails()) {
                return redirect()->back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                $file=$data['file'];
                $magento_file=$data['file'];
                $destination=public_path().'\upload';

                //  move_uploaded_file($magento_file, $destination.'/filenew.csv');

                //  var_dump($data['file']);die();


                $fp = fopen($file, "r");
                $line   = 1;
                if($fp) {
                    while (!feof($fp)) {

                        $tmp = fgets($fp); /*Reading a file line by line*/
                        $existZipcode = false;
                        if($line>1) {
                            $content = str_replace('"', '', $tmp);
                            $trackInfo = explode(',', $content);
                            if (count($trackInfo)) {
                                /*$carrierName = $trackInfo[1];*/
                                $trackingCode = $trackInfo[16];
                                $orderIncId = $trackInfo[15];
                                if ($orderIncId) {
                                    if ($trackingCode) {
                                        //if($carrierName){

                                        $mytime = Carbon::now();
                                        $expected_date=Carbon::now();
                                        $expected_date= $expected_date->addDays(3);
                                        // $this->creteShipment($orderIncId,$trackingCode);

                                        \ DB::table('order_items')
                                            ->where('increment_id', $orderIncId)
                                            ->update(array('tracking_number' => $trackingCode));
                                        \ DB::table('order_items')
                                            ->where('increment_id', $orderIncId)
                                            ->update(array('is_removed' => 1));
                                        \ DB::table('order_items')
                                            ->where('increment_id', $orderIncId)
                                            ->update(array('dispatched_date' => $mytime));
                                        \ DB::table('order_items')
                                            ->where('increment_id', $orderIncId)
                                            ->update(array('expected_delivery_date' => $expected_date));




                                        //}else{
                                        //$errors[] = $this->__('Service name not found at line '. $line);
                                        // }
                                    }
                                }
                            }

                        }
                        $line=$line+1;
                    }
                }

                //magento update
                $file_string='';
                // $magento_file.move($destination, 'file_uploaded.csv');
                move_uploaded_file($magento_file, $destination.'/file_uploaded.csv');
                // $fp = fopen($destination.'/file_uploaded.csv', "w");
                $filename=$destination.'/'.time().'magentofile.csv';
                $fp = fopen($magento_file,'r');

                $line   = 1;
                if($fp) {
                    while (!feof($fp)) {
                        $flag = 'true';

                        $tmp = fgets($fp); /*Reading a file line by line*/
                        $existZipcode = false;
                        if ($line <= 1) {
                            $myfile = fopen($filename, "a+");
                            //  var_dump('label check');
                            fwrite($myfile, $tmp);
                        }
                        $line=$line+1;
                    }
                }

                $fp = fopen($magento_file,'r');

                $line   = 1;
                if($fp) {
                    while (!feof($fp)) {
                        $flag='true';

                        $tmp = fgets($fp); /*Reading a file line by line*/
                        $existZipcode = false;
                        if($line>1) {
                            $content = str_replace('"', '', $tmp);
                            $trackInfo = explode(',', $content);
                            if (count($trackInfo)) {
                                /*$carrierName = $trackInfo[1];*/
                                $trackingCode = $trackInfo[16];
                                $orderIncId = $trackInfo[15];
                                if ($orderIncId) {
                                    if ($trackingCode) {
                                        //if($carrierName){


                                        // $this->creteShipment($orderIncId,$trackingCode);
                                        $label_color =\ DB::table('order_items')
                                            ->where('increment_id','=', $orderIncId)->get();
                                        foreach($label_color as $results)
                                        {
                                            if($results->label_color!='green')
                                            {

                                                $flag='false';
                                                break;
                                            }
                                        }

                                    }
                                }
                            }

                            if($flag == 'true')
                            {
                                $myfile = fopen($filename, "a+");
                                //  var_dump('label check');
                                fwrite($myfile, $tmp);

                                // $magento_file = str_replace($tmp, '', $magento_file);

                            }
                        }
                        $line=$line+1;

                    }
                }
                fclose($myfile);

                $magento=new Magento;
                $magento->moveFileToMagento($filename);
                // $magento->getSupplierName();

                //ndys check
                //$days=10;
                $suppliername='HBSupplies.co.uk';
                //  $magento->lastNDaysProduct($days,$suppliername);
//end

                // $magento->emailOrderReservation($productid=null,$type=null,$supplierid=null);
            }
        }
        catch(EntityNotValidException $e) {

            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        echo 'success';



    }

    public function addRowToImportInventory()
    {

        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required'

                ]
            );
            if ($v->fails()) {
                return redirect()->back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                // print_r($data);
                $magento=new Magento();
                $attributelist=  $magento->getAttributeList();
                $i=0;
//                foreach($attributelist as  $attribute)
//                {
//
//                    $response_data[$i] = $attribute;
//                    $i++;
//                }


                //return json_encode($attributelist);
            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        return $attributelist;




    }
    public function todaysreserv(){
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'product_id' =>'required',
                    'type' =>'required',
                    'supplierid'=>'required'
                ]
            );
            if ($v->fails()) {
                return redirect()>back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                print_r($data);
                $productid = $data['product_id'];
                $type =$data['type'];
                $supplierid =$data['supplierid'];

                $mage = new Magento();
                $lastndayinfo= $mage->emailOrderReservation($productid,$type,$supplierid);




            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        return "";
    }
    public function gettodaytable1(){
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'supplier_id' =>'required'
                ]
            );
            if ($v->fails()) {
                return redirect()>back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                //print_r($data);
                $order_id = $data['supplier_id'];

                $result=\ DB::table('order_items')->select('order_id','supplier_product_name','ordered_qty','sku','supplier_code','supplier_price')->where('supplier_code',$order_id )->get();
                $brr =array();
                foreach($result as $row){
                    $arr= array();
                    $arr[]= "<input type='checkbox' class='todayscheckbox'/>";
                    foreach($row as $key => $value){

                        if($key== 'ordered_qty'){
                            $arr[]=$value;
                            $arr[]=1;
                        }
                        else{
                            $arr[]=$value;
                        }
                        if($key=='supplier_price'){
                            $supprice= $value;
                        }
                        if($key == 'ordered_qty'){
                            $qty= $value;
                        }
                    }
                    $subtotal=$supprice*$qty;
                    $arr[]=$subtotal;
                    $arr[]=$subtotal*.2;
                    $arr[]= "no action";
                    $brr[]=$arr;
                }

               // return Datatables::of($result)->make(true);


            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
       return json_encode($brr);
    }
    public function gettodaytable2(){
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'supplier_id' =>'required',
                    'selecteddays'=> 'required',
                    'supp_product_name'=> 'required'
                ]
            );
            if ($v->fails()) {
                return redirect()>back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                $supplier_id = $data['supplier_id'];
                $selecteddays = $data['selecteddays'];
                $supp_product_name= $data['supp_product_name'];
                $mage = new Magento();
                $lastndayinfo = $mage->lastNDaysProduct($selecteddays,$supplier_id);
                $i=1;
                $result= array();
                $brr= array();
                foreach($lastndayinfo as $rows) {
                    $k=0;
                    foreach($supp_product_name as $key => $value){
                    if ($rows['supplier_product_name'] == $value && $k==0) {
                        $k=1;
                    }
                    }
                    if($k!=1){
                        $result[]=$rows;
                    }
                }
                    foreach($result as $row){
                    $arr= array();
                    $arr[]=$i;
                    $i++;
                    foreach($row as $key => $value){
                        if($key==2){
                            $arr[]= $value;
                            $arr[]=$supplier_id;
                        }else{
                            $arr[]=$value;
                        }
                        }
                    $arr[]="<button class='addabove btn btn-primary'>Add above</button>";
                    $brr[]= $arr;

                }
            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        print_r(json_encode($brr));
       // return true;
        //return json_encode($brr);

    }
    public function transitquantityupdate(){
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'current_value' =>'required',
                    'product_sku' => 'required',
                    'sub_total' => 'required',
                    'tor_vat' => 'required'
                ]
            );
            if ($v->fails()) {
                return redirect()>back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                $quantity = $data['current_value'];
                $sku = $data['product_sku'];
                $sub_total= $data['sub_total'];
                $tor_vat = $data['tor_vat'];

                if( \DB :: Table('transit_final_products')->Where('sku',$sku)->update(array('qty'=>$quantity,'subtotal'=>$sub_total,'vat'=>$tor_vat))){
                    $result=1;
                }else{
                    $result=0;
                }


            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        return  $result;

    }
	
	
  
    public  function updateInventoryFile()
{

    try{
        $v = Validator::Make(Input::all(),
            [
                '_token' => 'required',
                'file'=>'required'
            ]
        );
        if ($v->fails()) {
            return redirect()->back()->withInput()->withErrors($v->errors());
        } else {
            $data = Input::all();
            $supplierId = 1; /*will get dynamically*/
            /*$supplierId = $data['sId'];*/
            $file_parts = pathinfo($_FILES['file']['name']);
            if($file_parts['extension'] == 'csv'){
                /*upload file*/
                $inventoryFile = $data['file'];
                $filename = public_path().'\upload'.'/'.time().'inventoryfile.csv';
                if(move_uploaded_file($inventoryFile, $filename)){
                    $magentoObject = new Magento();
                    if($magentoObject->setProductInventory($supplierId,$filename))
                    {
                        unlink($filename);
                    }
                }else{
                    /*problem in upload file*/
                }
            }else{
                /*extension validaion*/
            }
        }
    }
    catch(EntityNotValidException $e) {

        return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
    } catch(Exception $e) {
        return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
    }
    echo 'success';

}
	 public  function toraddproduct()
    {

        try{
            $json = array();
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required'
                ]
            );
            if ($v->fails()) {
                $json['data'] = false;
                $json['msg'] = 'validation fails';
                return redirect()->back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                $sCode = $data['scode'];
                $qty = $data['qty'];
                /*$transitId = $data['tid'];*/
                $transitId = 1;
                $magentoObject = new Magento();
                if($pData = $magentoObject->getProductBySCode($sCode)){
                    \DB::table('transit_final_products')->insert(
                        ['transit_report_id' => $transitId,'product_name' => $pData["product_name"],'supplier_product_name' => $pData["supplier_product_name"],'sku' => $pData["sku"],'product_id'=>$pData["product_id"],'supplier_code'=>$pData["supplier_code"],'qty'=>$qty,'supplier_price'=>$pData["supplier_price"],'subtotal'=> (int)$qty * (float)$pData["supplier_price"],'vat'=> 0, 'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
                    );
                    $json['data'] = true;
                    $json['msg'] = 'product add successfully';
                }else{
                    $json['data'] = false;
                    $json['msg'] = 'sCode not found in magento';
                }
            }
        }
        catch(EntityNotValidException $e) {
            $json['data'] = false;
            $json['msg'] = $e->validationErrors();
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            $json['data'] = false;
            $json['msg'] = $e->getMessage();
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
        echo json_encode($json);
    }
    public function imptable2(){
        try{
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required',
                    'supplier_id' =>'required'
                ]
            );
            if ($v->fails()) {
                return redirect()>back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                $supplier_id= $data['supplier_id'];


                $result= \DB::table('new_products')->where('supplier_id',$supplier_id);
                print_r($result);


            }
        }
        catch(EntityNotValidException $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }
       // return  $result;
    }

    public function addProductToMage(){
        try{
            $json = array();
            $v = Validator::Make(Input::all(),
                [
                    '_token' => 'required'
                ]
            );
            if ($v->fails()) {
                $json['data'] = false;
                $json['msg'] = 'validation fails';
                return redirect()->back()->withInput()->withErrors($v->errors());
            } else {
                $data = Input::all();
                $data =  $suppler = \DB::table('new_products')
                    ->where('id', $data['rowid'])
                    ->where('added_in_magento', 0)
                    ->where('is_removed', 0)
                    ->first();
                $magentoObject = new Magento();
                if($magentoObject->addNewProduct($data)){
                    /*update new product table*/
                    \DB::table('new_products')
                        ->where('id', $data->id)
                        ->update(array('added_in_magento' => 1,'updated_at' =>Carbon::now()));
                    /*add inventory table*/

                    $json['data'] = true;
                    $json['msg'] = 'product update in magento successfully';
               }else{
                    $json['data'] = false;
                    $json['msg'] = 'product not updfate in magento';
                }
            }
        }
        catch(EntityNotValidException $e) {
            $json['data'] = false;
            $json['msg'] = $e->validationErrors();
            return Redirect::back()->withInput()->withFlashDanger($e->validationErrors());
        } catch(Exception $e) {
            $json['data'] = false;
            $json['msg'] = $e->getMessage();
            return Redirect::back()->withInput()->withFlashDanger($e->getMessage());
        }

        echo json_encode($json);
    }
}

?>