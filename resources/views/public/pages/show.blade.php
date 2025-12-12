<x-web-layout>
    <div class="px-4 max-w-4xl mx-auto py-12">
        <div class="bg-white rounded-5xl shadow-floating p-8 md:p-12 mb-12">
            <h1 class="text-3xl md:text-5xl font-black mb-8 text-primary">{{ $page->title }}</h1>
            
            <div class="prose prose-lg text-secondary prose-headings:font-bold prose-headings:text-primary max-w-none">
                {!! nl2br(e($page->content)) !!}
            </div>
        </div>
    </div>
</x-web-layout>
