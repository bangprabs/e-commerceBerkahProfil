<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_image',
    ];

    public function subcategories()
    {
        return $this->hasMany('App\Models\Category', 'parent_id')->where('status', 1);
    }

    public function parentcategory()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id')->select('id', 'category_name');
    }

    public static function getCategories()
    {
        $getCategories = Category::where(['parent_id' => 0, 'status'=> 1])->with('subcategories')->get();
        return $getCategories;
    }

    public static function catDetails($url)
    {
        $catDetails = Category::select('id', 'parent_id', 'category_name', 'url', 'meta_title', 'meta_description', 'meta_keywords', 'description')->with(['subcategories' => function($query){
            $query->select('id', 'parent_id', 'category_name', 'url', 'description')->where('status', 1);
        }])->where('url', $url)->first()->toArray();

        if ($catDetails['parent_id'] == 0) {
            #Hanya menampilkan main cateogory di breadcrumb
            $breadcrumb = '<a href="'.url($catDetails['url']).'">'.$catDetails['category_name'].'</a>';
        } else {
            #menampilkan semua main dan sub kategori di breadcrumb
            $parentCategory = Category::select('category_name', 'url')->where('id', $catDetails['parent_id'])->first()->toArray();
            $breadcrumb = '<a href="'.url($parentCategory['url']).'">'.$parentCategory['category_name'].'</a>&nbsp;<span class="divider">/</span>&nbsp;<a href="'.url($catDetails['url']).'">'.$catDetails['category_name'].'</a>';
        }

        $catIds = array();
        $catIds[] = $catDetails['id'];
        foreach ($catDetails['subcategories'] as $key => $subcat) {
            $catIds[] = $subcat['id'];
        }
        return array('catIds' => $catIds, 'catDetails' => $catDetails, 'breadcrumb' => $breadcrumb);
    }

    // 'breadcrumb' => $breadcrumb

}
