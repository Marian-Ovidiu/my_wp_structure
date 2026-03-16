@props([
    'menu' => [],
    'navClass' => '',
    'listClass' => 'flex flex-wrap items-center gap-4',
    'linkClass' => 'text-sm font-medium text-gray-700 hover:text-gray-900',
    'activeClass' => 'text-gray-900',
])

<nav class="{{ $navClass }}" aria-label="{{ __('Primary navigation', 'my_structure') }}">
    <ul class="{{ $listClass }}">
        @foreach ($menu as $item)
            @php
                $isActive = !empty($item->current);
            @endphp
            <li>
                <a
                    href="{{ $item->url }}"
                    class="{{ $linkClass }} {{ $isActive ? $activeClass : '' }}"
                    @if ($isActive) aria-current="page" @endif
                >
                    {{ $item->title }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
