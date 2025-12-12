<x-admin-layout>
    @section('header', 'CMS Pages')

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-xl font-bold text-primary">All Pages</h2>
        <a href="{{ route('admin.pages.create') }}" class="px-6 py-3 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
            + Add New Page
        </a>
    </div>

    <div class="bg-white rounded-5xl shadow-soft overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-soft-grey/30 border-b border-soft-grey">
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Title</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">URL Slug</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Status</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Last Updated</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-soft-grey/50">
                    @forelse ($pages as $page)
                    <tr class="hover:bg-soft-grey/10 transition-colors">
                        <td class="p-6">
                            <h4 class="font-bold text-primary">{{ $page->title }}</h4>
                        </td>
                        <td class="p-6">
                            <a href="{{ route('pages.show', $page->slug) }}" target="_blank" class="text-sm font-mono text-secondary hover:underline hover:text-primary">
                                /p/{{ $page->slug }} ↗
                            </a>
                        </td>
                        <td class="p-6">
                            @if($page->is_published)
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Published</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">Draft</span>
                            @endif
                        </td>
                        <td class="p-6">
                            <span class="text-sm font-bold text-secondary">{{ $page->updated_at->diffForHumans() }}</span>
                        </td>
                        <td class="p-6">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.pages.edit', $page) }}" class="text-sm font-bold text-secondary hover:text-primary">Edit</a>
                                <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" onsubmit="return confirm('Delete this page?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm font-bold text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center text-secondary">
                            No pages found. Use the button above to create one.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-6 border-t border-soft-grey">
            {{ $pages->links() }}
        </div>
    </div>
</x-admin-layout>
