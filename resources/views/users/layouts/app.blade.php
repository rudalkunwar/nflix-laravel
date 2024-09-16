@include('users.partials.header')

@yield('content')

@php
    session_start();
@endphp
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sessionMessage = '<?php echo session('success') ? session('success') : ''; ?>';
        if (sessionMessage) {
            Toastify({
                text: sessionMessage,
                duration: 4000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                stopOnFocus: true,
            }).showToast();
        }
    });
</script>

@include('users.partials.footer')
