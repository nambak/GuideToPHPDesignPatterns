<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use \SoapClient;

final class ProxyTestCase extends TestCase
{
    const WSDL = 'http://live.capescience.com/wsdl/GlobalWeather.wsdl';

    private $client;

    protected function setUp(): void
    {
        $this->client = new SoapClient(self::WSDL);
    }

    public function testMethodsOfSoapClient()
    {
        $soapClientMethods = [
            '__construct',
            '__call',
            '__soapCall',
            '__getLastRequest',
            '__getLastResponse',
            '__getLastRequestHeaders',
            '__getLastResponseHeaders',
            '__getFunctions',
            '__getTypes',
            '__doRequest'
        ];

        $this->assertEquals($soapClientMethods, get_class_methods(get_class($this->client)));
    }

    public function tesstSoapFunctions()
    {
        $globalWeatherFunctions = [
            'Station getStation(string $code)',
            'boolean isValidCode(string $code)',
            'ArrayOfstring listCountries()',
            'ArrayOfStation searchByCode(string $code)',
            'ArrayOfStation searchByCountry(string $country)',
            'ArrayOfStation searchByName(string $name)',
            'ArrayOfStation searchByRegion(string $region)',
            'WeatherReport getWeatherReport(string $code)',
        ];

        $this->assertEquals($globalWeatherFunctions, $this->client->__getFunctions());
    }

    public function testGetWeatherReport()
    {
        $molineWeather = $this->client->getWeatherReport('KMLI');

        $this->assertInstanceOf(stdClass::class, $molineWeather);

        $weaterTests = [
            'timestamp' => 'String',
            'station' => 'stdClass',
            'phenomena' => 'Array',
            'precipitation' => 'Array',
            'extremes' => 'Array',
            'pressure' => 'stdClass',
            'sky' => 'stdClass',
            'temperature' => 'stdClass',
            'visibility' => 'stdClass',
            'wind' => 'stdClass',
        ];

        foreach ($weatherTests as $key => $isa) {
            $this->assertInstanceOf($isa, $molineWeather->$key, "{$key} should be {$isa}. actually [%s]");
        }

        $temp = $molineWeather->temperature;

        $temperatureTests = [
            'ambient' => 'Float',
            'dewpoint' => 'Float',
            'relativeHumidity' => 'Integer',
            'string' => 'String',
        ];

        foreach ($temperatureTests as $key => $isa) {
            $this->assertInstanceOf($isa, $temp->key, "{$key} should be {$isa}, actually [%s]");
        }
    }
}