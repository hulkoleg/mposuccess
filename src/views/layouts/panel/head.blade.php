<meta charset="utf-8"/>
<title>{{ $title or config('mposuccess.default_title')}}: {{ config('mposuccess.company_title') }}</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta name="_token" content="{{ csrf_token() }}"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES
<link href="/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/> -->
<link href="/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="/assets/admin/layout/css/themes/light2.css" rel="stylesheet" type="text/css"/>
<link href="/assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>

{!! \Assets::css() !!}
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>