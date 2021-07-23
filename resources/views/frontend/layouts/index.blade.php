<!DOCTYPE html>
<html lang="en">
    <head>
        @include('frontend.layouts.top')
    </head>
    <body>
        <div id="wrapper">
            @include('frontend.layouts.header') 
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                <!-- end Footer -->
            @include('frontend.layouts.footer')
        </div>
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        @include('frontend.layouts.bot')
    </body>
</html>