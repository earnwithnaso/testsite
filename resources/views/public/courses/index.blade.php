<x-web-layout>
    <div class="px-8 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-5xl font-black text-primary mb-4 tracking-tighter">Explore Courses</h1>
            <p class="text-xl text-secondary max-w-2xl mx-auto">Find the perfect course to upgrade your skills. Choose from our curated collection of premium content.</p>
        </div>

        <!-- Filter Placeholder (Tabs) -->
        <div class="flex justify-center gap-4 mb-16 overflow-x-auto pb-4">
            <button class="px-6 py-3 bg-primary text-white rounded-full font-bold shadow-medium hover:shadow-floating transition-all whitespace-nowrap">All Courses</button>
            <button class="px-6 py-3 bg-white text-secondary rounded-full font-bold shadow-soft hover:shadow-medium border border-soft-grey whitespace-nowrap hover:text-primary transition-all">Development</button>
            <button class="px-6 py-3 bg-white text-secondary rounded-full font-bold shadow-soft hover:shadow-medium border border-soft-grey whitespace-nowrap hover:text-primary transition-all">Design</button>
            <button class="px-6 py-3 bg-white text-secondary rounded-full font-bold shadow-soft hover:shadow-medium border border-soft-grey whitespace-nowrap hover:text-primary transition-all">Business</button>
            <button class="px-6 py-3 bg-white text-secondary rounded-full font-bold shadow-soft hover:shadow-medium border border-soft-grey whitespace-nowrap hover:text-primary transition-all">Marketing</button>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($courses as $course)
                <a href="{{ route('courses.show', $course->slug) }}" class="bg-white rounded-4xl shadow-medium hover:shadow-floating transition-all duration-300 group cursor-pointer border border-transparent hover:border-soft-grey block">
                    <div class="h-64 bg-soft-grey rounded-t-4xl m-2 relative overflow-hidden">
                        @if($course->thumbnail_path)
                            <img src="{{ Storage::url($course->thumbnail_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center text-primary/20 font-bold">THUMBNAIL</div>
                        @endif
                        <div class="absolute top-4 left-4 bg-white px-3 py-1 rounded-full text-xs font-bold shadow-sm capitalize">{{ $course->difficulty_level }}</div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-primary group-hover:text-black leading-tight line-clamp-2">{{ $course->title }}</h3>
                        </div>
                        <div class="flex justify-between items-center mb-4">
                             <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-200 rounded-full"></div>
                                <span class="text-xs font-bold text-primary">{{ $course->instructor->name ?? 'Instructor' }}</span>
                            </div>
                            <span class="text-lg font-black text-primary">₦{{ number_format($course->price, 2) }}</span>
                        </div>
                        <div class="w-full h-px bg-soft-grey/50 my-4"></div>
                        <div class="flex justify-between items-center text-xs font-bold text-secondary">
                            <span>{{ $course->lessons_count ?? 0 }} Lessons</span>
                            <span class="text-primary group-hover:underline">View Details -></span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-20">
                    <h3 class="text-2xl font-bold text-primary mb-2">No courses found</h3>
                    <p class="text-secondary">Check back later for new content.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $courses->links() }}
        </div>
    </div>
</x-web-layout>
