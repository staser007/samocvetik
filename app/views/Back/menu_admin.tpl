<div name="menu">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    {*<a href="{{@BASE}}/admin/current_auction.html" class="btn btn-default">Текущий аукцион</a>*}
                    {*<a href="{{@BASE}}/admin/open_auction.html" class="btn btn-default">Открыть аукцион</a>*}
                    {*<a href="{{@BASE}}/admin/close_auction.html" class="btn btn-default">Закрыть аукцион</a>*}
                    {*<a href="{{@BASE}}/admin/add_lot.html" class="btn btn-default">Добавить лот</a>*}
                    {*<a href="{{@BASE}}/admin/archive.html" class="btn btn-default">Архив</a>*}
                    {*<a href="{{@BASE}}/lk.html" class="btn btn-default">Главное меню</a>*}
                    <repeat group="{{@output.menu}}" key="{{@key}}" value="{{@value}}">
                        <a href="{{@BASE}}/admin/{{@key}}.html"
                           class="btn btn-default{{(@key==@output.action) ? ' active' : ''}}">{{@value}}</a>
                    </repeat>
                    <a href="{{@BASE}}/" class="btn btn-default">Главное меню</a>
                </div>
            </div>
        </div>
    </div>
</div>