<?php

namespace EcommerceApp\Test\Stories\Bootstrap;

use Behat\Gherkin\Node\PyStringNode;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use Behat\Testwork\Hook\Call\BeforeSuite;
use EcommerceApp\Test\TestCase;
use Behat\Behat\Context\Context;
use Behat\Behat\Definition\Call\When;
use Behat\Behat\Definition\Call\Then;
use Behat\Behat\Definition\Call\Given;

class FeatureContext extends TestCase implements Context
{
    /**
     * @var string
     */
    private $baseUrl;
    /**
     * @var Response
     */
    private $response;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var array
     */
    private $headers = [];

    public function __construct(string $baseUrl)
    {
        parent::__construct();
        $this->baseUrl  = $baseUrl;
        $this->request  = null;
        $this->response = null;
        $app = new Container();
        $app->singleton('app', 'Illuminate\Container\Container');

        /**
         * Set $app as FacadeApplication handler
         */
        Facade::setFacadeApplication($app);
    }

    /**
     * @BeforeSuite
     */
    public static function prepareDatabase(BeforeSuiteScope $scope)
    {
        exec('php artisan migrate:fresh --env=testing');
    }

    /**
     * @When I send a :method request to :url
     */
    public function iSendRequestToUrl($method, $url)
    {
        $url = ltrim($url, '/');
        switch ($method) {
            case 'GET':
                $this->response = Http::get(sprintf('%s/%s', $this->baseUrl, $url));
                break;
            case 'POST':
                $this->response = Http::post(sprintf('%s/%s', $this->baseUrl, $url));
                break;
            case 'PUT':
                $this->response = Http::put(sprintf('%s/%s', $this->baseUrl, $url));
                break;
            case 'DELETE':
                $this->response = Http::delete(sprintf('%s/%s', $this->baseUrl, $url));
                break;
            default:
                throw new \Exception(sprintf('Found unregistered/invalid request method: %s', $method));
        }

        if (!$this->response->successful()) {
            $this->response->throw();
        }
    }

    /**
     * @Then the response status code should be :statusCode
     */
    public function theResponseStatusCodeShouldBe($statusCode)
    {
        $this->assertEquals($statusCode, $this->response->status());
    }

    /**
     * @Then the response content should be :content
     */
    public function theResponseContentShouldBe($content)
    {
        $this->assertEquals($content, $this->response->body());
    }
}
