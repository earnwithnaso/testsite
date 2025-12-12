<x-web-layout>
    <!-- Hero Section -->
    <section class="relative px-8 py-20 bg-soft-grey rounded-b-6xl mb-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center relative z-10">
            <!-- Decorative Elements -->
            <div class="absolute -top-20 -left-20 w-40 h-40 bg-brand/10 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-10 -right-10 w-24 h-24 bg-blue-400/10 rounded-full blur-2xl animate-float-delayed"></div>
            <div class="space-y-8">
                <!-- Decorative Elements -->
                <div class="absolute -top-20 -left-20 w-40 h-40 bg-brand/10 rounded-full blur-3xl animate-pulse-slow"></div>
                
                <div class="inline-block bg-white px-4 py-2 rounded-full shadow-soft animate-float">
                    <span class="text-xs font-bold text-brand tracking-wide">🚀 START YOUR JOURNEY TODAY</span>
                </div>
                <h1 class="text-6xl font-black text-primary leading-tight tracking-tighter">
                    Master New Skills <br>
                    <span class="text-brand">Build Your Future.</span>
                </h1>
                <p class="text-lg text-secondary/80 max-w-lg leading-relaxed">
                    Access premium courses from industry experts. Learn at your own pace and achieve your professional goals with our curated learning paths.
                </p>
                <div class="flex gap-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-brand text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-green-600 transition-all transform hover:-translate-y-1">
                        Start Learning Now
                    </a>
                    <a href="{{ route('courses.index') }}" class="px-8 py-4 bg-white text-primary font-bold rounded-full shadow-soft hover:shadow-medium border border-soft-grey hover:border-brand transition-all">
                        Browse Courses
                    </a>
                </div>
                <div class="flex items-center gap-4 pt-4">
                    <div class="flex -space-x-4">
                        <div class="w-10 h-10 rounded-full bg-gray-300 border-2 border-white"></div>
                        <div class="w-10 h-10 rounded-full bg-gray-400 border-2 border-white"></div>
                        <div class="w-10 h-10 rounded-full bg-gray-500 border-2 border-white"></div>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-primary">1,000+ Students</p>
                        <div class="flex text-yellow-400 text-xs">★★★★★</div>
                    </div>
                </div>
            </div>
            <div class="relative">
                 <!-- Decorative 3D Shapes (CSS) -->
                 <div class="absolute -top-10 -right-10 w-24 h-24 bg-gradient-to-br from-yellow-300 to-orange-500 rounded-2xl rotate-12 blur-sm opacity-50 animate-float-delayed z-0"></div>
                 <div class="absolute bottom-10 -left-10 w-16 h-16 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full blur-sm opacity-50 animate-float z-0"></div>

                <div class="aspect-square bg-white rounded-5xl shadow-floating p-4 rotate-3 transition-transform hover:rotate-0 duration-500 relative z-10">
                    <div class="w-full h-full rounded-4xl overflow-hidden relative">
                         <img src="{{ asset('images/hero_student.png') }}" alt="Student" class="w-full h-full object-cover">
                         <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="max-w-7xl mx-auto px-8 mb-32">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="bg-white p-8 rounded-4xl shadow-soft text-center hover:shadow-medium transition-shadow">
                <h3 class="text-4xl font-black text-primary mb-2">50+</h3>
                <p class="text-sm font-bold text-secondary text-uppercase tracking-widest">COURSES</p>
            </div>
            <div class="bg-white p-8 rounded-4xl shadow-soft text-center hover:shadow-medium transition-shadow">
                <h3 class="text-4xl font-black text-primary mb-2">12k</h3>
                <p class="text-sm font-bold text-secondary text-uppercase tracking-widest">STUDENTS</p>
            </div>
            <div class="bg-white p-8 rounded-4xl shadow-soft text-center hover:shadow-medium transition-shadow">
                <h3 class="text-4xl font-black text-primary mb-2">100%</h3>
                <p class="text-sm font-bold text-secondary text-uppercase tracking-widest">SATISFACTION</p>
            </div>
            <div class="bg-white p-8 rounded-4xl shadow-soft text-center hover:shadow-medium transition-shadow">
                <h3 class="text-4xl font-black text-primary mb-2">24/7</h3>
                <p class="text-sm font-bold text-secondary text-uppercase tracking-widest">SUPPORT</p>
            </div>
        </div>
    </section>

    <!-- Featured Courses -->
    <section class="max-w-7xl mx-auto px-8 mb-32">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-4xl font-black text-primary mb-2">Featured Courses</h2>
                <p class="text-secondary text-lg">Hand-picked courses to get you started.</p>
            </div>
            <a href="{{ route('courses.index') }}" class="text-brand font-bold hover:underline mb-2">View All Courses -></a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Course Card 1 -->
            <div class="bg-white rounded-4xl shadow-medium hover:shadow-floating transition-all duration-300 group cursor-pointer border border-transparent hover:border-soft-grey">
                <div class="h-64 bg-soft-grey rounded-t-4xl m-2 relative overflow-hidden group-hover:scale-[1.02] transition-transform">
                    <img src="{{ asset('images/course_web.png') }}" class="w-full h-full object-cover" alt="Web Dev">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold shadow-sm text-brand">BEGINNER</div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-primary group-hover:text-black leading-tight">Complete Web Development Bootcamp</h3>
                        <span class="text-lg font-black text-primary ml-4">₦99</span>
                    </div>
                    <p class="text-secondary/70 text-sm mb-6 line-clamp-2">Learn web development from scratch with this comprehensive course covering HTML, CSS, JS, and more used ...</p>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-gray-200 rounded-full"></div>
                        <span class="text-xs font-bold text-primary">John Doe</span>
                    </div>
                </div>
            </div>

            <!-- Course Card 2 -->
             <div class="bg-white rounded-4xl shadow-medium hover:shadow-floating transition-all duration-300 group cursor-pointer border border-transparent hover:border-soft-grey">
                <div class="h-64 bg-soft-grey rounded-t-4xl m-2 relative overflow-hidden group-hover:scale-[1.02] transition-transform">
                    <img src="{{ asset('images/course_laravel.png') }}" class="w-full h-full object-cover" alt="Laravel">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold shadow-sm text-brand">ADVANCED</div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-primary group-hover:text-black leading-tight">Advanced Laravel Architecture</h3>
                        <span class="text-lg font-black text-primary ml-4">₦149</span>
                    </div>
                     <p class="text-secondary/70 text-sm mb-6 line-clamp-2">Deep dive into Laravel internals, service containers, and advanced design patterns for scalable apps.</p>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-gray-200 rounded-full"></div>
                        <span class="text-xs font-bold text-primary">Jane Smith</span>
                    </div>
                </div>
            </div>

            <!-- Course Card 3 -->
             <div class="bg-white rounded-4xl shadow-medium hover:shadow-floating transition-all duration-300 group cursor-pointer border border-transparent hover:border-soft-grey">
                <div class="h-64 bg-soft-grey rounded-t-4xl m-2 relative overflow-hidden group-hover:scale-[1.02] transition-transform">
                    <img src="{{ asset('images/course_marketing.png') }}" class="w-full h-full object-cover" alt="Marketing">
                     <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold shadow-sm text-brand">BEGINNER</div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-primary group-hover:text-black leading-tight">Digital Marketing Mastery</h3>
                        <span class="text-lg font-black text-primary ml-4">₦49</span>
                    </div>
                     <p class="text-secondary/70 text-sm mb-6 line-clamp-2">Master the art of digital marketing, SEO, and social media strategies to grow any business.</p>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-gray-200 rounded-full"></div>
                        <span class="text-xs font-bold text-primary">Mike Ross</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="max-w-5xl mx-auto px-8 mb-20">
        <div class="bg-brand rounded-5xl p-12 md:p-20 text-center shadow-floating relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2"></div>
            
            <h2 class="text-4xl md:text-5xl font-black text-white mb-6 relative z-10">Ready to start learning?</h2>
            <p class="text-white/80 mb-10 max-w-xl mx-auto relative z-10">Join thousands of students and start your journey towards mastery today. Get unlimited access to all courses.</p>
            <a href="{{ route('register') }}" class="px-10 py-5 bg-white text-brand font-bold rounded-full text-lg shadow-lg hover:bg-gray-100 transition-colors relative z-10">
                Get Started for Free
            </a>
        </div>
    </section>
</x-web-layout>
