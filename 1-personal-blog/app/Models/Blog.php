<?php
// app/Models/Blog.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
	use HasFactory;

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
