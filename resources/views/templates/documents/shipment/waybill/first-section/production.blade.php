@foreach($data->pages as $key => $page)
    <TABLE style="width:100%; height:0; " CELLSPACING=0>
        <COL WIDTH=7>
        <COL WIDTH=78>
        <COL WIDTH=77>
        <COL WIDTH=75>
        <COL WIDTH=66>
        <COL WIDTH=74>
        <COL WIDTH=189>
        <COL WIDTH=61>
        <COL WIDTH=70>
        <COL WIDTH=63>
        <COL WIDTH=64>
        <COL WIDTH=84>
        <COL WIDTH=143>
        <COL>

        @if(count($data->pages) > 1)
            <TR CLASS=R12>
                <TD CLASS="R12C12" COLSPAN=13>
                    <SPAN STYLE="white-space:nowrap;max-width:0;">Страница&nbsp;{{$key + 1}}
                    </SPAN>
                </TD>
                <TD><SPAN></SPAN></TD>
                <TD></TD>
            </TR>
        @endif

        <TR CLASS=R13>
            <TD><DIV STYLE="position:relative; height:56px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD CLASS="R13C1">Код продукции (номенклатур- ный номер)</TD>
            <TD CLASS="R13C1">Номер прейскуранта и дополнения к нему</TD>
            <TD CLASS="R13C1">Артикул или номер по прейскуранту</TD>
            <TD CLASS="R13C1">Коли- чество</TD>
            <TD CLASS="R13C1">Цена руб. коп.</TD>
            <TD CLASS="R13C1">Наименование продукции, товара (груза), ТУ, марка, размер, сорт</TD>
            <TD CLASS="R13C1">Единица измерения</TD>
            <TD CLASS="R13C1">Вид упаковки</TD>
            <TD CLASS="R13C1">Коли- чество мест</TD>
            <TD CLASS="R13C1">Масса, т</TD>
            <TD CLASS="R13C1">Сумма, руб. коп.</TD>
            <TD CLASS="R13C1">Порядковый номер за- писи по складской кар- тотеке (грузоотправи- телю, грузополучателю)</TD>
            <TD><DIV STYLE="position:relative; height:56px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD><DIV STYLE="width:100%;height:56px;overflow:hidden;"></DIV></TD>
        </TR>
        <TR CLASS=R14>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R14C1"><SPAN STYLE="white-space:nowrap;max-width:0;">1</SPAN></TD>
            <TD CLASS="R14C1"><SPAN STYLE="white-space:nowrap;max-width:0;">2</SPAN></TD>
            <TD CLASS="R14C1"><SPAN STYLE="white-space:nowrap;max-width:0;">3</SPAN></TD>
            <TD CLASS="R14C1"><SPAN STYLE="white-space:nowrap;max-width:0;">4</SPAN></TD>
            <TD CLASS="R14C1"><SPAN STYLE="white-space:nowrap;max-width:0;">5</SPAN></TD>
            <TD CLASS="R14C1"><SPAN STYLE="white-space:nowrap;max-width:0;">6</SPAN></TD>
            <TD CLASS="R14C1"><SPAN STYLE="white-space:nowrap;max-width:0;">7</SPAN></TD>
            <TD CLASS="R14C1"><SPAN STYLE="white-space:nowrap;max-width:0;">8</SPAN></TD>
            <TD CLASS="R14C1"><SPAN STYLE="white-space:nowrap;max-width:0;">9</SPAN></TD>
            <TD CLASS="R14C1"><SPAN STYLE="white-space:nowrap;max-width:0;">10</SPAN></TD>
            <TD CLASS="R14C1"><SPAN STYLE="white-space:nowrap;max-width:0;">11</SPAN></TD>
            <TD CLASS="R14C1"><SPAN STYLE="white-space:nowrap;max-width:0;">12</SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>

        @foreach($page['production'] as $productKey => $product)
            <TR CLASS=R15>
                <TD><DIV STYLE="position:relative; height:27px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
                <TD CLASS="R15C1"><DIV STYLE="position:relative; height:27px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
                <TD CLASS="R15C1"><DIV STYLE="position:relative; height:27px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
                <TD CLASS="R15C3"></TD>
                <TD CLASS="R15C4">{{$product->quantity}}&nbsp;</TD>
                <TD CLASS="R15C4">{{$product->price_without_nds}}&nbsp;</TD>
                <TD CLASS="R15C3">{{$product->full_name}}&nbsp;</TD>
                <TD CLASS="R15C7">{{$product->okei->symbol}}&nbsp;</TD>
                <TD CLASS="R15C7">{{$product->okei->unit}}&nbsp;</TD>
                <TD CLASS="R15C4">{{$product->count_places}}&nbsp;</TD>
                <TD CLASS="R15C4"><DIV STYLE="position:relative; height:27px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
                <TD CLASS="R15C4">{{$product->sum}}&nbsp;</TD>
                <TD CLASS="R15C12"><DIV STYLE="position:relative; height:27px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
                <TD><DIV STYLE="position:relative; height:27px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
                <TD><DIV STYLE="width:100%;height:27px;overflow:hidden;"></DIV></TD>
            </TR>
        @endforeach

        <TR CLASS=R12>
            <TD CLASS="R16C0"><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R16C2"><SPAN></SPAN></TD>
            <TD CLASS="R16C3"><SPAN STYLE="white-space:nowrap;max-width:0;">Итого</SPAN></TD>
            <TD CLASS="R16C4"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$page['total']['quantity']}}&nbsp;</SPAN></TD>
            <TD CLASS="R16C5"><SPAN></SPAN></TD>
            <TD CLASS="R16C4"><SPAN></SPAN></TD>
            <TD CLASS="R16C4"><SPAN></SPAN></TD>
            <TD CLASS="R16C4"><SPAN></SPAN></TD>
            <TD CLASS="R16C9"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$page['total']['count_places']}}&nbsp;</SPAN></TD>
            <TD CLASS="R16C4"><SPAN></SPAN></TD>
            <TD CLASS="R16C11"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$page['total']['sum']}}&nbsp;</SPAN></TD>
            <TD CLASS="R16C12"><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>

        @if(array_key_last($data->pages) === $key)
            <TR CLASS=R12>
                <TD CLASS="R17C3" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">Всего&nbsp;по&nbsp;накладной&nbsp;&nbsp;</SPAN></TD>
                <TD CLASS="R17C4"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->total['quantity']}}&nbsp;</SPAN></TD>
                <TD CLASS="R16C12"><SPAN></SPAN></TD>
                <TD CLASS="R16C12"><SPAN></SPAN></TD>
                <TD CLASS="R17C7"><SPAN></SPAN></TD>
                <TD CLASS="R16C4"><SPAN></SPAN></TD>
                <TD CLASS="R16C5"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->total['count_places']}}&nbsp;</SPAN></TD>
                <TD CLASS="R16C4"><SPAN></SPAN></TD>
                <TD CLASS="R16C4"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->total['sum']}}&nbsp;</SPAN></TD>
                <TD CLASS="R16C4"><SPAN></SPAN></TD>
                <TD><SPAN></SPAN></TD>
                <TD></TD>
            </TR>
        @endif
    </TABLE>
    @if(array_key_last($data->pages) !== $key)
        <p style="page-break-after: always;"></p>
    @endif
@endforeach
