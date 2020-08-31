<?php


namespace App\Utility;


class MimeTypeIconFunctionMapper
{

    public static $map = [
        'video/x-msvideo' => '\App\icon\file_video',
        'application/x-bzip' => '\App\icon\file_archive',
        'application/x-bzip2' => '\App\icon\file_archive',
        'text/css' => '\App\icon\file_code',
        'text/csv' => '\App\icon\file_csv',
        'application/msword' => '\App\icon\file_word',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => '\App\icon\file_word',
        'application/gzip' => '\App\icon\file_archive',
        'image/gif' => '\App\icon\file_image',
        'text/html' => '\App\icon\file_code',
        'application/java-archive' => '\App\icon\file_archive',
        'image/jpeg' => '\App\icon\file_image',
        'text/javascript' => '\App\icon\file_code',
        'application/json' => '\App\icon\file_code',
        'audio/mpeg' => '\App\icon\file_audio',
        'video/mpeg' => '\App\icon\file_video',
        'application/vnd.oasis.opendocument.presentation' => '\App\icon\file_presentation',
        'application/vnd.oasis.opendocument.spreadsheet' => '\App\icon\file_spreadsheet',
        'application/vnd.oasis.opendocument.text' => '\App\icon\file_word',
        'audio/ogg' => '\App\icon\file_audio',
        'video/ogg' => '\App\icon\file_video',
        'image/png' => '\App\icon\file_image',
        'application/pdf' => '\App\icon\file_pdf',
        'application/x-httpd-php' => '\App\icon\file_code',
        'application/vnd.ms-powerpoint' => '\App\icon\file_presentation',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => '\App\icon\file_presentation',
        'application/x-tar' => '\App\icon\file_archive',
        'image/tiff' => '\App\icon\file_image',
        'text/plain' => '\App\icon\file_file',
        'audio/wav' => '\App\icon\file_audio',
        'audio/webm' => '\App\icon\file_audio',
        'video/webm' => '\App\icon\file_video',
        'video/webp' => '\App\icon\file_image',
        'application/xhtml+xml' => '\App\icon\file_code',
        'application/vnd.ms-excel' => '\App\icon\file_spreadsheet',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => '\App\icon\file_spreadsheet',
        'application/xml' => '\App\icon\file_code',
        'text/xml' => '\App\icon\file_code',
        'application/zip' => '\App\icon\file_archive',
        'application/x-7z-compressed' => '\App\icon\file_archive',
    ];

    public static function iconForMimetype($mimeType, $withClasses = [])
    {
        $function = self::$map[$mimeType] ?? '\App\icon\file_file';
        return $function($withClasses);
    }
}
