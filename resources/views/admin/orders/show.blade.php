<x-admin-layout>
    @section('header', 'Order Details: ' . $order->order_number)

    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Side: Order Info -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Status Bar -->
                <div class="bg-white p-8 rounded-5xl shadow-soft flex flex-wrap items-center justify-between gap-6">
                    <div class="flex items-center gap-6">
                        <div>
                            <p class="text-[10px] font-black uppercase text-secondary tracking-widest leading-none mb-2">Order Status</p>
                            <span class="px-4 py-2 {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }} rounded-full text-xs font-black uppercase">
                                {{ $order->status }}
                            </span>
                        </div>
                        <div class="w-px h-10 bg-soft-grey"></div>
                        <div>
                            <p class="text-[10px] font-black uppercase text-secondary tracking-widest leading-none mb-2">Payment</p>
                            <span class="px-4 py-2 {{ $order->payment_status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} rounded-full text-xs font-black uppercase">
                                {{ $order->payment_status }}
                            </span>
                        </div>
                    </div>

                    @if($order->status == 'pending')
                    <div class="flex gap-4">
                        <form action="{{ route('admin.orders.approve', $order) }}" method="POST">
                            @csrf
                            <button class="px-8 py-3 bg-green-500 text-white font-bold rounded-full shadow-medium hover:bg-green-600 transition-all">
                                Approve Payment
                            </button>
                        </form>
                        
                        <button onclick="document.getElementById('disapprove-modal').classList.remove('hidden')" class="px-8 py-3 bg-red-50 text-red-600 font-bold rounded-full border border-red-100 hover:bg-red-100 transition-all">
                            Disapprove
                        </button>
                    </div>
                    @endif
                </div>

                <!-- Course/Items -->
                <div class="bg-white rounded-5xl shadow-soft overflow-hidden">
                    <div class="p-8 border-b border-soft-grey">
                        <h3 class="font-black text-xl text-primary">Items in Order</h3>
                    </div>
                    <div class="p-8">
                        @foreach($order->items as $item)
                        <div class="flex items-center gap-6">
                            <div class="w-24 h-16 bg-soft-grey rounded-2xl overflow-hidden shrink-0">
                                @if($item->course->thumbnail_path)
                                    <img src="{{ Storage::url($item->course->thumbnail_path) }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="font-black text-primary text-lg">{{ $item->course->title }}</h4>
                                <p class="text-sm text-secondary">Instructor: {{ $item->course->instructor->name ?? 'N/A' }}</p>
                            </div>
                            <div class="text-xl font-black text-primary">
                                ₦{{ number_format($item->price, 2) }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="bg-soft-grey/30 p-8 flex justify-between items-center text-primary">
                        <span class="font-bold uppercase tracking-widest text-secondary text-sm">Total Amount paid</span>
                        <span class="text-3xl font-black">₦{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>

                <!-- Payment Proof Section -->
                @if($order->payment_method == 'bank_transfer' && $order->payment_proof)
                <div class="bg-white p-8 rounded-5xl shadow-soft">
                    <h3 class="font-black text-xl text-primary mb-6">Payment Proof</h3>
                    <div class="border-4 border-soft-grey rounded-4xl overflow-hidden aspect-[4/3] bg-soft-grey flex items-center justify-center relative group">
                        <img src="{{ Storage::url($order->payment_proof) }}" class="w-full h-full object-contain">
                        <a href="{{ Storage::url($order->payment_proof) }}" target="_blank" class="absolute inset-0 bg-primary/40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white font-bold transition-opacity">
                            View Full Size ↗
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Side: Sidebar Info -->
            <div class="space-y-8">
                <!-- Student Card -->
                <div class="bg-primary p-8 rounded-5xl shadow-floating text-white">
                    <p class="text-[10px] font-black uppercase text-white/50 tracking-widest mb-6">Customer Information</p>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center font-black text-xl">
                            {{ substr($order->user->name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-lg leading-tight">{{ $order->user->name }}</h4>
                            <p class="text-sm text-white/60">Joined {{ $order->user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                    <div class="space-y-4 pt-4 border-t border-white/10">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-black uppercase text-white/40 mb-1">Email Address</span>
                            <span class="font-bold">{{ $order->user->email }}</span>
                        </div>
                    </div>
                </div>

                <!-- Internal Notes -->
                <div class="bg-white p-8 rounded-5xl shadow-soft">
                    <h4 class="font-black text-primary mb-4">Admin Notes</h4>
                    <div class="bg-soft-grey/50 p-4 rounded-3xl text-sm text-secondary font-medium min-h-[100px]">
                        @if($order->notes)
                            {!! nl2br(e($order->notes)) !!}
                        @else
                            <p class="italic">No notes recorded for this order.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Disapprove Modal -->
    <div id="disapprove-modal" class="fixed inset-0 bg-primary/80 backdrop-blur-sm z-[100] hidden items-center justify-center p-6">
        <div class="bg-white w-full max-w-md rounded-5xl p-10 shadow-floating">
            <h3 class="text-2xl font-black text-primary mb-2 text-center">Disapprove Order</h3>
            <p class="text-secondary text-sm text-center mb-8">Please provide a reason for cancelling this enrollment.</p>
            
            <form action="{{ route('admin.orders.disapprove', $order) }}" method="POST">
                @csrf
                <textarea name="reason" rows="4" class="w-full p-6 rounded-4xl border-2 border-soft-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary resize-none mb-6" placeholder="e.g., Transfer amount doesn't match, invalid receipt..."></textarea>
                
                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full py-4 bg-red-500 text-white font-bold rounded-full shadow-medium">
                        Disapprove & Cancel
                    </button>
                    <button type="button" onclick="document.getElementById('disapprove-modal').classList.add('hidden')" class="w-full py-4 bg-soft-grey text-secondary font-bold rounded-full">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
