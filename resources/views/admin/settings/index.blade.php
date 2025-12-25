<x-admin-layout>
    @section('header', 'General Settings')

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-5xl shadow-medium p-10">
            <h3 class="text-xl font-bold mb-8 text-primary">Website Configuration</h3>

            <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Site Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Site Name</label>
                        <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'Earn With Nazo') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Contact Email</label>
                        <input type="email" name="site_email" value="{{ old('site_email', $settings['site_email'] ?? 'info@earnwithnazo.com') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Contact Phone</label>
                         <input type="text" name="site_phone" value="{{ old('site_phone', $settings['site_phone'] ?? '') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" placeholder="+123...">
                    </div>
                </div>

                <hr class="border-soft-grey">

                <h3 class="text-xl font-bold mb-4 text-primary">Currency & Payment</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Currency Code (ISO)</label>
                        <input type="text" name="currency_code" value="{{ old('currency_code', $settings['currency_code'] ?? 'USD') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary uppercase" placeholder="USD, NGN, EUR">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-secondary mb-2 ml-4">Currency Symbol</label>
                        <input type="text" name="currency_symbol" value="{{ old('currency_symbol', $settings['currency_symbol'] ?? '$') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" placeholder="$, ₦, €">
                    </div>
                </div>

                <div class="mt-8 space-y-6">
                    <h4 class="text-lg font-bold text-primary">Bank Account Details (for Bank Transfer)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-secondary mb-2 ml-4">Bank Name</label>
                            <input type="text" name="bank_name" value="{{ old('bank_name', $settings['bank_name'] ?? '') }}" class="w-full h-12 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" placeholder="e.g., Access Bank">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-secondary mb-2 ml-4">Account Number</label>
                            <input type="text" name="account_number" value="{{ old('account_number', $settings['account_number'] ?? '') }}" class="w-full h-12 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" placeholder="0123456789">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-secondary mb-2 ml-4">Account Name</label>
                            <input type="text" name="account_name" value="{{ old('account_name', $settings['account_name'] ?? '') }}" class="w-full h-12 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" placeholder="Nazo E-Learning">
                        </div>
                    </div>
                </div>

                <!-- Address -->
                 <div>
                    <label class="block text-sm font-bold text-secondary mb-2 ml-4">Office Address</label>
                    <textarea name="site_address" rows="3" class="w-full p-6 rounded-4xl border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary resize-none">{{ old('site_address', $settings['site_address'] ?? '') }}</textarea>
                </div>

                <hr class="border-soft-grey">
                
                <h3 class="text-xl font-bold mb-4 text-primary">Social Media Links</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                         <label class="block text-sm font-bold text-secondary mb-2 ml-4">Facebook URL</label>
                        <input type="url" name="social_facebook" value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" placeholder="https://facebook.com/...">
                    </div>
                    <div>
                         <label class="block text-sm font-bold text-secondary mb-2 ml-4">Twitter URL</label>
                        <input type="url" name="social_twitter" value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" placeholder="https://twitter.com/...">
                    </div>
                    <div>
                         <label class="block text-sm font-bold text-secondary mb-2 ml-4">Instagram URL</label>
                        <input type="url" name="social_instagram" value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" placeholder="https://instagram.com/...">
                    </div>
                     <div>
                         <label class="block text-sm font-bold text-secondary mb-2 ml-4">YouTube URL</label>
                        <input type="url" name="social_youtube" value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}" class="w-full h-14 px-6 rounded-full border-2 border-border-grey focus:border-primary focus:ring-0 transition-colors bg-white text-primary" placeholder="https://youtube.com/...">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-8">
                     <button type="submit" class="px-10 py-4 bg-primary text-white font-bold rounded-full shadow-medium hover:shadow-floating hover:bg-secondary transition-all">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
