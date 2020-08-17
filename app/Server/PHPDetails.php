<?php


namespace App\Server;


class PHPDetails
{
    public function getDetails()
    {
        $details = [];

        $details['php_version'] = phpversion();
        $details['php_uname'] = php_uname();
        $details['zend_version'] = zend_version();
        $details['extensions_loaded'] = get_loaded_extensions();
        $details['zend_extensions_loaded'] = get_loaded_extensions(true);

        return $details;
    }

    public function getPhpInfo()
    {
        ob_start();

            phpinfo();

        $phpInfo = ob_get_clean();

        return $phpInfo;
    }
}
