<x-web-layout>
    @section('title', $course->meta_title ?: $course->title)
    
    @section('meta')
        <meta name="description" content="{{ $course->meta_description ?: Str::limit($course->description, 160) }}">
        <meta name="keywords" content="{{ $course->meta_keywords ?: 'education, online learning, course' }}">
    @endsection

    <div class="px-4 max-w-6xl mx-auto">
        <!-- Hero Section -->
        <div class="bg-primary text-white rounded-5xl shadow-floating p-8 md:p-12 mb-12 relative overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
                <div class="space-y-8">
                    <div class="flex flex-wrap gap-4">
                        <span class="px-4 py-1.5 bg-white/20 backdrop-blur rounded-full text-[10px] font-black tracking-widest uppercase text-white border border-white/10">{{ $course->difficulty_level }}</span>
                         @foreach($course->categories as $category)
                            <span class="px-4 py-1.5 bg-brand/30 border border-brand/20 rounded-full text-[10px] font-black tracking-widest uppercase text-white shadow-soft">{{ $category->name }}</span>
                        @endforeach
                    </div>
                    
                    <h1 class="text-5xl md:text-6xl font-black leading-tight tracking-tighter text-white">{{ $course->title }}</h1>
                    <p class="text-white/70 text-lg leading-relaxed font-medium line-clamp-3">{{ $course->short_description ?: Str::limit($course->description, 150) }}</p>
                    
                    <div class="flex flex-wrap items-center gap-8 pt-4">
                        <div class="flex items-center gap-3 bg-white/5 p-2 pr-6 rounded-2xl border border-white/10">
                            <div class="w-12 h-12 bg-white/10 rounded-xl overflow-hidden flex items-center justify-center shadow-lg border border-white/10">
                                @if($course->instructor->avatar)
                                    <img src="{{ Storage::url($course->instructor->avatar) }}" class="w-full h-full object-cover">
                                @else
                                    <i class="hgi-stroke hgi-user text-white/50 text-xl"></i>
                                @endif
                            </div>
                            <div>
                                <p class="text-[10px] text-white/40 font-black uppercase tracking-widest">Instructor</p>
                                <p class="text-sm font-bold text-white">{{ $course->instructor->name }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                             <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-white/50">
                                <i class="hgi-stroke hgi-book-open-01 text-xl"></i>
                             </div>
                             <div>
                                 <p class="text-[10px] text-white/40 font-black uppercase tracking-widest">Lessons</p>
                                 <p class="text-sm font-bold text-white">{{ $course->lessons->count() }}</p>
                             </div>
                        </div>

                        @if($course->duration_hours)
                        <div class="flex items-center gap-3">
                             <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-white/50">
                                <i class="hgi-stroke hgi-clock-01 text-xl"></i>
                             </div>
                             <div>
                                 <p class="text-[10px] text-white/40 font-black uppercase tracking-widest">Duration</p>
                                 <p class="text-sm font-bold text-white">{{ $course->duration_hours }}h</p>
                             </div>
                        </div>
                        @endif
                    </div>

                    <div class="pt-6 flex flex-wrap gap-4 items-center">
                        <span class="text-primary font-black text-xl">₦{{ number_format((float)($course->price ?? 0), 0) }}</span>
                        @auth
                            <a href="{{ route('checkout.start', $course) }}" class="px-8 py-4 bg-white text-primary font-bold rounded-full shadow-lg hover:shadow-xl hover:bg-soft-grey transition-all transform hover:-translate-y-1 text-lg inline-flex items-center gap-2">
                                <i class="hgi-stroke hgi-credit-card-pos"></i>
                                Enroll Now
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-primary font-bold rounded-full shadow-lg hover:shadow-xl hover:bg-soft-grey transition-all transform hover:-translate-y-1 text-lg inline-flex items-center gap-2">
                                <i class="hgi-stroke hgi-login-03"></i>
                                Login to Enroll
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Course Image / Preview -->
                 <div class="relative group">
                    <div class="aspect-video bg-soft-grey rounded-4xl overflow-hidden shadow-2xl rotate-2 group-hover:rotate-0 transition-transform duration-500">
                        @if($course->thumbnail_path)
                            <img src="{{ $course->thumbnail_path }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-primary/20 font-black text-2xl bg-white">THUMBNAIL</div>
                        @endif
                    </div>
                    
                    @if($course->preview_video_url)
                        <a href="{{ $course->preview_video_url }}" target="_blank" class="absolute inset-0 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-floating">
                                <i class="hgi-stroke hgi-play text-brand text-3xl ml-1"></i>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-20">
            <!-- Main Content (Description) -->
            <div class="md:col-span-2 space-y-12">
                <section>
                    <h2 class="text-2xl font-black text-primary mb-6 flex items-center gap-3">
                        <i class="hgi-stroke hgi-information-circle text-brand"></i>
                        About this Course
                    </h2>
                    <div class="prose prose-lg text-secondary">
                        {!! nl2br(e($course->description)) !!}
                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-primary mb-6 flex items-center gap-3">
                        <i class="hgi-stroke hgi-course-01 text-brand"></i>
                        Curriculum
                    </h2>
                    <div class="bg-white rounded-4xl shadow-soft overflow-hidden border border-soft-grey">
                        @forelse($course->lessons as $index => $lesson)
                            <div class="p-6 border-b border-soft-grey last:border-0 hover:bg-soft-grey/10 transition-colors flex items-center justify-between cursor-pointer group">
                                <div class="flex items-center gap-4">
                                    <div class="w-8 h-8 rounded-full bg-soft-grey flex items-center justify-center font-bold text-xs text-secondary group-hover:bg-primary group-hover:text-white transition-colors">
                                        {{ $index + 1 }}
                                    </div>
                                    <h4 class="font-bold text-primary">{{ $lesson->title }}</h4>
                                </div>
                                <div class="flex items-center gap-2 text-xs font-bold text-secondary bg-soft-grey/50 px-3 py-1 rounded-full">
                                    <i class="hgi-stroke hgi-lock-key-01 text-[10px]"></i>
                                    Locked
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center text-secondary">No lessons available yet.</div>
                        @endforelse
                    </div>
                </section>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <div class="bg-white p-8 rounded-4xl shadow-medium sticky top-28 border border-soft-grey">
                    <h3 class="font-bold text-xl mb-6 flex items-center gap-2">
                        <i class="hgi-stroke hgi-target-02 text-brand"></i>
                        What you'll learn
                    </h3>
                    <ul class="space-y-4">
                        @php
                            $goals = array_filter(explode("\n", (string)$course->goals));
                        @endphp
                        @forelse($goals as $goal)
                            <li class="flex items-start gap-3">
                                <i class="hgi-stroke hgi-check-mark-circle-01 text-brand mt-1"></i>
                                <span class="text-sm text-secondary font-medium">{{ $goal }}</span>
                            </li>
                        @empty
                            <li class="flex items-start gap-3">
                                <i class="hgi-stroke hgi-check-mark-circle-01 text-brand mt-1"></i>
                                <span class="text-sm text-secondary font-medium">Core concepts and fundamentals</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="hgi-stroke hgi-check-mark-circle-01 text-brand mt-1"></i>
                                <span class="text-sm text-secondary font-medium">Real-world practical examples</span>
                            </li>
                        @endforelse
                    </ul>
                    <hr class="border-soft-grey my-6">
                    <div class="text-center">
                        <p class="text-xs font-bold text-secondary mb-2">Full lifetime access</p>
                        <p class="text-xs text-secondary/70">Secure Payment Solution</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-web-layout>
