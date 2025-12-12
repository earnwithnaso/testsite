<x-admin-layout>
    @section('header', 'User Management')

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-xl font-bold text-primary">All Users</h2>
    </div>

    <div class="bg-white rounded-5xl shadow-soft overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-soft-grey/30 border-b border-soft-grey">
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">User Info</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Role</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Status</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Joined</th>
                        <th class="p-6 text-xs font-bold text-secondary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-soft-grey/50">
                    @forelse ($users as $user)
                    <tr class="hover:bg-soft-grey/10 transition-colors">
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-soft-grey flex items-center justify-center font-bold text-black/40 text-xs">
                                    {{ substr($user->name, 0, 2) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-primary">{{ $user->name }}</h4>
                                    <p class="text-xs text-secondary">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-6">
                            @if($user->role === 'admin')
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-bold uppercase">Admin</span>
                            @elseif($user->role === 'instructor')
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold uppercase">Instructor</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold uppercase">Student</span>
                            @endif
                        </td>
                        <td class="p-6">
                            @if($user->status === 'active')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Active</span>
                            @elseif($user->status === 'banned')
                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">Banned</span>
                            @else
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">Inactive</span>
                            @endif
                        </td>
                        <td class="p-6">
                            <span class="text-sm font-bold text-secondary">{{ $user->created_at->format('M d, Y') }}</span>
                        </td>
                        <td class="p-6">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-sm font-bold text-secondary hover:text-primary">Edit</a>
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user? This cannot be undone!')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-sm font-bold text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center text-secondary">
                            No users found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-6 border-t border-soft-grey">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>
