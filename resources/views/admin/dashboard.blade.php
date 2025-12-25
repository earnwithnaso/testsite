<x-admin-layout>
    @section('header', 'Dashboard Overview')

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Total Users -->
        <div class="bg-white p-8 rounded-5xl shadow-soft hover:shadow-medium transition-all group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-brand/10 text-brand rounded-full">
                    <i class="hgi-stroke hgi-user-group text-xl"></i>
                </div>
                <span class="text-xs font-bold bg-green-100 text-green-800 px-3 py-1 rounded-full">+12%</span>
            </div>
            <h3 class="text-secondary text-sm font-bold uppercase tracking-wider mb-1">Total Users</h3>
            <p class="text-4xl font-black text-primary">{{ number_format($stats['total_users']) }}</p>
        </div>

        <!-- Total Revenue -->
        <div class="bg-primary text-white p-8 rounded-5xl shadow-floating hover:transform hover:-translate-y-1 transition-all group relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 opacity-10 transform scale-150 rotate-12 transition-transform group-hover:scale-175">
                <i class="hgi-stroke hgi-money-01 text-8xl"></i>
            </div>
            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="p-3 bg-white/20 rounded-full">
                    <i class="hgi-stroke hgi-money-send-01 text-xl"></i>
                </div>
            </div>
            <h3 class="text-white/70 text-sm font-bold uppercase tracking-wider mb-1 relative z-10">Total Revenue</h3>
            <p class="text-4xl font-black text-white relative z-10">₦{{ number_format($stats['total_revenue'], 0) }}</p>
        </div>

        <!-- Active Courses -->
        <div class="bg-white p-8 rounded-5xl shadow-soft hover:shadow-medium transition-all group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-blue-500/10 text-blue-500 rounded-full">
                    <i class="hgi-stroke hgi-book-open-01 text-xl"></i>
                </div>
            </div>
            <h3 class="text-secondary text-sm font-bold uppercase tracking-wider mb-1">Active Courses</h3>
            <p class="text-4xl font-black text-primary">{{ number_format($stats['published_courses']) }} <span class="text-lg text-secondary/50 font-normal">/ {{ $stats['total_courses'] }}</span></p>
        </div>

        <!-- Orders -->
        <div class="bg-white p-8 rounded-5xl shadow-soft hover:shadow-medium transition-all group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-purple-500/10 text-purple-500 rounded-full">
                    <i class="hgi-stroke hgi-package text-xl"></i>
                </div>
            </div>
            <h3 class="text-secondary text-sm font-bold uppercase tracking-wider mb-1">Total Orders</h3>
            <p class="text-4xl font-black text-primary">{{ number_format($stats['total_orders']) }}</p>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
        <!-- Chart Placeholder -->
        <div class="lg:col-span-2 bg-white p-10 rounded-5xl shadow-soft">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold">Revenue Analytics</h3>
                <div class="flex items-center gap-2">
                    <i class="hgi-stroke hgi-calendar-01 text-secondary"></i>
                    <span class="text-sm font-bold text-secondary">Last 30 Days</span>
                </div>
            </div>
            <div class="h-64 bg-soft-grey/30 rounded-4xl flex items-center justify-center text-secondary/40 font-bold border-2 border-dashed border-soft-grey">
                <div class="text-center">
                    <i class="hgi-stroke hgi-chart-line-data-01 text-4xl mb-2 block"></i>
                    [CHART COMPONENT PLACEHOLDER]
                </div>
            </div>
        </div>

        <!-- Recent Actions -->
        <div class="bg-white p-10 rounded-5xl shadow-soft">
            <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                <i class="hgi-stroke hgi-activity-01 text-brand"></i>
                Recent Activity
            </h3>
            <div class="space-y-6">
                <!-- Item -->
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-soft-grey flex items-center justify-center">
                         <i class="hgi-stroke hgi-user text-primary"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-primary">John Doe registered</p>
                        <p class="text-xs text-secondary">2 minutes ago</p>
                    </div>
                </div>
                <!-- Item -->
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-brand/10 text-brand flex items-center justify-center">
                         <i class="hgi-stroke hgi-money-send-01 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-primary">New Order #1234</p>
                        <p class="text-xs text-secondary">15 minutes ago</p>
                    </div>
                </div>
                 <!-- Item -->
                 <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-500/10 text-blue-500 flex items-center justify-center font-bold text-xs">
                        <i class="hgi-stroke hgi-course-01"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-primary">Course Published</p>
                        <p class="text-xs text-secondary">1 hour ago</p>
                    </div>
                </div>
            </div>
             <button class="w-full mt-8 py-3 rounded-full border border-soft-grey text-sm font-bold hover:bg-black hover:text-white transition-colors flex items-center justify-center gap-2">
                View All Activity
                <i class="hgi-stroke hgi-arrow-right-01"></i>
            </button>
        </div>
    </div>
</x-admin-layout>
