<x-web-layout>
    <div class="py-20 bg-gradient-to-br from-soft-grey via-white to-primary/5 min-h-screen">
        <div class="max-w-5xl mx-auto px-6">
            <!-- Certificate Container -->
            <div class="bg-white rounded-[50px] shadow-2xl overflow-hidden border-8 border-primary/10 relative">
                <!-- Decorative Elements -->
                <div class="absolute top-0 left-0 w-64 h-64 bg-gradient-to-br from-primary/10 to-brand/10 rounded-full blur-3xl -ml-32 -mt-32"></div>
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-gradient-to-tl from-brand/10 to-primary/10 rounded-full blur-3xl -mr-32 -mb-32"></div>
                
                <!-- Certificate Header Border -->
                <div class="h-6 w-full bg-gradient-to-r from-primary via-brand to-primary"></div>
                
                <div class="p-16 relative z-10">
                    <!-- Header -->
                    <div class="text-center mb-12">
                        <div class="inline-block bg-primary/10 px-6 py-2 rounded-full text-primary text-xs font-black tracking-widest uppercase mb-6">
                            Certificate of Completion
                        </div>
                        <h1 class="text-6xl font-black text-primary tracking-tighter mb-4">Achievement Unlocked</h1>
                        <p class="text-secondary/60 font-medium text-lg">This certifies that</p>
                    </div>

                    <!-- Student Name -->
                    <div class="text-center mb-12">
                        <h2 class="text-5xl font-black text-primary tracking-tight border-b-4 border-primary/20 inline-block pb-4 px-8">
                            {{ $certificate->user->name }}
                        </h2>
                    </div>

                    <!-- Course Info -->
                    <div class="text-center mb-12">
                        <p class="text-secondary/60 font-medium text-lg mb-4">has successfully completed the course</p>
                        <h3 class="text-3xl font-black text-primary tracking-tight mb-6">{{ $certificate->course->title }}</h3>
                        
                        @if($certificate->course->instructor)
                        <div class="flex items-center justify-center gap-3 text-secondary/60">
                            <span class="text-sm font-bold">Instructed by</span>
                            <span class="text-sm font-black text-primary">{{ $certificate->course->instructor->name }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Certificate Details -->
                    <div class="grid grid-cols-2 gap-8 mb-12 max-w-2xl mx-auto">
                        <div class="text-center p-6 bg-soft-grey/30 rounded-3xl">
                            <p class="text-[10px] font-black uppercase text-secondary/40 tracking-widest mb-2">Certificate Number</p>
                            <p class="text-lg font-black text-primary tracking-tight">{{ $certificate->certificate_number }}</p>
                        </div>
                        <div class="text-center p-6 bg-soft-grey/30 rounded-3xl">
                            <p class="text-[10px] font-black uppercase text-secondary/40 tracking-widest mb-2">Date Issued</p>
                            <p class="text-lg font-black text-primary tracking-tight">{{ $certificate->issued_at->format('F d, Y') }}</p>
                        </div>
                    </div>

                    <!-- Signature Area -->
                    <div class="flex justify-center gap-16 mb-12">
                        <div class="text-center">
                            <div class="w-48 border-t-2 border-primary/30 mb-2"></div>
                            <p class="text-xs font-black uppercase text-secondary/40 tracking-widest">Platform Director</p>
                        </div>
                        <div class="text-center">
                            <div class="w-48 border-t-2 border-primary/30 mb-2"></div>
                            <p class="text-xs font-black uppercase text-secondary/40 tracking-widest">Course Instructor</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-center gap-4">
                        <button onclick="window.print()" class="px-8 py-4 bg-primary text-white font-black rounded-full shadow-glow hover:bg-secondary transition-all flex items-center gap-3">
                            <i class="hgi-stroke hgi-printer"></i>
                            PRINT CERTIFICATE
                        </button>
                        <a href="{{ route('student.courses.show', $certificate->course->slug) }}" class="px-8 py-4 border-2 border-soft-grey text-primary font-black rounded-full hover:bg-soft-grey/30 transition-all flex items-center gap-3">
                            <i class="hgi-stroke hgi-arrow-left-01"></i>
                            BACK TO COURSE
                        </a>
                    </div>
                </div>

                <!-- Certificate Footer Border -->
                <div class="h-6 w-full bg-gradient-to-r from-primary via-brand to-primary"></div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .max-w-5xl, .max-w-5xl * {
                visibility: visible;
            }
            .max-w-5xl {
                position: absolute;
                left: 0;
                top: 0;
            }
            button, a {
                display: none !important;
            }
        }
    </style>
</x-web-layout>
