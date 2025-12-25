<x-web-layout>
    <div class="py-20 bg-soft-grey min-h-screen">
        <div class="max-w-3xl mx-auto px-6">
            <div class="bg-white rounded-5xl shadow-floating p-12">
                <div class="text-center mb-10">
                    <span class="inline-block px-6 py-2 bg-primary/10 text-primary rounded-full text-sm font-bold mb-4">Finalize Enrollment</span>
                    <h1 class="text-4xl font-black text-primary">Bank Transfer Payment</h1>
                    <p class="text-secondary mt-4 font-medium">Please transfer the course fee to the account below and upload your receipt.</p>
                </div>

                <!-- Course Summary -->
                <div class="bg-soft-grey/30 rounded-4xl p-8 mb-10 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-primary text-lg">{{ $course->title }}</h3>
                        <p class="text-secondary text-sm">Course Enrollment Fee</p>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-black text-primary">{{ $currencySymbol }}{{ number_format($course->price, 2) }}</p>
                    </div>
                </div>

                <!-- Bank Account Info -->
                <div class="border-2 border-primary/20 rounded-4xl p-8 mb-10 bg-primary/5">
                    <h4 class="text-sm font-black text-primary uppercase tracking-widest mb-6 text-center">Transfer to this Account</h4>
                    
                    <div class="space-y-6">
                        <div class="flex justify-between items-center border-b border-primary/10 pb-4">
                            <span class="text-secondary font-bold">Bank Name</span>
                            <span class="text-primary font-black text-lg">{{ $bankDetails['bank_name'] ?? 'Not Set' }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-primary/10 pb-4">
                            <span class="text-secondary font-bold">Account Number</span>
                            <span class="text-primary font-black text-2xl tracking-tighter">{{ $bankDetails['account_number'] ?? '0000000000' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-secondary font-bold">Account Name</span>
                            <span class="text-primary font-black text-lg">{{ $bankDetails['account_name'] ?? 'Earn With Nazo' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Proof Form -->
                <form action="{{ route('checkout.bank_transfer.process', $course) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-secondary mb-4 ml-4">Upload Payment Proof (Receipt/Screenshot)</label>
                            <div class="relative w-full h-32 rounded-4xl border-2 border-dashed border-border-grey flex items-center justify-center bg-soft-grey/10 hover:bg-soft-grey/20 transition-colors cursor-pointer group">
                                <input type="file" name="payment_proof" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10" required>
                                <div class="text-center">
                                    <span class="block text-2xl mb-1">📃</span>
                                    <span class="text-sm font-bold text-secondary group-hover:text-primary">Click to select receipt</span>
                                </div>
                            </div>
                            @error('payment_proof') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full py-6 bg-primary text-white font-black rounded-full shadow-floating hover:shadow-hover hover:-translate-y-1 transition-all text-lg">
                                I HAVE PAID
                            </button>
                        </div>
                        
                        <p class="text-center text-secondary text-xs font-medium">
                            Once submitted, our team will verify your payment within 24 hours.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-web-layout>
