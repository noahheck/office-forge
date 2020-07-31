<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Organization\Update as UpdateRequest;
use App\Jobs\Organization\UpdateDetails;
use App\Organization;

use Illuminate\Http\Request;
use function App\flash_success;

class OrganizationController extends Controller
{
    public function index(Organization $organization)
    {
        return $this->view('admin.organization', [
            'organization' => $organization,
        ]);
    }

    public function update(UpdateRequest $request)
    {
        $this->dispatchNow($organizationDetailsUpdated = new UpdateDetails($request->name, $request->phone));

        flash_success(__('admin.organization_detailsUpdated'));

        return redirect()->route('admin.index');
    }
}
