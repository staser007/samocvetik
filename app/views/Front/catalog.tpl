<div class="single">
    <div class="container">
        <repeat group="{{ @games }}" key="{{ @key }}" value="{{ @value }}">
            <div class="products">
                <h3>{{ @value.label }}</h3>
            </div>
            <div class="single-left">
                <img src="{{@BASE}}/image/game_kind_icon_{{ @key }}.jpg" alt="">
            </div>
            <div class="single-right async" id="shedule/{{ @key }}">
                Loading...
            </div>
            <div class="clearfix"> </div>
        </repeat>
    </div>
</div>