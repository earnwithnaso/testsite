<x-app-layout>
    <x-slot name="header">
        <div class="flex items-end justify-between relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand/5 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="inline-block bg-brand/10 px-4 py-1 rounded-full text-brand text-[10px] font-black tracking-widest uppercase mb-3">Enrolled Content</div>
                <h2 class="font-black text-4xl text-primary leading-tight flex items-center gap-3 tracking-tighter">
                    <i class="hgi-stroke hgi-book-open-01 text-brand"></i>
                    My Learning Library
                </h2>
                <p class="text-secondary/60 font-medium mt-1">Manage your active enrollments and resume your progress.</p>
            </div>
            <a href="{{ route('courses.index') }}" class="hidden md:flex items-center gap-2 px-8 py-4 bg-primary text-white font-black rounded-full shadow-medium hover:shadow-floating transition-all text-sm group">
                <i class="hgi-stroke hgi-search-01"></i>
                Explore More
                <i class="hgi-stroke hgi-arrow-right-01 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </x-slot>

    @if($courses->isEmpty())
        <div class="py-32 text-center bg-white rounded-[40px] shadow-soft border border-soft-grey border-dashed">
            <div class="w-24 h-24 bg-soft-grey/30 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner">
                <i class="hgi-stroke hgi-folder-details text-5xl text-secondary/30"></i>
            </div>
            <h3 class="text-3xl font-black text-primary mb-4 tracking-tight">No courses found</h3>
            <p class="text-secondary/60 max-w-md mx-auto mb-10 font-medium">You haven't enrolled in any courses yet. Start your journey today with our curated content.</p>
            <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-3 px-10 py-5 bg-brand text-white font-black rounded-full shadow-glow hover:scale-105 transition-all">
                <i class="hgi-stroke hgi-book-02"></i>
                Browse All Courses
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($courses as $course)
                <div class="bg-white rounded-[40px] shadow-medium flex flex-col hover:shadow-floating transition-all duration-500 border border-transparent hover:border-soft-grey overflow-hidden group h-full">
                    <!-- Thumbnail -->
                    <div class="h-56 bg-soft-grey relative overflow-hidden">
                        @if($course->thumbnail_path)
                            <img src="{{ Str::startsWith($course->thumbnail_path, 'http') ? $course->thumbnail_path : Storage::url($course->thumbnail_path) }}" 
                                 alt="{{ $course->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center font-black text-primary/10 text-2xl">COURSE</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                    </div>

                    <!-- Content -->
                    <div class="p-8 flex-1 flex flex-col">
                        <div class="mb-6">
                            <h3 class="text-xl font-black text-primary mb-2 line-clamp-2 leading-tight group-hover:text-brand transition-colors">{{ $course->title }}</h3>
                            <p class="text-[10px] text-secondary/40 font-black uppercase tracking-widest flex items-center gap-1">
                                <i class="hgi-stroke hgi-user text-[12px]"></i>
                                {{ $course->instructor->name }}
                            </p>
                        </div>

                        <div class="mt-auto space-y-6">
                            <!-- Progress -->
                            @php
                                $total = (float)($course->lessons_count ?? 0);
                                $completed = (float)(\App\Models\LessonProgress::where('user_id', Auth::id())
                                    ->whereIn('lesson_id', $course->lessons->pluck('id'))
                                    ->count());
                                $percent = $total > 0 ? round(($completed / $total) * 100) : 0;
                            @endphp
                            <div class="space-y-3">
                                <div class="flex justify-between items-end">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-secondary/50 flex items-center gap-1">
                                        <i class="hgi-stroke hgi-playing-cards text-brand"></i>
                                        Your Progress
                                    </span>
                                    <span class="text-sm font-black text-primary">{{ (int)$percent }}%</span>
                                </div>
                                @php $progressWidth = (int)$percent . '%'; @endphp
                                <div class="w-full bg-soft-grey h-1.5 rounded-full overflow-hidden border border-soft-grey/30">
                                    <div class="bg-brand h-full rounded-full transition-all duration-1000 shadow-glow" style="width: {{ $progressWidth }}"></div>
                                </div>
                            </div>

                            <a href="{{ route('student.courses.show', $course->slug) }}" class="flex items-center justify-center gap-2 w-full py-4 bg-primary text-white font-black rounded-2xl shadow-medium hover:bg-brand transition-all group/btn">
                                <span>{{ $percent > 0 ? 'Resume Course' : 'Start Learning' }}</span>
                                <i class="hgi-stroke hgi-arrow-right-01 group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>
