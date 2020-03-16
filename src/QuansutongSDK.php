<?php

namespace Seek\QuansutongSDK;

use Hanson\Foundation\Foundation;

class QuansutongSDK extends Foundation
{
    protected $providers = [
        ServiceProvider::class
    ];

    public function __construct($config)
    {
        parent::__construct($config);
    }
}