<x-admin-layout>
    @section('header', 'Create Quiz')

    <div class="mb-8">
        <a href="{{ route('admin.courses.quizzes.index', $course) }}" class="text-sm font-bold text-secondary hover:text-primary flex items-center gap-2 mb-4">
            <i class="hgi-stroke hgi-arrow-left-01"></i> Back to Quizzes
        </a>
        <h2 class="text-2xl font-black text-primary tracking-tight">Create New Quiz</h2>
        <p class="text-secondary font-medium uppercase text-[10px] tracking-widest">For Course: {{ $course->title }}</p>
    </div>

    <div class="bg-white rounded-5xl shadow-soft p-10 max-w-2xl">
        <form action="{{ route('admin.courses.quizzes.store', $course) }}" method="POST" class="space-y-8">
            @csrf
            
            <div class="space-y-2">
                <label class="block text-sm font-black text-primary uppercase tracking-widest">Quiz Title</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Final Assessment" class="w-full px-6 py-4 rounded-2xl bg-soft-grey/30 border-2 border-transparent focus:border-primary focus:bg-white outline-none transition-all font-bold text-primary" required>
                @error('title') <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-sm font-black text-primary uppercase tracking-widest">Associated Lesson (Optional)</label>
                    <select name="lesson_id" class="w-full px-6 py-4 rounded-2xl bg-soft-grey/30 border-2 border-transparent focus:border-primary focus:bg-white outline-none transition-all font-bold text-primary">
                        <option value="">Course Level (No specific lesson)</option>
                        @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-black text-primary uppercase tracking-widest">Passing Percentage (%)</label>
                    <input type="number" name="passing_percentage" value="{{ old('passing_percentage', 70) }}" min="0" max="100" class="w-full px-6 py-4 rounded-2xl bg-soft-grey/30 border-2 border-transparent focus:border-primary focus:bg-white outline-none transition-all font-bold text-primary" required>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-black text-primary uppercase tracking-widest">Time Limit (Minutes - Optional)</label>
                <input type="number" name="time_limit" value="{{ old('time_limit') }}" placeholder="Leave empty for no limit" class="w-full px-6 py-4 rounded-2xl bg-soft-grey/30 border-2 border-transparent focus:border-primary focus:bg-white outline-none transition-all font-bold text-primary">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-black text-primary uppercase tracking-widest">Description</label>
                <textarea name="description" rows="4" class="w-full px-6 py-4 rounded-2xl bg-soft-grey/30 border-2 border-transparent focus:border-primary focus:bg-white outline-none transition-all font-bold text-primary">{{ old('description') }}</textarea>
            </div>

            <div class="pt-6 border-t border-soft-grey">
                <button type="submit" class="px-10 py-4 bg-primary text-white font-black rounded-full shadow-glow hover:bg-secondary hover:scale-[1.02] transition-all">
                    CREATE QUIZ
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
