@props(['value'])

<td {!! $attributes->merge(['class' => 'px-4 py-3']) !!}>
    @if(isset($value))
        {{ $value }}
    @else
        {!! $slot !!}
    @endif
</td>
