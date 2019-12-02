<?php


namespace App\Traits;


use App\EditorImage;

trait IsEditorResource
{
    public function claimTemporaryEditorImages($resourceTempId)
    {
        EditorImage::where('resource_temp_id', $resourceTempId)
            ->where('resource_type', get_class($this))
            ->update([
                'resource_id'      => $this->id,
                'resource_temp_id' => null,
            ]);
    }
}
