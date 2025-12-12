<x-admin-layout>
    @section('header', 'Category Management')

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-xl font-bold text-primary">All Categories</h2>
        <a href="{{ route('admin.categories.create') }}" class="px-6 py-3 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
            + Add Category
        </a>
    </div>

    <div class="bg-white rounded-5xl shadow-soft overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-soft-grey/30 border-b border-soft-grey">
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Name</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Slug</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Courses Count</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-soft-grey/50">
                    @forelse ($categories as $category)
                    <tr class="hover:bg-soft-grey/10 transition-colors">
                        <td class="p-6">
                            <h4 class="font-bold text-primary">{{ $category->name }}</h4>
                        </td>
                        <td class="p-6">
                            <span class="text-sm font-mono text-secondary bg-soft-grey/30 px-2 py-1 rounded">{{ $category->slug }}</span>
                        </td>
                        <td class="p-6">
                            <span class="text-sm font-bold text-primary">{{ $category->courses_count }}</span>
                        </td>
                        <td class="p-6">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-sm font-bold text-secondary hover:text-primary">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm font-bold text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-12 text-center text-secondary">
                            No categories found. Use the button above to add one.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-6 border-t border-soft-grey">
            {{ $categories->links() }}
        </div>
    </div>
</x-admin-layout>
