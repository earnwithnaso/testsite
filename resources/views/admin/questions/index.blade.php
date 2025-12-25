<x-admin-layout>
    @section('header', 'Question Management')

    <div class="mb-8">
        <a href="{{ route('admin.courses.quizzes.index', $quiz->course_id) }}" class="text-sm font-bold text-secondary hover:text-primary flex items-center gap-2 mb-4">
            <i class="hgi-stroke hgi-arrow-left-01"></i> Back to Quizzes
        </a>
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-black text-primary tracking-tight">Questions for: {{ $quiz->title }}</h2>
                <p class="text-secondary font-medium uppercase text-[10px] tracking-widest">Build your assessment step by step</p>
            </div>
            <a href="{{ route('admin.quizzes.questions.create', $quiz) }}" class="px-6 py-3 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
                + Add New Question
            </a>
        </div>
    </div>

    <div class="space-y-6">
        @forelse ($questions as $index => $question)
        <div class="bg-white rounded-5xl shadow-soft p-8 border border-transparent hover:border-primary/20 transition-all group">
            <div class="flex justify-between items-start mb-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-soft-grey rounded-2xl flex items-center justify-center text-primary font-black shrink-0">
                        {{ $index + 1 }}
                    </div>
                    <div>
                        <h3 class="font-bold text-primary text-lg leading-tight">{{ $question->question_text }}</h3>
                        <div class="flex gap-4 mt-2">
                             <span class="text-[10px] font-black uppercase text-secondary/40 tracking-widest">{{ $question->question_type }}</span>
                             <span class="text-[10px] font-black uppercase text-primary tracking-widest">{{ $question->points }} Points</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <a href="{{ route('admin.questions.edit', $question) }}" class="p-3 bg-soft-grey/50 rounded-2xl text-secondary hover:text-primary hover:bg-primary/10 transition-all">
                        <i class="hgi-stroke hgi-pencil-edit-01"></i>
                    </a>
                    <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" onsubmit="return confirm('Delete this question?')">
                        @csrf
                        @method('DELETE')
                        <button class="p-3 bg-soft-grey/50 rounded-2xl text-red-500 hover:text-white hover:bg-red-500 transition-all">
                            <i class="hgi-stroke hgi-delete-02"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($question->options as $option)
                <div class="p-4 rounded-3xl border-2 {{ $option->is_correct ? 'border-green-500 bg-green-50' : 'border-soft-grey bg-white' }} flex items-center gap-4">
                    <div class="w-6 h-6 rounded-full border-2 {{ $option->is_correct ? 'border-green-500 bg-green-500' : 'border-soft-grey' }} flex items-center justify-center text-white">
                        @if($option->is_correct) <i class="hgi-stroke hgi-checkmark-circle-01 text-xs"></i> @endif
                    </div>
                    <span class="text-sm font-bold {{ $option->is_correct ? 'text-green-700' : 'text-secondary' }}">{{ $option->option_text }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div class="bg-white rounded-5xl shadow-soft p-12 text-center">
            <p class="text-secondary font-bold">No questions added yet.</p>
            <p class="text-sm text-secondary/60 mt-2">Create multiple-choice or true/false questions for this quiz.</p>
        </div>
        @endforelse
    </div>
</x-admin-layout>
