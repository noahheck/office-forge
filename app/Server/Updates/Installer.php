<?php


namespace App\Server\Updates;


class Installer
{
    private $output;
    private $success = false;

    public function getOutput()
    {
        return $this->output;
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function installUpdates()
    {
        $output = [];
        $execResponse = '';

        try {
            $output[] = "Running 'apt update'";
            $output[] = '';
            exec("apt update", $output, $execResponse);

            // $execResponse will be anything other than 0 if unsuccessful
            if ($execResponse) {
                throw new \Exception("Error performing 'apt update'");
            }

            $output[] = '';
            $output[] = "Running 'apt-get -y -o Dpkg::Options::=\"--force-confdef\" -o Dpkg::Options::=\"--force-confold\" upgrade'";
            exec("apt-get -y -o Dpkg::Options::=\"--force-confdef\" -o Dpkg::Options::=\"--force-confold\" upgrade", $output, $execResponse);

            // $execResponse will be anything other than 0 if unsuccessful
            if ($execResponse) {
                throw new \Exception("Error performing 'apt-get -y -o Dpkg::Options::=\"--force-confdef\" -o Dpkg::Options::=\"--force-confold\" upgrade'");
            }

            $output[] = '';
            $output[] = "Running 'apt autoremove -y'";
            exec("apt autoremove -y", $output, $execResponse);

            // $execResponse will be anything other than 0 if unsuccessful
            if ($execResponse) {
                throw new \Exception("Error performing 'apt autoremove -y'");
            }

            $this->success = true;

        } catch (\Exception $e) {
            $output[] = '';
            $output[] = 'Exception caught with message: ' . $e->getMessage();
            $output[] = 'Exec response: ' . $execResponse;
        }

        $this->output = $output;
    }
}
