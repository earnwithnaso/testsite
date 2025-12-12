<x-admin-layout>
    @section('header', 'SEO Configuration')

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-5xl shadow-medium p-10">
            <h3 class="text-xl font-bold mb-8 text-primary">Search Engine Optimization</h3>

            <form action="{{ route('admin.settings.seo.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Meta Title -->
                <div>
                     <label class="block text-sm font-bold text-secondary mb-2 ml-4">Default Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $seoSettings->meta_title ?? '') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" placeholder="Site Name - Slogan">
                    @error('meta_title') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                </div>

                <!-- Meta Description -->
                <div>
                    <label class="block text-sm font-bold text-secondary mb-2 ml-4">Default Meta Description</label>
                    <textarea name="meta_description" rows="3" class="w-full p-6 rounded-4xl border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary resize-none" placeholder="Brief summary of your site...">{{ old('meta_description', $seoSettings->meta_description ?? '') }}</textarea>
                     @error('meta_description') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                </div>

                <!-- Keywords -->
                 <div>
                    <label class="block text-sm font-bold text-secondary mb-2 ml-4">Meta Keywords (Comma separated)</label>
                    <textarea name="meta_keywords" rows="2" class="w-full p-6 rounded-4xl border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary resize-none" placeholder="courses, learning, skills...">{{ old('meta_keywords', $seoSettings->meta_keywords ?? '') }}</textarea>
                </div>

                 <!-- OG Image -->
                <div>
                    <label class="block text-sm font-bold text-secondary mb-2 ml-4">Social Share Image (OG Image)</label>
                    <div class="flex items-center gap-6">
                        @if($seoSettings->og_image ?? false)
                            <div class="w-32 h-20 rounded-2xl overflow-hidden flex-shrink-0 border border-soft-grey">
                                <img src="{{ Storage::url($seoSettings->og_image) }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="relative w-full h-20 rounded-4xl border-2 border-dashed border-border-grey flex items-center justify-center bg-soft-grey/10 hover:bg-soft-grey/20 transition-colors cursor-pointer group">
                            <input type="file" name="og_image" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                            <span class="text-sm font-bold text-secondary group-hover:text-primary">Upload Standard Share Image</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-8 border-t border-soft-grey">
                     <button type="submit" class="px-10 py-4 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
                        Save SEO Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
