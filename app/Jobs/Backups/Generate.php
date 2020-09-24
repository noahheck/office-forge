<?php

namespace App\Jobs\Backups;

use App\Backups\Backup;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Str;
use Spatie\DbDumper\Compressors\GzipCompressor;
use Spatie\DbDumper\Databases\MySql;
use function App\temp_directory_path;

class Generate
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(MySql $dbDumper, FilesystemFactory $factory)
    {
        $backup = new Backup;
        $backup->started = now();

        try {

            $disk = $factory->disk('local');
            $tempDisk = $factory->disk('temp');

            $dbDumper->setDbName(config('database.connections.mysql.database'))
                ->setUserName(config('database.connections.mysql.username'))
                ->setPassword(config('database.connections.mysql.password'))
                ->useCompressor(new GzipCompressor())
            ;

            $fileName = date('Y-m-d_H_i_s') . '.sql.gz';

            $dbDumper->dumpToFile(\App\temp_directory_path() . DIRECTORY_SEPARATOR . $fileName);

            $disk->put('/backups/' . $fileName, $tempDisk->get($fileName));

            $tempDisk->delete($fileName);

            $backup->filename = $fileName;
            $backup->filesize = $disk->size('/backups/' . $fileName);

            $backup->successful = true;

        } catch (\Exception $e) {

            $backup->successful = false;
            $backup->error = $e->getMessage();
        }

        $backup->completed = now();

        $backup->save();
    }
}
