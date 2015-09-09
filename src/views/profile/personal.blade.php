<div class="row margin-top-20">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="{{ $user->url_avatar }}" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{ $user->surname }} {{ $user->name }}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <button type="button" class="btn btn-circle green-haze btn-sm">@lang('mposuccess::profile.refer')</button>
                    <button type="button" class="btn btn-circle btn-danger btn-sm">@lang('mposuccess::profile.message')</button>
                </div>
                <!-- END SIDEBAR BUTTONS -->
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">@lang('mposuccess::profile.title')</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li @if (!in_array(Session::get('tab'), [2,3])) class="active" @endif>
                                    <a href="#tab_1_1" data-toggle="tab">@lang('mposuccess::profile.personalInfo.title')</a>
                                </li>
                                <li @if (Session::get('tab') === 2) class="active" @endif>
                                    <a href="#tab_1_2" data-toggle="tab">@lang('mposuccess::profile.changeAvatar.title')</a>
                                </li>
                                <li @if (Session::get('tab') === 3) class="active" @endif>
                                    <a href="#tab_1_3" data-toggle="tab">@lang('mposuccess::profile.changePassword.title')</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane @if (!in_array(Session::get('tab'), [2,3])) active @endif" id="tab_1_1">
                                    <form id="form-change-data" method="post" action="{{ url('/profile/changeData') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group @if($errors->has('surname')) has-error @endif">
                                            <label class="control-label">@lang('mposuccess::profile.personalInfo.surname')</label>
                                            <input type="text" name="surname" placeholder="@lang('mposuccess::profile.personalInfo.surnamePlaceholder')"
                                                   class="form-control" value="{{ Input::old('surname', $user->surname) }}">
                                            @if($errors->has('surname'))
                                                <span id="name-error" class="help-block">{{ $errors->first('surname') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group @if($errors->has('name')) has-error @endif">
                                            <label class="control-label">@lang('mposuccess::profile.personalInfo.name')</label>
                                            <input type="text" name="name" placeholder="@lang('mposuccess::profile.personalInfo.namePlaceholder')"
                                                   class="form-control" value="{{ old('name', $user->name) }}">
                                            @if($errors->has('name'))
                                                <span id="name-error" class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group @if($errors->has('patronymic')) has-error @endif">
                                            <label class="control-label">@lang('mposuccess::profile.personalInfo.patronymic')</label>
                                            <input type="text" name="patronymic" placeholder="@lang('mposuccess::profile.personalInfo.patronymicPlaceholder')"
                                                   class="form-control" value="{{ old('patronymic', $user->patronymic) }}">
                                            @if($errors->has('patronymic'))
                                                <span id="name-error" class="help-block">{{ $errors->first('patronymic') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group @if($errors->has('birthday')) has-error @endif">
                                            <label class="control-label">@lang('mposuccess::profile.personalInfo.dataBirth')</label>
                                            <span class="input-group date date-picker" data-date-format="dd.mm.yyyy">
                                                <input type="text" class="form-control form-filter input-sm" name="birthday"
                                                       placeholder="01.01.1990" value="{{ old('birthday', date_format(date_create($user->birthday), 'd.m.Y')) }}">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </span>
                                            @if($errors->has('birthday'))
                                                <span id="name-error" class="help-block">{{ $errors->first('birthday') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.region')</label>
                                            <select name="country" id="select2_country" class="form-control select2 input-sm" data-placeholder="@lang('mposuccess::profile.regionNoSelect')" disabled>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country['code'] }}" data-country="{{ $country['flag'] }}">{{ $country['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.instruction')</label>
                                            <select id="select2_program" class="form-control input-sm" data-placeholder="@lang('mposuccess::profile.instructionNoSelect')" disabled>
                                                @foreach ($programs as $program)
                                                    <option value="{{ $program['id'] }}">{{ $program['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.refer')</label>
                                            <input type="text" placeholder="@lang('mposuccess::profile.referNone')" class="form-control" value="{{ $refer }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.personalInfo.email')</label>
                                            <input type="text" placeholder="name@gmail.com" class="form-control" value="{{$user->email}}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.personalInfo.dateRegister')</label>
                                            <input type="text" class="form-control" value="{{ $user->created_at }}" disabled>
                                        </div>

                                        <div class="margiv-top-10">
                                            <button type="submit" class="btn green-haze">
                                                @lang('mposuccess::profile.saveChanges')
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE AVATAR TAB -->
                                <div class="tab-pane @if (Session::get('tab') === 2) active @endif" id="tab_1_2">
                                    <form id="form-change-avatar" method="post" action="{{ url('/profile/changeAvatar') }}" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new">
                                                            @lang('mposuccess::profile.changeAvatar.selectImage')</span>
                                                        <input type="file" name="photo">
                                                    </span>
                                                    <a href="{{ url('profile/removeAvatar') }}" class="btn default fileinput-exists"
                                                        data-dismiss="fileinput" @if(!$user->url_avatar) disabled @endif>
                                                        @lang('mposuccess::profile.changeAvatar.remove')</a>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-10">
                                                <span class="label label-danger">@lang('mposuccess::profile.note')</span>
                                                <span>@lang('mposuccess::profile.changeAvatar.help')</span>
                                            </div>
                                        </div>
                                        <div class="margin-top-10">
                                            <button type="submit" class="btn green-haze">
                                                @lang('mposuccess::profile.submit')
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane @if (Session::get('tab') === 3) active @endif" id="tab_1_3">
                                    <form id="form-change-password" method="post" action="{{ url('/profile/changePassword') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group @if($errors->has('current')) has-error @endif">
                                            <label class="control-label">@lang('mposuccess::profile.changePassword.current')</label>
                                            <input type="password" name="current" class="form-control" value="{{ old('current') }}">
                                            @if($errors->has('current'))
                                                <span id="name-error" class="help-block">{{ $errors->first('current') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group  @if($errors->has('password')) has-error @endif">
                                            <label class="control-label">@lang('mposuccess::profile.changePassword.new')</label>
                                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                                            @if($errors->has('password'))
                                                <span id="name-error" class="help-block">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.changePassword.reType')</label>
                                            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                                        </div>
                                        <div class="margin-top-10">
                                            <button type="submit" class="btn green-haze">
                                                @lang('mposuccess::profile.changePassword.title')
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE PASSWORD TAB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>

<script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="../assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="../assets\global\plugins\bootstrap-datepicker\js\locales\bootstrap-datepicker.ru.js" charset="UTF-8"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->


<script type="text/javascript">
    //init date pickers
    $('.date-picker').datepicker({
        startDate: '-100y',
        endDate: '-18y',
        language: 'ru'
    });

    function formatCountry(state) {
        if (!state.id) return state.text; // optgroup
        return "<img class='flag' src='" + Metronic.getGlobalImgPath() + "flags/" + $(state.element).data('country') + ".png'/>&nbsp;&nbsp;" + state.text;
    }
    $("#select2_country").select2({
        allowClear: true,
        formatResult: formatCountry,
        formatSelection: formatCountry,
        escapeMarkup: function (m) {
            return m;
        }
    }).select2("val", "{{ $user->country }}");

    $('#select2_program').select2().select2("val", "{{ $user->program }}");
</script>