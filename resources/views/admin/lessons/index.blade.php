<x-admin-layout>
    @section('header', 'Manage Lessons')

    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-xl font-bold text-primary">Lessons for: {{ $course->title }}</h2>
            <a href="{{ route('admin.courses.index') }}" class="text-sm text-secondary hover:text-primary">&larr; Back to Courses</a>
        </div>
        <a href="{{ route('admin.courses.lessons.create', $course) }}" class="px-6 py-3 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
            + Add New Lesson
        </a>
    </div>

    <div class="bg-white rounded-5xl shadow-soft overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-soft-grey/30 border-b border-soft-grey">
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Order</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Lesson Title</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Duration</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Status</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Preview</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-soft-grey/50">
                    @forelse ($lessons as $lesson)
                    <tr class="hover:bg-soft-grey/10 transition-colors">
                        <td class="p-6">
                            <span class="w-8 h-8 rounded-full bg-soft-grey flex items-center justify-center font-bold text-xs text-secondary">{{ $lesson->position }}</span>
                        </td>
                        <td class="p-6">
                            <h4 class="font-bold text-primary">{{ $lesson->title }}</h4>
                            @if($lesson->is_free)
                                <span class="text-xs text-green-600 font-bold bg-green-100 px-2 py-0.5 rounded-full">Free Preview</span>
                            @endif
                        </td>
                         <td class="p-6">
                            <span class="text-sm font-bold text-secondary">{{ gmdate("i:s", $lesson->video_duration) }}</span>
                        </td>
                        <td class="p-6">
                            @if($lesson->is_published)
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Published</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">Draft</span>
                            @endif
                        </td>
                        <td class="p-6">
                            @if($lesson->video_url)
                                <span class="text-xs bg-soft-grey/30 px-2 py-1 rounded text-secondary truncate max-w-[100px] inline-block">Video Link</span>
                            @else
                                <span class="text-xs text-secondary/50">No Video</span>
                            @endif
                        </td>
                        <td class="p-6">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.lessons.edit', $lesson) }}" class="text-sm font-bold text-secondary hover:text-primary">Edit</a>
                                <form action="{{ route('admin.lessons.destroy', $lesson) }}" method="POST" onsubmit="return confirm('Delete this lesson?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm font-bold text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-12 text-center">
                            <p class="text-secondary font-bold">No lessons added yet.</p>
                            <p class="text-sm text-secondary/60 mt-2">Start building your curriculum.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
