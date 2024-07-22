@props(['value'])

<td {!! $attributes->merge(['class' => 'px-4 py-3 text-sm']) !!}>
    @if(isset($value))
        {{ $value }}
    @else
        {!! $slot !!}
    @endif
</td>
