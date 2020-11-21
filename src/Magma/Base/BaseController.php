<?php

declare(strict_types=1);

namespace Magma\Base;

use Magma\Base\Exception\BaseLogicException;
use Magma\Base\BaseView;

class BaseController
{
    
    /** @var array */
    protected array $routeParams;

    /** @var Object */
    private Object $twig;

    /**
     * Main class constructor
     *
     * @param array $routeParams
     * @return void
     */
    public function __construct(array $routeParams)
    {
        $this->routeParams = $routeParams;
        $this->twig = new BaseView();
    }

    /**
     * Renders a view template from sub controller classes
     *
     * @param string $template
     * @param array $context
     * @return Response
     */
    public function render(string $template, array $context = [])
    {
        if ($this->twig === null) {
            throw new BaseLogicException('You cannot use the render method if the twig bundle is not available.');
        }
        return $this->twig->getTemplate($template, $context);
    }

}