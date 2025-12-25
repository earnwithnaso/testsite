<x-web-layout>
    <div class="py-20 bg-soft-grey min-h-screen">
        <div class="max-w-4xl mx-auto px-6">
            <div class="mb-12 flex justify-between items-end">
                <div>
                    <h1 class="text-4xl font-black text-primary tracking-tighter mb-2">{{ $quiz->title }}</h1>
                    <p class="text-secondary font-medium">{{ $quiz->course->title }}</p>
                </div>
                <div class="text-right">
                    <div class="text-[10px] font-black uppercase text-secondary/40 tracking-widest mb-1">Time Limit</div>
                    <div class="text-xl font-black text-primary">
                        {{ $quiz->time_limit ? $quiz->time_limit . ' mins' : 'No Limit' }}
                    </div>
                </div>
            </div>

            <form action="{{ route('student.quizzes.submit', $quiz) }}" method="POST" class="space-y-8">
                @csrf
                
                @foreach ($quiz->questions as $index => $question)
                <div class="bg-white rounded-[40px] shadow-medium p-10 border border-transparent hover:border-primary/10 transition-all">
                    <div class="flex items-start gap-6 mb-8">
                        <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary font-black shrink-0">
                            {{ $index + 1 }}
                        </div>
                        <h3 class="text-xl font-bold text-primary leading-tight mt-2">{{ $question->question_text }}</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($question->options as $option)
                        <label class="relative group cursor-pointer">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" class="hidden peer" required>
                            <div class="p-6 rounded-3xl border-2 border-soft-grey bg-white peer-checked:border-primary peer-checked:bg-primary/5 group-hover:bg-soft-grey/30 transition-all flex items-center gap-4">
                                <div class="w-6 h-6 rounded-full border-2 border-soft-grey peer-checked:border-primary flex items-center justify-center">
                                    <div class="w-2.5 h-2.5 rounded-full bg-primary opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                </div>
                                <span class="text-secondary font-bold group-hover:text-primary transition-colors">{{ $option->option_text }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach

                <div class="pt-10 flex justify-center">
                    <button type="submit" class="px-12 py-5 bg-primary text-white font-black rounded-full shadow-glow hover:bg-secondary hover:scale-[1.05] transition-all flex items-center gap-3">
                        SUBMIT ASSESSMENT
                        <i class="hgi-stroke hgi-sent"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-web-layout>
