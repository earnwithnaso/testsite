<x-web-layout>
    <div class="px-6 md:px-12 max-w-[1600px] mx-auto py-20">
        <!-- Header Section -->
        <div class="relative mb-16 text-center">
            <div class="inline-block bg-brand/10 px-4 py-1.5 rounded-full text-brand text-[10px] font-black tracking-widest uppercase mb-4 shadow-sm border border-brand/20">Limitless Learning</div>
            <h1 class="text-4xl md:text-6xl font-black text-primary mb-6 tracking-tighter">Explore Our Courses</h1>
            <p class="text-lg md:text-xl text-secondary/70 max-w-2xl mx-auto font-medium leading-relaxed">Empower yourself with industry-leading knowledge. From beginner to pro, we have a path for you.</p>
        </div>

        <!-- Search & Filter Area -->
        <div class="flex flex-col lg:flex-row gap-12 items-start">
            <!-- Sidebar Filters -->
            <div class="w-full lg:w-80 shrink-0 space-y-8 sticky top-32">
                <!-- Search Box -->
                <form action="{{ route('courses.index') }}" method="GET" class="relative group">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search courses..." 
                           class="w-full pl-6 pr-12 py-4 bg-white rounded-2xl border-2 border-soft-grey focus:border-primary outline-none font-bold text-primary placeholder-secondary/50 shadow-soft transition-all">
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-secondary group-focus-within:text-primary transition-colors">
                        <i class="hgi-stroke hgi-search-01 text-xl"></i>
                    </button>
                    <!-- Preseve other filters -->
                    @foreach(request()->except(['search', 'page']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                </form>

                <!-- Filter Panel -->
                <div class="bg-white rounded-[40px] shadow-medium border border-soft-grey p-8 space-y-8">
                    <div class="flex items-center justify-between">
                        <h3 class="font-black text-xl text-primary tracking-tight">Filters</h3>
                        @if(request()->anyFilled(['category', 'level', 'price', 'rating', 'search']))
                            <a href="{{ route('courses.index') }}" class="text-[10px] font-black text-red-500 uppercase tracking-widest hover:underline">Clear All</a>
                        @endif
                    </div>

                    <!-- Category Filter -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase text-secondary/50 tracking-widest block">Categories</label>
                        <div class="space-y-2">
                             <a href="{{ route('courses.index', array_merge(request()->query(), ['category' => null, 'page' => null])) }}" 
                               class="flex items-center justify-between group cursor-pointer {{ !request('category') ? 'text-primary' : 'text-secondary' }}">
                                <span class="text-sm font-bold group-hover:text-primary transition-colors">All Categories</span>
                                @if(!request('category')) <i class="hgi-stroke hgi-checkmark text-brand text-xs"></i> @endif
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('courses.index', array_merge(request()->query(), ['category' => $category->slug, 'page' => null])) }}" 
                                   class="flex items-center justify-between group cursor-pointer {{ request('category') == $category->slug ? 'text-primary' : 'text-secondary' }}">
                                    <span class="text-sm font-bold group-hover:text-primary transition-colors">{{ $category->name }}</span>
                                    @if(request('category') == $category->slug) <i class="hgi-stroke hgi-checkmark text-brand text-xs"></i> @endif
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <hr class="border-soft-grey">

                    <!-- Level Filter -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase text-secondary/50 tracking-widest block">Difficulty</label>
                        <div class="space-y-2">
                            @foreach(['beginner', 'intermediate', 'advanced'] as $level)
                                <a href="{{ route('courses.index', array_merge(request()->query(), ['level' => request('level') == $level ? null : $level, 'page' => null])) }}" 
                                   class="flex items-center gap-3 p-3 rounded-2xl border-2 transition-all {{ request('level') == $level ? 'border-brand bg-brand/5 text-primary shadow-sm' : 'border-transparent hover:bg-soft-grey text-secondary' }}">
                                    <div class="w-4 h-4 rounded-full border-2 {{ request('level') == $level ? 'border-brand bg-brand' : 'border-soft-grey' }} flex items-center justify-center">
                                        <div class="w-2 h-2 rounded-full bg-white {{ request('level') == $level ? 'opacity-100' : 'opacity-0' }}"></div>
                                    </div>
                                    <span class="font-bold text-sm capitalize">{{ $level }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <hr class="border-soft-grey">

                    <!-- Price Filter -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase text-secondary/50 tracking-widest block">Price</label>
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('courses.index', array_merge(request()->query(), ['price' => request('price') == 'free' ? null : 'free', 'page' => null])) }}" 
                               class="py-3 text-center rounded-xl font-bold text-sm border-2 transition-all {{ request('price') == 'free' ? 'border-brand text-brand bg-brand/5' : 'border-soft-grey text-secondary hover:border-primary hover:text-primary' }}">
                                Free
                            </a>
                            <a href="{{ route('courses.index', array_merge(request()->query(), ['price' => request('price') == 'paid' ? null : 'paid', 'page' => null])) }}" 
                               class="py-3 text-center rounded-xl font-bold text-sm border-2 transition-all {{ request('price') == 'paid' ? 'border-brand text-brand bg-brand/5' : 'border-soft-grey text-secondary hover:border-primary hover:text-primary' }}">
                                Paid
                            </a>
                        </div>
                    </div>

                    <hr class="border-soft-grey">

                    <!-- Minimum Rating -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase text-secondary/50 tracking-widest block">Rating</label>
                        @foreach([4, 3] as $star)
                             <a href="{{ route('courses.index', array_merge(request()->query(), ['rating' => request('rating') == $star ? null : $star, 'page' => null])) }}" 
                               class="flex items-center gap-3 group cursor-pointer">
                                <div class="w-5 h-5 rounded-md border-2 {{ request('rating') == $star ? 'border-brand bg-brand text-white' : 'border-soft-grey text-transparent' }} flex items-center justify-center transition-all">
                                    <i class="hgi-stroke hgi-checkmark text-xs"></i>
                                </div>
                                <div class="flex items-center gap-1 group-hover:opacity-80 transition-opacity">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="hgi-stroke hgi-star text-sm {{ $i <= $star ? 'text-brand fill-brand' : 'text-soft-grey' }}"></i>
                                    @endfor
                                    <span class="text-xs font-bold text-secondary ml-2">& Up</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 min-w-0">
                <!-- Sorting & Count header -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                    <p class="font-bold text-secondary text-sm">Showing <span class="text-primary">{{ $courses->firstItem() ?? 0 }}-{{ $courses->lastItem() ?? 0 }}</span> of {{ $courses->total() }} results</p>
                    
                    <div class="relative group z-20">
                        <select onchange="window.location.href=this.value" class="appearance-none pl-6 pr-12 py-3 bg-white rounded-xl border border-soft-grey font-bold text-sm text-primary focus:border-brand outline-none shadow-sm cursor-pointer min-w-[180px]">
                            <option value="{{ route('courses.index', array_merge(request()->query(), ['sort' => 'newest'])) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="{{ route('courses.index', array_merge(request()->query(), ['sort' => 'price_low'])) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="{{ route('courses.index', array_merge(request()->query(), ['sort' => 'price_high'])) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                        <i class="hgi-stroke hgi-arrow-down-01 absolute right-4 top-1/2 -translate-y-1/2 text-secondary pointer-events-none"></i>
                    </div>
                </div>

                <!-- Course Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($courses as $course)
                        <div class="bg-white rounded-[40px] shadow-medium flex flex-col hover:shadow-floating transition-all duration-500 border border-transparent hover:border-soft-grey overflow-hidden group h-full relative">
                            <!-- Thumbnail Area -->
                            <div class="h-52 bg-soft-grey relative overflow-hidden">
                                <img src="{{ $course->thumbnail_path && Str::startsWith($course->thumbnail_path, 'http') ? $course->thumbnail_path : ($course->thumbnail_path ? Storage::url($course->thumbnail_path) : asset('images/course_web.png')) }}" 
                                     alt="{{ $course->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                                <!-- Badges -->
                                <div class="absolute top-4 left-4 flex gap-2">
                                     <span class="bg-white/95 backdrop-blur px-3 py-1 rounded-full text-[10px] font-black tracking-widest text-primary shadow-soft uppercase">
                                        {{ $course->difficulty_level }}
                                    </span>
                                </div>

                                <!-- Price on Image -->
                                <div class="absolute bottom-4 right-4 shadow-medium">
                                    <div class="bg-white rounded-2xl px-4 py-2 flex items-center gap-2">
                                        <span class="text-primary font-black text-lg">₦{{ number_format((float)($course->price ?? 0), 0) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Area -->
                            <div class="p-8 flex-1 flex flex-col">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-8 h-8 rounded-full bg-soft-grey overflow-hidden border border-white shadow-sm shrink-0">
                                        @if($course->instructor->avatar)
                                            <img src="{{ Storage::url($course->instructor->avatar) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-primary text-white font-black text-xs">{{ substr($course->instructor->name, 0, 1) }}</div>
                                        @endif
                                    </div>
                                    <span class="text-xs font-bold text-secondary truncate">{{ $course->instructor->name }}</span>
                                </div>

                                <h3 class="text-xl font-black text-primary mb-3 line-clamp-2 leading-tight group-hover:text-brand transition-colors">
                                    {{ $course->title }}
                                </h3>

                                <div class="mt-auto pt-6 border-t border-soft-grey/50 space-y-6">
                                    <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest text-secondary/50">
                                        <span class="flex items-center gap-1.5">
                                            <i class="hgi-stroke hgi-book-open-01 text-brand"></i>
                                            {{ $course->lessons_count ?? 0 }} Lessons
                                        </span>
                                        <span class="flex items-center gap-1.5">
                                            @php 
                                                $rating = $course->reviews()->where('is_approved', true)->avg('rating') ?? 5.0; 
                                            @endphp
                                            <i class="hgi-stroke hgi-star text-yellow-500 fill-yellow-500"></i>
                                            {{ number_format($rating, 1) }}
                                        </span>
                                    </div>

                                    <a href="{{ route('courses.show', $course->slug) }}" class="flex items-center justify-center gap-2 w-full py-4 bg-primary text-white font-bold rounded-full shadow-medium hover:bg-brand transition-all group/btn">
                                        <span>View Details</span>
                                        <i class="hgi-stroke hgi-arrow-right-01 group-hover/btn:translate-x-1 transition-transform"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center bg-white rounded-[40px] shadow-soft border border-soft-grey border-dashed">
                            <div class="w-20 h-20 bg-soft-grey/30 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="hgi-stroke hgi-search-01 text-4xl text-secondary"></i>
                            </div>
                            <h3 class="text-2xl font-black text-primary mb-2">No results found</h3>
                            <p class="text-secondary font-medium mb-8">Try adjusting your filters or search terms.</p>
                            <a href="{{ route('courses.index') }}" class="inline-block px-8 py-4 bg-primary text-white font-black rounded-full shadow-glow hover:bg-secondary transition-all">
                                Clear Filters
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-20">
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
</x-web-layout>
