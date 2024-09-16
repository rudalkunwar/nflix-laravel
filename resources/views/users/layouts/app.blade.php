@include('users.partials.header')

@yield('content')

@php
    session_start();
@endphp
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = @json(session('success'));
        const errorMessage = @json(session('error'));

        if (successMessage) {
            Toastify({
                text: successMessage,
                duration: 4000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "linear-gradient(to right, #00bfff, #1e90ff)", // Blue gradient
                stopOnFocus: true,
            }).showToast();
        }

        if (errorMessage) {
            Toastify({
                text: errorMessage,
                duration: 4000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "linear-gradient(to right, #ff4d4d, #ff0000)", // Red gradient
                stopOnFocus: true,
            }).showToast();
        }
    });
</script>


@include('users.partials.footer')
