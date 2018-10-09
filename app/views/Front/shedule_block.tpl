<table class="table shedule">
    <thead>
        <tr>
            <td>Команда 1</td>
            <td>Команда 2</td>
            <td>&nbsp;</td>
            <td>Статус</td>
        </tr>
    </thead>
    <tbody>
    <repeat group="{{ @meets }}" key="{{ @key }}" value="{{ @meet }}">
        <tr>
            <td><a href="{{ @BASE }}/games/{{ @meet.id }}/0" class="games">{{ @meet.club1 }} ({{ @meet.client1 }})</a></td>
            <td><a href="{{ @BASE }}/games/{{ @meet.id }}/1" class="games">{{ @meet.club2 }} ({{ @meet.client2 }})</a></td>
            <td>Время начала: {{ @meet.date }} ({{@meet.drawing}})</td>
            <td>Ожидает игроков</td>
        </tr>
    </repeat>
    </tbody>
</table>