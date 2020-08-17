<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Server\DatabaseDetails;
use App\Server\DiskDriveDetails;
use App\Server\OSDetails;
use App\Server\PHPDetails;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index(
        Request $request,
        OSDetails $osDetails,
        PHPDetails $phpDetails,
        DatabaseDetails $databaseDetails,
        DiskDriveDetails $diskDriveDetails
    ){
        $osDetails = $osDetails->getDetails();

        $phpDetails = $phpDetails->getDetails();

        $databaseDetails = $databaseDetails->getDetails();

        $diskDriveDetails = $diskDriveDetails->getDetails();

        return $this->view('admin.server.index', compact(
            'osDetails',
            'phpDetails',
            'databaseDetails',
            'diskDriveDetails'
        ));
    }

    public function phpinfo(PHPDetails $phpDetails)
    {
        $phpInfo = $phpDetails->getPhpInfo();

        return $this->view('admin.server.phpinfo', compact('phpInfo'));
    }
}
