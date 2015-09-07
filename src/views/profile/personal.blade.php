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
                    <button type="button" class="btn btn-circle green-haze btn-sm">@lang('mposuccess::profile.referral')</button>
                    <button type="button" class="btn btn-circle btn-danger btn-sm">@lang('mposuccess::profile.message')</button>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="extra_profile_account.html">
                                <i class="icon-settings"></i>
                                @lang('mposuccess::profile.accountSettings')</a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
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

                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.personalInfo.surname')</label>
                                            <input type="text" name="surname" placeholder="@lang('mposuccess::profile.personalInfo.surnamePlaceholder')"
                                                   class="form-control" value="{{ Input::old('surname', $user->surname) }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.personalInfo.name')</label>
                                            <input type="text" name="name" placeholder="@lang('mposuccess::profile.personalInfo.namePlaceholder')"
                                                   class="form-control" value="{{ Input::old('name', $user->name) }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.personalInfo.patronymic')</label>
                                            <input type="text" name="patronymic" placeholder="@lang('mposuccess::profile.personalInfo.patronymicPlaceholder')"
                                                   class="form-control" value="{{ Input::old('patronymic', $user->patronymic) }}">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.region')</label>
                                            <select class="form-control select2me input-sm" data-placeholder="@lang('mposuccess::profile.regionNoSelect')">
                                                @foreach ($regions as $region)
                                                    <option value="{{$region['code']}}">{{$region['name']}} ({{$region['code']}})</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.personalInfo.dataBirth')</label>
                                            <span class="input-group date date-picker" data-date-format="dd.mm.yyyy">
                                                <input type="text" class="form-control form-filter input-sm"  name="order_date_to" placeholder="01.01.1990">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </span>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.instruction')</label>
                                            <select class="form-control select2me input-sm" data-placeholder="@lang('mposuccess::profile.instructionNoSelect')">
                                                @foreach ($instructions as $instruction)
                                                    <option value="">{{$instruction['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.referral')</label>
                                            <input type="text" placeholder="@lang('mposuccess::profile.referralNone')" class="form-control" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.personalInfo.email')</label>
                                            <input type="text" placeholder="name@gmail.com" class="form-control" value="{{$user->email}}" disabled>
                                        </div>

                                        <div class="margiv-top-10">
                                            <button type="submit" class="btn green-haze">
                                                @lang('mposuccess::profile.saveChanges')
                                            </button>
                                            <a href="javascript:;" class="btn default">
                                                @lang('mposuccess::profile.cancel')</a>
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
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new">
                                                            @lang('mposuccess::profile.changeAvatar.selectImage')</span>
                                                        <span class="fileinput-exists">
                                                            @lang('mposuccess::profile.changeAvatar.changeImage')</span>
                                                        <input type="file" name="photo">
                                                    </span>
                                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput">
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
                                            <a href="javascript:;" class="btn default">
                                                @lang('mposuccess::profile.cancel')</a>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane @if (Session::get('tab') === 3) active @endif" id="tab_1_3">
                                    <form id="form-change-password" method="post" action="{{ url('/profile/changePassword') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.changePassword.current')</label>
                                            <input type="password" name="current" class="form-control" value="{{ Input::old('current') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.changePassword.new')</label>
                                            <input type="password" name="new" class="form-control" value="{{ Input::old('new') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.changePassword.reType')</label>
                                            <input type="password" name="re-type" class="form-control" value="{{ Input::old('re-type') }}">
                                        </div>
                                        <div class="margin-top-10">
                                            <button type="submit" class="btn green-haze">
                                                @lang('mposuccess::profile.changePassword.title')
                                            </button>
                                            <a href="javascript:;" class="btn default">
                                                @lang('mposuccess::profile.cancel')</a>
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

<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets\global\plugins\bootstrap-datepicker\js\locales\bootstrap-datepicker.ru.js" charset="UTF-8"></script>

<!-- END PAGE LEVEL SCRIPTS -->


<script type="text/javascript">
    //init date pickers
    $('.date-picker').datepicker({
        startDate: '-100y',
        endDate: '-18y',
        language: 'ru'
    });
</script>

<script type="text/javascript">
    $('.select2me').select2({
        placeholder: "Select",
        allowClear: true
    });


    /*function format(state) {
     if (!state.id) return state.text; // optgroup
     return "<img class='flag' src='" + Metronic.getGlobalImgPath() + "flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
     }
     $("#select2_sample4").select2({
     placeholder: "Select a Country",
     allowClear: true,
     formatResult: format,
     formatSelection: format,
     escapeMarkup: function (m) {
     return m;
     }
     });*/
</script>