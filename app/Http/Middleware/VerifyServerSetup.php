<?php

namespace App\Http\Middleware;

use App\Options;
use App\Server\Setup;
use Closure;

class VerifyServerSetup
{
    /**
     * @var Options
     */
    private $options;

    public function __construct(Options $options)
    {
        $this->options = $options;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->options->get(Setup::COMPLETED_OPTION, false)) {

            return redirect()->route("server-setup");
        }

        return $next($request);
    }
}
