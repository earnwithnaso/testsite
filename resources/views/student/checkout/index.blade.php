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
                                <span>{{ $currencySymbol }}{{ number_format((float)$course->price, 2) }}</span>
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
                        <div class="mb-10 text-center">
                            <div class="inline-block bg-primary/10 px-4 py-1 rounded-full text-primary text-[10px] font-black tracking-widest uppercase mb-4">Final Step</div>
                            <h2 class="text-4xl font-black text-primary mb-2 tracking-tighter">Complete Your Enrollment</h2>
                            <p class="text-secondary/60 font-medium">Please follow the instructions below to complete your payment via Bank Transfer.</p>
                        </div>

                        <div class="space-y-8">
                            <!-- Bank Transfer Details -->
                            <div class="bg-soft-grey/30 rounded-[40px] border-2 border-primary/10 p-10 relative overflow-hidden group">
                                <div class="absolute -right-10 -top-10 w-40 h-40 bg-primary/5 rounded-full blur-3xl transition-transform group-hover:scale-110"></div>
                                
                                <div class="relative z-10 space-y-10">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center text-white shadow-glow">
                                            <i class="hgi-stroke hgi-bank-transfer text-2xl"></i>
                                        </div>
                                        <h3 class="font-black text-xl text-primary tracking-tight">Bank Account Details</h3>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div class="space-y-2">
                                            <p class="text-[10px] font-black uppercase text-secondary/40 tracking-widest">Bank Provider</p>
                                            <p class="text-xl font-black text-primary">{{ $bankDetails['bank_name'] ?? 'Not Set' }}</p>
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-[10px] font-black uppercase text-secondary/40 tracking-widest">Account Holder</p>
                                            <p class="text-xl font-black text-primary">{{ $bankDetails['account_name'] ?? 'Earn With Nazo' }}</p>
                                        </div>
                                        <div class="md:col-span-2 space-y-2 pt-6 border-t border-primary/10">
                                            <p class="text-[10px] font-black uppercase text-secondary/40 tracking-widest">Account Number</p>
                                            <div class="flex items-center justify-between">
                                                <p class="text-4xl font-black text-primary tracking-tighter">{{ $bankDetails['account_number'] ?? 'Not Provided' }}</p>
                                                <button type="button" class="copy-account-btn p-4 bg-white rounded-2xl shadow-soft hover:bg-primary hover:text-white transition-all group/copy" data-account="{{ $bankDetails['account_number'] ?? '' }}">
                                                    <i class="hgi-stroke hgi-copy-01 group-hover/copy:scale-110 transition-transform"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="{{ route('checkout.bank_transfer.process', $course) }}" method="POST" enctype="multipart/form-data" class="pt-10 border-t border-primary/10 space-y-8">
                                        @csrf
                                        <div class="space-y-4">
                                            <label class="block text-sm font-black text-primary uppercase tracking-widest">Upload Payment Receipt</label>
                                            <div class="relative w-full h-32 rounded-3xl border-2 border-dashed border-primary/20 flex flex-col items-center justify-center bg-white hover:bg-primary/5 transition-all cursor-pointer group/upload">
                                                <input type="file" name="payment_proof" id="payment_proof_input" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10" required onchange="updateFileName(this)">
                                                <i class="hgi-stroke hgi-upload-04 text-3xl text-primary/30 group-hover/upload:text-primary mb-2 transition-colors"></i>
                                                <span class="text-sm font-black text-secondary/40 group-hover/upload:text-primary" id="file_name_display">Click to select image receipt</span>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="w-full py-6 bg-primary text-white font-black rounded-full shadow-glow hover:bg-secondary hover:scale-[1.02] transition-all flex items-center justify-center gap-3">
                                            DONE, SUBMIT ENROLLMENT
                                            <i class="hgi-stroke hgi-checkmark-circle-01 text-xl"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <script>
                            function updateFileName(input) {
                                const display = document.getElementById('file_name_display');
                                if (input.files[0]) {
                                    display.innerText = input.files[0].name;
                                    display.classList.remove('text-secondary/40');
                                    display.classList.add('text-primary');
                                }
                            }

                            // Handle copy button
                            document.addEventListener('DOMContentLoaded', function() {
                                const copyBtn = document.querySelector('.copy-account-btn');
                                if (copyBtn) {
                                    copyBtn.addEventListener('click', function() {
                                        const accountNumber = this.getAttribute('data-account');
                                        navigator.clipboard.writeText(accountNumber);
                                    });
                                }
                            });
                        </script>

                        <div class="mt-12 pt-8 border-t border-soft-grey text-center">
                            <p class="text-xs text-secondary/60 font-medium">By completing your purchase, you agree to our <a href="#" class="text-primary font-bold underline">Terms of Service</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-web-layout>
