<x-admin-layout>
    @section('header', 'Add Lesson')

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-5xl shadow-medium p-10">
            <h3 class="text-xl font-bold mb-8 text-primary">New Lesson for: {{ $course->title }}</h3>

            <form action="{{ route('admin.courses.lessons.store', $course) }}" method="POST" class="space-y-6">
                @csrf

                <!-- Title -->
                <div>
                     <label class="block text-sm font-bold text-secondary mb-2 ml-4">Lesson Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary placeholder-gray-400" placeholder="e.g. Introduction to MVC" required>
                    @error('title') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                </div>

                <!-- Video URL -->
                <div>
                     <label class="block text-sm font-bold text-secondary mb-2 ml-4">Video URL (Vimeo/YouTube/S3)</label>
                    <input type="url" name="video_url" value="{{ old('video_url') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" placeholder="https://...">
                    @error('video_url') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <!-- Duration -->
                    <div>
                         <label class="block text-sm font-bold text-secondary mb-2 ml-4">Duration (Seconds)</label>
                        <input type="number" name="video_duration" value="{{ old('video_duration', 0) }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary">
                        @error('video_duration') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <!-- Position -->
                     <div>
                         <label class="block text-sm font-bold text-secondary mb-2 ml-4">Sort Order</label>
                        <input type="number" name="position" value="{{ old('position') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" placeholder="Auto">
                        @error('position') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-bold text-secondary mb-2 ml-4">Lesson Content / Notes</label>
                    <textarea name="description" rows="4" class="w-full p-6 rounded-4xl border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary resize-none" placeholder="Lesson details...">{{ old('description') }}</textarea>
                     @error('description') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                </div>

                <!-- Toggles -->
                <div class="flex gap-8 ml-4">
                     <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" class="sr-only peer" checked>
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        <span class="ms-3 text-sm font-bold text-secondary">Publish</span>
                    </label>

                     <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_free" value="1" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                        <span class="ms-3 text-sm font-bold text-secondary">Free Preview</span>
                    </label>
                </div>

                <div class="flex items-center justify-end gap-4 pt-8">
                    <a href="{{ route('admin.courses.lessons.index', $course) }}" class="px-8 py-4 font-bold text-secondary hover:text-primary transition-colors">Cancel</a>
                    <button type="submit" class="px-10 py-4 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
                        Create Lesson
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
