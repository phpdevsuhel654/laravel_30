<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create a default user
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // Create categories and tags
        $categories = Category::factory(5)->create();
        $tags = Tag::factory(10)->create();

        // Create blogs and attach categories/tags
        Blog::factory(20)->create(['user_id' => $user->id])->each(function ($blog) use ($categories, $tags) {
            $blog->categories()->attach(
                $categories->random(rand(1, 2))->pluck('id')->toArray()
            );
            $blog->tags()->attach(
                $tags->random(rand(2, 4))->pluck('id')->toArray()
            );
        });
    }
}
