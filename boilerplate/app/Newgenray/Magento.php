<?php
/**
 * Created by PhpStorm.
 * User: Pankaj
 * Date: 10-12-2015
 * Time: 17:10
 */
namespace App\Newgenray;

require_once(__DIR__ . '/../../../buycare_live/app/Mage.php');
use Mage;


class Magento{

    const LOAD_PRODUCT_FOR_INVENTORY = 'supplier_product_id';
    const MAGENTOBUYCARE = 'buycare_live';

    public function __construct()
    {
        umask(0);
        Mage::app();
    }

    public function getOrders()
    {
        // $orderCollection = Mage::getModel('sales/order')->getCollection();
        $modelsupplier=Mage::getSingleton('newgenray_supplier/supplier');
        // var_dump($orderCollection);
        var_dump($modelsupplier);
    }
    public function printAction($itemids)

    {
        $flag = false;
        if (!empty($itemids)) {
            $orderIds = array_unique($itemids);
            foreach ($orderIds as  $itemId => $orderId) {
                $invoices = Mage::getResourceModel('sales/order_invoice_collection')
                    ->setOrderFilter($orderId)
                    ->load();
                $orderInStockItems = array();
                foreach($itemids  as  $key=>$val ) {
                    if($val == $orderId){
                        $orderInStockItems[$key] = $val;
                    }
                }
                if ($invoices->getSize() > 0) {
                    $flag = true;
                    if (!isset($pdf)){
                        $pdf = Mage::getModel('sales/order_pdf_invoice')->getSupplierPdfForLarvel($invoices,$orderInStockItems);
                        //$pdf = $this->getSupplierPdf($invoices,$orderInStockItems);

                    } else {
                        $pages = Mage::getModel('sales/order_pdf_invoice')->getSupplierPdfForLarvel($invoices,$orderInStockItems);

                        $pdf->pages = array_merge ($pdf->pages, $pages->pages);

                    }
                    // $this->setOrderPrintCount($orderId);
                }
            }



            /*get orderid from itemid*/

            if ($flag) {
                return $pdf->render();



            }

            else {
                return false;
            }
        }

        else{
            return false;
        }

    }






    public function  printActionLAravel($itemid,$sort_order,$invoice_email)
    {
        $invoice_email=$invoice_email;
        $sort_order=$sort_order;
        $itemids=$itemid;
        $modelsupplier=Mage::getSingleton('newgenray_supplier/supplier');
        $pdf = $modelsupplier->printActionLarvel($itemids,$sort_order,$invoice_email);
        return $pdf;
    }
    public function printCsv($orderid,$invoice_email)
    {
        $invoice_email=$invoice_email;
        $orderId=$orderid;
        $modelsupplier=Mage::getSingleton('newgenray_supplier/supplier');
        $csv= $modelsupplier->shippingLabelHtmlLaravel($orderId,$invoice_email);
        return $csv;
    }

    public Function SendPrintEmail($pdf ,$csv,$labelhtml)
    {
        $pdf=$pdf;
        $csv=$csv;
        $labelhtml=$labelhtml;
        $modelsupplier=Mage::getSingleton('newgenray_supplier/supplier');
        return   $modelsupplier->SendPrintEmail($pdf,$csv,$labelhtml);
    }

    public function importTrackingLArvel($filename)
    {
        // $path = Mage::getBaseDir('media') . DS;;
        // var_dump($path);

        $filename=$filename;
        Mage::helper('newgenray_supplier')->importTrackingLArvel($filename);
        return 'success';
    }
    public function moveFileToMagento($path)
    {
        $pathmagento = Mage::getBaseDir('media') . DS.time().'magentofile.csv';
        rename($path, $pathmagento);
        $this->importTrackingLArvel($pathmagento);
        var_dump('here');
        return 'success';

    }

