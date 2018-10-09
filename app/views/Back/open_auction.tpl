{*{{var_dump(@ClosedLots)}}*}
<form action="../../../index.php" method="post" class="open_auction_form">
    <p><b>ОТКРЫТЬ АУКЦИОН</b></p>
    <div class="form-group">
        <table class="table table-striped table-bordered table-hover table-condensed ">
            <thead>
            <tr>
                <th>№ аукциона</th>
                <th>Начальная цена</th>
                <th>Шаг торгов</th>
                <th>Открытие аукциона</th>
                <th>Закрытие аукциона</th>
                <th>Статус</th>
                <check if="{{sizeof(@OpenedLots) == 0}}">
                    <th>Открыть</th>
                </check>
            </tr>
            </thead>
            <set number="{{@ClosedLots[0]->number}}"></set>
            <repeat group="{{@ClosedLots}}" key="{{@key}}" value="{{@lot}}">
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
                    <td align="center" name="status">
                        <check if="{{@lot->status == 0}}">
                            <true>Закрыт</true>
                            <false>Открыт</false>
                        </check>
                    </td>
                    <check if="{{sizeof(@OpenedLots) == 0}}">
                        <td align="center"><input type="radio" class="check" name="status_change[]"
                                                  value="{{@lot->number}} " >
                        </td>
                    </check>
                </tr>
                <set number="{{@lot->number}}"></set>
            </repeat>
        </table>
    </div>
    <div class="form-group">
        <check if="{{sizeof(@OpenedLots) == 0}}">
            <true><input type="button" value="Открыть" class="btn btn-success open_auction_btn"></true>
        </check>
    </div>
</form>


{*<table class="table table-striped table-bordered table-hover table-condensed ">*}
{*<thead>*}
{*<tr>*}
{*<th>№ аукциона</th>*}
{*<th>Начальная цена</th>*}
{*<th>Шаг торгов</th>*}
{*<th>Открытие аукциона</th>*}
{*<th>Закрытие аукциона</th>*}
{*<th>Статус</th>*}
{*<check if="{{sizeof(@ClosedLots) > 0 && sizeof(@OpenedLots) == 0}}">*}
{*<th>Открыть <input type="checkbox" id="total" checked disabled></th>*}
{*</check>*}
{*</tr>*}
{*</thead>*}
{*<check if="{{sizeof(@ClosedLots) > 0 && sizeof(@OpenedLots) == 0}}">*}
{*<true>*}
{*<set number="{{@ClosedLots[0]->number}}"></set>*}
{*<repeat group="{{@ClosedLots}}" key="{{@key}}" value="{{@lot}}">*}
{*{{var_dump(@lot->number)}}*}
{*<check if="{{@lot->number != @number}}">*}
{*<true>*}
{*<tr>*}
{*<td colspan="8">&nbsp;</td>*}
{*</tr>*}
{*</true>*}
{*</check>*}
{*<tr>*}
{*<td align="center" name="id">{{@lot->number}}</td>*}
{*<td align="center" name="first_price">{{@lot->first_price}}</td>*}
{*<td align="center" name="step">{{@lot->step}}</td>*}
{*<td align="center"*}
{*name="start_trading">{{date("d-m-Y H:i:s", strtotime(@lot->start_trading))}}</td>*}
{*<td align="center"*}
{*name="end_trading">{{date("d-m-Y H:i:s", strtotime(@lot->end_trading))}}</td>*}
{*<td align="center" name="status">*}
{*<check if="{{@lot->status == 0}}">*}
{*<true>Закрыт</true>*}
{*<false>Открыт</false>*}
{*</check>*}
{*<input type="hidden" name="status_change"*}
{*id="status_change" value="{{@lot->number}}">*}
{*</td>*}
{*<check if="{{sizeof(@ClosedLots) > 0 && sizeof(@OpenedLots) == 0}}">*}
{*<td align="center"><input type="checkbox" class="check" name="status_change"*}
{*id="status_change" value="{{@lot->number}} " checked*}
{*disabled>*}
{*</td>*}
{*</check>*}
{*</tr>*}
{*</true>*}
{*</check>*}
{*<set number="{{@lot->number}}"></set>*}
{*</repeat>*}
{*</table>*}