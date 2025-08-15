<?php

namespace Lib;

class Kernel
{
    public function run()
    {
        $request = Request::makeFromGlobals();
        $router = new Router();

        require_once ROOT . '/routes.php';

        $router->run($request);
    }
}