    /* public function getSupplierName(){
         $suppliername= Array();
         $result= Mage::getModel('modulemart_suppliers/supplier')->getCollection()->getData();
         var_dump($result);
         foreach($result as $results)
         {
            foreach($results as $key=>$value)
                                            {
                                    if($key=='supplier_name')
                                                              {
                                                              $suppliername[]=$value;

                                                              }
                                                       }
                                               }


         return $suppliername;
     }*/
    public function getSupplierName(){
        $suppliername= Array();
        $results= Mage::getModel('modulemart_suppliers/supplier')->getCollection()->getData();
        return $results;
    }

    public function lastNDaysProduct($days,$suppliername)
    {
        $days=$days;
        $suppliername=$suppliername;
        $modelsupplier=Mage::getSingleton('newgenray_supplier/supplier');
        $data=  $modelsupplier->lastNDaysproduct($days,$suppliername);
        var_dump($data);
    }
    public function emailOrderReservation($productid,$type,$supplierid)
    {
        $modelsupplier=Mage::getSingleton('newgenray_supplier/supplier');
        $modelsupplier->sendMailToSupplierLarvel($productid,$type,$supplierid);
    }

    public function getAttrCode($val,$sId){
        $val = trim($val);
        $attribute = \DB::table('attribute_mapping')
                ->where('supplier_id', $sId)
                ->where('supplier_attribute', $val)
                ->first();
        return $attribute->magento_attribute;
    }
    public Function getAttributeList()
    {
        $attributelist=Array();
        $attributes = Mage::getResourceModel('catalog/product_attribute_collection');
        $i=0;
        foreach($attributes as $attribute)
        {
            $attributelist[$i]= $attribute->getAttributeCode();
            $i++;
        }
        return $attributelist;
    }


    public function setProductInventory($supplierId,$filename){
        $fp     = @fopen($filename, 'r');
        $line   = 1;
        $errors = array();
        if($fp){
            $code = array();
            $updatedCount = 0;
            $newProductCount = 0;
            $productUpdateCount = 0;
            $zeroInventoryProducts = 0;
            while (!feof($fp)) {
                $tmp = fgets($fp); /*Reading a file line by line*/
                $content      = str_replace('"', '', $tmp);
                $csvArray = explode(',', $content);
                if($line == 1){
                    /*set code in array*/
                    foreach($csvArray as $val){
                        /*get attribute code from attribute_mapping table */
                        $code[] = $this->getAttrCode($val,$supplierId);
                    }

                }else if($line >1){
                    /*search suppler product id index in code array*/
                    $sPidIndex = array_search($this::LOAD_PRODUCT_FOR_INVENTORY, $code);
                    if($sPidIndex){
                        $sPId = $csvArray[$sPidIndex];
                        $magProduct = Mage::getModel('catalog/product')
                                ->getCollection()
                                ->addFieldToFilter($this::LOAD_PRODUCT_FOR_INVENTORY,$sPId)
                                ->getFirstItem();
                        if($magePId = $magProduct->getId()){
                            $productUpdateCount++;
                            /*update product*/
                            $data = array();
                            foreach($csvArray as $key=>$val) {
                                if ($code[$key]) {
                                    $mediaAttribute = array(
                                        'thumbnail',
                                        'small_image',
                                        'image',
                                        'ebay_product_image'
                                    );
                                    $galleryAttribute = 'gallery';
                                    if ($code[$key] == 'qty') {
                                        /*update product inventory*/
                                        if ((int)$val > 0) {
                                            $stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($magProduct->getId());
                                            $stockItem->setData('manage_stock', 1);
                                            $stockItem->setData('is_in_stock', 1);
                                            $stockItem->setData('qty', (int)$val);
                                            $stockItem->save();
                                        }
                                    } else if ($code[$key] == 'gallery') {

                                    } else if (in_array($code[$key], $mediaAttribute)) {
                                        $content = file_get_contents($val);
                                        $info = pathinfo($val);
                                        $importDirectory = base_path() . '/../'.$this::MAGENTOBUYCARE.'/media/import';
                                        $filePath = $importDirectory . '/' . time() . $info['basename'];
                                        file_put_contents($filePath,$content);
                                        /*set into product*/
                                        if (file_exists($filePath)) {
                                            Mage::getModel('catalog/product')
                                                ->load($magProduct->getId())->addImageToMediaGallery($filePath, $code[$key], false,false)
                                                ->save();
                                        }
                                    } else {
                                        $data[$code[$key]] = $val;
                                    }
                                }
                            }
                            Mage::getModel('catalog/product')
                                ->load($magProduct->getId())
                                ->addData($data)
                                ->save();
                            $updatedCount++;
                            /*check product stock*/
                            $stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($magProduct->getId())
                                ->getIsInStock();
                            if($stock == 0){
                                $zeroInventoryProducts ++;
                            }
                            unset($stock);
                        }else{
                            $productUpdateCount++;
                            /*save data into new_products table*/
                            $tempSku = time();
                            $suppler = \DB::table('modulemart_suppliers_supplier')
                                    ->where('entity_id', $supplierId)
                                    ->first();
                            $pNameIndex = array_search('name', $code);
                            $sPidIndex = array_search($this::LOAD_PRODUCT_FOR_INVENTORY, $code);
                            $pName = $csvArray[$pNameIndex];
                            $sPId = $csvArray[$sPidIndex];
                            $text = array();
                            foreach($csvArray as $key => $val){
                                if($key != $sPidIndex || $key != $pNameIndex){
                                    $text[$code[$key]] = $val;
                                }
                            }
                            $text = serialize($text);
                            \DB::table('new_products')->insert(
                                ['supplier_id' => $supplierId,'supplier_name' => $suppler->supplier_name,'temporary_sku' => $tempSku,'product_name' => $pName,'supplier_product_id'=>$sPId,'text'=>$text,'created_at'=>Mage::getModel('core/date')->date('Y-m-d H:i:s'),'updated_at'=>Mage::getModel('core/date')->date('Y-m-d H:i:s')]
                            );
                            unset($tempSku);
                            $newProductCount++;
                        }
                    }
                }
                echo $line;
                $line++;
            }
            $suppler = \DB::table('modulemart_suppliers_supplier')
                ->where('entity_id', $supplierId)
                ->first();
            \DB::table('import_inventory_updates')->insert(
                ['supplier_id' => $supplierId,'supplier_name' => $suppler->supplier_name,'total_products' => $newProductCount,'updated_products' => $updatedCount,'new_products'=>$newProductCount,'zero_inventory_products'=> $zeroInventoryProducts,'created_at'=>Mage::getModel('core/date')->date('Y-m-d H:i:s'),'updated_at'=>Mage::getModel('core/date')->date('Y-m-d H:i:s')]
            );
        }

        return true;
    }

