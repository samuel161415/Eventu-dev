<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PostSeeder extends Seeder
{
    public function run()
    {
        $filePath = public_path('excel/posts/posts.csv');
        $file = fopen($filePath, 'r');

        // Get the headers from the first row
        $headers = fgetcsv($file, 0, ',');

        // Ensure the database connection uses UTF-8
        DB::statement('SET NAMES utf8mb4');
        DB::statement('SET CHARACTER SET utf8mb4');

        // Read each row of the CSV file
        while (($row = fgetcsv($file, 0, ',')) !== false) {
            $data = array_combine($headers, $row);

            // Skip rows with missing required fields
            if (empty($data['title']) || empty($data['slug']) || empty($data['content']) || empty($data['user_id']) || empty($data['created_at']) || empty($data['updated_at'])) {
                continue;
            }

            // Escape values and ensure they are properly encoded
            $data = array_map(function($value) {
                return utf8_encode($value);
            }, $data);

            // Insert the data into the database
            DB::table('posts')->insert([
                'title' => $data['title'],
                'slug' => $data['slug'],
                'content' => $data['content'],
                'user_id' => (int) $data['user_id'],
                'image' => $data['image'] ?? null,
                'meta_description' => $data['meta_description'] ?? null,
                'meta_keywords' => $data['meta_keywords'] ?? null,
                'is_published' => (int) $data['is_published'] ?? 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        fclose($file);
    }
}
