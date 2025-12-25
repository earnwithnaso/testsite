<x-web-layout>
    <div class="py-20 bg-soft-grey min-h-screen">
        <div class="max-w-2xl mx-auto px-6">
            <div class="bg-white rounded-[50px] shadow-floating overflow-hidden relative">
                <!-- Header Gradient -->
                <div class="h-4 w-full bg-gradient-to-r {{ $result->is_passed ? 'from-green-400 to-emerald-500' : 'from-red-400 to-orange-500' }}"></div>
                
                <div class="p-12 text-center">
                    <!-- Status Icon -->
                    <div class="w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-8 {{ $result->is_passed ? 'bg-green-100 text-green-500' : 'bg-red-100 text-red-500' }}">
                        @if($result->is_passed)
                            <i class="hgi-stroke hgi-checkmark-circle-01 text-5xl"></i>
                        @else
                            <i class="hgi-stroke hgi-cancel-circle-01 text-5xl"></i>
                        @endif
                    </div>

                    <h1 class="text-4xl font-black text-primary tracking-tighter mb-2">
                        {{ $result->is_passed ? 'Course Legend!' : 'Keep Pushing!' }}
                    </h1>
                    <p class="text-secondary font-medium uppercase text-xs tracking-widest mb-10">
                        Quiz: {{ $quiz->title }}
                    </p>

                    <!-- Score Card -->
                    <div class="bg-soft-grey/30 rounded-4xl p-8 mb-10 grid grid-cols-2 gap-4">
                        <div class="text-left border-r border-soft-grey">
                            <div class="text-[10px] font-black uppercase text-secondary/40 tracking-widest mb-1">Your Score</div>
                            <div class="text-4xl font-black text-primary tracking-tighter">{{ $result->percentage }}%</div>
                        </div>
                        <div class="text-left pl-4">
                            <div class="text-[10px] font-black uppercase text-secondary/40 tracking-widest mb-1">Passing Score</div>
                            <div class="text-4xl font-black text-primary tracking-tighter">{{ $quiz->passing_percentage }}%</div>
                        </div>
                    </div>

                    <div class="space-y-4 mb-10">
                        <div class="flex justify-between text-sm font-bold border-b border-soft-grey pb-4">
                            <span class="text-secondary">Correct Answers</span>
                            <span class="text-primary">{{ $result->correct_answers }} / {{ $result->total_questions }}</span>
                        </div>
                        <div class="flex justify-between text-sm font-bold">
                            <span class="text-secondary">Status</span>
                            <span class="{{ $result->is_passed ? 'text-green-500' : 'text-red-500' }}">{{ $result->is_passed ? 'PASSED' : 'NOT PASSED' }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4">
                        @if(!$result->is_passed)
                            <a href="{{ route('student.quizzes.show', $quiz) }}" class="w-full py-5 bg-primary text-white font-black rounded-full shadow-glow hover:bg-secondary transition-all">
                                RETAKE QUIZ
                            </a>
                        @endif
                        <a href="{{ route('student.courses.show', [$quiz->course->slug, $quiz->lesson_id]) }}" class="w-full py-5 border-2 border-soft-grey text-primary font-black rounded-full hover:bg-soft-grey/30 transition-all">
                            RETURN TO COURSE
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-web-layout>
