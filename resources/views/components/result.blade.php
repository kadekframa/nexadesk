@if (session()->has('sweetAlert'))
    <script>
        const sweetAlertData = @json(session('sweetAlert'));

        Swal.fire({
            icon: sweetAlertData.icon,
            title: sweetAlertData.title,
            html: sweetAlertData.text, // Use `html` to interpret any HTML or newlines
            footer: sweetAlertData.footer || '' // Use an empty string if footer is not set
        });
    </script>
@endif
