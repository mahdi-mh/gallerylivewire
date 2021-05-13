<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use RuntimeException;

class ImageSaverController extends Controller
{

    /*
     * to add a new upload size
     *
     * add const name with array value [ width , height ]
     * add public function like saveLargeHd() and call self::saveImage(your const size) and the end return $this
     * add delete in DeleteAllPhotos() method
     */

    const Original = 'original';
    const LargeHd = [1920,1080];
    const Large = [720,400];
    const Medium = [360,200];
    const Small = [40,40];


    private $fileName,$imageLoaded;

    /**
     * pass image path that Image can load
     *
     * @param $imageFileRealPath
     * @return $this|bool
     */
    public function loadImage($imageFileRealPath){
        $this->fileName   = (string)time() . "-".Str::random(5).'.jpg';
        try {
            $this->imageLoaded = Image::make($imageFileRealPath);
            return $this;
        } catch (RuntimeException $exception){
            throw $exception;
        }
    }

    /**
     * @return string image path
     */
    public function saveAllSizes(){
        return $this->saveOriginal()->saveLargeHd()->saveLarge()->saveMedium()->saveSmall()->getFileName();
    }

    /**
     * @return $this
     */
    public function saveOriginal(){
        $temp = $this->imageLoaded;
        try {
            $temp->stream();
            Storage::disk('upload')->makeDirectory("original");
            Storage::disk('upload')->put("original/".$this->fileName, $temp,'public');
            return $this;
        } catch (RuntimeException $exception){
            throw $exception;
        }
    }

    /**
     * @return $this
     */
    public function saveLargeHd(){
        self::saveImage(self::LargeHd);
        return $this;
    }

    /**
     * @return $this
     */
    public function saveLarge(){
        self::saveImage(self::Large);
        return $this;
    }

    /**
     * @return $this
     */
    public function saveMedium(){
        self::saveImage(self::Medium);
        return $this;
    }

    /**
     * @return $this
     */
    public function saveSmall(){
        self::saveImage(self::Small);
        return $this;
    }

    /**
     * @param array $size [int width,int height]
     * @return string
     */
    public static function GetFullPath(array $size){
        return env('APP_URL').'/'.self::GetPath($size);
    }

    /**
     * @param array $size [int width,int height]
     * @return string
     */
    public static function GetPath($size){
        if ($size == self::Original) return '/upload/'.self::Original.'/';
        $width = $size[0];
        $height = (isset($size[1]))? $size[1] : $size[0];
        $svePath = "$width-$height";
        return '/upload/'.$svePath.'/';
    }

    /**
     * @param array $size [int width,int height]
     */
    private function saveImage(array $size){
        $width = $size[0];
        $height = (isset($size[1]))? $size[1] : $size[0];
        $temp = $this->imageLoaded;
        $svePath = "$width-$height";
        try {
            $temp->fit($width,$height);
            $temp->stream();
            Storage::disk('upload')->makeDirectory($svePath);
            Storage::disk('upload')->put($svePath."/".$this->fileName, $temp,'public');
        } catch (RuntimeException $exception){
            throw $exception;
        }
    }

    /**
     * delete photo from all upload directory
     *
     * @param $photoPath
     */
    public static function DeleteAllPhotos($photoPath){
        Storage::disk('upload')->delete(self::Original."/".$photoPath);
        Storage::disk('upload')->delete(self::LargeHd[0]."-".self::LargeHd[1]."/".$photoPath);
        Storage::disk('upload')->delete(self::Large[0]."-".self::Large[1]."/".$photoPath);
        Storage::disk('upload')->delete(self::Medium[0]."-".self::Medium[1]."/".$photoPath);
        Storage::disk('upload')->delete(self::Small[0]."-".self::Small[1]."/".$photoPath);
    }

    /**
     * delete all directory of sizes
     */
    public static function DeleteAllDirectory(){
        foreach (Storage::disk('upload')->allDirectories() as $directory){
            Storage::disk('upload')->deleteDirectory($directory);
        }
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

}
