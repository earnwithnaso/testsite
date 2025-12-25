<x-app-layout>
    <div class="max-w-[1600px] mx-auto py-8">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Left Side: Video Player & Info -->
            <div class="flex-1 space-y-12">
                <!-- Player Area -->
                <div class="aspect-video bg-black rounded-[40px] overflow-hidden shadow-2xl relative group border-8 border-white">
                    @if($lesson && ($lesson->video_url || $lesson->video_path))
                        @if($lesson->video_path)
                            <video class="w-full h-full object-cover" controls autoplay>
                                <source src="{{ Storage::url($lesson->video_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <!-- Responsive Video Embed -->
                            @php
                                $videoUrl = $lesson->video_url;
                                if (str_contains($videoUrl, 'youtube.com') || str_contains($videoUrl, 'youtu.be')) {
                                    $videoId = '';
                                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $videoUrl, $match)) {
                                        $videoId = $match[1];
                                    }
                                    $finalUrl = "https://www.youtube.com/embed/{$videoId}?autoplay=1&rel=0";
                                } else {
                                    $finalUrl = $videoUrl;
                                }
                            @endphp
                            <iframe class="w-full h-full" src="{{ $finalUrl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @endif
                    @else
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-white/10 bg-gradient-to-br from-primary to-black">
                            <i class="hgi-stroke hgi-play-circle text-8xl mb-4 opacity-5"></i>
                            <p class="font-black text-xl bg-clip-text text-transparent bg-gradient-to-b from-white to-white/20">Select a lesson to start learning</p>
                        </div>
                    @endif
                </div>

                <!-- Lesson Info -->
                <div class="bg-white p-10 rounded-[40px] shadow-soft border border-soft-grey relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-brand/5 rounded-full blur-3xl -mr-32 -mt-32"></div>
                    
                    <div class="relative z-10 flex flex-wrap justify-between items-start gap-8">
                        <div class="space-y-4 max-w-2xl">
                            <div class="inline-flex items-center gap-2 bg-brand/10 px-4 py-1.5 rounded-full text-brand text-[10px] font-black tracking-widest uppercase">
                                <i class="hgi-stroke hgi-book-02"></i>
                                {{ $course->title }}
                            </div>
                            <h1 class="text-4xl font-black text-primary leading-tight tracking-tighter">{{ $lesson->title ?? 'Welcome' }}</h1>
                        </div>
                        
                        <div class="flex flex-wrap gap-4">
                            @if($lesson && $lesson->pdf_path)
                                <a href="{{ Storage::url($lesson->pdf_path) }}" target="_blank" class="px-8 py-4 bg-soft-grey text-primary font-black rounded-2xl hover:bg-primary hover:text-white transition-all transform hover:-translate-y-1 flex items-center gap-3 shadow-soft">
                                    <i class="hgi-stroke hgi-document-attachment text-xl"></i>
                                    Resources
                                </a>
                            @endif
                            
                            @if($lesson && !in_array($lesson->id, $completedLessonIds))
                                <form action="{{ route('student.lessons.complete', $lesson->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-8 py-4 bg-brand text-white font-black rounded-2xl shadow-medium hover:shadow-floating hover:bg-green-600 transition-all transform hover:-translate-y-1 flex items-center gap-3">
                                        Mark Done
                                        <i class="hgi-stroke hgi-checkmark-circle-02"></i>
                                    </button>
                                </form>
                            @elseif($lesson)
                                <div class="px-8 py-4 bg-brand/10 text-brand font-black rounded-2xl flex items-center gap-3 border border-brand/20 shadow-soft">
                                    Lesson Completed 
                                    <i class="hgi-stroke hgi-checkmark-circle-01 text-xl"></i>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-12 pt-10 border-t border-soft-grey">
                        <h3 class="font-black text-xl text-primary mb-6 flex items-center gap-3 uppercase tracking-tight">
                            <i class="hgi-stroke hgi-information-circle text-brand"></i>
                            Session Overview
                        </h3>
                        <div class="prose prose-lg text-secondary/70 leading-relaxed font-medium max-w-none">
                            {!! nl2br(e($lesson->description ?? 'No description provided for this lesson.')) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Curriculum Sidebar -->
            <div class="w-full lg:w-[450px] shrink-0 space-y-8">
                <!-- Progress Card -->
                <div class="bg-primary p-10 rounded-[40px] shadow-floating text-white relative overflow-hidden group">
                    <div class="absolute -right-8 -bottom-8 opacity-10 transform scale-150 rotate-12 transition-transform group-hover:scale-175 duration-700">
                         <i class="hgi-stroke hgi-award-01 text-[120px]"></i>
                    </div>
                    
                    <h3 class="font-black text-2xl text-white mb-8 relative z-10 tracking-tighter flex items-center gap-3">
                        <i class="hgi-stroke hgi-playing-cards text-brand"></i>
                        Goal Progress
                    </h3>
                    
                    @php
                        $totalLessons = (float)($course->lessons->count() ?: 1);
                        $completedCount = (float)count($completedLessonIds);
                        $percentage = round(($completedCount / $totalLessons) * 100);
                    @endphp
                    
                    <div class="space-y-4 relative z-10">
                        <div class="flex justify-between items-end text-[10px] font-black uppercase tracking-widest text-white/50">
                            <span>{{ (int)$completedCount }} / {{ (int)$totalLessons }} Modules</span>
                            <span class="text-white text-base">{{ (int)$percentage }}%</span>
                        </div>
                        <div class="w-full bg-white/10 h-3 rounded-full overflow-hidden border border-white/10 backdrop-blur-sm">
                            <div class="bg-brand h-full rounded-full transition-all duration-1000 shadow-glow" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Course Assets -->
                @if($course->pdf_path || $course->video_path)
                <div class="bg-white rounded-[40px] shadow-medium overflow-hidden border border-soft-grey p-8 space-y-6">
                    <h3 class="font-black text-xl text-primary flex items-center gap-3 tracking-tighter uppercase">
                        <i class="hgi-stroke hgi-attachment text-brand"></i>
                        Resources
                    </h3>
                    <div class="space-y-4">
                        @if($course->pdf_path)
                            <a href="{{ Storage::url($course->pdf_path) }}" target="_blank" class="flex items-center gap-4 p-5 bg-soft-grey/30 rounded-2xl hover:bg-brand hover:text-white transition-all group border border-transparent hover:border-brand/20">
                                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-soft">
                                    <i class="hgi-stroke hgi-file-document-01 text-xl text-brand group-hover:scale-110 transition-transform"></i>
                                </div>
                                <span class="font-black text-xs uppercase tracking-widest">Syllabus (PDF)</span>
                            </a>
                        @endif
                        @if($course->video_path)
                            <button onclick="document.getElementById('introVideoModal').classList.remove('hidden')" class="w-full flex items-center gap-4 p-5 bg-soft-grey/30 rounded-2xl hover:bg-brand hover:text-white transition-all group border border-transparent hover:border-brand/20">
                                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-soft">
                                    <i class="hgi-stroke hgi-play-circle-01 text-xl text-brand group-hover:scale-110 transition-transform"></i>
                                </div>
                                <span class="font-black text-xs uppercase tracking-widest">Intro Video</span>
                            </button>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Lessons List -->
                <div class="bg-white rounded-[40px] shadow-soft overflow-hidden border border-soft-grey">
                    <div class="p-8 border-b border-soft-grey flex items-center justify-between bg-soft-grey/10">
                        <h3 class="font-black text-xl text-primary tracking-tighter">Course Modules</h3>
                        <div class="w-10 h-10 bg-white rounded-xl shadow-soft flex items-center justify-center text-brand">
                             <i class="hgi-stroke hgi-listView-01"></i>
                        </div>
                    </div>
                    <div class="max-h-[600px] overflow-y-auto custom-scrollbar">
                        @foreach($course->lessons as $idx => $item)
                            <a href="{{ route('student.courses.show', [$course->slug, $item->id]) }}" 
                               class="flex items-start gap-5 p-6 hover:bg-soft-grey/30 border-b border-soft-grey/50 last:border-0 transition-all group {{ isset($lesson) && $lesson->id == $item->id ? 'bg-soft-grey/50' : '' }}">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 font-black text-sm transition-all duration-300 {{ in_array($item->id, $completedLessonIds) ? 'bg-brand text-white shadow-glow' : 'bg-soft-grey text-secondary/40' }} group-hover:scale-110">
                                    @if(in_array($item->id, $completedLessonIds))
                                        <i class="hgi-stroke hgi-checkmark-circle-01 text-lg"></i>
                                    @else
                                        {{ $idx + 1 }}
                                    @endif
                                </div>
                                <div class="space-y-2 flex-1">
                                    <h4 class="font-extrabold text-sm text-primary leading-tight transition-colors {{ isset($lesson) && $lesson->id == $item->id ? 'text-brand' : 'group-hover:text-primary' }}">{{ $item->title }}</h4>
                                    <div class="flex items-center gap-4 text-[10px] text-secondary/40 font-black uppercase tracking-widest">
                                        <span class="flex items-center gap-1.5">
                                            <i class="hgi-stroke hgi-play-circle text-[14px]"></i>
                                            {{ floor($item->video_duration / 60) }}m {{ $item->video_duration % 60 }}s
                                        </span>
                                        @if($item->is_free)
                                            <span class="bg-brand/10 text-brand px-2 rounded-full border border-brand/10">Sample</span>
                                        @endif
                                    </div>
                                </div>
                                @if(isset($lesson) && $lesson->id == $item->id)
                                    <div class="w-2 h-2 rounded-full bg-brand animate-pulse"></div>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Instructor Card mini -->
                <div class="bg-white p-8 rounded-[40px] shadow-soft border border-soft-grey group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-soft-grey/50 rounded-full -mr-16 -mt-16 group-hover:bg-brand/5 transition-colors"></div>
                    <div class="flex items-center gap-5 relative z-10">
                        <div class="w-16 h-16 bg-soft-grey rounded-2xl flex items-center justify-center font-black text-primary shadow-soft border border-white overflow-hidden">
                            @if($course->instructor->avatar)
                                <img src="{{ Storage::url($course->instructor->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-2xl">{{ substr($course->instructor->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase text-secondary/40 tracking-widest mb-1">Expert Mentor</p>
                            <h4 class="font-black text-lg text-primary tracking-tight">{{ $course->instructor->name }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
