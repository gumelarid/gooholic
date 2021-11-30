@include('front.template.header')

@yield('pageTitle')

<section class="section blog-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @yield('content')
            </div>

            @include('front.template.sidebar')
        </div>

        @yield('pagination')
    </div>
</section>

@include('front.template.footer')