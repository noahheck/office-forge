<?php

namespace App\Jobs\FileType\Panel;

use App\FileType;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateOrder
{
    use Dispatchable, Queueable;

    private $fileType;
    private $orderedPanels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FileType $fileType, $orderedPanels)
    {
        $this->fileType = $fileType;
        $this->orderedPanels = $orderedPanels;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $panelOrderMap = array_flip($this->orderedPanels);

        $panels = $this->fileType->panels;

        foreach ($panels as $panel) {

            if (!array_key_exists($panel->id, $panelOrderMap)) {

                continue;
            }

            $panel->order = $panelOrderMap[$panel->id] + 1;
            $panel->save();
        }
    }
}
