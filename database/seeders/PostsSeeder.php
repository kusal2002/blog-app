<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Fetch all users and categories
        $users = User::all();
        $categories = Category::all();

        if ($users->isEmpty() || $categories->isEmpty()) {
            $this->command->info('No users or categories found. Please seed them first.');
            return;
        }

        foreach ($categories as $category) {
            foreach ($users as $user) {
                for ($i = 0; $i < 10; $i++) { // Create 10 posts per user-category pair
                    Post::create([
                        'title' => $faker->sentence(6, true), // Generate a random title
                        'slug' => Str::slug($faker->sentence(6, true) . '-' . $i), // Unique slug
                        'content' => $faker->paragraphs(3, true), // Generate random paragraphs
                        'image' => 'https://picsum.photos/800/600?random=12965',
                        'user_id' => $user->id,
                        'category_id' => $category->id,
                    ]);
                }
            }
        }

        $this->command->info('Sample posts created successfully!');
    }

}
