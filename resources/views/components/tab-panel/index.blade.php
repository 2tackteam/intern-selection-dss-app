@props(['tabButtons', 'tabContents'])

<div {!! $attributes->merge(['class' => 'mx-auto p-5 rounded shadow']) !!}>
    <div class="flex space-x-4 border-b">

        {!! $tabButtons !!}
    </div>

    <div>
        {{ $tabContents }}
    </div>
</div>
