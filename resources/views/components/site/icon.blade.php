@props(['name'])

<svg {{ $attributes->class(['icon']) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    @switch($name)
        @case('instagram')
            <rect x="3" y="3" width="18" height="18" rx="5" />
            <circle cx="12" cy="12" r="4" />
            <path d="M17.5 6.5h.01" />
            @break

        @case('whatsapp')
            <path d="M20.5 11.6a8.5 8.5 0 0 1-12.6 7.5L3 20.5l1.4-4.7A8.5 8.5 0 1 1 20.5 11.6Z" />
            <path d="M8.4 7.8c.2-.4.4-.4.7-.4h.5c.2 0 .4.1.5.5l.8 2c.1.3.1.5-.1.7l-.7.8c-.2.2-.1.4 0 .6.7 1.3 1.8 2.3 3.2 2.9.2.1.4.1.6-.1l.9-1.1c.2-.2.4-.3.7-.2l2 .9c.3.1.5.3.5.5 0 .3-.1 1.5-.8 2.1-.6.6-1.5.8-2.4.6-1.2-.3-2.8-.9-4.8-2.6-1.6-1.4-2.7-3.2-3-4.4-.3-1.1 0-2.1.4-2.8Z" />
            @break

        @case('arrow-up-right')
            <path d="M7 17 17 7" />
            <path d="M7 7h10v10" />
            @break

        @case('arrow-right')
            <path d="M5 12h14" />
            <path d="m14 7 5 5-5 5" />
            @break

        @case('arrow-down-right')
            <path d="M7 7h10v10" />
            <path d="m7 17 10-10" />
            @break

        @case('arrow-up')
            <path d="m7 11 5-5 5 5" />
            <path d="M12 6v12" />
            @break

        @case('chevron-left')
            <path d="m15 18-6-6 6-6" />
            @break

        @case('chevron-right')
            <path d="m9 18 6-6-6-6" />
            @break

        @case('precision')
            <circle cx="12" cy="12" r="8" />
            <circle cx="12" cy="12" r="3" />
            <path d="M12 2v3M22 12h-3M12 22v-3M2 12h3" />
            @break

        @case('layers')
            <path d="m12 3-9 5 9 5 9-5-9-5Z" />
            <path d="m3 12 9 5 9-5" />
            <path d="m3 16 9 5 9-5" />
            @break

        @case('spark')
            <path d="m12 3 1.5 5.5L19 10l-5.5 1.5L12 17l-1.5-5.5L5 10l5.5-1.5L12 3Z" />
            <path d="m19 16 .7 2.3L22 19l-2.3.7L19 22l-.7-2.3L16 19l2.3-.7L19 16Z" />
            @break

        @case('search')
            <circle cx="11" cy="11" r="7" />
            <path d="m20 20-4-4" />
            @break
    @endswitch
</svg>
