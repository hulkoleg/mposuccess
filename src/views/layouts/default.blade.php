<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="ru">
<!--<![endif]-->
<!-- BEGIN HEAD -->
    <head>
        @include('Mposuccess::layouts.head')
    </head>

    <body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo">

        @include('Mposuccess::layouts.top')

        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            @include('Mposuccess::layouts.slidebar')
            @include('Mposuccess::layouts.content')
        </div>
        <!-- END CONTAINER -->
        @include('Mposuccess::layouts.footer')
        @include('Mposuccess::layouts.script')
    </body>
<!-- END BODY -->
</html>