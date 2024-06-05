<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

trait UploadTrait
{
    /**
     * Upload file
     *
     * @param UploadedFile $file
     * @param $path
     * @param $old
     * @return string
     */
    protected function upload($file, $path, $old_file_path = "")
    {
        $code = date('ymdhis') . '_' . rand(1111, 9999);

        (!empty($old_file_path)) ? $this->oldFile($old_file_path, true) : '';

        $fileName = $code . $file->hashName();
        return Storage::disk('public')->putFileAs('upload/' . $path, $file, Str::lower($fileName));
    }

    /**
     * Old file delete or file path.
     *
     * @param $filepath 
     * @param $isDelete 
     * @return string
     */
    public function oldFile($filepath, $isDelete = false)
    {
        $filepath = Str::after($filepath, 'storage/');

        if ($isDelete && $filepath) {
            if (Storage::disk('public')->exists($filepath)) {
                Storage::delete($filepath);
            }
        }
        return $filepath;
    }
}
