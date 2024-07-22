@props(['isHeader' => false])

@php($headerClass = $isHeader ? 'font-bold' : '')

<tr {!! $attributes->merge(['class' => "border-b border-gray-300 dark:border-gray-400 $headerClass"]) !!}>
    {!! $slot !!}
</tr>
