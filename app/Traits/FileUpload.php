<?php
namespace App\Traits;
use Str,Storage;
use Illuminate\Support\Facades\File;

 trait FileUpload{

    public function uploadFile($file)
    {
        $date = date('Y-m-d');
        $file_name=Str::random(10).'-'.time();
        $ext=strtolower($file->getClientOriginalExtension());
        $file_full_name = $date.'/'.$file_name . '.' . $ext;
        $upload_path = 'uploads/'.$date.'/';
        // $file_path = $upload_path . $file_full_name;
        $file->move($upload_path,$file_full_name);
        return $file_full_name;
    }

    public function removeFile($file)
    {
        if(File::exists(public_path($file))){
            File::delete(public_path($file));
        } 
    }
}