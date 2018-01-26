<?php
/**
 * Switch between the included languages
 */
$router->group(['namespace' => 'Language'], function () use ($router)
{
	require(__DIR__ . "/Routes/Language/Lang.php");
});

/**
 * Frontend Routes
 * Namespaces indicate folder structure
 */
$router->group(['namespace' => 'Frontend'], function () use ($router)
{
	require(__DIR__ . "/Routes/Frontend/Frontend.php");
	require(__DIR__ . "/Routes/Frontend/Access.php");
});

/**
 * Backend Routes
 * Namespaces indicate folder structure
 */
$router->group(['namespace' => 'Backend'], function () use ($router)
{
	$router->group(['prefix' => 'admin', 'middleware' => 'auth'], function () use ($router)
	{

		/**
		 * These routes need view-backend permission (good if you want to allow more than one group in the backend, then limit the backend features by different roles or permissions)
		 *
		 * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
		 */
		$router->group(['middleware' => 'access.routeNeedsPermission:view-backend'], function () use ($router)
		{
			require(__DIR__ . "/Routes/Backend/Dashboard.php");
			require(__DIR__ . "/Routes/Backend/Access.php");
			require(__DIR__ . "/Routes/Backend/LogViewer.php");


			Route::get('/order-shipment-report', [
				'as' => 'ordershipment', 'uses' => 'orders\OrderController@orderShipment'
			]);
			Route::get('/todays-final-order', [
				'as' => 'todays-final-order', 'uses' => 'orders\OrderController@todayFinalOrder'
			]);
			Route::get('/transit-order-report', [
				'as' => 'transitreport', 'uses' => 'orders\OrderController@transitOrderReport'
			]);
			Route::get('/import-inventory', [
				'as' => 'importInventory', 'uses' => 'orders\OrderController@importInventory'
			]);
			Route::get('/print-label-invoice', [
				'as' => 'printlabel', 'uses' => 'orders\OrderController@getAllOrders'
			]);
			Route::post('/resend',[
				'as' => 're-send', 'uses' => 'orders\OrderController@resend'
			]);
			Route::post('/refund',[
				'as' => 'refund', 'uses' => 'orders\OrderController@refund'
			]);
			Route::post('/genratefinal',[
				'as' => 'genratefinal', 'uses' => 'orders\OrderController@genratefinal'
			]);
			Route::post('/todaysreserv',[
				'as' => 'todaysreserv', 'uses' => 'orders\OrderController@todaysreserv'
			]);
			Route::post('/gettodaytable1',[
				'as' => 'gettodaytable1', 'uses' => 'orders\OrderController@gettodaytable1'
			]);
			Route::post('/gettodaytable2',[
				'as' => 'gettodaytable2', 'uses' => 'orders\OrderController@gettodaytable2'
			]);
			Route::post('/transitquantityupdate',[
				'as' => 'transitquantityupdate', 'uses' => 'orders\OrderController@transitquantityupdate'
			]);
			Route::post('/toraddproduct',[
				'as' => 'toraddproduct', 'uses' => 'orders\OrderController@toraddproduct'
			]);
			/*vikas*/
			Route::post('/addProductToMage',[
				'as' => 'addProductToMage', 'uses' => 'orders\OrderController@addProductToMage'
			]);
			/*end*/
			//gopal
			Route::post('/add/row', [
				'as' => 'add-row','uses' => 'orders\OrderController@addRowToImportInventory'
			]);
			Route::post('/update/inventory', [
				'as' => 'update-inventory','uses' => 'orders\OrderController@updateInventoryFile'
			]);
			Route::get('/print-label-invoice', [
				'as' => 'printlabel', 'uses' => 'orders\OrderController@getAllOrders'
			]);
			Route::post('/hold/order', [ 'as' => 'hold-order','uses' => 'orders\OrderController@holdOrder'
			]);
			Route::post('/unhold/order', [ 'as' => 'unhold-order','uses' => 'orders\OrderController@unholdOrder'
			]);
			Route::post('/cancel/invoice', [ 'as' => 'cancel-invoice','uses' => 'orders\OrderController@cancelInvoice'
			]);
			Route::post('/remove/order', [ 'as' => 'remove-order','uses' => 'orders\OrderController@removeOrder'
			]);
			Route::post('/cancel/label', [ 'as' => 'cancel-label','uses' => 'orders\OrderController@cancelLabel'
			]);
			Route::post('/track/order', [ 'as' => 'track-order','uses' => 'orders\OrderController@trackOrder'
			]);
			Route::post('/place/order', [ 'as' => 'place-order','uses' => 'orders\OrderController@updateThirdpartyOrder'
			]);
			Route::post('/print/invoice', [ 'as' => 'print-invoice','uses' => 'orders\OrderController@printInvoice'
			]);
			Route::post('/download/label', [ 'as' => 'download-label','uses' => 'orders\OrderController@downloadAction'
			]);
			Route::post('/tracking/file', [ 'as' => 'tracking-file','uses' => 'orders\OrderController@importTrackingFile'
			]);
			Route::post('/tortable1',[
				'as' => 'tortable1', 'uses' => 'orders\OrderController@tortable1'
			]);
			Route::post('/importinventory1data',[
				'as' => 'importinventory1data', 'uses' => 'orders\OrderController@importinventory1data'
			]);
			Route::post('/importattributeupdate',[
				'as' => 'importattributeupdate', 'uses' => 'orders\OrderController@importattributeupdate'
			]);
			Route::post('/imptable2',[
				'as' => 'imptable2', 'uses' => 'orders\OrderController@imptable2'
			]);

		});
	});
});
use Illuminate\Http\Request;
Route::group(['namespace'=>'Backend\orders'], function () {

});