    public function getProductBySCode($sCode){

        $data = array();
        $mageProduct = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('supplier_product_name')
            ->addAttributeToSelect('supplier_product_price')
            ->addFieldToFilter($this::LOAD_PRODUCT_FOR_INVENTORY,$sCode)
            ->getFirstItem();
        if($mageProduct->getId()){
            $data['product_name'] = $mageProduct->getName();
            $data['supplier_product_name'] = $mageProduct->getSupplierProductName(); //may be change in new magento
            $data['sku'] = $mageProduct->getSku();
            $data['product_id'] = $mageProduct->getId();
            $data['supplier_code'] = $sCode;//may be change in new magento
            $data['supplier_price'] = $mageProduct->getSupplierProductPrice(); //may be change in new magento
            return $data;
        }

        return false;
    }

    public function addNewProduct($data){
        /*Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);*/
        $product = Mage::getModel('catalog/product');
        $pData = unserialize($data->text);
        $zeroInventoryProducts = 0;
        try{
            $product
            //    ->setStoreId(1) //set data in store scope
                ->setWebsiteIds(array(1)) //website ID the product is assigned to, as an array
                ->setAttributeSetId(4) //ID of a attribute set named 'default'
                ->setTypeId('simple') //product type
                ->setCreatedAt(strtotime('now')) //product creation time
                ->setUpdatedAt(strtotime('now')) //product update time
                ->setSku($data->temporary_sku) //SKU
                ->setName($data->product_name) //product name
                ->setStatus(1) //product status (1 - enabled, 2 - disabled)
                ->setTaxClassId(0) //tax class (0 - none, 1 - default, 2 - taxable, 4 - shipping)
                ->setVisibility(1) //catalog and search visibility
                /*may be change*/
                ->setSupplierName($data->supplier_name)
                ->setSupplierProductId($data->supplier_product_id);
                /*end*/
                //->setCategoryIds(array(3, 10)); //assign product to categories

                if(isset($pData['qty'])){
                    if((int)$pData['qty'] > 0){
                        $product->setStockData(array(
                           'use_config_manage_stock' => 0, //'Use config settings' checkbox
                           'manage_stock'=>1, //manage stock
                           'is_in_stock' => 1, //Stock Availability
                           'qty' => (int)$pData['qty'] //qty
                        ));
                    }else{
                        $product->setStockData(array(
                            'use_config_manage_stock' => 0, //'Use config settings' checkbox
                            'manage_stock'=>1, //manage stock
                            'is_in_stock' => 0, //Stock Availability
                            'qty' => (int)$pData['qty'] //qty
                        ));
                        /*Zero Inventory Products*/
                        $zeroInventoryProducts = 1;
                    }
                    unset($pData['qty']);
                }
                if(isset($pData['thumbnail'])){
                    $content = file_get_contents($pData['thumbnail']);
                    $info = pathinfo($pData['thumbnail']);
                    $importDirectory = base_path() . '/../'.$this::MAGENTOBUYCARE.'/media/import';
                    $filePath = $importDirectory . '/' . time() . $info['basename'];
                    file_put_contents($filePath,$content);
                    /*set into product*/
                    if (file_exists($filePath)) {
                        $product->addImageToMediaGallery($filePath, 'thumbnail', false,false);
                    }
                    unset($pData['thumbnail']);
                }if(isset($pData['small_image'])){
                    $content = file_get_contents($pData['small_image']);
                    $info = pathinfo($pData['small_image']);
                    $importDirectory = base_path() . '/../'.$this::MAGENTOBUYCARE.'/media/import';
                    $filePath = $importDirectory . '/' . time() . $info['basename'];
                    file_put_contents($filePath,$content);
                    /*set into product*/
                    if (file_exists($filePath)) {
                        $product->addImageToMediaGallery($filePath, 'small_image', false,false);
                    }
                    unset($pData['small_image']);
                }if(isset($pData['image'])){
                    $content = file_get_contents($pData['image']);
                    $info = pathinfo($pData['image']);
                    $importDirectory = base_path() . '/../'.$this::MAGENTOBUYCARE.'/media/import';
                    $filePath = $importDirectory . '/' . time() . $info['basename'];
                    file_put_contents($filePath,$content);
                    /*set into product*/
                    if (file_exists($filePath)) {
                        $product->addImageToMediaGallery($filePath, 'image', false,false);
                    }
                    unset($pData['image']);
                }if(isset($pData['ebay_product_image'])){
                    $content = file_get_contents($pData['ebay_product_image']);
                    $info = pathinfo($pData['ebay_product_image']);
                    $importDirectory = base_path() . '/../'.$this::MAGENTOBUYCARE.'/media/import';
                    $filePath = $importDirectory . '/' . time() . $info['basename'];
                    file_put_contents($filePath,$content);
                    /*set into product*/
                    if (file_exists($filePath)) {
                        $product->addImageToMediaGallery($filePath, 'ebay_product_image', false,false);
                    }
                    unset($pData['ebay_product_image']);
                }

                $product->addData($pData);
                if($product->save()){
                    \DB::table('import_inventory_updates')->insert(
                        ['supplier_id' => $data->supplier_id,'supplier_name' => $data->supplier_name,'total_products' => 0,'updated_products' => 1,'new_products'=>-1,'zero_inventory_products'=> $zeroInventoryProducts,'created_at'=>Mage::getModel('core/date')->date('Y-m-d H:i:s'),'updated_at'=>Mage::getModel('core/date')->date('Y-m-d H:i:s')]
                    );

                    return trues;
                }
            return false;
        }catch(Exception $e){
            return false;
        }
    }

}
