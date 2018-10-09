<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>{{ @content_header }}</h2>
        <include if="{{ isset(@breadcrumbs) }}" href="Admin/breadcrumbs.tpl" />
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-5">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="input-group">
                        <input type="text" placeholder="Search client " class="input form-control">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                        </span>
                    </div>
                    <div class="clients-list">
                        <div class="tab-pane">
                            <div class="full-height-scroll">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                        <loop from="{{ @i=0 }}" to="{{ !@users_list->dry() }}" step="{{ @users_list->next() && @i++ }}">
                                            <tr>
                                                <td class="client-avatar"><img alt="image" src="{{@BASE}}/img/a2.jpg"> </td>
                                                <td><a data-toggle="tab" href="#contact-{{@users_list->id}}" class="client-link">{{ @users_list->label_name() }}</a></td>
                                                <td> {{ implode(',', @users_list->roles) }}</td>
                                                <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                                <td> {{ @users_list->email }}</td>
                                                <td class="client-status"><span class="label label-primary">Active</span></td>
                                            </tr>
                                        </loop>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="tab-content">
                        <loop from="{{ @i=@users_list->first() }}" to="{{ !@users_list->dry() }}" step="{{ @users_list->next() && @i++ }}">
                            <include href="Admin/user_details.tpl" with="user={{@users_list}}" />
                        </loop>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<include href="Admin/footer.tpl"/>