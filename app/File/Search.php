<?php


namespace App\File;


use App\File;
use App\FileType;
use App\User;

class Search
{
    /**
     * @var File
     */
    private $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function searchForFilesAccessibleByUser(User $user, $searchTerm, $fileTypeId = null)
    {
        $files = $this->file
            ->where('name', 'LIKE', "%{$searchTerm}%")
            ->when($fileTypeId, function($query, $fileTypeId) {

                return $query->where('file_type_id', $fileTypeId);
            })
            ->orderBy('name', 'ASC')
            ->get();

        $files->load('fileType', 'fileType.teams', 'accessLocks');

        return $files->filter(function($file) use ($user) {

            return $user->can('view', $file);
        });
    }
}
