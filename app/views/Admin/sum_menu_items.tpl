<ul class="nav nav-second-level collapse">
    <repeat group="{{@items}}" key="{{@key}}" value="{{@item}}">
        <set href="{{ isset(@item.href) ? @item.href : @BASE.'/admin/'.@item.name }}" sub_items="{{ isset(@item.items ) }}" />
        <li{{ @PARAMS.action==@item.name ? ' class="active"':'' }}><a href="{{@href}}">{{@item.label}}</a></li>
        <include href="Admin/sum_menu_items.tpl" if="{{@sub_items}}" with="items={{@item.items}} "/>
    </repeat>
</ul>