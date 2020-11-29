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
        $this->render('client/home/index.html.twig', [
            'users' => var_dump($user->getRepo()->findOneBy(['id' => 45]))
        ]);
    }

    protected function before()
    {}

    protected function after()
    {}


}