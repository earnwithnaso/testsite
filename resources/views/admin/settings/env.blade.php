<x-admin-layout>
    @section('header', 'Environment Config')

    <div class="max-w-4xl mx-auto">
        <div class="bg-red-50 border border-red-100 rounded-4xl p-6 mb-8 flex items-start gap-4">
            <span class="text-2xl">⚠️</span>
            <div>
                <h4 class="font-bold text-red-800">Sensitive Information</h4>
                <p class="text-sm text-red-600 mt-1">These settings are read directly from your <code>.env</code> file. To change them, you must edit the file on the server manually. This is a security measure.</p>
            </div>
        </div>

        <div class="bg-white rounded-5xl shadow-medium p-10">
            <h3 class="text-xl font-bold mb-8 text-primary">System Variables</h3>

            <div class="space-y-6">
                @foreach($envData as $key => $value)
                <div class="flex items-center justify-between p-4 bg-soft-grey/10 rounded-3xl border border-soft-grey">
                    <div>
                        <p class="text-xs font-bold text-secondary uppercase tracking-wider">{{ $key }}</p>
                        <p class="font-mono text-primary mt-1">{{ $value ?? 'Not Set' }}</p>
                    </div>
                    <div class="w-2 h-2 rounded-full {{ $value ? 'bg-green-500' : 'bg-red-500' }}"></div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-8 pt-8 border-t border-soft-grey text-right">
                <p class="text-xs text-secondary">Last checked: {{ now()->format('H:i:s') }}</p>
            </div>
        </div>
    </div>
</x-admin-layout>
