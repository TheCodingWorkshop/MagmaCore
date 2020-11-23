<?php

declare(strict_types=1);

namespace Magma\Http;

use Symfony\Component\HttpFoundation\Request;

class RequestHandler
{

    /**
     * Wrapper method for symfony http request object
     *
     * @return Request
     */
    public function handler() : Request
    {
        if (!isset($request)) {
            $request = new Request();
            if ($request) {
                $create = $request->createFromGlobals();
                if ($create) {
                    return $create;
                }
            }
        }
        return false;
    }

}