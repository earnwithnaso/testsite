<x-app-layout>
    <x-slot name="header">
        <div class="flex items-end justify-between">
            <div>
                <h2 class="font-black text-3xl text-primary leading-tight">
                    Hello, {{ Auth::user()->name }}! 👋
                </h2>
                <p class="text-secondary font-medium mt-1">Ready to continue learning?</p>
            </div>
            <a href="{{ route('courses.index') }}" class="hidden md:inline-block px-6 py-3 bg-brand text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-green-600 transition-all text-sm">
                Browse Courses
            </a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Stats Column -->
        <div class="space-y-8">
            <div class="bg-white p-8 rounded-5xl shadow-soft border border-soft-grey">
                <span class="text-xs font-bold bg-soft-grey px-3 py-1 rounded-full text-secondary uppercase">In Progress</span>
                <h3 class="mt-4 text-4xl font-black text-primary">3</h3>
                <p class="text-sm font-bold text-secondary">Active Courses</p>
            </div>
            
            <div class="bg-brand p-8 rounded-5xl shadow-floating text-white">
                <span class="text-xs font-bold bg-white/20 px-3 py-1 rounded-full text-white uppercase">Certificate</span>
                <h3 class="mt-4 text-4xl font-black text-white">0</h3>
                <p class="text-sm font-bold text-white/70">Completed</p>
            </div>
        </div>

        <!-- Main Content Column -->
        <div class="md:col-span-2 space-y-8">
            <!-- Continue Learning -->
            <div class="bg-white p-8 rounded-5xl shadow-soft">
                <h3 class="text-xl font-bold text-primary mb-6">Continue Learning</h3>
                
                <!-- Course Item Placeholder -->
                <div class="group flex flex-col md:flex-row gap-6 items-center p-4 rounded-4xl hover:bg-soft-grey/20 transition-colors border border-transparent hover:border-soft-grey">
                    <div class="w-full md:w-32 h-24 bg-soft-grey rounded-3xl flex items-center justify-center font-bold text-black/20 text-xs">COURSE IMG</div>
                    <div class="flex-1 w-full text-center md:text-left">
                        <h4 class="font-bold text-lg text-primary">Web Development Bootcamp</h4>
                        <div class="w-full bg-soft-grey/50 rounded-full h-2 mt-3 overflow-hidden">
                            <div class="bg-primary h-full rounded-full" style="width: 35%"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-xs font-bold text-secondary">
                            <span>35% Complete</span>
                            <span>2h 15m remaining</span>
                        </div>
                    </div>
                    <button class="bg-primary text-white w-12 h-12 rounded-full flex items-center justify-center hover:scale-110 transition-transform shadow-medium">
                        ▶
                    </button>
                </div>

                <!-- Another Placeholder -->
                <div class="mt-4 text-center">
                    <p class="text-secondary text-sm">Don't have any active courses?</p>
                    <a href="{{ route('courses.index') }}" class="inline-block mt-2 font-bold text-primary hover:underline">Explore Catalog -></a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
