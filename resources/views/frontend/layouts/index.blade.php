<!DOCTYPE html>
<html lang="en">
    <head>
        @include('frontend.layouts.top')
    </head>
    <body>
        <div id="wrapper">
            @include('frontend.layouts.header')
            <div class="left-side-menu">
            @include('frontend.layouts.menu')
            </div>
            <div class="content-page">
                <div class="content">
                    @yield('content')
                </div>
                <!-- end Footer -->
            </div>
            @include('frontend.layouts.footer')
        </div>
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        @include('frontend.layouts.bot')
    </body>
</html>