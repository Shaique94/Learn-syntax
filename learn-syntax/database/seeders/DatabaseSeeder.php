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

        DB::table('posts')->insert([
            [
                'topic_id' => 1, // Links to 'HTML Tags Overview' topic
                'title' => 'HTML Tags Overview: Complete Guide',
                'content' => 'This post provides a comprehensive overview of all HTML tags, their purposes, and usage examples. Learn how to structure HTML documents with essential tags like <div>, <span>, <header>, <footer>, and more.',
                'image_path' => 'images/html-tags-overview.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'topic_id' => 2, // Links to 'HTML Forms' topic
                'title' => 'Mastering HTML Forms',
                'content' => 'Forms are a critical part of web development. This post dives into the different types of form inputs, like text fields, radio buttons, checkboxes, and how to process form data with GET and POST methods.',
                'image_path' => 'images/html-forms.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'topic_id' => 3, // Links to 'CSS Selectors' topic
                'title' => 'CSS Selectors Explained',
                'content' => 'CSS selectors are essential for targeting specific elements on a webpage. In this post, we discuss universal selectors, class selectors, ID selectors, attribute selectors, and more.',
                'image_path' => 'images/css-selectors.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'topic_id' => 4, // Links to 'CSS Flexbox' topic
                'title' => 'CSS Flexbox: Layouts Made Easy',
                'content' => 'The Flexbox layout system provides a powerful way to arrange items in a container. This post explains the key concepts of Flexbox, including justify-content, align-items, and flex-grow.',
                'image_path' => 'images/css-flexbox.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'topic_id' => 5, // Links to 'Promises in JavaScript' topic
                'title' => 'Mastering JavaScript Promises',
                'content' => 'Promises are used to handle asynchronous operations in JavaScript. This post provides a step-by-step guide on how promises work, how to create them, and how to chain multiple promises for effective async workflows.',
                'image_path' => 'images/promises-in-javascript.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        
    }
}
