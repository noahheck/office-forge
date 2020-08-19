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
            $output[] = "Running 'apt upgrade -y'";
            exec("apt upgrade -y", $output, $execResponse);

            // $execResponse will be anything other than 0 if unsuccessful
            if ($execResponse) {
                throw new \Exception("Error performing 'apt upgrade -y'");
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
