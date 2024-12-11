<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('courses')->insert([
            [
                'title' => 'Introduction to Web Development',
                'description' => 'Learn the basics of web development, including HTML, CSS, and JavaScript.',
                'image' => 'web-development.jpg',
                'status' => 1,
                'course_slug' => 'introduction-to-web-development',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Advanced JavaScript Techniques',
                'description' => 'Deep dive into modern JavaScript, including ES6+ features, async programming, and design patterns.',
                'image' => 'advanced-js.jpg',
                'status' => 1,
                'course_slug' => 'advanced-javascript-techniques',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mastering Laravel',
                'description' => 'A comprehensive guide to Laravel, covering routing, models, controllers, and advanced concepts.',
                'image' => 'mastering-laravel.jpg',
                'status' => 1,
                'course_slug' => 'mastering-laravel',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        DB::table('chapters')->insert([
            [
                'course_id' => 1,
                'chapter_name' => 'Getting Started with HTML',
                'chapter_description' => 'An introduction to HTML and its fundamental concepts.',
                'chapter_slug' => 'getting-started-with-html',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'chapter_name' => 'Mastering CSS',
                'chapter_description' => 'Learn how to style web pages using CSS, including layout and design techniques.',
                'chapter_slug' => 'mastering-css',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2,
                'chapter_name' => 'Asynchronous JavaScript',
                'chapter_description' => 'Master async programming with promises, async/await, and event loops.',
                'chapter_slug' => 'asynchronous-javascript',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 3,
                'chapter_name' => 'Routing in Laravel',
                'chapter_description' => 'Learn how to manage routes and controllers in a Laravel application.',
                'chapter_slug' => 'routing-in-laravel',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 3,
                'chapter_name' => 'Eloquent ORM',
                'chapter_description' => 'An in-depth guide to using Eloquent ORM for database management.',
                'chapter_slug' => 'eloquent-orm',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('topics')->insert([
            [
                'chapter_id' => 1,
                'topic_name' => 'HTML Tags Overview',
                'topic_description' => 'A comprehensive list of HTML tags and their usage.',
                'topic_slug' => 'html-tags-overview',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chapter_id' => 1,
                'topic_name' => 'HTML Forms',
                'topic_description' => 'Learn how to create forms using HTML and capture user input.',
                'topic_slug' => 'html-forms',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chapter_id' => 2,
                'topic_name' => 'CSS Selectors',
                'topic_description' => 'An overview of CSS selectors and how to use them effectively.',
                'topic_slug' => 'css-selectors',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chapter_id' => 2,
                'topic_name' => 'CSS Flexbox',
                'topic_description' => 'A guide to using CSS Flexbox for layout and positioning.',
                'topic_slug' => 'css-flexbox',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chapter_id' => 3,
                'topic_name' => 'Promises in JavaScript',
                'topic_description' => 'Understand how to use Promises for asynchronous programming.',
                'topic_slug' => 'promises-in-javascript',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
