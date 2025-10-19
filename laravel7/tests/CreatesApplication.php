<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication {

    public function createApplication() {

        $application = require __DIR__.'/../bootstrap/app.php';
        $application->make(Kernel::class)->bootstrap();
        return $application;
    
    }

}
