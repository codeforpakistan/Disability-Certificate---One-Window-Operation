<style>
    .logo-list {
        text-align: center;
        border-bottom: 1px solid #ddd;
    }
    .logo-list img {
        display: inline-block;
        max-width: 85%;
        transition: all 0.3s ease-in-out;
        -webkit-filter: grayscale(100);
        -moz-filter: grayscale(100);
        filter: grayscale(100);
    }
    .logo-list img:hover {
        filter: none;
        transform: scale(1.2);
        -webkit-filter: none;
        -moz-filter: none;
    }
</style>
<footer class="logo-list bg-white pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-1 col-md-4 col-6">
                <a href="https://www.pakistan.gov.pk/" target="_blank">
                    <img src="{{ asset('img/pak-logo.png') }}" class="img-fluid" alt="Bluehost logo">
                </a>
            </div>
            <div class="col-lg-1 col-md-4 col-6">
                <a href="https://www.nih.org.pk/" target="_blank">
                    <img src="{{ asset('img/nih-logo.png') }}" class="img-fluid" alt="Hostgator logo">
                </a>
            </div>
            <div class="col-lg-1 col-md-4 col-6">
                <a href="https://www.nih.org.pk/" target="_blank">
                    <img src="{{ asset('img/nirm-logo.jpeg') }}" class="img-fluid" alt="Green Geeks logo">
                </a>
            </div>
            <div class="col-lg-1 col-md-4 col-6">
                <a href="https://www.nadra.gov.pk/" target="_blank">
                    <img src="{{ asset('img/nadra-logo.png') }}" class="img-fluid" alt="WordPress logo">
                </a>
            </div>
            <div class="col-lg-1 col-md-4 col-6">
                <a href="https://www.nih.org.pk/" target="_blank">
                    <img src="{{ asset('img/tech-logo.png') }}" class="img-fluid" alt="DreamHost logo">
                </a>
            </div>
            <div class="col-lg-1 col-md-4 col-6">
                <a href="https://codeforpakistan.org" target="_blank">
                    <img src="{{ asset('img/cfp-logo.jpeg') }}" class="img-fluid" alt="Hostinger logo">
                </a>
            </div>
        </div>
    </div>
    <hr>
    <div class="pb-2 px-3">
        <div class="mt-2 text-center">© Copyright {{ date('Y') }}. Designed, Developed and Maintained by <a class="text-green-700 hover:text-blue-400 no-underline hover:underline" href="https://codeforpakistan.org">Code for Pakistan</a>.</div>
    </div>
</footer>