<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\Course;
use Illuminate\Support\Str;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Starting image download...\n";

// Ensure directory exists
if (!Storage::disk('public')->exists('courses')) {
    Storage::disk('public')->makeDirectory('courses');
}

$courses = Course::all();

foreach ($courses as $course) {
    // Check if thumbnail matches a URL pattern
    if ($course->thumbnail_path && Str::startsWith($course->thumbnail_path, 'http')) {
        echo "Processing course: {$course->title}\n";
        echo "Downloading from: {$course->thumbnail_path}\n";

        try {
            // Use file_get_contents fallback
            $context = stream_context_create([
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ]);
            
            $content = @file_get_contents($course->thumbnail_path, false, $context);

            if ($content !== false) {
                // Generate a filename
                $extension = 'jpg'; // Unsplash images usually work as jpg
                $filename = 'courses/' . Str::slug($course->title) . '-' . Str::random(6) . '.' . $extension;

                // Store the file
                Storage::disk('public')->put($filename, $content);

                // Update the course
                $course->thumbnail_path = $filename;
                $course->save();

                echo "Saved to: {$filename}\n";
            } else {
                echo "Failed to download image (file_get_contents returned false).\n";
            }
        } catch (\Exception $e) {
            echo "Error downloading image: " . $e->getMessage() . "\n";
        }
    } else {
        echo "Skipping course: {$course->title} (Local or empty path)\n";
    }
}

echo "Done.\n";
