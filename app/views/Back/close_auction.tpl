<form action="../../../index.php" method="post" class="close_auction_form">
    <p><b>ЗАКРЫТЬ АУКЦИОН</b></p>
    <div class="form-group">
        <table class="table table-striped table-bordered table-hover table-condensed ">
            <thead>
            <tr>
                <th>№ аукциона</th>
                <th>Начальная цена</th>
                <th>Шаг торгов</th>
                <th>Открытие аукциона</th>
                <th>Закрытие аукциона</th>
                <th>Текущая цена</th>
                <th>Пользователь</th>
                <th>Статус</th>
                <th>Закрыть <input type="checkbox" id="total"></th>
            </tr>
            </thead>
            <set number="{{@OpenedLots[0]->number}}"></set>
            <repeat group="{{@OpenedLots}}" key="{{@key}}" value="{{@lot}}">
                <check if="{{@lot->number != @number}}">
                    <true>
                        <tr>
                            <td colspan="8">&nbsp;</td>
                        </tr>
                    </true>
                </check>
                <tr>
                    <td align="center" name="id">{{@lot->number}}</td>
                    <td align="center" name="first_price">{{@lot->first_price}}</td>
                    <td align="center" name="step">{{@lot->step}}</td>
                    <td align="center" name="start_trading">{{date("d-m-Y H:i:s", strtotime(@lot->start_trading))}}</td>
                    <td align="center" name="end_trading">{{date("d-m-Y H:i:s", strtotime(@lot->end_trading))}}</td>
                    <td align="center" name="end_price">{{@lot->end_price}}</td>
                    <td align="center" name="bidder">{{@lot->bidder}}</td>
                    <td align="center" name="status">
                        <check if="{{@lot->status == 0}}">
                            <true>Закрыт</true>
                            <false>Открыт</false>
                        </check>
                    </td>
                    <td align="center"><input type="checkbox" class="check" name="status_change[]" value="{{@lot->number}}">
                    </td>
                </tr>
                <set number="{{@lot->number}}"></set>
            </repeat>
        </table>
    </div>
    <div class="form-group">
        <check if="{{sizeof(@OpenedLots) > 0}}">
            <true><input type="button" value="Сохранить" class="btn btn-success close_auction_btn"></true>
        </check>
    </div>
</form>


{*<div class="form-group">*}
{*<table class="table table-striped table-bordered table-hover table-condensed ">*}
{*<thead>*}
{*<tr>*}
{*<th>№ аукциона</th>*}
{*<th>Начальная цена</th>*}
{*<th>Шаг торгов</th>*}
{*<th>Открытие аукциона</th>*}
{*<th>Закрытие аукциона</th>*}
{*<th>Статус</th>*}
{*</tr>*}
{*</thead>*}
{*<check if="{{sizeof(@OpenedLots) > 0}}">*}
{*<true>*}
{*<tr>*}
{*<td align="center" name="id">{{@OpenedLots[0]->number}}</td>*}
{*<td align="center" name="first_price">{{@OpenedLots[0]->first_price}}</td>*}
{*<td align="center" name="step">{{@OpenedLots[0]->step}}</td>*}
{*<td align="center"*}
{*name="start_trading">{{date("d-m-Y H:i:s", strtotime(@OpenedLots[0]->start_trading))}}</td>*}
{*<td align="center"*}
{*name="end_trading">{{date("d-m-Y H:i:s", strtotime(@OpenedLots[0]->end_trading))}}</td>*}
{*<td align="center" name="status">*}
{*<check if="{{@OpenedLots[0]->status == 0}}">*}
{*<true>Закрыт</true>*}
{*<false>Открыт</false>*}
{*</check>*}
{*<input type="hidden" name="status_change"*}
{*id="status_change" value="{{@OpenedLots[0]->number}}">*}
{*</td>*}
{*</tr>*}
{*</true>*}
{*</check>*}
{*</table>*}
{*</div>*}
{*<div class="form-group">*}
{*<check if="{{sizeof(@OpenedLots) > 0}}">*}
{*<true><input type="button" value="Закрыть" class="btn btn-success open_auction_btn"></true>*}
{*</check>*}
{*</div>*}