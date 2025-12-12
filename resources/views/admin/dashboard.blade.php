<x-admin-layout>
    @section('header', 'Dashboard Overview')

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Total Users -->
        <div class="bg-white p-8 rounded-5xl shadow-soft hover:shadow-medium transition-all group">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-soft-grey rounded-full">
                    👥
                </div>
                <span class="text-xs font-bold bg-green-100 text-green-800 px-3 py-1 rounded-full">+12%</span>
            </div>
            <h3 class="text-secondary text-sm font-bold uppercase tracking-wider mb-1">Total Users</h3>
            <p class="text-4xl font-black text-primary">{{ number_format($stats['total_users']) }}</p>
        </div>

        <!-- Total Revenue -->
        <div class="bg-primary text-white p-8 rounded-5xl shadow-floating hover:transform hover:-translate-y-1 transition-all">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-white/20 rounded-full">
                    💰
                </div>
            </div>
            <h3 class="text-white/70 text-sm font-bold uppercase tracking-wider mb-1">Total Revenue</h3>
            <p class="text-4xl font-black text-white">₦{{ number_format($stats['total_revenue'], 2) }}</p>
        </div>

        <!-- Active Courses -->
        <div class="bg-white p-8 rounded-5xl shadow-soft hover:shadow-medium transition-all">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-soft-grey rounded-full">
                    🎓
                </div>
            </div>
            <h3 class="text-secondary text-sm font-bold uppercase tracking-wider mb-1">Active Courses</h3>
            <p class="text-4xl font-black text-primary">{{ number_format($stats['published_courses']) }} <span class="text-lg text-secondary/50 font-normal">/ {{ $stats['total_courses'] }}</span></p>
        </div>

        <!-- Orders -->
        <div class="bg-white p-8 rounded-5xl shadow-soft hover:shadow-medium transition-all">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-soft-grey rounded-full">
                    📦
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
            <h3 class="text-xl font-bold mb-6">Revenue Analytics</h3>
            <div class="h-64 bg-soft-grey/30 rounded-4xl flex items-center justify-center text-secondary/40 font-bold border-2 border-dashed border-soft-grey">
                [CHART COMPONENT PLACEHOLDER]
            </div>
        </div>

        <!-- Recent Actions -->
        <div class="bg-white p-10 rounded-5xl shadow-soft">
            <h3 class="text-xl font-bold mb-6">Recent Activity</h3>
            <div class="space-y-6">
                <!-- Item -->
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-soft-grey flex items-center justify-center font-bold text-xs">JD</div>
                    <div>
                        <p class="text-sm font-bold text-primary">John Doe registered</p>
                        <p class="text-xs text-secondary">2 minutes ago</p>
                    </div>
                </div>
                <!-- Item -->
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-soft-grey flex items-center justify-center font-bold text-xs text-green-600">₦</div>
                    <div>
                        <p class="text-sm font-bold text-primary">New Order #1234</p>
                        <p class="text-xs text-secondary">15 minutes ago</p>
                    </div>
                </div>
                 <!-- Item -->
                 <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-soft-grey flex items-center justify-center font-bold text-xs">🎓</div>
                    <div>
                        <p class="text-sm font-bold text-primary">Course Published</p>
                        <p class="text-xs text-secondary">1 hour ago</p>
                    </div>
                </div>
            </div>
             <button class="w-full mt-8 py-3 rounded-full border border-soft-grey text-sm font-bold hover:bg-black hover:text-white transition-colors">
                View All Activity
            </button>
        </div>
    </div>
</x-admin-layout>
