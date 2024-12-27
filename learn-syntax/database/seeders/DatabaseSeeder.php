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
            ],[
                'title' => 'New course Techniques',
                'description' => 'Deep dive into modern JavaScript, including ES6+ features, async programming, and design patterns.',
                'image' => 'advanced-js.jpg',
                'status' => 1,
                'course_slug' => 'advanced-courset-techniques',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => ' JavaScript Techniques',
                'description' => 'Deep dive into modern JavaScript, including ES6+ features, async programming, and design patterns.',
                'image' => 'advanced-js.jpg',
                'status' => 1,
                'course_slug' => 'javascript-techniques',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Advanced Techniques',
                'description' => 'Deep dive into modern JavaScript, including ES6+ features, async programming, and design patterns.',
                'image' => 'advanced-js.jpg',
                'status' => 1,
                'course_slug' => 'advanced techniques',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Advanced HTML Techniques',
                'description' => 'Deep dive into modern JavaScript, including ES6+ features, async programming, and design patterns.',
                'image' => 'advanced-js.jpg',
                'status' => 1,
                'course_slug' => 'advanced-HTML-techniques',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Advanced CSS bootstrap',
                'description' => 'Deep dive into modern JavaScript, including ES6+ features, async programming, and design patterns.',
                'image' => 'advanced-js.jpg',
                'status' => 1,
                'course_slug' => 'advanced-css-techniques',
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
                'content' => 'Computers have become an integral part of modern life, revolutionizing the way we work, communicate, and entertain ourselves. From their origins as massive machines occupying entire rooms, computers have evolved into compact, powerful devices that fit into the palm of a hand. At their core, computers are devices designed to process information, capable of performing billions of calculations per second. This processing power drives innovation in fields like artificial intelligence, data analysis, and software development. For instance, advancements in computer technology enable businesses to optimize operations through data-driven decisions, while individuals leverage computers to connect globally via social media, email, and video conferencing platforms. Furthermore, the rise of cloud computing has transformed how data is stored and accessed, allowing users to retrieve files and applications from virtually anywhere. This capability fosters collaboration across borders and time zones, making teamwork more efficient than ever before. Education has also been revolutionized by computers, as students and educators alike benefit from tools that facilitate interactive learning, virtual classrooms, and access to vast online resources.

                On a technical level, a computer consists of several key components: the central processing unit (CPU), which acts as the brain of the system; memory, which temporarily stores data for quick access; and storage devices, like solid-state drives (SSDs) and hard drives, which retain data over the long term. These components are interconnected via a motherboard, enabling seamless communication. Advances in semiconductor technology have led to the development of faster and more energy-efficient processors, contributing to the proliferation of devices like laptops, tablets, and smartphones. The software running on these machines, whether operating systems like Windows, macOS, or Linux, or applications tailored for specific tasks, determines their functionality. Open-source software, in particular, has fostered a community-driven approach to innovation, where programmers worldwide collaborate to develop and refine applications.

                    In the gaming industry, computers serve as the foundation for creating and experiencing immersive virtual worlds. High-performance graphics cards render stunning visuals, while advancements in processing power enable complex simulations and real-time gameplay. Moreover, artificial intelligence algorithms embedded in modern games enhance the realism of non-player characters, creating dynamic and engaging experiences for players. Beyond entertainment, computer simulations play a critical role in scientific research, from modeling climate change to exploring molecular interactions in drug discovery. These applications highlight the versatility of computers and their ability to tackle some of humanitys greatest challenges.

                Despite their benefits, the rapid growth of computer technology has raised concerns about privacy, security, and environmental impact. Cybersecurity threats, such as hacking and data breaches, underscore the importance of safeguarding sensitive information. Ethical considerations also arise in the context of artificial intelligence, as developers strive to ensure these systems operate transparently and without bias. On the environmental front, the production and disposal of electronic devices contribute to e-waste, prompting calls for sustainable practices and recycling initiatives. As society becomes increasingly reliant on computers, striking a balance between innovation and responsibility will be crucial.

                Looking ahead, the future of computers is poised to be shaped by emerging technologies like quantum computing and machine learning. Quantum computers, which operate on the principles of quantum mechanics, promise unparalleled processing capabilities, potentially revolutionizing industries from cryptography to logistics. Meanwhile, advancements in machine learning are enabling computers to recognize patterns and make decisions with minimal human intervention. These developments suggest that computers will continue to drive progress, empowering individuals and organizations to overcome challenges and seize new opportunities.',
                'image_path' => 'images/html-tags-overview.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'topic_id' => 2, // Links to 'HTML Forms' topic
                'title' => 'Mastering HTML Forms',
                'content' => 'Computers have become an integral part of modern life, revolutionizing the way we work, communicate, and entertain ourselves. From their origins as massive machines occupying entire rooms, computers have evolved into compact, powerful devices that fit into the palm of a hand. At their core, computers are devices designed to process information, capable of performing billions of calculations per second. This processing power drives innovation in fields like artificial intelligence, data analysis, and software development. For instance, advancements in computer technology enable businesses to optimize operations through data-driven decisions, while individuals leverage computers to connect globally via social media, email, and video conferencing platforms. Furthermore, the rise of cloud computing has transformed how data is stored and accessed, allowing users to retrieve files and applications from virtually anywhere. This capability fosters collaboration across borders and time zones, making teamwork more efficient than ever before. Education has also been revolutionized by computers, as students and educators alike benefit from tools that facilitate interactive learning, virtual classrooms, and access to vast online resources.

On a technical level, a computer consists of several key components: the central processing unit (CPU), which acts as the brain of the system; memory, which temporarily stores data for quick access; and storage devices, like solid-state drives (SSDs) and hard drives, which retain data over the long term. These components are interconnected via a motherboard, enabling seamless communication. Advances in semiconductor technology have led to the development of faster and more energy-efficient processors, contributing to the proliferation of devices like laptops, tablets, and smartphones. The software running on these machines, whether operating systems like Windows, macOS, or Linux, or applications tailored for specific tasks, determines their functionality. Open-source software, in particular, has fostered a community-driven approach to innovation, where programmers worldwide collaborate to develop and refine applications.

In the gaming industry, computers serve as the foundation for creating and experiencing immersive virtual worlds. High-performance graphics cards render stunning visuals, while advancements in processing power enable complex simulations and real-time gameplay. Moreover, artificial intelligence algorithms embedded in modern games enhance the realism of non-player characters, creating dynamic and engaging experiences for players. Beyond entertainment, computer simulations play a critical role in scientific research, from modeling climate change to exploring molecular interactions in drug discovery. These applications highlight the versatility of computers and their ability to tackle some of humanitys greatest challenges.

Despite their benefits, the rapid growth of computer technology has raised concerns about privacy, security, and environmental impact. Cybersecurity threats, such as hacking and data breaches, underscore the importance of safeguarding sensitive information. Ethical considerations also arise in the context of artificial intelligence, as developers strive to ensure these systems operate transparently and without bias. On the environmental front, the production and disposal of electronic devices contribute to e-waste, prompting calls for sustainable practices and recycling initiatives. As society becomes increasingly reliant on computers, striking a balance between innovation and responsibility will be crucial.

Looking ahead, the future of computers is poised to be shaped by emerging technologies like quantum computing and machine learning. Quantum computers, which operate on the principles of quantum mechanics, promise unparalleled processing capabilities, potentially revolutionizing industries from cryptography to logistics. Meanwhile, advancements in machine learning are enabling computers to recognize patterns and make decisions with minimal human intervention. These developments suggest that computers will continue to drive progress, empowering individuals and organizations to overcome challenges and seize new opportunities.',
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
                'content' => 'Computers have become an integral part of modern life, revolutionizing the way we work, communicate, and entertain ourselves. From their origins as massive machines occupying entire rooms, computers have evolved into compact, powerful devices that fit into the palm of a hand. At their core, computers are devices designed to process information, capable of performing billions of calculations per second. This processing power drives innovation in fields like artificial intelligence, data analysis, and software development. For instance, advancements in computer technology enable businesses to optimize operations through data-driven decisions, while individuals leverage computers to connect globally via social media, email, and video conferencing platforms. Furthermore, the rise of cloud computing has transformed how data is stored and accessed, allowing users to retrieve files and applications from virtually anywhere. This capability fosters collaboration across borders and time zones, making teamwork more efficient than ever before. Education has also been revolutionized by computers, as students and educators alike benefit from tools that facilitate interactive learning, virtual classrooms, and access to vast online resources.

On a technical level, a computer consists of several key components: the central processing unit (CPU), which acts as the brain of the system; memory, which temporarily stores data for quick access; and storage devices, like solid-state drives (SSDs) and hard drives, which retain data over the long term. These components are interconnected via a motherboard, enabling seamless communication. Advances in semiconductor technology have led to the development of faster and more energy-efficient processors, contributing to the proliferation of devices like laptops, tablets, and smartphones. The software running on these machines, whether operating systems like Windows, macOS, or Linux, or applications tailored for specific tasks, determines their functionality. Open-source software, in particular, has fostered a community-driven approach to innovation, where programmers worldwide collaborate to develop and refine applications.

In the gaming industry, computers serve as the foundation for creating and experiencing immersive virtual worlds. High-performance graphics cards render stunning visuals, while advancements in processing power enable complex simulations and real-time gameplay. Moreover, artificial intelligence algorithms embedded in modern games enhance the realism of non-player characters, creating dynamic and engaging experiences for players. Beyond entertainment, computer simulations play a critical role in scientific research, from modeling climate change to exploring molecular interactions in drug discovery. These applications highlight the versatility of computers and their ability to tackle some of humanitys greatest challenges.

Despite their benefits, the rapid growth of computer technology has raised concerns about privacy, security, and environmental impact. Cybersecurity threats, such as hacking and data breaches, underscore the importance of safeguarding sensitive information. Ethical considerations also arise in the context of artificial intelligence, as developers strive to ensure these systems operate transparently and without bias. On the environmental front, the production and disposal of electronic devices contribute to e-waste, prompting calls for sustainable practices and recycling initiatives. As society becomes increasingly reliant on computers, striking a balance between innovation and responsibility will be crucial.

Looking ahead, the future of computers is poised to be shaped by emerging technologies like quantum computing and machine learning. Quantum computers, which operate on the principles of quantum mechanics, promise unparalleled processing capabilities, potentially revolutionizing industries from cryptography to logistics. Meanwhile, advancements in machine learning are enabling computers to recognize patterns and make decisions with minimal human intervention. These developments suggest that computers will continue to drive progress, empowering individuals and organizations to overcome challenges and seize new opportunities.',
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
