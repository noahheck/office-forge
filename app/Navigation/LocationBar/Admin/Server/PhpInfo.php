<?php


namespace App\Navigation\LocationBar\Admin\Server;


use App\Navigation\LocationBar;

class PhpInfo extends LocationBar
{
    public function __construct()
    {
        parent::__construct(__('admin.server_php_phpinfo'));

        $this->addLink(new \App\Navigation\Link\Admin\Home);
        $this->addLink(new \App\Navigation\Link\Admin\Server);
    }
}
