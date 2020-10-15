<?php

namespace App\Http\Controllers;

use App\Http\Response\AjaxResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $view
     * @param array $data
     * @param array $mergeData
     * @return \Illuminate\Http\Response
     */
    protected function view($view, $data = [], $mergeData = [])
    {
        return view($view, $data, $mergeData);
    }

    /**
     * @param bool $success
     * @param array $data
     * @param array $errors
     * @return \Illuminate\Http\Response
     */
    protected function json($success, $data = [], $errors = [])
    {
        return new AjaxResponse($success, $data, $errors);
    }

    /**
     * @param $pathToFile
     * @param null $name
     * @param array $headers
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    protected function download($pathToFile, $name = null, $headers = [])
    {
        return response()->download($pathToFile, $name, $headers);
    }
}
