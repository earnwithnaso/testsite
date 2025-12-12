@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-soft-grey focus:border-primary focus:ring-primary rounded-full shadow-soft px-5 py-3 w-full']) }}>
