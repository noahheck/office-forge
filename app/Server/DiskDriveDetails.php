<?php


namespace App\Server;


class DiskDriveDetails
{
    public function getDetails()
    {
        $details = [];

        $totalSpace = disk_total_space('/');
        $freeSpace = disk_free_space('/');
        $usedSpace = $totalSpace - $freeSpace;

        $details['totalSpace'] = $this->getSymbolByQuantity($totalSpace);
        $details['freeSpace'] = $this->getSymbolByQuantity($freeSpace);
        $details['usedSpace'] = $this->getSymbolByQuantity($usedSpace);

        return $details;
    }

    /**
     * https://www.php.net/manual/en/function.disk-total-space.php#75971
     * 
     * @param $bytes
     * @return string
     */
    private function getSymbolByQuantity($bytes) {
        $symbols = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
        $exp = floor(log($bytes)/log(1024));

        return sprintf('%.2f '.$symbols[$exp], ($bytes/pow(1024, floor($exp))));
    }
}
