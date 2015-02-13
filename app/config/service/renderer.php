<?php

use Tuum\Locator\Locator;
use Tuum\View\Tuum\Renderer;
use Tuum\Web\App;

return new Renderer(new Locator($app->get(App::TEMPLATE_DIR)));