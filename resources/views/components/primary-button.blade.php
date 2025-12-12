<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center items-center px-8 py-3 bg-primary border border-transparent rounded-full font-bold text-sm text-surface tracking-wide hover:bg-secondary focus:bg-secondary active:bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition ease-in-out duration-150 shadow-medium hover:shadow-floating']) }}>
    {{ $slot }}
</button>
