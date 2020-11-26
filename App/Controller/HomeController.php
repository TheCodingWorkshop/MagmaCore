<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\UserModel;
use Magma\Base\BaseController;

class HomeController extends BaseController
{

    public function __construct($routeParams)
    {
        parent::__construct($routeParams);
    }

    public function indexAction()
    {
        $repo = new UserModel();
        var_dump($repo);
    }

    protected function before()
    {}

    protected function after()
    {}


}