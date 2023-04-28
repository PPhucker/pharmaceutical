@foreach($data->pages as $key => $page)
    <TABLE style="width:100%; height:0; " CELLSPACING=0>
        <COL WIDTH=7>
        <COL WIDTH=35>
        <COL WIDTH=228>
        <COL WIDTH=77>
        <COL WIDTH=59>
        <COL WIDTH=45>
        <COL WIDTH=42>
        <COL WIDTH=42>
        <COL WIDTH=56>
        <COL WIDTH=63>
        <COL WIDTH=63>
        <COL WIDTH=81>
        <COL WIDTH=91>
        <COL WIDTH=62>
        <COL WIDTH=61>
        <COL WIDTH=76>
        <COL>

        @if(count($data->pages) > 1)
            <TR CLASS=R20>
                <TD CLASS="R20C15" COLSPAN=16>
                    <SPAN STYLE="white-space:nowrap;max-width:0;">Страница&nbsp;{{$key + 1}}</SPAN>
                </TD>
                <TD><SPAN></SPAN></TD>
                <TD></TD>
            </TR>
        @endif

        <TR CLASS=R20>
            <TD CLASS="R21C0">
                <DIV STYLE="position:relative; height:15px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV>
            </TD>
            <TD CLASS="R21C1" ROWSPAN=2>Но-<BR>мер<BR>по по-<BR>рядку</TD>
            <TD CLASS="R21C2" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Товар</SPAN></TD>
            <TD CLASS="R21C2" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Единица&nbsp;измерения</SPAN></TD>
            <TD CLASS="R21C1" ROWSPAN=2>Вид упаков ки</TD>
            <TD CLASS="R21C2" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Количество</SPAN></TD>
            <TD CLASS="R21C1" ROWSPAN=2>Масса брутто</TD>
            <TD CLASS="R21C2" ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Коли-<BR>чество&nbsp;<BR>(масса&nbsp;<BR>нетто)</SPAN></TD>
            <TD CLASS="R21C2" ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Цена,<BR>руб.&nbsp;коп.</SPAN></TD>
            <TD CLASS="R21C2" ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Сумма&nbsp;без<BR>учета&nbsp;НДС,<BR>руб.&nbsp;коп.</SPAN></TD>
            <TD CLASS="R21C2" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">НДС</SPAN></TD>
            <TD CLASS="R21C2" ROWSPAN=2>
            <SPAN STYLE="white-space:nowrap;max-width:0;">Сумма&nbsp;с<BR>учетом&nbsp;<BR>НДС,&nbsp;<BR>руб.&nbsp;коп.</SPAN></TD>
            <TD><DIV STYLE="position:relative; height:15px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD><DIV STYLE="width:100%;height:15px;overflow:hidden;"></DIV></TD>
        </TR>
        <TR CLASS=R22>
            <TD CLASS="R22C0"><SPAN></SPAN></TD>
            <TD CLASS="R22C2" style="border-right: #000000 1px solid">наименование, характеристика, сорт, артикул товара</TD>
            <TD CLASS="R22C3"><SPAN STYLE="white-space:nowrap;max-width:0;">код</SPAN></TD>
            <TD CLASS="R22C2" style="border-right: #000000 1px solid">наиме- нование</TD>
            <TD CLASS="R22C2" style="border-right: #000000 1px solid">код по ОКЕИ</TD>
            <TD CLASS="R22C2" style="border-right: #000000 1px solid">в одном месте</TD>
            <TD CLASS="R22C2" style="border-right: #000000 1px solid">мест,<BR>штук</TD>
            <TD CLASS="R22C2" style="border-right: #000000 1px solid">ставка, %</TD>
            <TD CLASS="R22C2" style="border-right: #000000 1px solid">сумма, <BR>руб. коп.</TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R20>
            <TD CLASS="R23C0"><SPAN></SPAN></TD>
            <TD CLASS="R23C1"><SPAN STYLE="white-space:nowrap;max-width:0;">1</SPAN></TD>
            <TD CLASS="R23C1"><SPAN STYLE="white-space:nowrap;max-width:0;">2</SPAN></TD>
            <TD CLASS="R23C3"><SPAN STYLE="white-space:nowrap;max-width:0;">3</SPAN></TD>
            <TD CLASS="R23C1"><SPAN STYLE="white-space:nowrap;max-width:0;">4</SPAN></TD>
            <TD CLASS="R23C3"><SPAN STYLE="white-space:nowrap;max-width:0;">5</SPAN></TD>
            <TD CLASS="R23C3"><SPAN STYLE="white-space:nowrap;max-width:0;">6</SPAN></TD>
            <TD CLASS="R23C3"><SPAN STYLE="white-space:nowrap;max-width:0;">7</SPAN></TD>
            <TD CLASS="R23C3"><SPAN STYLE="white-space:nowrap;max-width:0;">8</SPAN></TD>
            <TD CLASS="R23C3"><SPAN STYLE="white-space:nowrap;max-width:0;">9</SPAN></TD>
            <TD CLASS="R23C3"><SPAN STYLE="white-space:nowrap;max-width:0;">10</SPAN></TD>
            <TD CLASS="R23C3"><SPAN STYLE="white-space:nowrap;max-width:0;">11</SPAN></TD>
            <TD CLASS="R23C3"><SPAN STYLE="white-space:nowrap;max-width:0;">12</SPAN></TD>
            <TD CLASS="R23C1"><SPAN STYLE="white-space:nowrap;max-width:0;">13</SPAN></TD>
            <TD CLASS="R23C3"><SPAN STYLE="white-space:nowrap;max-width:0;">14</SPAN></TD>
            <TD CLASS="R23C3"><SPAN STYLE="white-space:nowrap;max-width:0;">15</SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>

        @foreach($page['production'] as $productKey => $product)
            <TR CLASS=R24>
                <TD CLASS="R24C0"><SPAN></SPAN></TD>
                <TD CLASS="R24C1"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$productKey}}</SPAN></TD>
                <TD CLASS="R24C2">{{$product->full_name}}</TD>
                <TD CLASS="R24C3"></TD>
                <TD CLASS="R24C4"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$product->okei->symbol}}</SPAN></TD>
                <TD CLASS="R24C5">{{$product->okei->code}}</TD>
                <TD CLASS="R24C6"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$product->okei->unit}}</SPAN></TD>
                <TD CLASS="R24C7"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$product->count_in_place}}</SPAN></TD>
                <TD CLASS="R24C7"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$product->count_places}}</SPAN></TD>
                <TD CLASS="R24C7"><SPAN></SPAN></TD>
                <TD CLASS="R24C10"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$product->quantity}}</SPAN></TD>
                <TD CLASS="R24C10"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$product->price_without_nds}}</SPAN></TD>
                <TD CLASS="R24C12"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$product->sum_without_nds}}</SPAN></TD>
                <TD CLASS="R24C13"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$product->nds}}</SPAN></TD>
                <TD CLASS="R24C14"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$product->sum_nds}}</SPAN></TD>
                <TD CLASS="R24C15"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$product->sum}}</SPAN></TD>
                <TD><SPAN></SPAN></TD>
                <TD></TD>
            </TR>
        @endforeach

        <TR CLASS=R20>
            <TD CLASS="R25C0"><SPAN></SPAN></TD>
            <TD CLASS="R25C1"><SPAN></SPAN></TD>
            <TD CLASS="R25C2"><SPAN></SPAN></TD>
            <TD CLASS="R25C3"><SPAN></SPAN></TD>
            <TD CLASS="R25C0"><SPAN></SPAN></TD>
            <TD CLASS="R25C7" COLSPAN=3><SPAN STYLE="white-space:nowrap;max-width:0;">Итого&nbsp;</SPAN></TD>
            <TD CLASS="R25C8"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$page['total']['count_places']}}</SPAN></TD>
            <TD CLASS="R25C9"><SPAN></SPAN></TD>
            <TD CLASS="R25C8"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$page['total']['quantity']}}</SPAN></TD>
            <TD CLASS="R25C11"><SPAN STYLE="white-space:nowrap;max-width:0;">Х</SPAN></TD>
            <TD CLASS="R25C12"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$page['total']['sum_without_nds']}}</SPAN></TD>
            <TD CLASS="R25C13"><SPAN STYLE="white-space:nowrap;max-width:0;">Х</SPAN></TD>
            <TD CLASS="R25C14"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$page['total']['sum_nds']}}</SPAN></TD>
            <TD CLASS="R25C15"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$page['total']['sum']}}</SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>

        @if(array_key_last($data->pages) === $key)
            <TR CLASS=R20>
                <TD CLASS="R25C0"><SPAN></SPAN></TD>
                <TD CLASS="R26C7" COLSPAN=7><SPAN STYLE="white-space:nowrap;max-width:0;">Всего&nbsp;по&nbsp;накладной&nbsp;</SPAN>
                </TD>
                <TD CLASS="R26C8"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->total['count_places']}}</SPAN></TD>
                <TD CLASS="R26C9"><SPAN></SPAN></TD>
                <TD CLASS="R26C8"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->total['quantity']}}</SPAN></TD>
                <TD CLASS="R26C11"><SPAN STYLE="white-space:nowrap;max-width:0;">Х</SPAN></TD>
                <TD CLASS="R26C12"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->total['sum_without_nds']}}</SPAN></TD>
                <TD CLASS="R26C11"><SPAN STYLE="white-space:nowrap;max-width:0;">Х</SPAN></TD>
                <TD CLASS="R26C12"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->total['sum_nds']}}</SPAN></TD>
                <TD CLASS="R26C12"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->total['sum']}}</SPAN></TD>
                <TD><SPAN></SPAN></TD>
                <TD></TD>
            </TR>
        @endif
    </TABLE>
    @if(array_key_last($data->pages) !== $key)
        <p style="page-break-after: always;"></p>
    @endif
@endforeach
