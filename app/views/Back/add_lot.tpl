<form action="../../../index.php" class="add_lot_form ajax_form">
    <p><b>СОЗДАТЬ НОВЫЙ АУКЦИОН</b></p>
    <div id="add_lot">
        <div class="form-group">
            <label for="PlaceNumber">Количество мест:</label>
            <input type="text" name="count" class="form-control" id="CountPlace1" placeholder="Укажите количество мест">
        </div>
        <div class="form-group">
            <label for="PriceStart">Начальная цена:</label>
            <input type="text" name="first_price" class="form-control" id="InputPrice1"
                   placeholder="Укажите начальную цену">
            <input type="hidden" name="end_price" class="form-control" id="EndPrice1">
        </div>
        <div class="form-group">
            <label for="PriceStep">Шаг торгов:</label>
            <input type="text" name="step" class="form-control" id="InputStep1" placeholder="Укажите шаг торгов">
        </div>
        {*<div class="form-group">*}
        {*<label for="OpenAuction">Открыть аукцион:</label>*}
        {*<input type="checkbox" name="status" id="InputOpenAuction1">*}
        {*</div>*}
        <div class="form-group">
            <label for="StartTrading">Начало аукциона:</label>
            <input type="text" name="start_trading" class="form-control" id="StartTrading1"
                   placeholder="дд-мм-гггг чч:мм">
        </div>
        <div class="form-group">
            <label for="EndTrading">Закрытие аукциона:</label>
            <input type="text" name="end_trading" class="form-control" id="EndTrading1" placeholder="дд-мм-гггг чч:ммм">
        </div>
        <a href="{{@BASE}}../../../../index.php" class="btn btn-danger">Отмена</a>
        <button type="button" class="btn btn-success btn_submit add_lots">Сохранить</button>
    </div>
</form>