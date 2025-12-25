<x-web-layout>
    <div class="py-20 bg-soft-grey min-h-screen">
        <div class="max-w-4xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Left: Order Summary -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-5xl shadow-medium p-8 border border-soft-grey">
                        <h3 class="font-black text-xl text-primary mb-6">Order Summary</h3>
                        <div class="space-y-4">
                            <div class="aspect-video rounded-3xl overflow-hidden bg-soft-grey">
                                @if($course->thumbnail_path)
                                    <img src="{{ Storage::url($course->thumbnail_path) }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-primary">{{ $course->title }}</h4>
                                <p class="text-xs text-secondary font-medium">{{ $course->instructor->name }}</p>
                            </div>
                            <hr class="border-soft-grey">
                            <div class="flex justify-between items-center text-lg font-black text-primary">
                                <span>Total</span>
                                <span>{{ $currencySymbol }}{{ number_format($course->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-primary p-8 rounded-5xl shadow-floating text-white relative overflow-hidden group">
                        <div class="absolute -right-4 -bottom-4 opacity-10 transform scale-150 rotate-12 transition-transform group-hover:scale-175">
                             <i class="hgi-stroke hgi-security-check text-8xl"></i>
                        </div>
                        <div class="relative z-10">
                            <h4 class="font-bold mb-2">Secure Checkout</h4>
                            <p class="text-xs text-white/70 font-medium">Your payment information is encrypted and secure.</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Payment Methods -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-5xl shadow-floating p-10 md:p-12">
                        <div class="mb-10">
                            <h2 class="text-3xl font-black text-primary mb-2">Select Payment Method</h2>
                            <p class="text-secondary font-medium uppercase text-[10px] tracking-widest">Choose how you want to pay</p>
                        </div>

                        <div class="space-y-4">
                            <!-- Stripe / Card Payment -->
                            <form action="{{ route('checkout.stripe', $course) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-between p-8 rounded-4xl border-2 border-soft-grey hover:border-brand hover:bg-brand/5 transition-all group text-left">
                                    <div class="flex items-center gap-6">
                                        <div class="w-14 h-14 bg-brand/10 rounded-2xl flex items-center justify-center text-brand text-2xl group-hover:bg-brand group-hover:text-white transition-all">
                                            <i class="hgi-stroke hgi-credit-card"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-extrabold text-primary text-lg">Online Payment</h4>
                                            <p class="text-xs text-secondary font-medium">Pay with Debit Card, Apple Pay, or Google Pay</p>
                                        </div>
                                    </div>
                                    <i class="hgi-stroke hgi-arrow-right-01 text-secondary group-hover:text-brand transition-all"></i>
                                </button>
                            </form>

                            <!-- Bank Transfer -->
                            <button onclick="document.getElementById('bankTransferSection').classList.toggle('hidden')" class="w-full flex items-center justify-between p-8 rounded-4xl border-2 border-soft-grey hover:border-primary hover:bg-primary/5 transition-all group text-left">
                                <div class="flex items-center gap-6">
                                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary text-2xl group-hover:bg-primary group-hover:text-white transition-all">
                                        <i class="hgi-stroke hgi-bank-transfer"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-extrabold text-primary text-lg">Manual Bank Transfer</h4>
                                        <p class="text-xs text-secondary font-medium">Transfer to our account and upload receipt</p>
                                    </div>
                                </div>
                                <i class="hgi-stroke hgi-arrow-down-01 text-secondary group-hover:text-primary transition-all"></i>
                            </button>

                            <!-- Bank Transfer Details (Hidden by default) -->
                            <div id="bankTransferSection" class="hidden animate-fade-in-down">
                                <div class="mt-4 p-8 rounded-4xl bg-soft-grey/30 border-2 border-primary/20 space-y-8">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-1">
                                            <p class="text-[10px] font-black uppercase text-secondary/50 tracking-widest">Bank Name</p>
                                            <p class="font-bold text-primary">{{ $bankDetails['bank_name'] ?? 'Not Set' }}</p>
                                        </div>
                                        <div class="space-y-1">
                                            <p class="text-[10px] font-black uppercase text-secondary/50 tracking-widest">Account Name</p>
                                            <p class="font-bold text-primary">{{ $bankDetails['account_name'] ?? 'Earn With Nazo' }}</p>
                                        </div>
                                        <div class="col-span-2 space-y-1 pt-4 border-t border-primary/10">
                                            <p class="text-[10px] font-black uppercase text-secondary/50 tracking-widest">Account Number</p>
                                            <p class="text-3xl font-black text-primary tracking-tighter">{{ $bankDetails['account_number'] ?? '0000000000' }}</p>
                                        </div>
                                    </div>

                                    <form action="{{ route('checkout.bank_transfer.process', $course) }}" method="POST" enctype="multipart/form-data" class="pt-6 border-t border-primary/10 space-y-6">
                                        @csrf
                                        <div>
                                            <label class="block text-sm font-bold text-secondary mb-3">Upload Transfer Receipt</label>
                                            <div class="relative w-full h-24 rounded-3xl border-2 border-dashed border-border-grey flex items-center justify-center bg-white hover:bg-soft-grey/20 transition-colors cursor-pointer group">
                                                <input type="file" name="payment_proof" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10" required>
                                                <div class="text-center">
                                                    <span class="text-sm font-bold text-secondary group-hover:text-primary">Click to select file</span>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="w-full py-5 bg-primary text-white font-black rounded-full shadow-floating hover:bg-secondary transition-all">
                                            SUBMIT PROOF
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12 pt-8 border-t border-soft-grey text-center">
                            <p class="text-xs text-secondary/60 font-medium">By completing your purchase, you agree to our <a href="#" class="text-primary font-bold underline">Terms of Service</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-web-layout>
