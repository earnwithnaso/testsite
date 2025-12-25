<x-app-layout>
    <div class="max-w-6xl mx-auto py-8">
        <div class="mb-12">
            <h1 class="text-4xl font-black text-primary tracking-tighter mb-2">My Certificates</h1>
            <p class="text-secondary font-medium">Your achievements and completed courses</p>
        </div>

        @if($certificates->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($certificates as $certificate)
            <div class="bg-white rounded-[40px] shadow-medium overflow-hidden border border-soft-grey hover:shadow-floating transition-all group">
                <!-- Certificate Preview -->
                <div class="h-48 bg-gradient-to-br from-primary/10 via-brand/10 to-primary/10 relative overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="hgi-stroke hgi-award-01 text-8xl text-primary/20 group-hover:scale-110 transition-transform"></i>
                    </div>
                    <div class="absolute top-4 right-4 bg-white px-4 py-2 rounded-full shadow-soft">
                        <p class="text-[10px] font-black uppercase text-primary tracking-widest">Certified</p>
                    </div>
                </div>

                <!-- Certificate Info -->
                <div class="p-8 space-y-6">
                    <div>
                        <h3 class="font-black text-lg text-primary leading-tight mb-2">{{ $certificate->course->title }}</h3>
                        <p class="text-xs text-secondary/60 font-bold uppercase tracking-widest">{{ $certificate->certificate_number }}</p>
                    </div>

                    <div class="flex items-center gap-3 text-xs">
                        <i class="hgi-stroke hgi-calendar text-brand"></i>
                        <span class="font-bold text-secondary">Issued {{ $certificate->issued_at->format('M d, Y') }}</span>
                    </div>

                    <a href="{{ route('student.certificates.show', $certificate) }}" class="block w-full py-4 bg-primary text-white font-black rounded-full text-center shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
                        VIEW CERTIFICATE
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-white rounded-[40px] shadow-soft p-16 text-center">
            <div class="w-24 h-24 bg-soft-grey rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="hgi-stroke hgi-award-01 text-4xl text-secondary/40"></i>
            </div>
            <h3 class="text-2xl font-black text-primary mb-2">No Certificates Yet</h3>
            <p class="text-secondary/60 font-medium mb-8">Complete courses to earn certificates of achievement</p>
            <a href="{{ route('student.courses.index') }}" class="inline-block px-8 py-4 bg-primary text-white font-black rounded-full shadow-glow hover:bg-secondary transition-all">
                BROWSE MY COURSES
            </a>
        </div>
        @endif
    </div>
</x-app-layout>
