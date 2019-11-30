<?php

namespace App\Http\Controllers;

use App\Http\Response\AjaxResponse;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $session = $request->session();

        $notifications = [
            'success' => $session->pull('success', []),
            'info'    => $session->pull('info', []),
            'warning' => $session->pull('warning', []),
            'error'   => $session->pull('error', []),
        ];

        return $this->json((new AjaxResponse(true))->setData($notifications));
    }
}
