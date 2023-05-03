@foreach($data->pages as $key => $page)
<TABLE style="width:100%; height:0;" CELLSPACING=0>
    <COL WIDTH=6>
    <COL WIDTH=21>
    <COL WIDTH=230>
    <COL WIDTH=42>
    <COL WIDTH=38>
    <COL WIDTH=69>
    <COL WIDTH=54>
    <COL WIDTH=62>
    <COL WIDTH=74>
    <COL WIDTH=65>
    <COL WIDTH=62>
    <COL WIDTH=74>
    <COL WIDTH=82>
    <COL WIDTH=48>
    <COL WIDTH=64>
    <COL WIDTH=104>
    <COL WIDTH=5>
    <COL>

    @if(count($data->pages) > 1)
        <TR CLASS=R20>
            <TD style="font-size: 8pt;font-style: italic;text-align: right;vertical-align: top;" COLSPAN=16>
                <SPAN STYLE="white-space:nowrap;max-width:0;">Страница&nbsp;{{$key + 1}}</SPAN>
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
    @endif

    <TR CLASS=R16>
        <TD><DIV STYLE="position:relative; height:43px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R16C1" ROWSPAN=2>№ п/п</TD>
        <TD CLASS="R16C2" ROWSPAN=2>Наименование товара (описание выполненных работ, оказанных услуг), имущественного
            права
        </TD>
        <TD CLASS="R16C2" ROWSPAN=2>Код вида товара</TD>
        <TD CLASS="R16C1" COLSPAN=2>Единица<BR>измерения</TD>
        <TD CLASS="R16C6" ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Коли-<BR>чество&nbsp;<BR>(объем)</SPAN></TD>
        <TD CLASS="R16C2" ROWSPAN=2>Цена (тариф) за единицу измерения</TD>
        <TD CLASS="R16C2" ROWSPAN=2>Стоимость товаров (работ, услуг), имущественных прав без налога - всего</TD>
        <TD CLASS="R16C6" ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">В&nbsp;том<BR>числе<BR>сумма&nbsp;<BR>акциза</SPAN></TD>
        <TD CLASS="R16C2" ROWSPAN=2>Налоговая ставка</TD>
        <TD CLASS="R16C2" ROWSPAN=2>Сумма налога, предъявляемая покупателю</TD>
        <TD CLASS="R16C12" ROWSPAN=2>Стоимость товаров (работ, услуг), имущественных прав с налогом - всего</TD>
        <TD CLASS="R16C1" COLSPAN=2 STYLE="border-right: #000000 1px solid; ">Страна<BR>происхождения товара</TD>
        <TD CLASS="R16C12" ROWSPAN=2>Регистрационный номер декларации на товары или регистрационный номер партии товара,
            подлежащего прослеживаемости
        </TD>
        <TD><DIV STYLE="position:relative; height:43px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:43px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:43px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R16>
        <TD><DIV STYLE="position:relative; height:43px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R17C4"><SPAN STYLE="white-space:nowrap;max-width:0;">код</SPAN></TD>
        <TD CLASS="R16C1">условное обозначение (национальное)</TD>
        <TD CLASS="R17C12">цифровой код</TD>
        <TD CLASS="R17C12">краткое наименование</TD>
        <TD CLASS="R17C16" COLSPAN=2><DIV STYLE="position:relative; height:43px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:43px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R4>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R18C1"><SPAN STYLE="white-space:nowrap;max-width:0;">1</SPAN></TD>
        <TD CLASS="R18C1"><SPAN STYLE="white-space:nowrap;max-width:0;">1а</SPAN></TD>
        <TD CLASS="R18C1"><SPAN STYLE="white-space:nowrap;max-width:0;">1б</SPAN></TD>
        <TD CLASS="R18C4"><SPAN STYLE="white-space:nowrap;max-width:0;">2</SPAN></TD>
        <TD CLASS="R18C4"><SPAN STYLE="white-space:nowrap;max-width:0;">2а</SPAN></TD>
        <TD CLASS="R18C1"><SPAN STYLE="white-space:nowrap;max-width:0;">3</SPAN></TD>
        <TD CLASS="R18C1"><SPAN STYLE="white-space:nowrap;max-width:0;">4</SPAN></TD>
        <TD CLASS="R18C1"><SPAN STYLE="white-space:nowrap;max-width:0;">5</SPAN></TD>
        <TD CLASS="R18C1"><SPAN STYLE="white-space:nowrap;max-width:0;">6</SPAN></TD>
        <TD CLASS="R18C1"><SPAN STYLE="white-space:nowrap;max-width:0;">7</SPAN></TD>
        <TD CLASS="R18C1"><SPAN STYLE="white-space:nowrap;max-width:0;">8</SPAN></TD>
        <TD CLASS="R18C1"><SPAN STYLE="white-space:nowrap;max-width:0;">9</SPAN></TD>
        <TD CLASS="R18C4"><SPAN STYLE="white-space:nowrap;max-width:0;">10</SPAN></TD>
        <TD CLASS="R18C4"><SPAN STYLE="white-space:nowrap;max-width:0;">10а</SPAN></TD>
        <TD CLASS="R18C1"><SPAN STYLE="white-space:nowrap;max-width:0;">11</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>

    @foreach($page['production'] as $productKey => $product)
        <TR CLASS=R19>
            <TD CLASS="R19C0"><SPAN></SPAN></TD>
            <TD CLASS="R19C1">{{$productKey}}</TD>
            <TD CLASS="R19C2">{{$product->full_name}}</TD>
            <TD CLASS="R19C2">--</TD>
            <TD CLASS="R19C4"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$product->okei->code}}</SPAN></TD>
            <TD CLASS="R19C4"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$product->okei->symbol}}&nbsp;</SPAN></TD>
            <TD CLASS="R19C1">{{$product->quantity}}</TD>
            <TD CLASS="R19C1">{{$product->price_without_nds}}&nbsp;</TD>
            <TD CLASS="R19C1">{{$product->sum_without_nds}}&nbsp;</TD>
            <TD CLASS="R19C1">Без акциза</TD>
            <TD CLASS="R19C2">{{$product->nds}}</TD>
            <TD CLASS="R19C1">{{$product->sum_nds}}&nbsp;</TD>
            <TD CLASS="R19C1">{{$product->sum}}&nbsp;</TD>
            <TD CLASS="R19C2">--</TD>
            <TD CLASS="R19C2">--</TD>
            <TD CLASS="R19C2">--</TD>
            <TD CLASS="R19C0"><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
    @endforeach

    <TR CLASS=R4>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R20C1" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Итого</SPAN></TD>
        <TD CLASS="R20C3"><SPAN></SPAN></TD>
        <TD CLASS="R20C3"><SPAN></SPAN></TD>
        <TD CLASS="R20C3"><SPAN></SPAN></TD>
        <TD CLASS="R20C3"><SPAN></SPAN></TD>
        <TD CLASS="R20C3"><SPAN></SPAN></TD>
        <TD CLASS="R20C8">{{$page['total']['sum_without_nds']}}&nbsp;</TD>
        <TD CLASS="R20C9" COLSPAN=2 STYLE="border-right: #000000 1px solid; "><SPAN
                STYLE="white-space:nowrap;max-width:0;">Х</SPAN></TD>
        <TD CLASS="R20C8">{{$page['total']['sum_nds']}}&nbsp;</TD>
        <TD CLASS="R20C8">{{$page['total']['sum']}}&nbsp;</TD>
        <TD CLASS="R20C13"><SPAN></SPAN></TD>
        <TD CLASS="R20C13"><SPAN></SPAN></TD>
        <TD CLASS="R20C13"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>

    @if(array_key_last($data->pages) === $key)
    <TR CLASS="R4">
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R20C1" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Всего&nbsp;к&nbsp;оплате</SPAN></TD>
        <TD CLASS="R20C3"><SPAN></SPAN></TD>
        <TD CLASS="R20C3"><SPAN></SPAN></TD>
        <TD CLASS="R20C3"><SPAN></SPAN></TD>
        <TD CLASS="R20C3"><SPAN></SPAN></TD>
        <TD CLASS="R20C3"><SPAN></SPAN></TD>
        <TD CLASS="R20C8">{{$data->total['sum_without_nds']}}&nbsp;</TD>
        <TD CLASS="R20C9" COLSPAN=2 STYLE="border-right: #000000 1px solid; "><SPAN
                STYLE="white-space:nowrap;max-width:0;">Х</SPAN></TD>
        <TD CLASS="R20C8">{{$data->total['sum_nds']}}&nbsp;</TD>
        <TD CLASS="R20C8">{{$data->total['sum']}}&nbsp;</TD>
        <TD CLASS="R20C13" style="border-top: #ffffff 1px solid"><SPAN></SPAN></TD>
        <TD CLASS="R20C13" style="border-top: #ffffff 1px solid"><SPAN></SPAN></TD>
        <TD CLASS="R20C13" style="border-top: #ffffff 1px solid"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    @endif
</TABLE>
@if(array_key_last($data->pages) !== $key)
    <p style="page-break-after: always;"></p>
@endif
@endforeach
