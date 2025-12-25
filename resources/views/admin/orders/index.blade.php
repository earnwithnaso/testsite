<x-admin-layout>
    @section('header', 'Enrollment Management')

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h2 class="text-xl font-bold text-primary">All Enrollments</h2>
            <p class="text-sm text-secondary">Manage course purchases and bank transfer approvals.</p>
        </div>
        
        <div class="flex gap-2">
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold hover:bg-yellow-200 transition-colors">Pending Only</a>
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-soft-grey text-secondary rounded-full text-xs font-bold hover:bg-border-grey transition-colors">Clear Filter</a>
        </div>
    </div>

    <div class="bg-white rounded-5xl shadow-soft overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-soft-grey/30 border-b border-soft-grey">
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Order No.</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Student</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Course</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Amount</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Status</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-soft-grey/50">
                    @forelse ($orders as $order)
                    <tr class="hover:bg-soft-grey/10 transition-colors">
                        <td class="p-6">
                            <span class="font-bold text-primary text-sm">{{ $order->order_number }}</span>
                            <p class="text-[10px] text-secondary mt-1">{{ $order->created_at->format('M d, Y H:i') }}</p>
                        </td>
                        <td class="p-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center font-bold text-primary text-xs">
                                    {{ substr($order->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-primary text-sm">{{ $order->user->name }}</h4>
                                    <p class="text-xs text-secondary">{{ $order->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-6">
                            <div class="text-sm font-bold text-primary">
                                @foreach($order->items as $item)
                                    <div>{{ $item->course->title }}</div>
                                @endforeach
                            </div>
                        </td>
                        <td class="p-6 font-bold text-primary">
                            ₦{{ number_format($order->total_amount, 2) }}
                        </td>
                        <td class="p-6">
                            <div class="flex flex-col gap-1">
                                <!-- Status -->
                                @if($order->status == 'completed')
                                    <span class="w-fit px-3 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-black uppercase">Completed</span>
                                @elseif($order->status == 'pending')
                                    <span class="w-fit px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-[10px] font-black uppercase">Pending</span>
                                @else
                                    <span class="w-fit px-3 py-1 bg-red-100 text-red-700 rounded-full text-[10px] font-black uppercase">{{ $order->status }}</span>
                                @endif

                                <!-- Payment Status -->
                                @if($order->payment_status == 'paid')
                                    <span class="text-[10px] text-green-600 font-bold ml-1">Paid</span>
                                @else
                                    <span class="text-[10px] text-yellow-600 font-bold ml-1">Unpaid</span>
                                @endif
                            </div>
                        </td>
                        <td class="p-6">
                            <a href="{{ route('admin.orders.show', $order) }}" class="px-6 py-2 bg-soft-grey text-primary text-xs font-bold rounded-full hover:bg-primary hover:text-white transition-all">
                                View Details
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-12 text-center text-secondary font-bold">
                            No orders found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($orders->hasPages())
        <div class="p-6 border-t border-soft-grey">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
