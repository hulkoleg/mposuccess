    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-editable/inputs-ext/address/address.css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box grey-cascade">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>Новости
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a class="btn green" href="/panel/admin/news/add" data-target="#ajax" data-toggle="modal">
                                        @lang('mposuccess::panel.news.add') <i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="table_news">
                        <thead>
                        <tr>
                            <th class="table-checkbox">
                                <input type="checkbox" class="group-checkable" data-set="#table_news .checkboxes"/>
                            </th>
                            <th>
                                @lang('mposuccess::panel.news.name')
                            </th>
                            <th>
                                @lang('mposuccess::panel.news.content')
                            </th>
                            <th>
                                @lang('mposuccess::panel.news.type.added')
                            </th>
                            <th>
                                @lang('mposuccess::panel.news.type.edited')
                            </th>
                            <th>
                                @lang('mposuccess::panel.news.type.title')
                            </th>
                            <th>
                                @lang('mposuccess::panel.news.status.title')
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($news as $item)
                                <tr class="odd gradeX">
                                    <td>
                                        <input type="checkbox" class="checkboxes" value="1"/>
                                    </td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ substr(strip_tags($item->preview), 0, 100) }}..
                                    </td>
                                    <td class="center" align="center">
                                        {{ date_format(date_create($item->created_at), 'd M Y H:i') }}
                                    </td>
                                    <td class="center" align="center">
                                        {{ date_format(date_create($item->updated_at), 'd M Y H:i') }}
                                    </td>
                                    <td align="center">
                                        @if($item->type == config('mposuccess.news_type_private'))
                                            <span class="label label-sm label-danger">
                                                @lang('mposuccess::panel.news.type.private') </span>
                                        @elseif($item->type == config('mposuccess.news_type_company'))
                                            <span class="label label-sm label-info">
                                                @lang('mposuccess::panel.news.type.company') </span>
                                        @elseif($item->type == config('mposuccess.news_type_world'))
                                            <span class="label label-sm label-warning">
                                                @lang('mposuccess::panel.news.type.world') </span>
                                        @else
                                            <span class="label label-sm label-default">
                                                @lang('mposuccess::panel.news.type.unknown') </span>
                                        @endif
                                    </td>
                                    <td align="center">
                                        @if($item->display)
                                            <span class="label label-sm label-success">
                                                @lang('mposuccess::panel.news.status.displayed') </span>
                                        @else
                                            <span class="label label-sm label-warning">
                                                @lang('mposuccess::panel.news.status.hidden') </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <!--DOC: Aplly "modal-cached" class after "modal" class to enable ajax content caching-->
    <div class="modal fade" id="ajax" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="../../assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
											<span>
											&nbsp;&nbsp;Loading... </span>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->


    <div class="row">
        <div class="col-md-12">
            <table id="user" class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <td style="width:15%">
                        @lang('mposuccess::panel.news.name')
                    </td>
                    <td style="width:50%">
                        <a href="javascript:;" id="username" data-type="text" data-pk="1"  data-placeholder="Required" data-original-title="Enter @lang('mposuccess::panel.news.name')">
                        </a>
                    </td>
                    <td style="width:35%">
							<span class="text-muted">
							Simple text field </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        @lang('mposuccess::panel.news.status.title')
                    </td>
                    <td>
                        <a href="javascript:;" id="status" data-type="select" data-pk="1" data-value="1" data-original-title="Select sex">
                        </a>
                    </td>
                    <td>
							<span class="text-muted">
							Select, loaded from js array. Custom display </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Group
                    </td>
                    <td>
                        <a href="javascript:;" id="group" data-type="select" data-pk="1" data-value="5" data-source="/groups" data-original-title="Select group">
                            Admin </a>
                    </td>
                    <td>
							<span class="text-muted">
							Select, loaded from server. <strong>No buttons</strong> mode </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Plan vacation?
                    </td>
                    <td>
                        <a href="javascript:;" id="vacation" data-type="date" data-viewformat="dd.mm.yyyy" data-pk="1" data-placement="right" data-original-title="When you want vacation to start?">
                            25.02.2013 </a>
                    </td>
                    <td>
							<span class="text-muted">
							Datepicker </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Date of birth
                    </td>
                    <td>
                        <a href="javascript:;" id="dob" data-type="combodate" data-value="1984-05-15" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1" data-original-title="Select Date of birth">
                        </a>
                    </td>
                    <td>
							<span class="text-muted">
							Date field (combodate) </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Setup event
                    </td>
                    <td>
                        <a href="javascript:;" id="event" data-type="combodate" data-template="D MMM YYYY HH:mm" data-format="YYYY-MM-DD HH:mm" data-viewformat="MMM D, YYYY, HH:mm" data-pk="1" data-original-title="Setup event date and time">
                        </a>
                    </td>
                    <td>
							<span class="text-muted">
							Datetime field (combodate) </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Meeting start
                    </td>
                    <td>
                        <a href="javascript:;" id="meeting_start" data-type="datetime" data-pk="1" data-url="/post" data-placement="right" title="Set date & time">
                            15/03/2013 12:45 </a>
                    </td>
                    <td>
							<span class="text-muted">
							Bootstrap datetime </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Comments
                    </td>
                    <td>
                        <a href="javascript:;" id="comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-original-title="Enter comments">awesome<br>
                            user!</a>
                    </td>
                    <td>
							<span class="text-muted">
							Textarea. Buttons below. Submit by <i>ctrl+enter</i>
							</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Type State
                    </td>
                    <td>
                        <a href="javascript:;" id="state" data-type="typeahead" data-pk="1" data-placement="right" data-original-title="Start typing State..">
                        </a>
                    </td>
                    <td>
							<span class="text-muted">
							Bootstrap 2.x typeahead </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Fresh fruits
                    </td>
                    <td>
                        <a href="javascript:;" id="fruits" data-type="checklist" data-value="2,3" data-original-title="Select fruits">
                        </a>
                    </td>
                    <td>
							<span class="text-muted">
							Checklist </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Tags
                    </td>
                    <td>
                        <a href="javascript:;" id="tags" data-type="select2" data-pk="1" data-original-title="Enter tags">
                            html, javascript </a>
                    </td>
                    <td>
							<span class="text-muted">
							Select2 (tags mode) </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Country
                    </td>
                    <td>
                        <a href="javascript:;" id="country" data-type="select2" data-pk="1" data-value="BS" data-original-title="Select country">
                        </a>
                    </td>
                    <td>
							<span class="text-muted">
							Select2 (dropdown mode) </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Address
                    </td>
                    <td>
                        <a href="javascript:;" id="address" data-type="address" data-pk="1" data-original-title="Please, fill address">
                        </a>
                    </td>
                    <td>
							<span class="text-muted">
							Your custom input, several fields </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Notes
                    </td>
                    <td>
                        <div id="note" data-pk="1" data-type="wysihtml5" data-toggle="manual" data-original-title="Enter notes">
                            <h3>WYSIWYG</h3>
                            WYSIWYG means <i>What You See Is What You Get</i>.<br>
                            But may also refer to:
                            <ul>
                                <li>
                                    WYSIWYG (album), a 2000 album by Chumbawamba
                                </li>
                                <li>
                                    "Whatcha See is Whatcha Get", a 1971 song by The Dramatics
                                </li>
                                <li>
                                    WYSIWYG Film Festival, an annual Christian film festival
                                </li>
                            </ul>
                            <i>Source:</i>
                            <a href="http://en.wikipedia.org/wiki/WYSIWYG_%28disambiguation%29">
                                wikipedia.org </a>
                        </div>
                    </td>
                    <td>
                        <a href="javascript:;" id="pencil">
                            <i class="fa fa-pencil"></i> [edit] </a>
                        <br>
							<span class="text-muted">
							Wysihtml5 (bootstrap only).<br>
							 Toggle by another element </span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

