@props([
    'name',
    'filled' => false,
])

@switch($name)
    @case('portal')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.6" d="M12 3c4.86 0 8.5 3.42 8.5 8.3 0 5.1-4.13 8.38-8.22 9.4a1.2 1.2 0 0 1-.56 0C7.64 19.68 3.5 16.4 3.5 11.3 3.5 6.42 7.14 3 12 3Z" />
            <path stroke-width="1.4" d="M7.4 11.35c.98-2.55 3-4 5.76-4 1.48 0 2.72.33 3.78.95" />
            <path stroke-width="1.4" d="M8.1 15.18c1.18 1.12 2.58 1.67 4.12 1.67 1.72 0 3.19-.61 4.4-1.86" />
            <path stroke-width="1.2" d="M10.65 10.1c.78-.63 1.6-.95 2.47-.95 1.17 0 2.22.52 3.13 1.56" />
        </svg>
        @break

    @case('route')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.7" d="M5 6.5h7.5c2.4 0 4 1.48 4 3.5s-1.6 3.5-4 3.5h-1" />
            <path stroke-width="1.7" d="M19 17.5H11.5c-2.4 0-4-1.48-4-3.5s1.6-3.5 4-3.5h1" />
            <circle cx="5" cy="6.5" r="1.5" fill="currentColor" stroke="none" />
            <circle cx="19" cy="17.5" r="1.5" fill="currentColor" stroke="none" />
        </svg>
        @break

    @case('dossier')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.6" d="M6 5.5h10.5L19 8v10.5A1.5 1.5 0 0 1 17.5 20h-11A1.5 1.5 0 0 1 5 18.5V7a1.5 1.5 0 0 1 1-1.5Z" />
            <path stroke-width="1.4" d="M8.5 11h7M8.5 14.5h7M8.5 8.5h4.5" />
            <path stroke-width="1.4" d="M16.5 5.5V8H19" />
        </svg>
        @break

    @case('pulse')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.7" d="M3.5 12h4l1.6-3.4L12.1 16l2.1-5 1.3 3h5" />
            <path stroke-width="1.2" d="M4.5 7.5h3M16.5 7.5h3M4.5 16.5h3M16.5 16.5h3" />
        </svg>
        @break

    @case('status-alive')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.8" d="M4 12h3.2l1.5-3.2 2.7 7.1 2.1-5.1 1.4 2.9H20" />
            <path stroke-width="1.3" d="M6 6.8c1.5-1.3 3.5-2 6-2s4.5.7 6 2M6 17.2c1.5 1.3 3.5 2 6 2s4.5-.7 6-2" />
        </svg>
        @break

    @case('status-dead')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.6" d="M7.2 15.2c-1.15-1.08-1.7-2.48-1.7-4.2 0-3.45 2.62-6 6.5-6s6.5 2.55 6.5 6c0 1.72-.55 3.12-1.7 4.2" />
            <path stroke-width="1.6" d="M8 15.5v2.8c0 .94.76 1.7 1.7 1.7h4.6c.94 0 1.7-.76 1.7-1.7v-2.8" />
            <path stroke-width="1.5" d="m9.2 10.1 2 2m0-2-2 2M14.8 10.1l-2 2m0-2 2 2" />
            <path stroke-width="1.3" d="M10 16.5h4" />
        </svg>
        @break

    @case('status-unknown')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.6" d="M12 3.8 20.2 12 12 20.2 3.8 12 12 3.8Z" />
            <path stroke-width="1.8" d="M9.6 9.3c.45-1.1 1.35-1.65 2.7-1.65 1.45 0 2.55.87 2.55 2.1 0 1.02-.55 1.55-1.65 2.2-.82.49-1.2.94-1.2 1.8" />
            <path stroke-width="2" d="M12 16.25h.01" />
        </svg>
        @break

    @case('archive')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.6" d="M5 6.5h14v11A1.5 1.5 0 0 1 17.5 19h-11A1.5 1.5 0 0 1 5 17.5v-11Z" />
            <path stroke-width="1.6" d="M4 6.5h16V4.8A.8.8 0 0 0 19.2 4H4.8A.8.8 0 0 0 4 4.8v1.7Z" />
            <path stroke-width="1.4" d="M9 11.5h6M10 14.5h4" />
        </svg>
        @break

    @case('favorite')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24']) }} aria-hidden="true">
            @if($filled)
                <path fill="currentColor" d="M12 21c-.33 0-.66-.1-.94-.28C7.24 18.1 4 14.8 4 10.88 4 8.1 6.18 6 8.98 6c1.36 0 2.68.55 3.62 1.5C13.55 6.55 14.86 6 16.23 6 19.03 6 21 8.1 21 10.88c0 3.9-3.24 7.2-7.06 9.84-.28.18-.61.28-.94.28Z" />
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4" d="M12 21c-.33 0-.66-.1-.94-.28C7.24 18.1 4 14.8 4 10.88 4 8.1 6.18 6 8.98 6c1.36 0 2.68.55 3.62 1.5C13.55 6.55 14.86 6 16.23 6 19.03 6 21 8.1 21 10.88c0 3.9-3.24 7.2-7.06 9.84-.28.18-.61.28-.94.28Z" />
            @else
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 21c-.33 0-.66-.1-.94-.28C7.24 18.1 4 14.8 4 10.88 4 8.1 6.18 6 8.98 6c1.36 0 2.68.55 3.62 1.5C13.55 6.55 14.86 6 16.23 6 19.03 6 21 8.1 21 10.88c0 3.9-3.24 7.2-7.06 9.84-.28.18-.61.28-.94.28Z" />
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M8.7 8.2c-.94.2-1.8.76-2.3 1.63" />
            @endif
        </svg>
        @break

    @case('beacon')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.7" d="M12 4v10" />
            <path stroke-width="1.7" d="M9.2 11.2 12 14l2.8-2.8" />
            <path stroke-width="1.4" d="M6 19c1.6-1.25 3.6-1.88 6-1.88S16.4 17.75 18 19" />
            <path stroke-width="1.2" d="M7 6.5c1.12-1 2.8-1.5 5-1.5s3.88.5 5 1.5" />
        </svg>
        @break

    @case('profile')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="8.3" r="3.2" stroke-width="1.6" />
            <path stroke-width="1.6" d="M5.5 18.8c1.38-2.36 3.55-3.55 6.5-3.55s5.12 1.19 6.5 3.55" />
        </svg>
        @break

    @case('key')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="8.2" cy="11.2" r="3.2" stroke-width="1.6" />
            <path stroke-width="1.6" d="M11.2 13.2 19 21" />
            <path stroke-width="1.4" d="M14.6 16.6 17 14.2M16.7 18.7l1.8-1.8" />
        </svg>
        @break

    @case('search')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="10.5" cy="10.5" r="4.8" stroke-width="1.6" />
            <path stroke-width="1.8" d="m15 15 4 4" />
        </svg>
        @break

    @case('mail')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.6" d="M4.8 6h14.4c.44 0 .8.36.8.8v10.4a.8.8 0 0 1-.8.8H4.8a.8.8 0 0 1-.8-.8V6.8c0-.44.36-.8.8-.8Z" />
            <path stroke-width="1.4" d="m5 7 7 5.4L19 7" />
        </svg>
        @break

    @case('logout')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.6" d="M10 5.5H6.5A1.5 1.5 0 0 0 5 7v10a1.5 1.5 0 0 0 1.5 1.5H10" />
            <path stroke-width="1.7" d="M13 16.5 18 12l-5-4.5" />
            <path stroke-width="1.7" d="M18 12H9" />
        </svg>
        @break

    @case('menu')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.8" d="M5 7h14M5 12h14M5 17h14" />
        </svg>
        @break

    @case('close')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.8" d="m6 6 12 12M18 6 6 18" />
        </svg>
        @break

    @case('arrow-left')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.8" d="m10 6-6 6 6 6" />
            <path stroke-width="1.8" d="M5 12h15" />
        </svg>
        @break

    @case('arrow-right')
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path stroke-width="1.8" d="m14 6 6 6-6 6" />
            <path stroke-width="1.8" d="M19 12H4" />
        </svg>
        @break

    @default
        <svg {{ $attributes->merge(['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor']) }} aria-hidden="true">
            <circle cx="12" cy="12" r="7" stroke-width="1.6" />
        </svg>
@endswitch
