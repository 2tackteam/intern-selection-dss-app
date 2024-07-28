@props(['tabButtons', 'tabContents'])

@php($active = 'inline-flex items-center px-1 pt-1 border-b-2 border-blue-400 dark:border-blue-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-blue-700 transition duration-150 ease-in-out')
@php($inactive = 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out')


<div {!! $attributes->merge(['class' => 'mx-auto p-5 rounded shadow']) !!}>
    <div class="flex space-x-4 border-b">

        {!! $tabButtons !!}

{{--        <button class="tab-button {{ $active }}" data-tab="tab1">Tab 1</button>--}}
{{--        <button class="tab-button {{ $inactive }}" data-tab="tab2">Tab 2</button>--}}
{{--        <button class="tab-button {{ $inactive }}" data-tab="tab3">Tab 3</button>--}}
    </div>

    <div>
        {{ $tabContents }}
    </div>

{{--    <div id="tab1" class="tab-content p-4">--}}
{{--        <h2 class="text-xl font-semibold mb-2">Content for Tab 1</h2>--}}
{{--        <p>This is the content for tab 1.</p>--}}
{{--    </div>--}}
{{--    <div id="tab2" class="tab-content p-4 hidden">--}}
{{--        <h2 class="text-xl font-semibold mb-2">Content for Tab 2</h2>--}}
{{--        <p>This is the content for tab 2.</p>--}}
{{--    </div>--}}
{{--    <div id="tab3" class="tab-content p-4 hidden">--}}
{{--        <h2 class="text-xl font-semibold mb-2">Content for Tab 3</h2>--}}
{{--        <p>This is the content for tab 3.</p>--}}
{{--    </div>--}}
</div>

@pushonce('scripts')
    <script>
        // function openTab(evt, tabId) {
        //     var i, tabcontent, tablinks;
        //     tabcontent = document.getElementsByClassName("tab-content");
        //     for (i = 0; i < tabcontent.length; i++) {
        //         tabcontent[i].classList.add("hidden");
        //     }
        //     tablinks = document.querySelectorAll("button");
        //     for (i = 0; i < tablinks.length; i++) {
        //         tablinks[i].classList.remove("border-blue-500", "text-blue-500");
        //         tablinks[i].classList.add("text-gray-500");
        //     }
        //     document.getElementById(tabId).classList.remove("hidden");
        //     evt.currentTarget.classList.add("border-blue-500", "text-blue-500");
        // }

        const $tabButton = $('.tab-button')
        const $tabContent = $('.tab-content')
        $tabButton.click(function(){
            const tabId = $(this).data('tab');

            $tabContent.addClass('hidden');
            $('#' + tabId).removeClass('hidden');

            $tabButton.removeClass('{{ $active }}');
            $tabButton.addClass('{{ $inactive }}');
            $(this).addClass('{{ $active }}');
        });
    </script>
@endpushonce

