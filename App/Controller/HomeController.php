<?php

declare(strict_types=1);

namespace App\Controller;

use Magma\Base\BaseController;
use App\Model\UserModel;

class HomeController extends BaseController
{

    public function __construct($routeParams)
    {
        parent::__construct($routeParams);
    }

    public function indexAction()
    {
        $user = new UserModel();
        $data = $user->getRepo()->findOneBy(['id' => 1]);
        var_dump($data);
        die();

    }

    protected function before()
    {}

    protected function after()
    {}


}