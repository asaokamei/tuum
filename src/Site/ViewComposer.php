<?php
namespace Demo\Site;

use Tuum\View\Renderer;
use Tuum\Web\Psr7\Request;
use Tuum\Web\Psr7\Response;
use Tuum\Web\ReleaseInterface;
use Tuum\Web\View\ViewStream;

class ViewComposer implements ReleaseInterface
{
    /**
     * @param Request       $request
     * @param callable|null $next
     * @return null|Response
     */
    public function __invoke($request, $next = null)
    {
        $path = $request->getUri()->getPath();
        $root = explode('/', trim($path,'/'))[0];
        return $next ? $next($request->withAttribute('navMenu', $root)): null;
    }

    /**
     * @param Request       $request
     * @param null|Response $response
     * @return null|Response
     */
    public function release($request, $response)
    {
        if (is_null($response)) {
            $response = $request->respond()->asNotFound();
        }
        if ($request->getAttribute('navMenu') === 'docs' && $response->isType(Response::TYPE_VIEW)) {
            return $this->viewDocs($request, $response);
        }

        return $response;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @return Response
     */
    private function viewDocs($request, $response)
    {
        // start with file name. 
        $file_name = basename($request->getUri()->getPath());

        // normalize file name. 
        $fileLookUp = [
            'license' => 'index',
        ];
        $file_name = isset($fileLookUp[$file_name]) ? $fileLookUp[$file_name]: $file_name;

        // find breadcrumb title. 
        $titleList   = [
            'index'            => 'Documents Top',
            'quick-install'    => 'Installation',
            'quick-routing'    => 'Routes File',
            'quick-controller' => 'Controller and View',
            '' => '',
        ];
        $breadTitle = isset($titleList[$file_name]) ?$titleList[$file_name]:'Documents Top';
        $breadcrumb = "<li><a href=\"/docs/index\" >Documents</a></li>\n".
            "<li class=\"active\">{$breadTitle}</li>";
        
        /** @var ViewStream $view */
        $view = $response->getBody();
        $view->modRenderer(function($renderer) use($breadcrumb, $file_name) {
            /** @var Renderer $renderer */
            $renderer->setSection('breadcrumb', $breadcrumb);
            $renderer->blockAsSection('layout/docs-layout', 'sub-menu', ['file_name' => $file_name]);
            return $renderer;
        });
        
        return $response;
    }
}