<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\UserModel;
use Magma\Base\BaseController;

class UserController extends BaseController
{

    public function __construct(array $routeParams)
    {
        
        parent::__construct($routeParams);

    }

    protected function indexAction()
    {
        echo $this->routeParams['action'];
    }

    protected function editAction()
    {
        $user = new UserModel();
        echo $this->routeParams['namespace'] . '/' . $this->routeParams['controller'] . '/' . $this->routeParams['id'] . '/' . $this->routeParams['action'];
    }

}