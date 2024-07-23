@props(['disabled' => false])

<div class="flatpickr flex rounded-md overflow-hidden" role="group" aria-label="Basic example">
    <input data-input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-l-md shadow-sm']) !!}>
    <button type="button" class="mt-1 bg-gray-500 text-white px-4 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500" data-toggle>
        <i class="far fa-calendar-days"></i>
    </button>
    <button type="button" class="mt-1 bg-gray-500 text-white px-4 rounded-r-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500" data-clear>
        <i class="fas fa-delete-left"></i>
    </button>
</div>

