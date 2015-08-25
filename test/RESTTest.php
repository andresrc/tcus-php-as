<?php

namespace Derquinse\PhpAS;

/**
 * Tests for REST Service.
 *
 * @backupGlobals disabled
 */
class RESTTest extends \PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        if (isset($_ENV['BASE_URI'])) {
            $this->client = new \GuzzleHttp\Client([
            'base_uri' => $_ENV['BASE_URI'],
            'http_errors' => false,
            ]);
        } else {
            $this->markTestSkipped('Set BASE_URI environment variable');
        }
    }

    public function testValidGetId()
    {
        $response = $this->client->get('address/3');

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('name', $data);
        $this->assertEquals(3, $data['id']);
    }

    public function testInvalidGetId()
    {
        $response = $this->client->get('address/badId');
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testValidGetAll()
    {
        $response = $this->client->get('address');

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertTrue(is_array($data));
        $this->assertTrue(count($data) > 0);
        foreach ($all as $a) {
            $this->assertArrayHasKey('id', $a);
            $this->assertArrayHasKey('name', $a);
        }
    }
}
