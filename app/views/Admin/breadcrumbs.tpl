<ol class="breadcrumb">
    <set count="{{ count(@breadcrumbs) }}"/>
    <loop from="{{ @i=0 }}" to="{{ @i < @count }}" step="{{ @i++ }}">
        <set piece="{{ each(@breadcrumbs[@i]) }}" />
        <check if="{{ @i < @count-1 }}">
            <true>
                <li>
                    <a href="{{ @piece.value }}">{{ @piece.key }}</a>
                </li>
            </true>
            <false>
                <li class="active">
                    <strong>{{ @piece.key }}</strong>
                </li>
            </false>
        </check>
    </loop>
</ol>