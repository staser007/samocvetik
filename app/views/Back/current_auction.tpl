<form action="../../../index.php" method="post" class="open_auction_form">
    <p><b>ТЕКУЩИЙ АУКЦИОН</b></p>
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
                <th>ID участника</th>
                <th>Ставка</th>
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
                    <td align="center" name="status">
                        <check if="{{@lot->status == 0}}">
                            <true>Закрыт</true>
                            <false>Открыт</false>
                        </check>
                    </td>
                    <td align="center" name="end_trading">{{@lot->bidder}}</td>
                    <td align="center" name="status">{{@lot->end_price}}</td>
                </tr>
                <set number="{{@lot->number}}"></set>
            </repeat>
        </table>
    </div>
</form>