<?php


namespace App\Traits\MediaFiles;


use App\Utility\MimeTypeIconFunctionMapper;

trait MediaFileResource
{
    public function canPreviewInBrowser(): bool
    {
        $previewableMimeTypes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'application/pdf',
        ];

        return in_array($this->mimetype, $previewableMimeTypes);
    }

    public function icon($withClasses = [])
    {
        if ($headshot = $this->currentHeadshot()) {
            $classes = implode(' ', array_unique(array_merge($withClasses, ['headshot', 'icon',])));

            return "<img class='" . e($classes) . "' src='" . route('headshot', [$headshot->id, 'icon', $headshot->icon_filename]) . "' title='" . e($this->name) . "' alt='" . e($this->name) . "'>";
        }

        return MimeTypeIconFunctionMapper::iconForMimetype($this->mimetype, $withClasses);
    }

    public function thumbnail($withClasses = [])
    {
        if ($headshot = $this->currentHeadshot()) {
            $classes = implode(' ', array_unique(array_merge($withClasses, ['headshot', 'thumbnail',])));

            return "<img class='" . e($classes) . "' src='" . route('headshot', [$headshot->id, 'thumb', $headshot->thumb_filename]) . "' title='" . e($this->name) . "' alt='" . e($this->name) . "'>";
        }

        $withClasses = array_merge($withClasses, ['thumbnail']);

        return MimeTypeIconFunctionMapper::iconForMimetype($this->mimetype, $withClasses);
    }
}
