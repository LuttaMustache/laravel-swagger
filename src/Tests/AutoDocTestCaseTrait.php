<?php

namespace LuttaMustache\Support\AutoDoc\Tests;

use LuttaMustache\Support\AutoDoc\Services\SwaggerService;
use LuttaMustache\Support\AutoDoc\Http\Middleware\AutoDocMiddleware;

trait AutoDocTestCaseTrait
{
    public $docService;

//    public function createApplication()
//    {
//        parent::createApplication();
//    }

    public function tearDown(): void
    {
        $this->saveDocumentation();

        parent::tearDown();
    }

    public function saveDocumentation()
    {
        $docService = $this->docService ??  app(SwaggerService::class);
        $docService->saveProductionData();
    }

    /**
     * Disabling documentation collecting on current test
     */
    public function skipDocumentationCollecting()
    {
        AutoDocMiddleware::$skipped = true;
    }
}
