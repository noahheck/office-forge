<?php

namespace App\Jobs\Report\Dataset\Visualization;

use App\Report\Dataset\Visualization;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable;

    private $visualization;
    private $label;
    private $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Visualization $visualization, $label, $type)
    {
        $this->visualization = $visualization;
        $this->label = $label;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $visualization = $this->visualization;
        $visualization->label = $this->label;
        $visualization->type = $this->type;

        $visualization->save();
    }
}
