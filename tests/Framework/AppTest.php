<?php
namespace Test\Framework;

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    public function testRedirectTrainingSlash()
    {
          $request = new ServerRequest("GET", "/demoslash/");
          $response = (new App())->run($request);
          $this->assertContains("/demoslash", $response->getHeader('Location'));
          $this->assertEquals(301, $response->getStatusCode());
    }

    public function testBlog()
    {
        $request = new ServerRequest("GET", "/blog");
        $response = (new App())->run($request);
        $this->assertStringContainsString('<h1> Bienvenue sur le blog </h1>', (string) $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }



    public function testError404()
    {
        $request = new ServerRequest("GET", "/aze");
        $response = (new App())->run($request);
        $this->assertStringContainsString('<h1> Erreur 404 </h1>', (string) $response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }
}
