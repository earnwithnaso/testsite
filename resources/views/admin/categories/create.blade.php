<x-admin-layout>
    @section('header', 'Add Category')

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-5xl shadow-medium p-10">
            <h3 class="text-xl font-bold mb-8 text-primary">New Category Details</h3>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                     <label class="block text-sm font-bold text-secondary mb-2 ml-4">Category Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary placeholder-gray-400" placeholder="e.g. Design" required>
                    @error('name') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-bold text-secondary mb-2 ml-4">Description (Optional)</label>
                    <textarea name="description" rows="4" class="w-full p-6 rounded-4xl border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary resize-none" placeholder="Category details...">{{ old('description') }}</textarea>
                     @error('description') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end gap-4 pt-8">
                    <a href="{{ route('admin.categories.index') }}" class="px-8 py-4 font-bold text-secondary hover:text-primary transition-colors">Cancel</a>
                    <button type="submit" class="px-10 py-4 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
                        Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
