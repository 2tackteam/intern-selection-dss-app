@props(['tabId', 'tabTitle', 'tabContent', 'first' => false])

<div id="{{ "tab_$tabId" }}" class="tab-content p-4 {{ !$first ? 'hidden' : '' }}">
    <div class="text-xl font-semibold mb-2">
        {!! $tabTitle !!}
    </div>
    {!! $tabContent !!}
</div>
