<x-admin-layout>
    @section('header', 'Edit Question')

    <div class="mb-8">
        <a href="{{ route('admin.quizzes.questions.index', $quiz) }}" class="text-sm font-bold text-secondary hover:text-primary flex items-center gap-2 mb-4">
            <i class="hgi-stroke hgi-arrow-left-01"></i> Back to Questions
        </a>
        <h2 class="text-2xl font-black text-primary tracking-tight">Edit Question</h2>
        <p class="text-secondary font-medium uppercase text-[10px] tracking-widest">Quiz: {{ $quiz->title }}</p>
    </div>

    <div class="bg-white rounded-5xl shadow-soft p-10 max-w-3xl" x-data="{ 
        type: '{{ $question->question_type }}',
        options: [
            @foreach($question->options as $option)
                { text: '{{ $option->option_text }}' },
            @endforeach
        ],
        correctOption: {{ $question->options->search(fn($o) => $o->is_correct) }},
        addOption() {
            if (this.options.length < 6) {
                this.options.push({ text: '' });
            }
        },
        removeOption(index) {
            if (this.options.length > 2) {
                this.options.splice(index, 1);
                if (this.correctOption >= this.options.length) {
                    this.correctOption = this.options.length - 1;
                }
            }
        }
    }">
        <form action="{{ route('admin.questions.update', $question) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')
            
            <div class="space-y-2">
                <label class="block text-sm font-black text-primary uppercase tracking-widest">Question Text</label>
                <textarea name="question_text" rows="3" class="w-full px-6 py-4 rounded-2xl bg-soft-grey/30 border-2 border-transparent focus:border-primary focus:bg-white outline-none transition-all font-bold text-primary" required>{{ old('question_text', $question->question_text) }}</textarea>
                @error('question_text') <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-sm font-black text-primary uppercase tracking-widest">Question Type</label>
                    <select name="question_type" x-model="type" class="w-full px-6 py-4 rounded-2xl bg-soft-grey/30 border-2 border-transparent focus:border-primary focus:bg-white outline-none transition-all font-bold text-primary">
                        <option value="multiple_choice">Multiple Choice</option>
                        <option value="true_false">True / False</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-black text-primary uppercase tracking-widest">Points</label>
                    <input type="number" name="points" value="{{ old('points', $question->points) }}" min="1" class="w-full px-6 py-4 rounded-2xl bg-soft-grey/30 border-2 border-transparent focus:border-primary focus:bg-white outline-none transition-all font-bold text-primary" required>
                </div>
            </div>

            <div class="space-y-6">
                <div class="flex justify-between items-center">
                    <label class="block text-sm font-black text-primary uppercase tracking-widest">Options & Correct Answer</label>
                    <button type="button" @click="addOption()" x-show="type === 'multiple_choice' && options.length < 6" class="text-xs font-black text-primary hover:underline">+ Add Option</button>
                </div>

                <div class="space-y-4">
                    <template x-for="(option, index) in options" :key="index">
                        <div class="flex items-center gap-4">
                            <label class="cursor-pointer">
                                <input type="radio" name="correct_option" :value="index" x-model="correctOption" class="hidden peer">
                                <div class="w-10 h-10 rounded-2xl border-2 border-soft-grey peer-checked:border-green-500 peer-checked:bg-green-500 flex items-center justify-center text-white transition-all">
                                    <i class="hgi-stroke hgi-checkmark-circle-01 text-sm" x-show="correctOption == index"></i>
                                    <span class="text-xs font-black text-secondary/40" x-show="correctOption != index" x-text="String.fromCharCode(65 + index)"></span>
                                </div>
                            </label>
                            
                            <input type="text" :name="'options['+index+'][text]'" x-model="option.text" placeholder="Enter option text..." class="flex-1 px-6 py-4 rounded-2xl bg-soft-grey/30 border-2 border-transparent focus:border-primary focus:bg-white outline-none transition-all font-bold text-primary" required>
                            
                            <button type="button" @click="removeOption(index)" x-show="type === 'multiple_choice' && options.length > 2" class="p-4 rounded-2xl text-secondary hover:text-red-500 hover:bg-red-50 transition-all">
                                <i class="hgi-stroke hgi-delete-02"></i>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <div class="pt-6 border-t border-soft-grey">
                <button type="submit" class="px-10 py-4 bg-primary text-white font-black rounded-full shadow-glow hover:bg-secondary hover:scale-[1.02] transition-all">
                    UPDATE QUESTION
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
