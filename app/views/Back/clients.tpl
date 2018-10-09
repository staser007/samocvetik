<form action="../../../index.php" method="post" class="clients_form">
    <div class="container">
        <div class="row">
            <p><b>УЧАСТНИКИ</b></p>
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>e-mail</th>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Номер квартиры</th>
                        <th>Дата регистрации собственности</th>
                        <th>Гос.номер автомобиля</th>
                        <th>Марка автомобиля</th>
                    </tr>
                    </thead>
                    <repeat group="{{@ClientsInfo}}" key="{{@key}}" value="{{@client}}">
                        <tr>
                            <td>{{@client['id']}}</td>
                            <td>{{@client['email']}}</td>
                            <td>{{@client['surname']}}</td>
                            <td>{{@client['name']}}</td>
                            <td>{{@client['patronymic']}}</td>
                            <td>{{@client['adress']}}</td>
                            <td>{{date("d-m-Y", strtotime(@client['reg_flat']))}}</td>
                            <td>{{@client['car_number']}}</td>
                            <td>{{@client['car']}}</td>
                        </tr>
                    </repeat>
                </table>
            </div>
        </div>
    </div>
</form>