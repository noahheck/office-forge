<?php


namespace App\Url;


use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NamedRouteChecker
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function urlIs($url, $routeName): bool
    {
        try {
            $testRequest = \Request::create($url);

            $matchedRoute = \Route::getRoutes()->match($testRequest);

        } catch (MethodNotAllowedHttpException $e) {

            $testRequest = \Request::create($url, 'POST');

            $matchedRoute = \Route::getRoutes()->match($testRequest);

        } catch (NotFoundHttpException $e) {

            return false;
        }

        return $matchedRoute->named($routeName);
    }
}
