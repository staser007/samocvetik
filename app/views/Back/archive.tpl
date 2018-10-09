{*<check if="{{isset(@GetAllChangesLot)}}">*}
    {*<true>*}
        {*<check if="{{count(@GetAllChangesLot) > 0}}">*}
            {*<true>*}
                {*<form action="archive.html" method="post" class="archive_detail_form">*}
                    {*<p><b>ПОДРОБНОСТИ АУКЦИОНА</b></p>*}
                    {*<div class="form-group">*}
                        {*<table class="table table-striped table-bordered table-hover table-condensed ">*}
                            {*<thead>*}
                            {*<tr>*}
                                {*<th>Лот</th>*}
                                {*<th>Начальная цена</th>*}
                                {*<th>Шаг торгов</th>*}
                                {*<th>Дата</th>*}
                                {*<th>Статус</th>*}
                                {*<th>Участник</th>*}
                                {*<th>Ставка</th>*}
                            {*</tr>*}
                            {*</thead>*}
                            {*<set number="{{@GetAllChangesLot[0]->number}}"></set>*}
                            {*<repeat group="{{@GetAllChangesLot}}" key="{{@key}}" value="{{@lot}}">*}
                                {*<check if="{{@lot->number != @number}}">*}
                                    {*<true>*}
                                        {*<tr>*}
                                            {*<td colspan="8">&nbsp;</td>*}
                                        {*</tr>*}
                                    {*</true>*}
                                {*</check>*}
                                {*<tr>*}
                                    {*<td align="center" name="id">{{@lot->lot}}</td>*}
                                    {*<td align="center" name="first_price">{{@lot->start_price}}</td>*}
                                    {*<td align="center" name="step">{{@lot->step}}</td>*}
                                    {*<td align="center" name="start_trading">{{date("d-m-Y H:i:s", @lot->opdate)}}</td>*}
                                    {*<td align="center" name="status">*}
                                        {*<check if="{{@lot->status == 0}}">*}
                                            {*<true>Закрыт</true>*}
                                            {*<false>Открыт</false>*}
                                        {*</check>*}
                                    {*</td>*}
                                    {*<td align="center" name="end_trading">{{@lot->user}}</td>*}
                                    {*<td align="center" name="status">{{@lot->end_price}}</td>*}
                                {*</tr>*}
                                {*<set number="{{@lot->number}}"></set>*}
                            {*</repeat>*}
                        {*</table>*}
                    {*</div>*}
                    {*<div class="form-group text-right">*}
                        {*<a href="{{@BASE}}/admin/archive.html" class="btn btn-default">Вернуться к списку лотов</a>*}
                    {*</div>*}
                {*</form>*}
            {*</true>*}
            {*<false>*}
                {*<div class="form-grouptext-right">*}
                    {*<p>*}
                    {*<h3><b>По указанному лоту торги отсутствуют!</b></h3></p>*}
                    {*<a href="{{@BASE}}/admin/archive.html" class="btn btn-default">Вернуться к списку лотов</a>*}
                {*</div>*}
            {*</false>*}
        {*</check>*}
    {*</true>*}
    {*<false>*}


        <form action="../../../index.php" method="post" class="archive_form">
            <p><b>ЗАКРЫТЫЕ АУКЦИОНЫ</b></p>
            <div class="form-group">
                <table class="table table-striped table-bordered table-hover table-condensed ">
                    <thead>
                    <tr>
                        <th>№ аукциона</th>
                        <th>Открытие аукциона</th>
                        <th>Закрытие аукциона</th>
                        <th>Статус</th>
                        <th>Начальная цена</th>
                        <th>Шаг торгов</th>
                        <th>Детали</th>
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
                            <td align="center"
                                name="start_trading">{{date("d-m-Y H:i:s", strtotime(@lot->start_trading))}}</td>
                            <td align="center"
                                name="end_trading">{{date("d-m-Y H:i:s", strtotime(@lot->end_trading))}}</td>
                            <td align="center" name="status">
                                <check if="{{@lot->status == 0}}">
                                    <true>Закрыт</true>
                                    <false>Открыт</false>
                                </check>
                                <input type="hidden" name="status_change"
                                       id="status_change" value="{{@lot->number}}">
                            </td>
                            <td align="center" name="first_price">{{@lot->first_price}}</td>
                            <td align="center" name="step">{{@lot->step}}</td>
                            <td align="center"><a href="../../../index.php" class="btn_details btn btn-link"
                                                  name="details"
                                                  value="Детали" id="id_{{@lot->number}}">Детали</a>
                        </tr>
                        <set number="{{@lot->number}}"></set>
                    </repeat>
                </table>
            </div>



            {*<p><b>ОТКРЫТЫЕ АУКЦИОНЫ</b></p>*}
            {*<div class="form-group">*}
                {*<table class="table table-striped table-bordered table-hover table-condensed ">*}
                    {*<thead>*}
                    {*<tr>*}
                        {*<th>Лот</th>*}
                        {*<th>Начальная цена</th>*}
                        {*<th>Шаг торгов</th>*}
                        {*<th>Открытие аукциона</th>*}
                        {*<th>Закрытие аукциона</th>*}
                        {*<th>Статус</th>*}
                        {*<th>Участник</th>*}
                        {*<th>Ставка</th>*}
                        {*<th>Детали</th>*}
                    {*</tr>*}
                    {*</thead>*}
                    {*<set number="{{@OpenedLots[0]->number}}"></set>*}
                    {*<repeat group="{{@OpenedLots}}" key="{{@key}}" value="{{@lot}}">*}
                        {*<check if="{{@lot->number != @number}}">*}
                            {*<true>*}
                                {*<tr>*}
                                    {*<td colspan="8">&nbsp;</td>*}
                                {*</tr>*}
                            {*</true>*}
                        {*</check>*}
                        {*<tr name="{{@lot->id}}" attr="">*}
                            {*<td align="center" name="id">{{@lot->id}}</td>*}
                            {*<td align="center" name="first_price">{{@lot->first_price}}</td>*}
                            {*<td align="center" name="step">{{@lot->step}}</td>*}
                            {*<td align="center" name="start_trading">{{date("d-m-Y H:i:s", strtotime(@lot->start_trading))}}</td>*}
                            {*<td align="center" name="end_trading">{{date("d-m-Y H:i:s", strtotime(@lot->end_trading))}}</td>*}
                            {*<td align="center" name="status">*}
                                {*<check if="{{@lot->status == 0}}">*}
                                    {*<true>Закрыт</true>*}
                                    {*<false>Открыт</false>*}
                                {*</check>*}
                            {*</td>*}
                            {*<td align="center" name="end_trading">{{@lot->bidder}}</td>*}
                            {*<td align="center" name="status">{{@lot->end_price}}</td>*}
                            {*<td align="center"><a href="archive.html?lot={{@lot->id}}" class="btn_details btn btn-link"*}
                                                  {*name="details"*}
                                                  {*value="Детали" id="lot_{{@lot->id}}">Детали</a>*}
                            {*</td>*}
                        {*</tr>*}
                        {*<set number="{{@lot->number}}"></set>*}
                    {*</repeat>*}
                {*</table>*}
            {*</div>*}
        </form>
    {*</false>*}
{*</check>*}