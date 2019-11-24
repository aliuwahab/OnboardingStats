<?php
namespace Test\Integration;


use GuzzleHttp\Client;
use Test\TemperTest;

class StatisticsControllerTest extends TemperTest
{


    public function setUp()
    {
        parent::setUp();
        $this->http = new Client(['base_uri' => BASE_URL]);
    }


    /**
     * @test
     */
    public function testOnboardingApiRouteIsValid(){
        $response = $this->http->request('GET', 'user-agent');
        $this->assertEquals(200, $response->getStatusCode());
    }


    /**
     * @test
     */
    public function testOnboardingApiReturnsValidJsonDataType(){

        $response = $this->http->request('GET', '/stats/onboarding');
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-type"];
        $this->assertEquals("application/json", $contentType[0]);
    }


    /**
     * @test
     */
    public function testOnboardingApiReturnsValidData(){

        $response = $this->http->request('GET', '/stats/onboarding');
        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-type"];
        $this->assertEquals("application/json", $contentType[0]);
        $data = json_decode($response->getBody()->getContents());
        $this->assertIsObject($data);
        $this->assertObjectHasAttribute('data',$data);
        $this->assertObjectHasAttribute('series',$data->data);
        $this->assertObjectHasAttribute('categories',$data->data);
    }



    public function tearDown() {

        parent::tearDown();

        $this->http = null;
    }
}