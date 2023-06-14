<div class="print table-responsive">
    <div id="document-template"
         style="zoom: 100%">
        <link href="{{ asset('css/templates/documents/shipment/appendix.css') }}"
              rel="stylesheet">
        <TABLE style="width:100%; height:0;" CELLSPACING=0>
            <COL WIDTH=33>
            <COL WIDTH=284>
            <COL WIDTH=143>
            <COL WIDTH=81>
            <COL WIDTH=112>
            <COL WIDTH=196>
            <COL WIDTH=76>
            <COL WIDTH=89>
            <COL>
            <TR CLASS=R0a>
                <TD CLASS="R0C0a" COLSPAN=8><SPAN STYLE="white-space:nowrap;max-width:0;">Приложение</SPAN></TD>
                <TD><SPAN></SPAN></TD>
                <TD></TD>
            </TR>
            <TR>
                @for($i = 0; $i < 9; $i++)
                    <TD><SPAN></SPAN></TD>
                @endfor
                <TD>&nbsp;</TD>
            </TR>
            <TR CLASS=R2a>
                <TD CLASS="R2C0a" COLSPAN=8>
                    <SPAN STYLE="white-space:nowrap;max-width:0;">
                        к&nbsp;накладной&nbsp;№&nbsp;{{$number}}&nbsp;от&nbsp;{{$date}}</SPAN>
                </TD>
                <TD><SPAN></SPAN></TD>
                <TD></TD>
            </TR>
            <TR>
                @for($i = 0; $i < 9; $i++)
                    <TD><SPAN></SPAN></TD>
                @endfor
                <TD>&nbsp;</TD>
            </TR>
            <TR CLASS=R2a>
                <TD CLASS="R4C0a" COLSPAN=8>{{$data->organization->supplier}}</TD>
                <TD><SPAN></SPAN></TD>
                <TD></TD>
            </TR>
            <TR CLASS=R5a>
                <TD CLASS="R5C0a" COLSPAN=9><SPAN STYLE="white-space:nowrap;max-width:0;">(Поставщик)</SPAN></TD>
                <TD></TD>
            </TR>
            <TR>
                @for($i = 0; $i < 9; $i++)
                    <TD><SPAN></SPAN></TD>
                @endfor
                <TD>&nbsp;</TD>
            </TR>
            <TR CLASS=R2a>
                <TD CLASS="R4C0a" COLSPAN=8>{{$data->contractor->buyer}}</TD>
                <TD><SPAN></SPAN></TD>
                <TD></TD>
            </TR>
            <TR CLASS=R5a>
                <TD CLASS="R5C0a" COLSPAN=9><SPAN STYLE="white-space:nowrap;max-width:0;">(Получатель)</SPAN></TD>
                <TD></TD>
            </TR>
            <TR>
                @for($i = 0; $i < 9; $i++)
                    <TD><SPAN></SPAN></TD>
                @endfor
                <TD>&nbsp;</TD>
            </TR>
        </TABLE>
        @foreach($data->pages as $key => $page)
            <TABLE style="width:100%; height:0;" CELLSPACING=0>
                <COL WIDTH=33>
                <COL WIDTH=284>
                <COL WIDTH=143>
                <COL WIDTH=81>
                <COL WIDTH=112>
                <COL WIDTH=196>
                <COL WIDTH=76>
                <COL WIDTH=89>
                <COL>
                <TR CLASS=R10a>
                    <TD CLASS="R10C0a">№ п/п</TD>
                    <TD CLASS="R10C0a">Торговое название, лекарственная форма, дозировка</TD>
                    <TD CLASS="R10C0a">Международное непатентованное название</TD>
                    <TD CLASS="R10C0a">Серия</TD>
                    <TD CLASS="R10C0a">Срок годности</TD>
                    <TD CLASS="R10C0a">Производитель</TD>
                    <TD CLASS="R10C0a">Единица измерения</TD>
                    <TD CLASS="R10C0a">Количество</TD>
                    <TD><SPAN></SPAN></TD>
                    <TD></TD>
                </TR>
                <TR CLASS=R11a>
                    <TD CLASS="R11C0a"><SPAN STYLE="white-space:nowrap;max-width:0;">1</SPAN></TD>
                    <TD CLASS="R11C0a"><SPAN STYLE="white-space:nowrap;max-width:0;">2</SPAN></TD>
                    <TD CLASS="R11C0a"><SPAN STYLE="white-space:nowrap;max-width:0;">3</SPAN></TD>
                    <TD CLASS="R11C0a"><SPAN STYLE="white-space:nowrap;max-width:0;">4</SPAN></TD>
                    <TD CLASS="R11C0a"><SPAN STYLE="white-space:nowrap;max-width:0;">5</SPAN></TD>
                    <TD CLASS="R11C0a"><SPAN STYLE="white-space:nowrap;max-width:0;">6</SPAN></TD>
                    <TD CLASS="R11C0a"><SPAN STYLE="white-space:nowrap;max-width:0;">7</SPAN></TD>
                    <TD CLASS="R11C0a"><SPAN STYLE="white-space:nowrap;max-width:0;">8</SPAN></TD>
                    <TD><SPAN></SPAN></TD>
                    <TD></TD>
                </TR>
                @foreach($page['production'] as $productKey => $product)
                    <TR CLASS=R12a>
                        <TD CLASS="R12C0a">{{$productKey}}</TD>
                        <TD CLASS="R12C1a" style="text-align: left;">{{$product->full_name}}</TD>
                        <TD CLASS="R12C1a">{{$product->international_name}}</TD>
                        <TD CLASS="R12C1a">{{$product->series}}</TD>
                        <TD CLASS="R12C1a">{{$product->best_before_date}}</TD>
                        <TD CLASS="R12C1a" style="text-align: left;">ООО "РОСБИО", Россия, Санкт-Петербург,
                            Мельничная ул, дом №12 литер А
                        </TD>
                        <TD CLASS="R12C1a">{{$product->okei->symbol}}</TD>
                        <TD CLASS="R12C0a" style="text-align: center;vertical-align:middle">
                            {{$product->quantity}}
                        </TD>
                        <TD><SPAN></SPAN></TD>
                        <TD></TD>
                    </TR>
                @endforeach
            </TABLE>
            @if(array_key_last($data->pages) !== $key)
                <p style="page-break-after: always;"></p>
            @endif
        @endforeach
        <TABLE style="width:100%; height:0; " CELLSPACING=0>
            <TR CLASS=R11a>
                @for($i = 0; $i < 8; $i++)
                    <TD CLASS="R13C0a"><SPAN></SPAN></TD>
                @endfor
                <TD><SPAN></SPAN></TD>
                <TD>&nbsp;</TD>
            </TR>
            <TR CLASS=R11a>
                @for($i = 0; $i < 8; $i++)
                    <TD CLASS="R13C0a"><SPAN></SPAN></TD>
                @endfor
                <TD><SPAN></SPAN></TD>
                <TD>&nbsp;</TD>
            </TR>
            <TR CLASS=R11a>
                @for($i = 0; $i < 8; $i++)
                    <TD CLASS="R13C0a"><SPAN></SPAN></TD>
                @endfor
                <TD><SPAN></SPAN></TD>
                <TD>&nbsp;</TD>
            </TR>
            <TR CLASS=R11a>
                @for($i = 0; $i < 8; $i++)
                    <TD CLASS="R13C0a"><SPAN></SPAN></TD>
                @endfor
                <TD><SPAN></SPAN></TD>
                <TD>&nbsp;</TD>
            </TR>
            <TR CLASS=R11a>
                <TD CLASS="R13C0a" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Исполнительный&nbsp;директор&nbsp;______________________&nbsp;</SPAN>
                </TD>
                <TD CLASS="R13C0a" COLSPAN=3><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->director}}</SPAN>
                </TD>
                <TD CLASS="R13C0a" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">_____________________________________</SPAN>
                </TD>
                <TD CLASS="R13C0a" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">___________</SPAN></TD>
                <TD></TD>
            </TR>
            <TR CLASS=R5a>
                <TD CLASS="R18C0a" COLSPAN=5><SPAN STYLE="white-space:nowrap;max-width:0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(должность)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(подпись)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ФИО)</SPAN>
                </TD>
                <TD CLASS="R18C0a" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">(подпись&nbsp;уполномоченного&nbsp;лица&nbsp;получателя)</SPAN>
                </TD>
                <TD CLASS="R18C0a" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ФИО)</SPAN>
                </TD>
                <TD></TD>
            </TR>
            <TR CLASS=R11a>
                @for($i = 0; $i < 8; $i++)
                    <TD CLASS="R13C0a"><SPAN></SPAN></TD>
                @endfor
                <TD><SPAN></SPAN></TD>
                <TD>&nbsp;</TD>
            </TR>
            <TR CLASS=R11>
                @for($i = 0; $i < 6; $i++)
                    <TD CLASS="R13C0a"><SPAN></SPAN></TD>
                @endfor
                <TD CLASS="R13C0aa"><SPAN></SPAN></TD>
                <TD CLASS="R13C0"><SPAN></SPAN></TD>
                <TD><SPAN></SPAN></TD>
                <TD>&nbsp;</TD>
            </TR>
            <TR CLASS=R11a>
                <TD CLASS="R13C0a" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Главный&nbsp;бухгалтер_____________________________</SPAN>
                </TD>
                <TD CLASS="R13C0a" COLSPAN=7><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->bookkeeper}}</SPAN>
                </TD>
                <TD></TD>
            </TR>
            <TR CLASS=R5a>
                <TD CLASS="R18C0a" COLSPAN=9><SPAN STYLE="white-space:nowrap;max-width:0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(должность)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(подпись)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ФИО)</SPAN>
                </TD>
                <TD></TD>
            </TR>
            <TR CLASS=R2a>
                @for($i = 0; $i < 6; $i++)
                    <TD CLASS="R23C0a"><SPAN></SPAN></TD>
                @endfor
                <TD><SPAN></SPAN></TD>
                <TD CLASS="R23C0a"><SPAN></SPAN></TD>
                <TD><SPAN></SPAN></TD>
                <TD>&nbsp;</TD>
            </TR>
            <TR CLASS=R2a>
                @for($i = 0; $i < 6; $i++)
                    <TD CLASS="R23C0a"><SPAN></SPAN></TD>
                @endfor
                <TD><SPAN></SPAN></TD>
                <TD CLASS="R23C0a"><SPAN></SPAN></TD>
                <TD><SPAN></SPAN></TD>
                <TD>&nbsp;</TD>
            </TR>
            <TR CLASS=R2a>
                <TD CLASS="R23C0a" COLSPAN=5><SPAN STYLE="white-space:nowrap;max-width:0;">{{$date}}</SPAN></TD>
                <TD CLASS="R23C0a" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;"></SPAN></TD>
                <TD></TD>
            </TR>
            <TR CLASS=R2a>
                @for($i = 0; $i < 6; $i++)
                    <TD CLASS="R23C0a"><SPAN></SPAN></TD>
                @endfor
                <TD><SPAN></SPAN></TD>
                <TD CLASS="R23C0a"><SPAN></SPAN></TD>
                <TD><SPAN></SPAN></TD>
                <TD>&nbsp;</TD>
            </TR>
            <TR CLASS=R2a>
                <TD CLASS="R23C0a" COLSPAN=5><SPAN STYLE="white-space:nowrap;max-width:0px;">мп</SPAN></TD>
                <TD CLASS="R23C0a" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0px;">мп</SPAN></TD>
                <TD></TD>
            </TR>
        </TABLE>
    </div>
</div>
