<x-admin-layout>
    @section('header', 'Edit Course')

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-5xl shadow-medium p-10">
            <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Title -->
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Course Title</label>
                        <input type="text" name="title" value="{{ old('title', $course->title) }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary placeholder-gray-400" required>
                        @error('title') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Price (₦)</label>
                        <input type="number" name="price" value="{{ old('price', $course->price) }}" step="0.01" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" required>
                         @error('price') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <!-- Level -->
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Difficulty Level</label>
                        <select name="difficulty_level" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary appearance-none cursor-pointer">
                            <option value="beginner" {{ $course->difficulty_level == 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="intermediate" {{ $course->difficulty_level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="advanced" {{ $course->difficulty_level == 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                         @error('difficulty_level') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <!-- Instructor -->
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Instructor</label>
                        <select name="instructor_id" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary appearance-none cursor-pointer" required>
                            @foreach($instructors as $instructor)
                                <option value="{{ $instructor->id }}" {{ $course->instructor_id == $instructor->id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                         @error('instructor_id') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Description</label>
                        <textarea name="description" rows="5" class="w-full p-6 rounded-4xl border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary resize-none" required>{{ old('description', $course->description) }}</textarea>
                         @error('description') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>

                     <!-- Thumbnail -->
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Course Thumbnail</label>
                        <div class="flex items-center gap-6">
                            @if($course->thumbnail_path)
                                <div class="w-32 h-20 rounded-2xl overflow-hidden flex-shrink-0 border border-soft-grey">
                                    <img src="{{ Storage::url($course->thumbnail_path) }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <div class="relative w-full h-20 rounded-4xl border-2 border-dashed border-border-grey flex items-center justify-center bg-soft-grey/10 hover:bg-soft-grey/20 transition-colors cursor-pointer group">
                                <input type="file" name="thumbnail" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                                <span class="text-sm font-bold text-secondary group-hover:text-primary">Change Image</span>
                            </div>
                        </div>
                    </div>

                    <!-- Publish Toggle -->
                    <div class="col-span-2 flex items-center gap-4 ml-4">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_published" value="1" class="sr-only peer" {{ $course->is_published ? 'checked' : '' }}>
                            <div class="relative w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all peer-checked:bg-primary"></div>
                            <span class="ms-3 text-sm font-bold text-secondary">Published</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-8 border-t border-soft-grey">
                    <a href="{{ route('admin.courses.index') }}" class="px-8 py-4 font-bold text-secondary hover:text-primary transition-colors">Cancel</a>
                    <button type="submit" class="px-10 py-4 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
                        Update Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
