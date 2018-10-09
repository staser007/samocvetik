<ul class="sub-nav">
    <repeat group="{{ @items }}" key="{{ @key }}" value="{{ @item }}">
        <li{{ isset(@item.items) ? ' class="plan active"' : '' }}>
            <a href="{{ @BASE }}/{{ @key }}.html">{{ @item.label }}</a>
            <include href="Front/submenu.tpl" if="{{ isset(@item.items)}}" with="items={{ @item.items }}" />
        </li>
    </repeat>
</ul>