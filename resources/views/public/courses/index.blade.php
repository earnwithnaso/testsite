<x-web-layout>
    <div class="px-8 max-w-7xl mx-auto py-20">
        <!-- Header Section -->
        <div class="relative mb-20">
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-brand/5 rounded-full blur-3xl"></div>
            <div class="text-center relative z-10">
                <div class="inline-block bg-brand/10 px-4 py-1 rounded-full text-brand text-xs font-black tracking-widest uppercase mb-4">Limitless Learning</div>
                <h1 class="text-6xl font-black text-primary mb-6 tracking-tighter">Explore Our Courses</h1>
                <p class="text-xl text-secondary/70 max-w-2xl mx-auto font-medium">Empower yourself with industry-leading knowledge. From beginner to pro, we have a path for you.</p>
            </div>
        </div>

        <!-- Premium Filter Pills -->
        <div class="flex flex-wrap justify-center gap-4 mb-20">
            <button class="px-10 py-4 bg-primary text-white rounded-full font-black shadow-medium hover:shadow-floating transition-all whitespace-nowrap text-sm">
                All Courses
            </button>
            @php
                $tags = ['Development', 'Design', 'Business', 'Marketing', 'Crypto'];
            @endphp
            @foreach($tags as $tag)
                <button class="px-8 py-4 bg-white text-secondary font-black rounded-full shadow-soft hover:shadow-medium border border-soft-grey whitespace-nowrap hover:text-primary transition-all text-sm">
                    {{ $tag }}
                </button>
            @endforeach
        </div>

        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($courses as $course)
                <div class="bg-white rounded-[40px] shadow-medium flex flex-col hover:shadow-floating transition-all duration-500 border border-transparent hover:border-soft-grey overflow-hidden group h-full">
                    <!-- Thumbnail Area -->
                    <div class="h-56 bg-soft-grey relative overflow-hidden">
                        <img src="{{ $course->thumbnail_path && Str::startsWith($course->thumbnail_path, 'http') ? $course->thumbnail_path : ($course->thumbnail_path ? Storage::url($course->thumbnail_path) : asset('images/course_web.png')) }}" 
                             alt="{{ $course->title }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex gap-2">
                             <span class="bg-white/95 backdrop-blur px-4 py-1.5 rounded-full text-[10px] font-black tracking-widest text-primary shadow-soft">
                                {{ strtoupper($course->difficulty_level) }}
                            </span>
                        </div>

                        <!-- Price on Image -->
                        <div class="absolute bottom-4 right-4 shadow-medium">
                            <div class="bg-white rounded-2xl p-3 flex items-center gap-2">
                                <span class="text-primary font-black text-xl">₦{{ number_format((float)($course->price ?? 0), 0) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Content Area -->
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="text-xl font-black text-primary mb-2 line-clamp-2 leading-tight group-hover:text-brand transition-colors">
                            {{ $course->title }}
                        </h3>
                        
                        <p class="text-secondary/60 text-xs font-black uppercase tracking-widest mb-6 flex items-center gap-1">
                            By {{ $course->instructor->name }}
                        </p>

                        <div class="mt-auto space-y-6">
                            <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest text-secondary/50">
                                <span class="flex items-center gap-1">
                                    <i class="hgi-stroke hgi-book-open-01 text-brand"></i>
                                    {{ $course->lessons_count ?? 0 }} Lessons
                                </span>
                                <span class="flex items-center gap-1">
                                    <i class="hgi-stroke hgi-user-group text-brand"></i>
                                    {{ $course->students_count ?? rand(50, 200) }} Students
                                </span>
                            </div>

                            <a href="{{ route('courses.show', $course->slug) }}" class="flex items-center justify-center gap-2 w-full py-4 bg-primary text-white font-bold rounded-full shadow-medium hover:bg-brand transition-all group/btn">
                                <span>Learn More</span>
                                <i class="hgi-stroke hgi-arrow-right-01 group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-32 text-center bg-white rounded-[40px] shadow-soft border border-soft-grey border-dashed">
                    <div class="w-20 h-20 bg-soft-grey/30 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="hgi-stroke hgi-search-01 text-4xl text-secondary"></i>
                    </div>
                    <h3 class="text-2xl font-black text-primary mb-2">No courses found</h3>
                    <p class="text-secondary font-medium">We're constantly adding new content. Check back soon!</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-20 flex justify-center">
            {{ $courses->links() }}
        </div>
    </div>
</x-web-layout>
