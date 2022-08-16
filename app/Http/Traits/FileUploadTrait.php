<?php
namespace App\Http\Traits;


trait FileUploadTrait
{
    public function uploadFile($file, $path)
    {
    $file_name = time() . '_' . $file->hashName();
    $file->move($path,$file_name);
    return $file_name;
    }
}
?>
