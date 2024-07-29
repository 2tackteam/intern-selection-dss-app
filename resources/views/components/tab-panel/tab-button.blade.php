@props(['tabId', 'value', 'first' => false])

@php($active = 'inline-flex items-center px-4 py-2 border-b-2 border-blue-400 text-sm font-semibold leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-blue-400 transition duration-150 ease-in-out')
@php($inactive = 'inline-flex items-center px-4 py-2 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out')

<button class="tab-button {{ $first ? $active : $inactive }}" data-tab="{{ "tab_$tabId" }}">
    {!! $value ?? $slot !!}
</button>

@push('scripts')
    <script>
        var $tabButton, $tabContent

        $tabButton = $('.tab-button')
        $tabContent = $('.tab-content')
        $tabButton.click(function(){
            const tabId = $(this).data('tab');

            $tabContent.addClass('hidden');
            $('#' + tabId).removeClass('hidden');

            $tabButton.not(this).removeClass('{{ $active }}')
            $tabButton.not(this).removeClass('{{ $inactive }}')
            $tabButton.not(this).addClass('{{ $inactive }}')

            $(this).removeClass('{{ $inactive }}');
            $(this).addClass('{{ $active }}');
        });
    </script>
@endpush

