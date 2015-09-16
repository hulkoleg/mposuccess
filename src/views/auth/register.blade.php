<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="/assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="index.html" class="logo-default">
        <span>TEACHER</span>
        <span>LOG</span>
        <!--<img src="../..//assets/admin/layout/img/logo.png" alt="logo" class="logo-default"/>-->
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN REGISTRATION FORM -->
    <form class="register-form" action="{{ url('/auth/register') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <h3 align="center">Зарегистрироваться</h3>
        <div class="form-group @if($errors->has('name')) has-error @endif">
            <label class="control-label visible-ie8 visible-ie9">Имя</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Имя" name="name" value="{{ old('name') }}"/>
            </div>
            @if($errors->has('name'))
                <span id="name-error" class="help-block">{{$errors->first('name')}}</span>
            @endif
        </div>
        <div class="form-group @if($errors->has('surname')) has-error @endif">
            <label class="control-label visible-ie8 visible-ie9">Фамилия</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Фамилия" name="surname"
                       value="{{ old('surname') }}"/>
            </div>
            @if($errors->has('surname'))
                <span id="name-error" class="help-block">{{$errors->first('surname')}}</span>
            @endif
        </div>
        <div class="form-group @if($errors->has('patronymic')) has-error @endif">
            <label class="control-label visible-ie8 visible-ie9">Отчество</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Отчество" name="patronymic"
                       value="{{ old('patronymic') }}"/>
            </div>
            @if($errors->has('patronymic'))
                <span id="name-error" class="help-block">{{$errors->first('patronymic')}}</span>
            @endif
        </div>
        <div class="form-group @if($errors->has('email')) has-error @endif">
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email"
                       value="{{ old('email') }}"/>
            </div>
            @if($errors->has('email'))
                <span id="name-error" class="help-block">{{$errors->first('email')}}</span>
            @endif
        </div>
        <div class="form-group @if($errors->has('password')) has-error @endif">
            <label class="control-label visible-ie8 visible-ie9">Пароль</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password"
                       placeholder="Пароль" name="password"/>
            </div>
            @if($errors->has('password'))
                <span id="name-error" class="help-block">{{$errors->first('password')}}</span>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Введите свой пароль снова</label>
            <div class="controls">
                <div class="input-icon">
                    <i class="fa fa-check"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                           placeholder="Введите свой пароль снова" name="password_confirmation"/>
                </div>
            </div>
        </div>

        <div class="form-group @if($errors->has('birthday')) has-error @endif">
            <label class="control-label visible-ie8 visible-ie9">Дата рождения</label>
            <span class="input-group date date-picker" data-date-format="dd.mm.yyyy">
                <input type="text" class="form-control form-filter input-sm" name="birthday" placeholder="01.01.1990"  value="{{ old('birthday') }}">
                <span class="input-group-btn">
                    <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                </span>
            </span>
            @if($errors->has('birthday'))
                <span id="name-error" class="help-block">{{$errors->first('birthday')}}</span>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Пригласивший</label>
            <div class="controls">
                <input name="refer" id="select2_refer" class="form-control select2" placeholder="Пригласивший">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Выбор программы</label>
            <div class="input-icon">
                <i class="fa fa-home"></i>
                <select name="program" class="form-control">
                    @foreach ($programs as $program)
                        <option value="{{ $program['id'] }}" @if($program['id'] == old('program')) selected @endif>
                            {{ $program['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <select name="country" id="select2_country" class="form-control select2">
                @foreach ($countries as $country)
                    <option value="{{ $country['code'] }}" data-country="{{ $country['flag'] }}">{{ $country['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="tnc" @if(old('tnc')) checked @endif/> Я согласен с <a href="javascript:;">
                    Условиями использования </a>
                и <a href="javascript:;">
                    Политикой конфиденциальности </a>
            </label>
            <div id="register_tnc_error">
            </div>
        </div>
        <div class="form-actions">
            <a href="{{ url('/auth/login') }}" type="button" class="btn btn-default">
                <i class="m-icon-swapleft"></i> Назад
            </a>
            <button type="submit" id="register-submit-btn" class="btn blue pull-right">
                Зарегистрироваться <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
    2015 &copy; Mposuccess - Admin.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="/assets/global/plugins/respond.min.js"></script>
<script src="/assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script>
    jQuery(document).ready(function () {
        //init date pickers
        $('.date-picker').datepicker({
            startDate: '-100y',
            endDate: '-18y',
            language: 'ru'
        });

        function formatCountry(state) {
            if (!state.id) return state.text; // optgroup
            return "<img class='flag' src='../../assets/global/img/flags/" + $(state.element).data('country') + ".png'/>&nbsp;&nbsp;" + state.text;
        }
        $("#select2_country").select2({
            allowClear: true,
            formatResult: formatCountry,
            formatSelection: formatCountry,
            escapeMarkup: function (m) {
                return m;
            }
        });
        @if(old('country'))
            $("#select2_country").select2("val", "{{ old('country') }}");
        @endif

        var $referEl = $("#select2_refer");
        $referEl.select2({
            id: function(data) { return data.sid; },
            minimumInputLength: 3,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "/auth/refers",
                dataType: 'json',
                results: function (data) {
                    //var more = (page * pageSize) < data.total; // whether or not there are more results available
                    return { results: data }; // notice we return the value of more so Select2 knows if more results can be loaded
                },
                data: function (term) { // page is the one-based page number tracked by Select2
                    return {
                        q: term    //search term
                    };
                }
            },
            formatResult: function (item) {
                return "<option value='" + item.sid + "'>" + item.name + "</option>";
            },
            formatSelection: function (item) {
                return item.name;
            }
        });

        @if(old('refer'))
            $referEl.select2("search", "{{ old('refer') }}")
                .on("select2-loaded", function(e) {
                    var nameFirst = $('.select2-results li:first').text();
                    $referEl.select2("close")
                            .off("select2-loaded")
                            .select2("data", { sid: "{{ old('refer') }}", name: nameFirst });
                });
        @endif
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>