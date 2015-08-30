<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<!--<![endif]-->
<!-- BEGIN HEAD -->
    <head>
        @include('mposuccess::layouts.front.head')
    </head>

    <body class="corporate">

        <header>
            @include('mposuccess::layouts.front.top')
            @include('mposuccess::layouts.front.header')
        </header>

        <!-- BEGIN CONTAINER -->
        <div class="main">
            <div class="container">
                {{ $content }}
            </div>
        </div>

        <!-- END CONTAINER -->
        @include('mposuccess::layouts.front.prefooter')
        @include('mposuccess::layouts.front.footer')
        @include('mposuccess::layouts.front.script')
    </body>
<!-- END BODY -->
</html>