<h1 class="page-header">Servers</h1>

<form class="form-horizontal" role="form" method="post">
    <repeat group="@servers" key="@key" value="@value">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-lg-6">
                <div class="input-group">
                    <check if="{{ @value['pid'] }}">
                        <true>
                            <span class="input-group-addon" style="width: 100px">{{ @value['pid'] }}</span>
                            <input type="text" class="form-control" value="{{ @key }}">
                            <span class="input-group-btn">
                                <button class="btn btn-default stop-server" type="button" name="{{ @value['pid'] }}">
                                    <span class="glyphicon glyphicon-stop"></span>
                                </button>
                            </span>
                        </true>
                        <false>
                            <span class="input-group-addon" style="width: 100px">&nbsp;</span>
                            <input type="text" class="form-control" value="{{ @key }}">
                            <span class="input-group-btn">
                                <button class="btn btn-default start-server" type="button" name="{{ @key }}">
                                    <span class="glyphicon glyphicon-play"></span>
                                </button>
                            </span>
                        </false>
                    </check>
                </div>
            </div>
        </div>
    </repeat>
</form>
