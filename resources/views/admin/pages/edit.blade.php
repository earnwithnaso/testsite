<x-admin-layout>
    @section('header', 'Edit Page')

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-5xl shadow-medium p-10">
            <h3 class="text-xl font-bold mb-8 text-primary">Update Page: {{ $page->title }}</h3>

            <form action="{{ route('admin.pages.update', $page) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <div>
                     <label class="block text-sm font-bold text-secondary mb-2 ml-4">Page Title</label>
                    <input type="text" name="title" value="{{ old('title', $page->title) }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" required>
                    @error('title') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-secondary mb-2 ml-4">Content (HTML allowed)</label>
                    <textarea name="content" rows="15" class="w-full p-6 rounded-4xl border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary resize-none font-mono text-sm">{{ old('content', $page->content) }}</textarea>
                     @error('content') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Meta Title (SEO)</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Meta Description (SEO)</label>
                        <textarea name="meta_description" rows="2" class="w-full p-4 rounded-4xl border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary resize-none">{{ old('meta_description', $page->meta_description) }}</textarea>
                    </div>
                </div>

                <div class="flex items-center gap-4 ml-4">
                     <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" class="sr-only peer" {{ $page->is_published ? 'checked' : '' }}>
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        <span class="ms-3 text-sm font-bold text-secondary">Published</span>
                    </label>
                </div>

                <div class="flex items-center justify-end gap-4 pt-8 border-t border-soft-grey">
                    <a href="{{ route('admin.pages.index') }}" class="px-8 py-4 font-bold text-secondary hover:text-primary transition-colors">Cancel</a>
                    <button type="submit" class="px-10 py-4 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
                        Update Page
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
