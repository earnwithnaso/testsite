<x-web-layout>
    <div class="px-4 max-w-6xl mx-auto">
        <!-- Hero Section -->
        <div class="bg-primary text-white rounded-5xl shadow-floating p-8 md:p-12 mb-12 relative overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <span class="px-4 py-1 bg-white/20 rounded-full text-xs font-bold uppercase tracking-wider">{{ $course->difficulty_level }}</span>
                         @foreach($course->categories as $category)
                            <span class="px-4 py-1 border border-white/20 rounded-full text-xs font-bold uppercase tracking-wider">{{ $category->name }}</span>
                        @endforeach
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black leading-tight tracking-tighter">{{ $course->title }}</h1>
                    <p class="text-white/70 text-lg leading-relaxed line-clamp-3">{{ Str::limit($course->description, 150) }}</p>
                    
                    <div class="flex items-center gap-6 pt-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-full"></div>
                            <div>
                                <p class="text-xs text-white/50 font-bold uppercase">Instructor</p>
                                <p class="text-sm font-bold">{{ $course->instructor->name }}</p>
                            </div>
                        </div>
                        <div class="w-px h-10 bg-white/10"></div>
                        <div>
                             <p class="text-xs text-white/50 font-bold uppercase">Lessons</p>
                             <p class="text-sm font-bold">{{ $course->lessons->count() }}</p>
                        </div>
                    </div>

                    <div class="pt-6 flex flex-wrap gap-4 items-center">
                        <span class="text-4xl font-black">{{ $currency }}{{ number_format($course->price, 2) }}</span>
                        @auth
                            <a href="{{ route('checkout.start', $course) }}" class="px-8 py-4 bg-white text-primary font-bold rounded-full shadow-lg hover:shadow-xl hover:bg-soft-grey transition-all transform hover:-translate-y-1 text-lg inline-block">
                                Enroll Now
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-primary font-bold rounded-full shadow-lg hover:shadow-xl hover:bg-soft-grey transition-all transform hover:-translate-y-1 text-lg inline-block">
                                Login to Enroll
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Course Image -->
                 <div class="aspect-video bg-soft-grey rounded-4xl overflow-hidden shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-500">
                    @if($course->thumbnail_path)
                        <img src="{{ Storage::url($course->thumbnail_path) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-primary/20 font-black text-2xl bg-white">THUMBNAIL</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-20">
            <!-- Main Content (Description) -->
            <div class="md:col-span-2 space-y-12">
                <section>
                    <h2 class="text-2xl font-black text-primary mb-6">About this Course</h2>
                    <div class="prose prose-lg text-secondary">
                        {!! nl2br(e($course->description)) !!}
                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-primary mb-6">Curriculum</h2>
                    <div class="bg-white rounded-4xl shadow-soft overflow-hidden border border-soft-grey">
                        @forelse($course->lessons as $index => $lesson)
                            <div class="p-6 border-b border-soft-grey last:border-0 hover:bg-soft-grey/10 transition-colors flex items-center justify-between cursor-pointer group">
                                <div class="flex items-center gap-4">
                                    <div class="w-8 h-8 rounded-full bg-soft-grey flex items-center justify-center font-bold text-xs text-secondary group-hover:bg-primary group-hover:text-white transition-colors">
                                        {{ $index + 1 }}
                                    </div>
                                    <h4 class="font-bold text-primary">{{ $lesson->title }}</h4>
                                </div>
                                <span class="text-xs font-bold text-secondary bg-soft-grey/50 px-3 py-1 rounded-full">Locked 🔒</span>
                            </div>
                        @empty
                            <div class="p-8 text-center text-secondary">No lessons available yet.</div>
                        @endforelse
                    </div>
                </section>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <div class="bg-white p-8 rounded-4xl shadow-medium sticky top-28">
                    <h3 class="font-bold text-xl mb-6">What you'll learn</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <span class="text-green-500 font-bold">✓</span>
                            <span class="text-sm text-secondary font-medium">Core concepts and fundamentals</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-green-500 font-bold">✓</span>
                            <span class="text-sm text-secondary font-medium">Real-world practical examples</span>
                        </li>
                         <li class="flex items-start gap-3">
                            <span class="text-green-500 font-bold">✓</span>
                            <span class="text-sm text-secondary font-medium">Industry best practices</span>
                        </li>
                    </ul>
                    <hr class="border-soft-grey my-6">
                    <div class="text-center">
                        <p class="text-xs font-bold text-secondary mb-2">30-Day Money-Back Guarantee</p>
                        <p class="text-xs text-secondary/70">Full lifetime access</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-web-layout>
