<x-app-layout>
    <x-slot name="header">
        <div class="flex items-end justify-between relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand/5 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="inline-block bg-brand/10 px-4 py-1 rounded-full text-brand text-[10px] font-black tracking-widest uppercase mb-3">Student Dashboard</div>
                <h2 class="font-black text-4xl text-primary leading-tight flex items-center gap-3 tracking-tighter">
                    Hello, {{ explode(' ', Auth::user()->name)[0] }}! 
                    <i class="hgi-stroke hgi-hand-waving-02 text-brand animate-float"></i>
                </h2>
                <p class="text-secondary/60 font-medium mt-1">You've completed {{ $totalCompleted }} lessons. Keep up the great work!</p>
            </div>
            <a href="{{ route('courses.index') }}" class="hidden md:flex items-center gap-2 px-8 py-4 bg-brand text-white font-black rounded-full shadow-medium hover:shadow-floating hover:bg-green-600 transition-all text-sm group">
                <i class="hgi-stroke hgi-search-01"></i>
                Browse Courses
                <i class="hgi-stroke hgi-arrow-right-01 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Stats Column -->
        <div class="space-y-8">
            <div class="bg-white p-10 rounded-[40px] shadow-soft border border-soft-grey group hover:border-brand transition-all duration-500 overflow-hidden relative">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary/5 rounded-full group-hover:bg-primary/10 transition-colors"></div>
                <div class="flex items-center justify-between mb-6 relative z-10">
                    <div class="w-14 h-14 bg-soft-grey rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-500">
                        <i class="hgi-stroke hgi-book-open-01 text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-5xl font-black text-primary mb-1 tracking-tighter">{{ $enrolledCourses->count() }}</h3>
                <p class="text-xs font-black text-secondary/40 uppercase tracking-widest">Active Courses</p>
            </div>
            
            <div class="bg-primary p-10 rounded-[40px] shadow-floating text-white relative overflow-hidden group">
                <div class="absolute -right-8 -bottom-8 opacity-10 transform scale-150 rotate-12 transition-transform group-hover:scale-175 duration-700">
                    <i class="hgi-stroke hgi-award-01 text-[120px]"></i>
                </div>
                <div class="flex items-center justify-between mb-6 relative z-10">
                    <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center text-white backdrop-blur-sm border border-white/10 group-hover:bg-white group-hover:text-primary transition-all duration-500">
                        <i class="hgi-stroke hgi-checkmark-circle-01 text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-5xl font-black text-white relative z-10 tracking-tighter">{{ $totalCompleted }}</h3>
                <p class="text-xs font-black text-white/40 uppercase tracking-widest relative z-10">Lessons Mastered</p>
            </div>

            <!-- Achievement Card mini -->
            <div class="bg-gradient-to-br from-brand to-green-600 p-8 rounded-[40px] shadow-floating text-white group cursor-pointer hover:shadow-glow transition-all duration-500">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center text-white backdrop-blur-sm">
                        <i class="hgi-stroke hgi-star text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-sm tracking-tight">Daily Streak</h4>
                        <p class="text-[10px] text-white/70 font-bold uppercase tracking-widest">5 Days Running</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Column -->
        <div class="md:col-span-2 space-y-8">
            <!-- Continue Learning -->
            <div class="bg-white p-10 rounded-[40px] shadow-soft border border-soft-grey">
                <div class="flex items-baseline justify-between mb-10">
                    <h3 class="text-2xl font-black text-primary tracking-tighter flex items-center gap-3">
                        <i class="hgi-stroke hgi-playing-cards text-brand"></i>
                        Continue Learning
                    </h3>
                    <a href="{{ route('student.courses.index') }}" class="text-[10px] font-black text-secondary/40 hover:text-primary uppercase tracking-widest flex items-center gap-2 group/all transition-colors">
                        View Full Library
                        <i class="hgi-stroke hgi-arrow-right-01 group-hover/all:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                
                <div class="space-y-6">
                    @forelse($enrolledCourses as $course)
                        @php
                            $total = (float)($course->lessons_count ?? 0);
                            $completed = (float)(\App\Models\LessonProgress::where('user_id', Auth::id())
                                ->whereIn('lesson_id', $course->lessons->pluck('id'))
                                ->count());
                            $percent = $total > 0 ? round(($completed / $total) * 100) : 0;
                        @endphp
                        <div class="group flex flex-col md:flex-row gap-8 items-center p-6 rounded-[32px] hover:bg-soft-grey/30 transition-all duration-500 border border-transparent hover:border-soft-grey relative">
                            <div class="w-full md:w-40 h-28 bg-soft-grey rounded-2xl overflow-hidden shadow-sm shrink-0 relative">
                                @if($course->thumbnail_path)
                                    <img src="{{ Str::startsWith($course->thumbnail_path, 'http') ? $course->thumbnail_path : Storage::url($course->thumbnail_path) }}" alt="" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center font-black text-black/10 text-xs">COURSE</div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            </div>
                            
                            <div class="flex-1 w-full space-y-4">
                                <div>
                                    <h4 class="font-black text-xl text-primary tracking-tight transition-colors group-hover:text-brand">{{ $course->title }}</h4>
                                    <p class="text-[10px] text-secondary/40 font-black uppercase tracking-widest mt-1">Instructor: {{ $course->instructor->name }}</p>
                                </div>
                                
                                <div class="space-y-2">
                                    <div class="flex justify-between items-end">
                                        <div class="text-[10px] font-black uppercase tracking-widest text-secondary/60">Completion</div>
                                        <div class="text-sm font-black text-primary">{{ (int)$percent }}%</div>
                                    </div>
                                    @php $progressWidth = (int)$percent . '%'; @endphp
                                    <div class="w-full bg-soft-grey/50 rounded-full h-2 overflow-hidden border border-white">
                                        <div class="bg-brand h-full rounded-full transition-all duration-1000 shadow-glow" style="width: {{ $progressWidth }};"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{ route('student.courses.show', $course->slug) }}" class="w-full md:w-16 h-16 bg-primary text-white rounded-2xl flex items-center justify-center hover:bg-brand transition-all hover:scale-110 shadow-medium hover:shadow-floating shrink-0 group/link">
                                <i class="hgi-stroke hgi-play text-2xl ml-1 group-hover:scale-110 transition-transform"></i>
                            </a>
                        </div>
                    @empty
                        <div class="py-20 text-center bg-soft-grey/20 rounded-[32px] border border-dashed border-soft-grey">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-soft">
                                <i class="hgi-stroke hgi-search-01 text-4xl text-secondary/30"></i>
                            </div>
                            <h4 class="text-xl font-black text-primary mb-2">Ready to start?</h4>
                            <p class="text-secondary/60 text-sm font-medium mb-8">You don't have any active courses yet.</p>
                            <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-3 px-10 py-5 bg-primary text-white font-black rounded-full hover:bg-brand hover:shadow-glow transition-all shadow-medium">
                                <i class="hgi-stroke hgi-book-02"></i>
                                Explore Courses
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
