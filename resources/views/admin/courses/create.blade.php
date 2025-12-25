<x-admin-layout>
    @section('header', 'Create Course')

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-5xl shadow-medium p-6 md:p-10">
            <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                    <!-- Title -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Course Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary placeholder-gray-400" placeholder="e.g. Master Laravel 11" required>
                        @error('title') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <!-- Short Description -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Short Description (for cards)</label>
                        <input type="text" name="short_description" value="{{ old('short_description') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary placeholder-gray-400" placeholder="Brief summary of the course">
                        @error('short_description') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>

                     <!-- Price -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-secondary mb-2 ml-4">Price (₦)</label>
                            <input type="number" name="price" value="{{ old('price', 0) }}" step="0.01" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" required>
                             @error('price') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-secondary mb-2 ml-4">Stripe Price ID</label>
                            <input type="text" name="stripe_price_id" value="{{ old('stripe_price_id') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary placeholder-gray-400" placeholder="price_...">
                            @error('stripe_price_id') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Level -->
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Difficulty Level</label>
                        <select name="difficulty_level" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary appearance-none cursor-pointer">
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                        </select>
                         @error('difficulty_level') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Duration (Hours)</label>
                        <input type="number" name="duration_hours" value="{{ old('duration_hours') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" placeholder="e.g. 10">
                        @error('duration_hours') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Category</label>
                        <select name="category_id" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary appearance-none cursor-pointer">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Instructor -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Instructor</label>
                        <select name="instructor_id" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary appearance-none cursor-pointer" required>
                            <option value="">Select Instructor</option>
                            @foreach($instructors as $instructor)
                                <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                         @error('instructor_id') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <!-- Preview Video -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Preview Video URL (YouTube/Vimeo)</label>
                        <input type="url" name="preview_video_url" value="{{ old('preview_video_url') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary placeholder-gray-400" placeholder="https://youtube.com/watch?v=...">
                        @error('preview_video_url') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Description</label>
                        <textarea name="description" rows="5" class="w-full p-6 rounded-4xl border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary resize-none" placeholder="Course details..." required>{{ old('description') }}</textarea>
                         @error('description') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <!-- Goals -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Course Goals (one per line)</label>
                        <textarea name="goals" rows="4" class="w-full p-6 rounded-4xl border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary resize-none" placeholder="What will students learn?">{{ old('goals') }}</textarea>
                         @error('goals') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                    </div>

                    <!-- SEO -->
                    <div class="col-span-1 md:col-span-2 pt-4">
                        <h3 class="font-black text-lg mb-4 ml-4">SEO Settings</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-secondary mb-1 ml-4 uppercase">Meta Title</label>
                                <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="w-full h-12 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-secondary mb-1 ml-4 uppercase">Meta Description</label>
                                <input type="text" name="meta_description" value="{{ old('meta_description') }}" class="w-full h-12 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-secondary mb-1 ml-4 uppercase">Meta Keywords</label>
                                <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}" class="w-full h-12 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary text-sm">
                            </div>
                        </div>
                    </div>

                     <!-- Thumbnail -->
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Course Thumbnail</label>
                        <div class="relative w-full h-32 rounded-4xl border-2 border-dashed border-border-grey flex items-center justify-center bg-soft-grey/10 hover:bg-soft-grey/20 transition-colors cursor-pointer group">
                            <input type="file" name="thumbnail" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                            <div class="text-center">
                                <span class="block text-2xl mb-1">🖼️</span>
                                <span class="text-sm font-bold text-secondary group-hover:text-primary">Click to upload image</span>
                            </div>
                        </div>
                    </div>

                    <!-- Course PDF Asset -->
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Course PDF (Syllabus/Info)</label>
                        <div class="relative w-full h-32 rounded-4xl border-2 border-dashed border-border-grey flex items-center justify-center bg-soft-grey/10 hover:bg-soft-grey/20 transition-colors cursor-pointer group">
                            <input type="file" name="pdf_file" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10" accept=".pdf">
                            <div class="text-center">
                                <span class="block text-2xl mb-1">📄</span>
                                <span class="text-sm font-bold text-secondary group-hover:text-primary">Click to upload PDF</span>
                            </div>
                        </div>
                    </div>

                    <!-- Course Video Asset -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Intro Video Asset (Optional)</label>
                        <div class="relative w-full h-32 rounded-4xl border-2 border-dashed border-border-grey flex items-center justify-center bg-soft-grey/10 hover:bg-soft-grey/20 transition-colors cursor-pointer group">
                            <input type="file" name="video_file" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10" accept="video/*">
                            <div class="text-center">
                                <span class="block text-2xl mb-1">🎬</span>
                                <span class="text-sm font-bold text-secondary group-hover:text-primary">Click to upload Video</span>
                            </div>
                        </div>
                    </div>

                    <!-- Toggles -->
                    <div class="col-span-1 md:col-span-2 flex flex-wrap gap-8 ml-4">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_published" value="1" class="sr-only peer">
                            <div class="relative w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all peer-checked:bg-primary"></div>
                            <span class="ms-3 text-sm font-bold text-secondary">Publish immediately</span>
                        </label>

                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" class="sr-only peer">
                            <div class="relative w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all peer-checked:bg-primary"></div>
                            <span class="ms-3 text-sm font-bold text-secondary">Feature on Home</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-8 border-t border-soft-grey">
                    <a href="{{ route('admin.courses.index') }}" class="px-8 py-4 font-bold text-secondary hover:text-primary transition-colors">Cancel</a>
                    <button type="submit" class="px-10 py-4 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all transform hover:-translate-y-1">
                        Create Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
