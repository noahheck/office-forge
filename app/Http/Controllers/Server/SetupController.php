<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Jobs\Organization\UpdateDetails;
use App\Jobs\User\Create as CreateUser;
use App\Options;
use App\Server\Setup;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Http\Requests\Server\Setup\Key as KeyRequest;
use App\Http\Requests\Server\Setup\Organization as OrganizationRequest;
use App\Http\Requests\Server\Setup\User as UserRequest;

class SetupController extends Controller
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var Options
     */
    private $options;

    public function __construct(Session $session, Options $options)
    {
        $this->session = $session;
        $this->options = $options;
    }

    public function index()
    {
        return $this->view('server-setup.index', []);
    }

    public function key(KeyRequest $request)
    {
        $key = $request->key;

        $this->session->put('setup-key', $key);

        return redirect()->route('server-setup.organization');
    }



    public function organization()
    {
        abort_unless($this->verifySetupKeyOnSession(), 403);

        return $this->view('server-setup.organization', []);
    }

    public function organizationSave(OrganizationRequest $request)
    {
        abort_unless($this->verifySetupKeyOnSession(), 403);

        $this->dispatchNow($organizationDetailsUpdated = new UpdateDetails($request->name, $request->phone));

        return redirect()->route('server-setup.user');
    }



    public function user()
    {
        abort_unless($this->verifySetupKeyOnSession(), 403);

        return $this->view('server-setup.user', []);
    }

    public function userSave(UserRequest $request)
    {
        abort_unless($this->verifySetupKeyOnSession(), 403);

        $this->dispatchNow($userCreated = new CreateUser(
            $request->name,
            $request->email,
            $request->timezone,
            $request->job_title,
            $request->password,
            true,
            true,
            true
        ));

        return redirect()->route('server-setup.completed');
    }



    public function completed()
    {
        $this->options->set(Setup::COMPLETED_OPTION, now());

        return $this->view('server-setup.completed');
    }



    private function verifySetupKeyOnSession()
    {
        $serverKey = $this->options->get(Setup::KEY_OPTION);
        $sessionKey = $this->session->get('setup-key');

        return $serverKey === $sessionKey;
    }
}
