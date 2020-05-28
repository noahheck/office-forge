<?php

namespace App\Http\Controllers;

use App\User;
use App\User\WorkProvider;
use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    public function index(Request $request, WorkProvider $workProvider)
    {
        $workStatus = $request->work_status ?? 'open';
        $userId = $request->user ?? $request->user()->id;

        $userId = (int) $userId;

        if (!$request->user()->isAdministrator()) {
            $userId = $request->user()->id;
        }
        $user = User::find($userId);

        switch ($workStatus):

            case "completed":
                $workItems = $workProvider->getCompletedWorkForUser($user);
                break;

            case "open":
                // no break
            default:
                $workItems = $workProvider->getOpenWorkForUser($user, true);
                break;

        endswitch;

        $userSelectOptions = User::orderBy('name')->get();
        $userSelectOptions->load('headshots');

        return $this->view('user-activity', compact(
            'workStatus',
            'userId',
            'workItems',
            'userSelectOptions'));
    }
}
