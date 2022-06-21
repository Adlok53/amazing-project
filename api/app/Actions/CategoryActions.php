<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;

class CategoryActions
{

    /**
     * Creates a folder with the category id
     * 
     * @param array $category
     */
    public static function create($category)
    {
        $id = $category['id'];
        Storage::disk('local')->makeDirectory("public/$id");
    }

    /**
     * Deletes the resulting folder with images
     * 
     * @param array $category
     */
    public static function delete($category)
    {
        $id = $category['id'];
        Storage::deleteDirectory("public/$id");
    }
}