<footer class="tm-black-bg">
    <div class="container">
        <div class="row">
            <p class="tm-copyright-text">Copyright &copy; Web Development</p>
        </div>
    </div>
</footer>
<script>
    // HTML document is loaded. DOM is ready.
    $(function() {

        $('#hotelCarTabs a').click(function(e) {
            e.preventDefault()
            $(this).tab('show')
        })

        $('.date').datetimepicker({
            format: 'MM/DD/YYYY'
        });
        $('.date-time').datetimepicker();

        // https://css-tricks.com/snippets/jquery/smooth-scrolling/
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location
                .hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });

    // Load Flexslider when everything is loaded.
    $(window).load(function() {
        //	For images only
        $('.flexslider').flexslider({
            controlNav: false
        });
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
        })
    </script>
@endif

@if (session('success'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif


<script>
    function toggleMenu() {
        const nav = document.querySelector('.tm-nav');
        nav.classList.toggle('show');
    }
</script>
</body>

</html>
