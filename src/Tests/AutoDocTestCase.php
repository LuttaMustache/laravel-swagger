<?php

namespace LuttaMustache\Support\AutoDoc\Tests;

use Illuminate\Foundation\Testing\TestCase;
use LuttaMustache\Support\AutoDoc\Services\SwaggerService;
use LuttaMustache\Support\AutoDoc\Http\Middleware\AutoDocMiddleware;

class AutoDocTestCase extends TestCase
{
    protected $docService;

    public function setUp()
    {
        parent::setUp();

        $this->docService = app(SwaggerService::class);
    }

    public function createApplication()
    {
        parent::createApplication();
    }

    public function tearDown()
    {
        $currentTestCount = $this->getTestResultObject()->count();
        $allTestCount = $this->getTestResultObject()->topTestSuite()->count();

        if (($currentTestCount == $allTestCount) && (!$this->hasFailed())) {
            $this->docService->saveProductionData();
        }

        parent::tearDown();
    }

    /**
     * Disabling documentation collecting on current test
     */
    public function skipDocumentationCollecting()
    {
        AutoDocMiddleware::$skipped = true;
    }
}