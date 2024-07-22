<button {{ $attributes->merge(['class' => 'toggle-button p-2 rounded-2xl bg-blue-500 text-white focus:outline-none w-12']) }}>
    <!-- Default icon (you can use any icon library, here Font Awesome is used) -->
    <i class="toggle-icon fas fa-sun"></i>
</button>


@pushonce('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpushonce

@pushonce('scripts')
    <!-- Font Awesome for icons (optional, replace with your preferred icon library) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"
            integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const $html = $('html')
        const $toggleButton = $('.toggle-button')
        const $toggleIcon = $('.toggle-icon')


        if (localStorage.getItem('darkMode') === 'true') {
            $html.addClass('dark');
            $toggleIcon.removeClass('fa-sun').addClass('fa-moon');
            $toggleButton.removeClass('bg-blue-500').addClass('bg-gray-700');
        }

        $toggleButton.click(function() {
            $html.toggleClass('dark');
            $('.toggle-icon').toggleClass('fa-sun fa-moon');
            $(this).toggleClass('bg-blue-500 bg-gray-700');

            // Save the current state to local storage
            if ($html.hasClass('dark')) {
                localStorage.setItem('darkMode', 'true');
            } else {
                localStorage.setItem('darkMode', 'false');
            }
        });
    </script>
@endpushonce
