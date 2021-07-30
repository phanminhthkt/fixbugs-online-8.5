<!DOCTYPE html>
<html lang="en">
    <head>
        @include('frontend.layouts.top')
    </head>
    <body>
        <div id="wrapper">
            <div id="app">
                <header-component></header-component>
            </div>
        </div>
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <script src="/js/app.js"></script>
        @include('frontend.layouts.bot')
    </body>
</html>