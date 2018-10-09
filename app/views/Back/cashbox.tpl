<form action="../../../index.php" method="post" class="pay_auction_form">
    <p><b>ЗАКРЫТЫЕ АУКЦИОНЫ</b></p>
    <div class="form-group">
        <table class="table table-striped table-bordered table-hover table-condensed ">
            <thead>
            <tr>
                <th>Лот</th>
                {*<th>Начальная цена</th>*}
                {*<th>Шаг торгов</th>*}
                <th>Открытие аукциона</th>
                <th>Закрытие аукциона</th>
                {*<th>Статус</th>*}
                <th>Квартира</th>
                <th>ФИО</th>
                <th>Цена</th>
                <th>Оплата <input type="checkbox" id="total"></th>
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
                    <td align="center" name="id">{{@lot->id}}</td>
                    {*<td align="center" name="first_price">{{@lot->first_price}}</td>*}
                    {*<td align="center" name="step">{{@lot->step}}</td>*}
                    <td align="center" name="start_trading">{{date("d-m-Y H:i:s", strtotime(@lot->start_trading))}}</td>
                    <td align="center" name="end_trading">{{date("d-m-Y H:i:s", strtotime(@lot->end_trading))}}</td>
                    {*<td align="center" name="status_pay">*}
                        {*<check if="{{@lot->status == 0}}">*}
                            {*<true>Закрыт</true>*}
                            {*<false>Открыт</false>*}
                        {*</check>*}
                    {*</td>*}
                    <td align="center">{{Controller::ViewRender("adress", @lot->bidder)}}</td>
                    <td align="center">{{Controller::ViewRender("fio", @lot->bidder)}}</td>
                    <td align="center">{{@lot->end_price}}</td>
                    <td align="center"><input type="checkbox" class="check" name="status_pay[{{@lot->id}}]"
                                              value="1" {{(@lot->payed == 1) ? 'checked="checked"' : ''}}>
                        <input type="hidden" name="all_id[{{@lot->id}}]" value="{{@lot->payed}}">
                        <set ids="{{@ids.@lot->id.','}}"></set>
                    </td>
                </tr>
                <set number="{{@lot->number}}"></set>
            </repeat>
        </table>
    </div>
    <div class="form-group">
        <check if="{{sizeof(@ClosedLots) > 0}}">
            <true><input type="button" value="Сохранить" class="btn btn-success pay_auction_btn"></true>
        </check>
    </div>
</form>