<div id="document-template" class="print table-responsive" style="zoom: 100%">
    <link href="{{ asset('css/templates/documents/act.css') }}" rel="stylesheet">
    <TABLE style="width:100%; height:0px; " CELLSPACING=0>
        @for($i = 0; $i < 19; $i++)
            <COL WIDTH=21>
        @endfor
        @for($i = 0; $i < 3; $i++)
            <COL WIDTH=28>
        @endfor
        @for($i = 0; $i < 4; $i++)
            <COL WIDTH=25>
        @endfor
        @for($i = 0; $i < 7; $i++)
            <COL WIDTH=28>
        @endfor
        <COL>
        <TR CLASS=R0>
            @for($i = 0; $i < 34; $i++)
                <TD><SPAN></SPAN></TD>
            @endfor
            <TD>&nbsp;</TD>
        </TR>
        <TR CLASS=R1>
            @for($i = 0; $i < 34; $i++)
                <TD><DIV STYLE="position:relative; height:1px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            @endfor
            <TD><DIV STYLE="width:100%;height:1px;overflow:hidden;">&nbsp;</DIV></TD>
        </TR>
        <TR CLASS=R2>
            <TD><DIV STYLE="position:relative; height:28px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD CLASS="R2C1" COLSPAN=32><SPAN STYLE="white-space:nowrap;max-width:0px;">{{$data->header}}</SPAN></TD>
            <TD><DIV STYLE="position:relative; height:28px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD><DIV STYLE="width:100%;height:28px;overflow:hidden;"></DIV></TD>
        </TR>
        <TR>
            @for($i = 0; $i < 34; $i++)
                <TD><SPAN></SPAN></TD>
            @endfor
            <TD>&nbsp;</TD>
        </TR>
        <TR CLASS=R4>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R4C1" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0px;">Исполнитель:</SPAN></TD>
            <TD CLASS="R4C5" COLSPAN=28>{{$data->organization->performer}}</TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R5>
            @for($i = 0; $i < 34; $i++)
                <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            @endfor
            <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;">&nbsp;</DIV>
            </TD>
        </TR>
        <TR CLASS=R4>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R4C1" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0px;">Заказчик:</SPAN></TD>
            <TD CLASS="R4C5" COLSPAN=28>{{$data->contractor->customer}}</TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R5>
            @for($i = 0; $i < 34; $i++)
                <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            @endfor
            <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;">&nbsp;</DIV></TD>
        </TR>
            @foreach($data->pages as $key => $page)
                <TR CLASS=R0>
                    <TD><SPAN></SPAN></TD>
                    <TD CLASS="R8C1" COLSPAN=2 ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0px;">№</SPAN></TD>
                    <TD CLASS="R8C3" COLSPAN=17 ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0px;">Наименование&nbsp;работ,&nbsp;услуг</SPAN>
                    </TD>
                    <TD CLASS="R8C3" COLSPAN=3 ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0px;">Кол-во</SPAN></TD>
                    <TD CLASS="R8C3" COLSPAN=2 ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0px;">Ед.</SPAN></TD>
                    <TD CLASS="R8C3" COLSPAN=4 ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0px;">Цена</SPAN></TD>
                    <TD CLASS="R8C29" COLSPAN=4 ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0px;">Сумма</SPAN></TD>
                    <TD><SPAN></SPAN></TD>
                    <TD></TD>
                </TR>
                <TR CLASS=R0>
                    <TD><SPAN></SPAN></TD>
                    <TD><SPAN></SPAN></TD>
                    <TD>&nbsp;</TD>
                </TR>
                @foreach($page['production'] as $productKey => $product)
                <TR CLASS=R10>
                    <TD><SPAN></SPAN></TD>
                    <TD CLASS="R10C1" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0px;">{{$productKey}}</SPAN></TD>
                    <TD CLASS="R10C3" COLSPAN=17>{{$product->name}}</TD>
                    <TD CLASS="R10C20" COLSPAN=3><SPAN STYLE="white-space:nowrap;max-width:0px;">{{$product->quantity}}</SPAN></TD>
                    <TD CLASS="R10C23" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0px;">{{$product->okei->symbol}}</SPAN></TD>
                    <TD CLASS="R10C20" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0px;">{{$product->price}}</SPAN></TD>
                    <TD CLASS="R10C29" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0px;">{{$product->sum}}</SPAN></TD>
                    <TD><SPAN></SPAN></TD>
                    <TD></TD>
                </TR>
                @endforeach
                <TR CLASS=R5>
                    <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
                    @for($i = 0; $i < 32; $i++)
                        <TD CLASS="R11C1"><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
                    @endfor
                    <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
                    <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;">&nbsp;</DIV></TD>
                </TR>
                @if(array_key_last($data->pages) === $key)
                <TR CLASS=R4>
                    <TD CLASS="R12C28" COLSPAN=29><SPAN STYLE="white-space:nowrap;max-width:0px;">Итого:</SPAN></TD>
                    <TD CLASS="R12C28" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0px;">{{$page['total']['sum']}}</SPAN></TD>
                    <TD><SPAN></SPAN></TD>
                    <TD></TD>
                </TR>
                <TR CLASS=R4>
                    <TD CLASS="R12C28" COLSPAN=29><SPAN
                            STYLE="white-space:nowrap;max-width:0px;">В&nbsp;том&nbsp;числе&nbsp;НДС</SPAN></TD>
                    <TD CLASS="R12C28" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0px;">{{$page['total']['sum_nds']}}</SPAN></TD>
                    <TD><SPAN></SPAN></TD>
                    <TD></TD>
                </TR>
                <TR CLASS=R5>
                    @for($i = 0; $i < 34; $i++)
                        <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
                    @endfor
                    <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;">&nbsp;</DIV></TD>
                </TR>
                <TR CLASS=R0>
                    <TD><SPAN></SPAN></TD>
                    <TD CLASS="R15C1" COLSPAN=32><SPAN STYLE="white-space:nowrap;max-width:0px;">Всего&nbsp;оказано&nbsp;услуг&nbsp;{{count($page['production'])}},&nbsp;на&nbsp;сумму&nbsp;{{$data->total['sum']}} руб</SPAN>
                    </TD>
                    <TD><SPAN></SPAN></TD>
                    <TD></TD>
                </TR>
                <TR CLASS=R4>
                    <TD><SPAN></SPAN></TD>
                    <TD CLASS="R4C5" COLSPAN=32>{{$data->total_sum}}</TD>
                    <TD><SPAN></SPAN></TD>
                    <TD></TD>
                </TR>
                <TR>
                    @for($i = 0; $i < 34; $i++)
                        <TD><SPAN></SPAN></TD>
                    @endfor
                    <TD>&nbsp;</TD>
                </TR>
                <TR CLASS=R0>
                    <TD><SPAN></SPAN></TD>
                    <TD CLASS="R18C1" COLSPAN=32 ROWSPAN=2>Вышеперечисленные услуги выполнены полностью и в срок. Заказчик
                        претензий по объему, качеству и срокам оказания услуг не имеет.
                    </TD>
                    <TD><SPAN></SPAN></TD>
                    <TD></TD>
                </TR>
                <TR CLASS=R19>
                    <TD><DIV STYLE="position:relative; height:19px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
                    <TD><DIV STYLE="position:relative; height:19px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
                    <TD><DIV STYLE="width:100%;height:19px;overflow:hidden;">&nbsp;</DIV></TD>
                </TR>
                <TR CLASS=R5>
                    <TD>
                        <DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV>
                    </TD>
                    @for($i = 0; $i < 32; $i++)
                        <TD CLASS="R20C1"><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
                    @endfor
                    <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
                    <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;">&nbsp;</DIV></TD>
                </TR>
                <TR>
                    @for($i = 0; $i < 32; $i++)
                        <TD><SPAN></SPAN></TD>
                    @endfor
                    <TD>&nbsp;</TD>
                </TR>
                <TR CLASS=R4>
                    <TD CLASS="R22C4" COLSPAN=5><SPAN STYLE="white-space:nowrap;max-width:0px;">Исполнитель</SPAN></TD>
                    <TD CLASS="R22C5"><SPAN></SPAN></TD>
                    <TD CLASS="R22C5"><SPAN></SPAN></TD>
                    <TD CLASS="R22C5"><SPAN></SPAN></TD>
                    <TD CLASS="R22C5"><SPAN></SPAN></TD>
                    <TD CLASS="R22C5" COLSPAN=7><SPAN></SPAN></TD>
                    <TD><SPAN></SPAN></TD>
                    <TD CLASS="R22C17" COLSPAN=3><SPAN STYLE="white-space:nowrap;max-width:0px;">Заказчик</SPAN></TD>
                    <TD CLASS="R22C5"><SPAN></SPAN></TD>
                    <TD CLASS="R22C5"><SPAN></SPAN></TD>
                    <TD CLASS="R22C5"><SPAN></SPAN></TD>
                    <TD CLASS="R22C5"><SPAN></SPAN></TD>
                    <TD CLASS="R22C5"><SPAN></SPAN></TD>
                    <TD CLASS="R22C5" COLSPAN=7><SPAN></SPAN></TD>
                    <TD CLASS="R22C32"><SPAN></SPAN></TD>
                    <TD><SPAN></SPAN></TD>
                    <TD></TD>
                </TR>
                @endif
            @endforeach
    </TABLE>
</div>
