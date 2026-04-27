<?php
// app/Models/Blog.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'content', 'slug'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blog_category');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tag');
    }
}
