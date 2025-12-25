<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, \Laravel\Cashier\Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'phone',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    /**
     * Get all lesson progress records for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lessonProgress()
    {
        return $this->hasMany(LessonProgress::class);
    }

    public function enrolledCourses()
    {
        return Course::whereHas('orderItems.order', function ($query) {
            $query->where('user_id', $this->id)->where('payment_status', 'paid');
        });
    }

    /**
     * Check if the user is enrolled in a specific course.
     *
     * @param  \App\Models\Course  $course
     * @return bool
     */
    public function isEnrolledIn(Course $course): bool
    {
        return $this->orders()->where('payment_status', 'paid')
            ->whereHas('items', function($query) use ($course) {
                $query->where('course_id', $course->id);
            })->exists();
    }

    public function isInstructor(): bool
    {
        return $this->role === 'instructor';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStaff(): bool
    {
        return $this->isAdmin() || $this->isInstructor();
    }

    /**
     * Get all certificates earned by this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
