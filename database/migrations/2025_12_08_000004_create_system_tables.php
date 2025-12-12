<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Email Logging
        Schema::create('email_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('to_email');
            $table->string('subject');
            $table->text('body');
            $table->string('template')->nullable();
            $table->enum('status', ['sent', 'failed', 'pending'])->default('pending');
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });

        // Email Templates
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // e.g., 'welcome_email'
            $table->string('subject');
            $table->text('body'); // HTML content
            $table->json('variables')->nullable(); // List of available variables
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // SEO Settings for static pages
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('page')->unique(); // e.g., 'home', 'about'
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('twitter_card')->default('summary_large_image');
            $table->string('canonical_url')->nullable();
            $table->string('robots')->default('index, follow');
            $table->timestamps();
        });

        // General Site Settings
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->enum('type', ['text', 'boolean', 'json', 'file'])->default('text');
            $table->string('group')->default('general'); // e.g., 'payment', 'social', 'contact'
            $table->boolean('is_public')->default(false); // Exposed to frontend?
            $table->timestamps();
        });

        // Activity Logs
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action'); // e.g., 'updated_profile'
            $table->text('description')->nullable();
            $table->nullableMorphs('subject'); // Polymorphic (model_type, model_id)
            $table->json('properties')->nullable(); // Changed attributes, etc.
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });

        // CMS Pages (About Us, Terms, etc.)
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->boolean('is_published')->default(false);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });

        // Contact Messages
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamp('replied_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('seo_settings');
        Schema::dropIfExists('email_templates');
        Schema::dropIfExists('email_logs');
    }
};
