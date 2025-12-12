<x-admin-layout>
    @section('header', 'Course Management')

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-xl font-bold text-primary">All Courses</h2>
        <a href="{{ route('admin.courses.create') }}" class="px-6 py-3 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
            + Create New Course
        </a>
    </div>

    <div class="bg-white rounded-5xl shadow-soft overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-soft-grey/30 border-b border-soft-grey">
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Course Info</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Instructor</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Price</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Status</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-soft-grey/50">
                    @forelse ($courses as $course)
                    <tr class="hover:bg-soft-grey/10 transition-colors">
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-12 bg-soft-grey rounded-2xl overflow-hidden flex-shrink-0">
                                    @if($course->thumbnail_path)
                                        <img src="{{ Storage::url($course->thumbnail_path) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-xs text-secondary/50 font-bold">IMG</div>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-bold text-primary">{{ $course->title }}</h4>
                                    <p class="text-xs text-secondary">{{ $course->lessons_count ?? 0 }} Lessons</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-6">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-soft-grey rounded-full"></div>
                                <span class="text-sm font-bold text-secondary">{{ $course->instructor->name ?? 'Unknown' }}</span>
                            </div>
                        </td>
                        <td class="p-6">
                            <span class="text-sm font-bold text-primary">₦{{ number_format($course->price, 2) }}</span>
                        </td>
                        <td class="p-6">
                            @if($course->is_published)
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Published</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">Draft</span>
                            @endif
                        </td>
                        <td class="p-6">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.courses.lessons.index', $course) }}" class="text-sm font-bold text-primary hover:underline">Manage Lessons</a>
                                <div class="w-px h-4 bg-soft-grey"></div>
                                <a href="{{ route('admin.courses.edit', $course) }}" class="text-sm font-bold text-secondary hover:text-primary">Edit</a>
                                <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                            <p class="text-secondary font-bold">No courses found.</p>
                            <p class="text-sm text-secondary/60 mt-2">Get started by creating a new course.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-6 border-t border-soft-grey">
            {{ $courses->links() }}
        </div>
    </div>
</x-admin-layout>
