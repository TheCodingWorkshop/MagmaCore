<?php

declare(strict_types=1);

namespace Magma\Base;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Magma\Twig\TwigExtension;
use Exception;

class BaseView
{

    /**
     * Get the contents of a view template using Twig
     *
     * @param string $template The template file
     * @param array $context Associative array of data to display in the view (optional)
     *
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Exception
     */
    public function getTemplate(string $template, array $context = [])
    {
        static $twig;
        if ($twig === null) {
            $loader = new FilesystemLoader('templates', TEMPLATES_PATH);
            $twig = new Environment($loader, array());
            $twig->addExtension(new DebugExtension());
            $twig->addExtension(new TwigExtension());
        }
        return $twig->render($template, $context);
    }

}