<?php
/**
 * Created by PhpStorm.
 * User: rafaelescuadra
 * Date: 12/07/2018
 * Time: 10:59 AM
 */

namespace App\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;

    public function  __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file){
        $filename = md5(uniqid()).'.'.$file->guessExtension();

//dd($this->uploadDirectory().$filename);
        $file->move($this->uploadDirectory(),$filename);

        return $filename;
    }

    public function uploadDirectory($location = null){
        return $location == null ? $this->targetDirectory : $location;
    }




}