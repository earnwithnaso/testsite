<x-web-layout>
    <!-- Hero Section -->
    <!-- Hero Section -->
    <section class="relative px-8 py-24 bg-gradient-to-br from-gray-50 via-white to-blue-50/30 overflow-hidden rounded-b-[80px] mb-20">
        <!-- Animated Background Orbs -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-brand/20 rounded-full blur-[100px] animate-pulse-slow"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-blue-400/20 rounded-full blur-[80px] animate-float"></div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-10">
            <div class="space-y-10">
                <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur px-5 py-2 rounded-full shadow-soft border border-white animate-fade-in-up">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-brand"></span>
                    </span>
                    <span class="text-xs font-black text-primary tracking-widest uppercase">The Future of E-Learning</span>
                </div>
                
                <h1 class="text-6xl md:text-7xl font-black text-primary leading-tight tracking-tighter">
                    Unlock Your Potential <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand to-blue-600">Without Limits.</span>
                </h1>
                
                <p class="text-xl text-secondary/70 max-w-lg leading-relaxed font-medium">
                    Experience a revolutionary learning platform designed to take your skills from beginner to industry-leader. Join the elite elite circle today.
                </p>
                
                <div class="flex flex-wrap gap-5">
                    <a href="{{ route('register') }}" class="px-10 py-5 bg-brand text-white font-black rounded-full shadow-[0_20px_50px_rgba(0,200,83,0.3)] hover:shadow-glow hover:-translate-y-1 transition-all duration-300">
                        Get Started Free
                    </a>
                    <a href="{{ route('courses.index') }}" class="px-10 py-5 bg-white text-primary font-bold rounded-full shadow-soft border border-soft-grey hover:border-brand transition-all flex items-center gap-2 group">
                        Browse Courses
                        <i class="hgi-stroke hgi-arrow-right-01 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                
                <div class="flex items-center gap-6 pt-4">
                    <div class="flex -space-x-4">
                        @for($i = 1; $i <= 4; $i++)
                        <div class="w-12 h-12 rounded-full border-4 border-white overflow-hidden bg-gray-200">
                             <img src="https://i.pravatar.cc/100?u={{$i}}" alt="User">
                        </div>
                        @endfor
                        <div class="w-12 h-12 rounded-full border-4 border-white bg-brand flex items-center justify-center text-white text-xs font-bold shadow-medium">
                            {{ $totalStudents > 1000 ? floor($totalStudents/1000).'k+' : $totalStudents }}
                        </div>
                    </div>
                    <div class="h-10 w-[1px] bg-border-grey hidden md:block"></div>
                    <div>
                        <div class="flex text-yellow-500 mb-1">
                            @for($i=0; $i<5; $i++)
                            <i class="hgi-stroke hgi-star text-sm"></i>
                            @endfor
                        </div>
                        <p class="text-xs font-bold text-secondary uppercase tracking-widest">4.9/5 Student Rating</p>
                    </div>
                </div>
            </div>

            <div class="relative lg:h-[600px] flex items-center justify-center">
                <!-- Floating Decorative Cards -->
                <div class="absolute top-10 left-0 bg-white p-4 rounded-2xl shadow-floating z-20 animate-float max-w-[180px]">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-brand/10 rounded-full flex items-center justify-center text-brand">
                             <i class="hgi-stroke hgi-clipping-path text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-primary">Web Design</p>
                            <p class="text-[10px] text-secondary font-medium">85% Completed</p>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-20 right-0 bg-white p-4 rounded-2xl shadow-floating z-20 animate-float-delayed max-w-[200px]">
                    <p class="text-xs font-bold text-primary mb-2">New Achievement!</p>
                    <div class="flex gap-2">
                        @for($i=0; $i<4; $i++)
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 border-2 border-white flex items-center justify-center">
                            <i class="hgi-stroke hgi-tally-mark-04 text-[8px] text-white"></i>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- Main Hero Image -->
                <div class="relative z-10 w-full max-w-md aspect-[4/5] perspective-1000">
                    <div class="w-full h-full bg-gradient-to-br from-brand to-blue-500 rounded-[60px] p-1 shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-700">
                        <div class="w-full h-full bg-white rounded-[58px] overflow-hidden relative">
                            <img src="{{ asset('images/hero_student.png') }}" alt="Student" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/40 via-transparent to-transparent"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Background Shapes -->
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-brand/10 rounded-full blur-3xl"></div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/10 rounded-full blur-[100px]"></div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="max-w-7xl mx-auto px-8 mb-32">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="group bg-white p-10 rounded-4xl shadow-soft hover:shadow-floating transition-all duration-500 relative overflow-hidden border border-soft-grey hover:border-transparent">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-brand to-green-600 opacity-5 group-hover:opacity-10 transition-opacity rounded-bl-[80px]"></div>
                <div class="w-12 h-12 flex items-center justify-center rounded-2xl bg-soft-grey mb-4 transform group-hover:scale-110 transition-transform duration-300">
                    <i class="hgi-stroke hgi-book-02 text-2xl text-primary"></i>
                </div>
                <h3 class="text-4xl font-black text-primary mb-1">{{ $totalCourses }}+</h3>
                <p class="text-xs font-black text-secondary/60 uppercase tracking-widest">Courses</p>
            </div>

            <div class="group bg-white p-10 rounded-4xl shadow-soft hover:shadow-floating transition-all duration-500 relative overflow-hidden border border-soft-grey hover:border-transparent">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-600 opacity-5 group-hover:opacity-10 transition-opacity rounded-bl-[80px]"></div>
                <div class="w-12 h-12 flex items-center justify-center rounded-2xl bg-soft-grey mb-4 transform group-hover:scale-110 transition-transform duration-300">
                    <i class="hgi-stroke hgi-user-group text-2xl text-primary"></i>
                </div>
                <h3 class="text-4xl font-black text-primary mb-1">{{ $totalStudents > 1000 ? floor($totalStudents/1000).'k' : $totalStudents }}</h3>
                <p class="text-xs font-black text-secondary/60 uppercase tracking-widest">Students</p>
            </div>

            <div class="group bg-white p-10 rounded-4xl shadow-soft hover:shadow-floating transition-all duration-500 relative overflow-hidden border border-soft-grey hover:border-transparent">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-600 opacity-5 group-hover:opacity-10 transition-opacity rounded-bl-[80px]"></div>
                <div class="w-12 h-12 flex items-center justify-center rounded-2xl bg-soft-grey mb-4 transform group-hover:scale-110 transition-transform duration-300">
                    <i class="hgi-stroke hgi-star text-2xl text-primary"></i>
                </div>
                <h3 class="text-4xl font-black text-primary mb-1">10y</h3>
                <p class="text-xs font-black text-secondary/60 uppercase tracking-widest">Experience</p>
            </div>

            <div class="group bg-white p-10 rounded-4xl shadow-soft hover:shadow-floating transition-all duration-500 relative overflow-hidden border border-soft-grey hover:border-transparent">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-orange-500 to-red-600 opacity-5 group-hover:opacity-10 transition-opacity rounded-bl-[80px]"></div>
                <div class="w-12 h-12 flex items-center justify-center rounded-2xl bg-soft-grey mb-4 transform group-hover:scale-110 transition-transform duration-300">
                    <i class="hgi-stroke hgi-chat-dot-02 text-2xl text-primary"></i>
                </div>
                <h3 class="text-4xl font-black text-primary mb-1">24/7</h3>
                <p class="text-xs font-black text-secondary/60 uppercase tracking-widest">Support</p>
            </div>
        </div>
    </section>

    <!-- Featured Courses -->
    <section class="max-w-7xl mx-auto px-8 mb-32">
        <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-16 gap-6">
            <div class="text-center md:text-left">
                <div class="inline-block bg-brand/10 px-4 py-1 rounded-full text-brand text-xs font-black tracking-widest uppercase mb-4">Top Rated Education</div>
                <h2 class="text-5xl font-black text-primary mb-4 tracking-tighter">Explore Featured Courses</h2>
                <p class="text-secondary/70 text-xl font-medium max-w-2xl">Hand-picked premium content designed to accelerate your career and master new technologies.</p>
            </div>
            <a href="{{ route('courses.index') }}" class="group flex items-center gap-3 bg-primary text-white px-8 py-4 rounded-full font-bold hover:bg-brand transition-all shadow-medium">
                View All
                <i class="hgi-stroke hgi-arrow-right-01 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($featuredCourses as $course)
            <div class="bg-white rounded-[40px] shadow-medium flex flex-col hover:shadow-floating transition-all duration-500 border border-transparent hover:border-soft-grey overflow-hidden group h-full">
                <!-- Thumbnail -->
                <div class="h-56 bg-soft-grey relative overflow-hidden">
                    <img src="{{ $course->thumbnail_path && Str::startsWith($course->thumbnail_path, 'http') ? $course->thumbnail_path : ($course->thumbnail_path ? Storage::url($course->thumbnail_path) : asset('images/course_web.png')) }}" 
                         alt="{{ $course->title }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                    <!-- Badges -->
                    <div class="absolute top-4 left-4 flex gap-2">
                        @if($course->is_featured)
                        <span class="bg-brand px-4 py-1.5 rounded-full text-[10px] font-black tracking-widest text-white shadow-soft">
                            FEATURED
                        </span>
                        @endif
                        <span class="bg-white/95 backdrop-blur px-4 py-1.5 rounded-full text-[10px] font-black tracking-widest text-primary shadow-soft">
                            {{ strtoupper($course->difficulty_level) }}
                        </span>
                    </div>

                    <!-- Price on Image -->
                    <div class="absolute bottom-4 right-4 shadow-medium">
                        <div class="bg-white rounded-2xl p-3 flex items-center gap-2">
                            <span class="text-primary font-black text-xl">₦{{ number_format($course->price, 0) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8 flex-1 flex flex-col">
                    <h3 class="text-xl font-black text-primary mb-2 line-clamp-2 leading-tight group-hover:text-brand transition-colors">
                        {{ $course->title }}
                    </h3>
                    
                    <p class="text-secondary/60 text-xs font-black uppercase tracking-widest mb-6 flex items-center gap-1">
                        By {{ $course->instructor->name }}
                    </p>

                    <div class="mt-auto space-y-6">
                        <div class="flex items-center gap-2">
                            @foreach($course->categories->take(1) as $category)
                            <span class="text-brand text-xs font-black uppercase tracking-wider flex items-center gap-1">
                                <i class="hgi-stroke hgi-tag-01"></i>
                                {{ $category->name }}
                            </span>
                            @endforeach
                        </div>

                        <a href="{{ route('courses.show', $course->slug) }}" class="flex items-center justify-center gap-2 w-full py-4 bg-primary text-white font-bold rounded-full shadow-medium hover:bg-brand transition-all group/btn">
                            <span>View Details</span>
                            <i class="hgi-stroke hgi-arrow-right-01 group-hover/btn:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center bg-soft-grey rounded-4xl">
                <i class="hgi-stroke hgi-search-01 text-4xl text-secondary mb-4 block"></i>
                <p class="text-secondary font-bold">No featured courses available at the moment.</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Call to Action -->
    <section class="max-w-7xl mx-auto px-8 mb-32">
        <div class="bg-primary rounded-[60px] p-12 md:p-24 text-center relative overflow-hidden shadow-2xl">
            <!-- Decorative concentric circles -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] border border-white/5 rounded-full pointer-events-none"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] border border-white/5 rounded-full pointer-events-none"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] border border-white/5 rounded-full pointer-events-none"></div>
            
            <!-- Glow effect -->
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-brand/20 rounded-full blur-[100px]"></div>
            <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-blue-500/20 rounded-full blur-[100px]"></div>

            <div class="relative z-10">
                <h2 class="text-5xl md:text-6xl font-black text-white mb-8 tracking-tighter max-w-3xl mx-auto leading-tight">
                    Start Your Path to <br> <span class="text-brand underline decoration-white/20 underline-offset-8">Mastery</span> Today.
                </h2>
                <p class="text-white/60 text-xl font-medium mb-12 max-w-2xl mx-auto leading-relaxed">
                    Join over 12,000 students learning from top-tier instructors. Full access to all courses, projects, and exclusive community resources.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-12 py-6 bg-brand text-white font-black rounded-full text-lg shadow-glow hover:-translate-y-1 transition-all">
                        Join the Community
                    </a>
                    <a href="{{ route('contact') }}" class="w-full sm:w-auto px-12 py-6 bg-white/10 text-white font-black rounded-full text-lg hover:bg-white/20 transition-all border border-white/10 backdrop-blur-sm">
                        Contact Support
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
