<x-admin-layout>
    @section('header', 'Quiz Management')

    <div class="mb-8">
        <a href="{{ route('admin.courses.index') }}" class="text-sm font-bold text-secondary hover:text-primary flex items-center gap-2 mb-4">
            <i class="hgi-stroke hgi-arrow-left-01"></i> Back to Courses
        </a>
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-black text-primary tracking-tight">{{ $course->title }}</h2>
                <p class="text-secondary font-medium uppercase text-[10px] tracking-widest">Manage Evaluations & Quizzes</p>
            </div>
            <a href="{{ route('admin.courses.quizzes.create', $course) }}" class="px-6 py-3 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
                + Create New Quiz
            </a>
        </div>
    </div>

    <div class="bg-white rounded-5xl shadow-soft overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-soft-grey/30 border-b border-soft-grey">
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Quiz Title</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Associated Lesson</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Questions</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Passing %</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-soft-grey/50">
                    @forelse ($quizzes as $quiz)
                    <tr class="hover:bg-soft-grey/10 transition-colors">
                        <td class="p-6">
                            <h4 class="font-bold text-primary">{{ $quiz->title }}</h4>
                        </td>
                        <td class="p-6">
                            @if($quiz->lesson)
                                <span class="text-sm font-bold text-secondary">{{ $quiz->lesson->title }}</span>
                            @else
                                <span class="text-xs font-bold text-secondary/40">General Course Quiz</span>
                            @endif
                        </td>
                        <td class="p-6">
                            <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-xs font-bold">{{ $quiz->questions_count }} Questions</span>
                        </td>
                        <td class="p-6">
                            <span class="text-sm font-bold text-primary">{{ $quiz->passing_percentage }}%</span>
                        </td>
                        <td class="p-6">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.quizzes.questions.index', $quiz) }}" class="text-sm font-bold text-primary hover:underline">Manage Questions</a>
                                <div class="w-px h-4 bg-soft-grey"></div>
                                <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="text-sm font-bold text-secondary hover:text-primary">Edit</a>
                                <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm font-bold text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center">
                            <p class="text-secondary font-bold">No quizzes found for this course.</p>
                            <p class="text-sm text-secondary/60 mt-2">Get started by creating your first evaluation.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
