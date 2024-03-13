<?php

namespace App\Utils;

use Illuminate\Http\UploadedFile;
use Symfony\Component\Mime\MimeTypes;
use Illuminate\Support\Str;

class FileUtil
{
    public static function generateFileName(UploadedFile $file): string
    {
        $mimeTypes = new MimeTypes();
        $extension = $file->getClientOriginalExtension();
        if (empty($extension)) {
            $mimeType = $file->getMimeType();
            $extensions = $mimeTypes->getExtensions($mimeType);
            $extension = !empty($extensions) ? $extensions[0] : '';
        }
        $ulid = strtolower(Str::ulid());
        return "{$ulid}.{$extension}";
    }

    

    public static function generateSlug(string $filename): string
    {
        return str_replace('.', '-', basename($filename, '.' . pathinfo($filename, PATHINFO_EXTENSION)));
    }

    public static function getMimeType(string $filename): string
    {
        $mimeTypes = new MimeTypes();
        return $mimeTypes->guessMimeType($filename);
    }
}
