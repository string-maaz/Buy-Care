<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;
class SoapController extends Controller {

    public function demo()
    {

        // Add a new service to the wrapper
        SoapWrapper::add(function ($service) {
            $service
                ->name('man')
                ->wsdl('localhost/buycare_live/api/v2_soap?wsdl=1')
                ->trace(true);                                                   // Optional: (parameter: true/false)
              //  ->header()                                                      // Optional: (parameters: $namespace,$name,$data,$mustunderstand,$actor)
              //  ->customHeader($customHeader)                                   // Optional: (parameters: $customerHeader) Use this to add a custom SoapHeader or extended class
              //  ->cookie()                                                      // Optional: (parameters: $name,$value)
            //    ->location()                                                    // Optional: (parameter: $location)
            //    ->certificate()                                                 // Optional: (parameter: $certLocation)
            //    ->cache(WSDL_CACHE_NONE)                                        // Optional: Set the WSDL cache
               // ->options(['login' => 'admin', 'password' => 'admin123']);   // Optional: Set some extra options
        });

        $data = [
            'CurrencyFrom' => 'USD',
            'CurrencyTo'   => 'EUR',
            'RateDate'     => '2015-12-18',
            'Amount'       => '1000'
        ];

        // Using the added service
        SoapWrapper::service('man', function ($service) use ($data) {
            var_dump($service->getFunctions());
           // var_dump($service->call('GetConversionAmount', [$data])->GetConversionAmountResult);
        });
    }

}