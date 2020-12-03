<?php

declare(strict_types=1);

namespace App\Controller;

use Magma\Base\BaseController;
use App\Model\UserModel;
use Magma\Yaml\YamlConfig;

class HomeController extends BaseController
{

    public function __construct($routeParams)
    {
        parent::__construct($routeParams);
    }

    public function indexAction()
    {
        $args = YamlConfig::file('controller')['user'];
        $user = new UserModel();
        $this->render('client/home/index.html.twig', [
            'users' => var_dump($user->getRepo()->findObjectBy(['id' => 35]))
        ]);
    }

    protected function before()
    {}

    protected function after()
    {}


}