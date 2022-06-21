<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StyleActions
{

    /**
     * Formats the resulting image and saves it to Storage /public/$id/
     * 
     * @param array $data
     * @return string $filename
     */
    public static function save($data)
    {
        $id = $data['category_id'];
        $filename = $data['photo']->getClientOriginalName();

        $data['photo']->move(Storage::path("/public/$id/"),$filename);
        $thumbnail = Image::make(Storage::path("/public/$id/").$filename);
        $thumbnail->fit(300, 300);
        $thumbnail->save(Storage::path("/public/$id/").$filename);

        return $filename;
    }

    /**
     * Deletes the old image, formats the resulting image and saves it in Storage /public/$id/
     * 
     * @param array $data
     * @param array $style
     * @return string $filename
     */
    public static function update($data, $style)
    {
        $id = $data['category_id'];

        if (Storage::delete("public/$id/" . $style['photo'])) {
            $filename = $data['photo']->getClientOriginalName();

            $data['photo']->move(Storage::path("/public/$id/"),$filename);
            $thumbnail = Image::make(Storage::path("/public/$id/").$filename);
            $thumbnail->fit(300, 300);
            $thumbnail->save(Storage::path("/public/$id/").$filename);
    
            return $filename;
        }
    }

    /**
     * Deletes the resulting image from Storage /public/$id/
     * 
     * @param array $data
     */
    public static function delete($data)
    {
        $id = $data['category_id'];
        Storage::delete("public/$id/" . $data['photo']);
    }
}
