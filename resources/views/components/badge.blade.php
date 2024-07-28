@props(['value', 'type' => 'default'])

@if($type === 'primary')
    @php($bgNText = 'bg-blue-500 dark:bg-blue-500 text-gray-100 dark:text-gray-50')
@elseif($type === 'danger')
    @php($bgNText = 'bg-blue-500 dark:bg-blue-500 text-gray-100 dark:text-gray-50')
@else
    @php($bgNText = 'bg-gray-400 dark:bg-gray-50 text-gray-100 dark:text-gray-700')
@endif

<span {{ $attributes->merge(['class'=> "inline-flex justify-center items-center rounded-md px-2 py-1 $bgNText text-[12px] font-medium ring-1 ring-inset ring-gray-500/10"]) }}>
    {{ $value ?? $slot }}
</span>
