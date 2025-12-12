<x-admin-layout>
    @section('header', 'About Page Content')

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-5xl shadow-medium p-10">
            <h3 class="text-xl font-bold mb-8 text-primary">About Us Configuration</h3>

            <form action="{{ route('admin.settings.about.update') }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                     <label class="block text-sm font-bold text-secondary mb-2 ml-4">Page Title</label>
                    <input type="text" name="about_title" value="{{ old('about_title', $aboutSettings['about_title'] ?? 'About Us') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary">
                </div>

                <!-- Main Content -->
                <div>
                    <label class="block text-sm font-bold text-secondary mb-2 ml-4">Main Story / Introduction</label>
                    <textarea name="about_content" rows="6" class="w-full p-6 rounded-4xl border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary resize-none placeholder-gray-400" placeholder="Tell your story...">{{ old('about_content', $aboutSettings['about_content'] ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Mission -->
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Our Mission</label>
                        <textarea name="about_mission" rows="4" class="w-full p-6 rounded-4xl border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary resize-none" placeholder="We aim to...">{{ old('about_mission', $aboutSettings['about_mission'] ?? '') }}</textarea>
                    </div>

                    <!-- Vision -->
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Our Vision</label>
                        <textarea name="about_vision" rows="4" class="w-full p-6 rounded-4xl border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary resize-none" placeholder="A world where...">{{ old('about_vision', $aboutSettings['about_vision'] ?? '') }}</textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-8 border-t border-soft-grey">
                     <button type="submit" class="px-10 py-4 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
                        Update About Page
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
