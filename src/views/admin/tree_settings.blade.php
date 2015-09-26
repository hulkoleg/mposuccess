<!-- BEGIN PROFILE CONTENT -->
<div class="profile-content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">@lang('mposuccess::admin.tree_settings')</span>
                    </div>
                </div>
            </div>
            <div class="panel-group accordion" id="accordion1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1" aria-expanded="true">
                                @lang('mposuccess::admin.first_structure')</a>
                        </h4>
                    </div>
                    <div id="collapse_1" class="panel-collapse collapse" aria-expanded="false">
                        <div class="panel-body" >
                            <form  id="form-change-settings-structure" method="post" action="{{ route(config('mposuccess.panel_url') . '.changeSettingsStructure') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group  @if($errors->has('cells')) has-error @endif">
                                    <label class="control-label">@lang('mposuccess::admin.settings.cells_to_fill')</label>
                                    <input type="text" name="cells" class="form-control" value="{!! $settings[1]['cells_to_fill'] !!}">
                                    @if($errors->has('cells'))
                                        <span id="name-error" class="help-block">{{ $errors->first('cells') }}</span>
                                    @endif
                                </div>
                                <div class="form-group  @if($errors->has('first_pay')) has-error @endif">
                                    <label class="control-label">@lang('mposuccess::admin.settings.first_pay')</label>
                                    <input type="text" name="first_pay" class="form-control" value="{!! $settings[1]['first_pay'] !!}">
                                    @if($errors->has('first_pay'))
                                        <span id="name-error" class="help-block">{{ $errors->first('first_pay') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">@lang('mposuccess::admin.settings.next_pay')</label>
                                    <input type="text" name="password_confirmation" class="form-control" value="{{ old('next_pay') }}">
                                    @if($errors->has('next_pay'))
                                        <span id="name-error" class="help-block">{{ $errors->first('next_pay') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">@lang('mposuccess::admin.settings.sum_pay')</label>
                                    <input type="text" name="password_confirmation" class="form-control" value="{{ old('sum_pay') }}">
                                    @if($errors->has('sum_pay'))
                                        <span id="name-error" class="help-block">{{ $errors->first('sum_pay') }}</span>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse_2" aria-expanded="false">
                                @lang('mposuccess::admin.second_structure')</a>
                        </h4>
                    </div>
                    <div id="collapse_2" class="panel-collapse collapse " aria-expanded="false">
                        <div class="panel-body">
                            <form  id="form-change-settings-structure" method="post" action="{{ route(config('mposuccess.panel_url') . '.changeSettingsStructure') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group  @if($errors->has('cells')) has-error @endif">
                                    <label class="control-label">@lang('mposuccess::admin.settings.cells_to_fill')</label>
                                    <input type="text" name="cells" class="form-control" value="{{ old('cells') }}">
                                    @if($errors->has('cells'))
                                        <span id="name-error" class="help-block">{{ $errors->first('cells') }}</span>
                                    @endif
                                </div>
                                <div class="form-group  @if($errors->has('first_pay')) has-error @endif">
                                    <label class="control-label">@lang('mposuccess::admin.settings.first_pay')</label>
                                    <input type="text" name="first_pay" class="form-control" value="{{ old('first_pay') }}">
                                    @if($errors->has('first_pay'))
                                        <span id="name-error" class="help-block">{{ $errors->first('first_pay') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">@lang('mposuccess::admin.settings.next_pay')</label>
                                    <input type="text" name="password_confirmation" class="form-control" value="{{ old('next_pay') }}">
                                    @if($errors->has('next_pay'))
                                        <span id="name-error" class="help-block">{{ $errors->first('next_pay') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">@lang('mposuccess::admin.settings.sum_pay')</label>
                                    <input type="text" name="password_confirmation" class="form-control" value="{{ old('sum_pay') }}">
                                    @if($errors->has('sum_pay'))
                                        <span id="name-error" class="help-block">{{ $errors->first('sum_pay') }}</span>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_3" aria-expanded="false">
                                @lang('mposuccess::admin.third_structure') </a>
                        </h4>
                    </div>
                    <div id="collapse_3" class="panel-collapse collapse" aria-expanded="false" >
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_4" aria-expanded="false">
                                @lang('mposuccess::admin.fourth_structure') </a>
                        </h4>
                    </div>
                    <div id="collapse_4" class="panel-collapse collapse" aria-expanded="false" >
                        <div class="panel-body">
                            <form  id="form-change-settings-structure" method="post" action="{{ route(config('mposuccess.panel_url') . '.changeSettingsStructure') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group  @if($errors->has('cells')) has-error @endif">
                                    <label class="control-label">@lang('mposuccess::admin.settings.cells_to_fill')</label>
                                    <input type="text" name="cells" class="form-control" value="{{ old('cells') }}">
                                    @if($errors->has('cells'))
                                        <span id="name-error" class="help-block">{{ $errors->first('cells') }}</span>
                                    @endif
                                </div>
                                <div class="form-group  @if($errors->has('first_pay')) has-error @endif">
                                    <label class="control-label">@lang('mposuccess::admin.settings.first_pay')</label>
                                    <input type="text" name="first_pay" class="form-control" value="{{ old('first_pay') }}">
                                    @if($errors->has('first_pay'))
                                        <span id="name-error" class="help-block">{{ $errors->first('first_pay') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">@lang('mposuccess::admin.settings.next_pay')</label>
                                    <input type="text" name="password_confirmation" class="form-control" value="{{ old('next_pay') }}">
                                    @if($errors->has('next_pay'))
                                        <span id="name-error" class="help-block">{{ $errors->first('next_pay') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">@lang('mposuccess::admin.settings.sum_pay')</label>
                                    <input type="text" name="password_confirmation" class="form-control" value="{{ old('sum_pay') }}">
                                    @if($errors->has('sum_pay'))
                                        <span id="name-error" class="help-block">{{ $errors->first('sum_pay') }}</span>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_5" aria-expanded="false">
                                @lang('mposuccess::admin.fifth_structure') </a>
                        </h4>
                    </div>
                    <div id="collapse_5" class="panel-collapse collapse" aria-expanded="false" >
                        <div class="panel-body">
                            <form  id="form-change-settings-structure" method="post" action="{{ route(config('mposuccess.panel_url') . '.changeSettingsStructure') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group  @if($errors->has('cells')) has-error @endif">
                                    <label class="control-label">@lang('mposuccess::admin.settings.cells_to_fill')</label>
                                    <input type="text" name="cells" class="form-control" value="{{ old('cells') }}">
                                    @if($errors->has('cells'))
                                        <span id="name-error" class="help-block">{{ $errors->first('cells') }}</span>
                                    @endif
                                </div>
                                <div class="form-group  @if($errors->has('first_pay')) has-error @endif">
                                    <label class="control-label">@lang('mposuccess::admin.settings.first_pay')</label>
                                    <input type="text" name="first_pay" class="form-control" value="{{ old('first_pay') }}">
                                    @if($errors->has('first_pay'))
                                        <span id="name-error" class="help-block">{{ $errors->first('first_pay') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">@lang('mposuccess::admin.settings.next_pay')</label>
                                    <input type="text" name="next_pay" class="form-control" value="{{ old('next_pay') }}">
                                    @if($errors->has('next_pay'))
                                        <span id="name-error" class="help-block">{{ $errors->first('next_pay') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">@lang('mposuccess::admin.settings.sum_pay')</label>
                                    <input type="text" name="sum_pay" class="form-control" value="{{ old('sum_pay') }}">
                                    @if($errors->has('sum_pay'))
                                        <span id="name-error" class="help-block">{{ $errors->first('sum_pay') }}</span>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_6" aria-expanded="false">
                                @lang('mposuccess::admin.sixth_structure') </a>
                        </h4>
                    </div>
                    <div id="collapse_6" class="panel-collapse collapse" aria-expanded="false" >
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
                <div class="margin-top-10">
                    <button type="submit" class="btn green-haze">
                        @lang('mposuccess::admin.settings.save_settings')
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END PROFILE CONTENT -->