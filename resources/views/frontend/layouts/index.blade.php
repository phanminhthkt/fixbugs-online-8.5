<!DOCTYPE html>
<html lang="en">
    <head>
        @include('frontend.layouts.top')
    </head>
    <body>
        <div id="wrapper">
            <div id="app">
                <message-component></message-component>
                <template-component 
                    user="{{json_encode(session('loginMember'),true)}}">
                </template-component>
            </div>
        </div>
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <script src="/js/app.js"></script>
        @include('frontend.layouts.bot')
    </body>
</html>