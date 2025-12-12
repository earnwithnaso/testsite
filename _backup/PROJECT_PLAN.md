# Course Subscription Website Plan

## 1. Project Overview
A simple yet powerful course subscription platform built with PHP Laravel. The platform will have two distinct sections: **Admin** for content management and **User** for consuming content and managing subscriptions.

## 2. Roles & Permissions

### Admin
*   **Dashboard:** View key metrics (Total Users, Active Subscriptions, Total Revenue).
*   **Course Management:** Create, Edit, Delete, and Publish courses.
*   **Lesson Management:** Add video lessons/episodes to courses.
*   **User Management:** View registered users and their subscription status.

### User
*   **Browse:** View available courses and free previews.
*   **Subscribe:** Purchase a subscription (Monthly/Yearly) to access premium content.
*   **Learn:** Watch course videos and track progress (optional).
*   **Account:** Manage profile and subscription settings.

## 3. Technical Architecture

*   **Framework:** Laravel 11.x
*   **Frontend:** Laravel Blade Templates + Tailwind CSS
*   **Authentication:** Laravel Breeze (Simple, customizable auth)
*   **Payments:** Laravel Cashier (Stripe)
*   **Database:** SQLite (for development) / MySQL (for production)

## 4. Database Schema

### `users`
*   `id`, `name`, `email`, `password`
*   `is_admin` (boolean)
*   `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at` (Cashier columns)

### `courses`
*   `id`, `title`, `slug`, `description`, `thumbnail_path`
*   `is_published` (boolean)
*   `created_at`, `updated_at`

### `lessons`
*   `id`, `course_id` (FK)
*   `title`, `slug`, `video_url` (or path)
*   `description`
*   `position` (for ordering)
*   `is_free` (boolean - for previews)

### `subscriptions` (Managed by Cashier)
*   Standard Laravel Cashier subscription table.

## 5. Implementation Roadmap

### Phase 1: Setup & Auth
*   Initialize Laravel Project.
*   Install Tailwind CSS.
*   Install & Configure Laravel Breeze (Auth).
*   Set up `is_admin` middleware.

### Phase 2: Database & Models
*   Create Migrations for Courses and Lessons.
*   Define Models and Relationships (`Course hasMany Lessons`).
*   Seed dummy data.

### Phase 3: Admin Panel
*   Create Admin Layout.
*   Build CRUD for Courses.
*   Build CRUD for Lessons.

### Phase 4: Public/User Views
*   Landing Page (List of Courses).
*   Course Detail Page (List of Lessons).
*   Lesson Watch Page (Video Player).
*   Protect content (Middleware to check subscription).

### Phase 5: Payments (Subscription)
*   Install Laravel Cashier.
*   Configure Stripe keys.
*   Create Pricing Page.
*   Handle Checkout & Webhooks.
