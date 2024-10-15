<div class="inline-flex rounded-md shadow-sm" role="group">
    @foreach ($buttons as $button)
        <a href="{{ $button['url'] }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border {{ $loop->first ? 'rounded-s-lg' : ($loop->last ? 'rounded-e-lg' : 'border-t border-b') }} border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            {!! $button['label'] !!}
        </a>
    @endforeach
</div>
