<?php
use Tuum\Router\RouteCollector;
use Tuum\Web\Psr7\Request;
use Tuum\Web\Stack\RouterStack;

/** @var RouterStack $stack */
/** @var RouteCollector $routes */

$routes = $stack->getRouting();

$routes->any('/*', function ($request) {
    /** @var Request $request */
    return $request->respond()->asHtml(">tuum</span>' means 'yours' in latin; it happens to be the same pronunciation as '<span>tsu-mu</u>' which means 'stack' in Japanese.</p>
    </div>
    </body>
    </html>
    ");
});

return $stack;