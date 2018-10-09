<div class="single">
    <div class="container">
        <div class="products">
            <h3>Регистрация</h3>
        </div>
        <form action="ajax/register" method="GET" class="form-horizontal form-ajax" id="regform">
            <div class="form-group">
                <label for="reg_name" class="col-sm-4 control-label">Name:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="reg_name" name="reg_name" placeholder="Name">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="reg_email" class="col-sm-4 control-label">Email:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="reg_email" name="reg_email" placeholder="Email">
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked="checked" id="reg_majority" name="reg_majority"> мне есть 18 лет
                        </label>
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-6">
                    <button type="submit" class="btn btn-default">Регистрация</button>
                </div>
            </div>
        </form>
    </div>
</div>
