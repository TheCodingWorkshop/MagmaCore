<?php

declare(strict_types=1);

namespace App\Controller;

use Magma\Base\BaseController;

class HomeController extends BaseController
{

    public function __construct($routeParams)
    {
        parent::__construct($routeParams);
    }

    public function indexAction()
    {
    }

    protected function before()
    {}

    protected function after()
    {}


}