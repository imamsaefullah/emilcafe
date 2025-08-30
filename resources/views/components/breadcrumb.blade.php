<nav class="text-sm text-gray-600 mb-4" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex items-center space-x-2">
        <li class="disabled">
            <a href="{{ url(route('dashboard')) }}" class="text-blue-600 hover:underline ">Home</a>
        </li>

        @foreach ($segments as $segment)
            <li class="inline-flex items-center">
                <svg class="w-4 h-4 mx-2 text-gray-400 " fill="currentColor" viewBox="0 0 20 20">
                    <path d="M7.05 4.05a.5.5 0 10-.7.7L10.29 9l-3.94 3.95a.5.5 0 10.7.7l4.25-4.25a.5.5 0 000-.7L7.05 4.05z" />
                </svg>
                @if ($segment['url'])
                    <a href="{{ $segment['url'] }}" class="text-blue-600 hover:underline">
                        {{ $segment['label'] }}
                    </a>
                @else
                    <span class="text-gray-800 font-medium">{{ $segment['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
