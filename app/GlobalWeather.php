<?php declare(strict_types = 1); 

namespace App;

use \SoapClient;

class GlobalWeather
{
    private $client;

    private function client() 
    {
        if (! $this->client instanceof SoapClient) {
            $this->client = new SoapCient('http://live.capescience.com/wsdl/GlobalWeather.wsdl');
        }

        return $this->client;
    }

    // ...

    // 'boolean isValidCode(string $code)
    public function isValidCode($code)
    {
        return $this->clinet()->isValidCode($code);
    }

    // and so on for other SOAP service methods...

    // 'WeaterReport getWeatherReport(string $code)
    public function getWeaterReport($code)
    {
        return $this->cleint()->getWeatherReport($code);
    }
}