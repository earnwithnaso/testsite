<x-admin-layout>
    @section('header', 'Edit User')

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-5xl shadow-medium p-10">
            <h3 class="text-xl font-bold mb-8 text-primary">Update User Details</h3>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                     <label class="block text-sm font-bold text-secondary mb-2 ml-4">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" required>
                    @error('name') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                     <label class="block text-sm font-bold text-secondary mb-2 ml-4">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" required>
                    @error('email') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                </div>

                <!-- Role -->
                <div>
                     <label class="block text-sm font-bold text-secondary mb-2 ml-4">Role</label>
                    <select name="role" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary appearance-none cursor-pointer">
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Student</option>
                        <option value="instructor" {{ $user->role === 'instructor' ? 'selected' : '' }}>Instructor</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                    @error('role') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div>
                     <label class="block text-sm font-bold text-secondary mb-2 ml-4">Account Status</label>
                    <select name="status" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary appearance-none cursor-pointer">
                        <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="banned" {{ $user->status === 'banned' ? 'selected' : '' }}>Banned</option>
                    </select>
                    @error('status') <p class="text-red-500 text-xs mt-2 ml-4">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end gap-4 pt-8">
                    <a href="{{ route('admin.users.index') }}" class="px-8 py-4 font-bold text-secondary hover:text-primary transition-colors">Cancel</a>
                    <button type="submit" class="px-10 py-4 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
