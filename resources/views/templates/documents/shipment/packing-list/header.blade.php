<TABLE style="/*width:100%; height:0; */" CELLSPACING=0>
    <COL WIDTH=7>
    <COL WIDTH=111>
    <COL WIDTH=264>
    <COL WIDTH=98>
    <COL WIDTH=98>
    <COL WIDTH=265>
    <COL WIDTH=98>
    <COL WIDTH=18>
    <COL WIDTH=49>
    <COL WIDTH=78>
    <COL>
    <TR CLASS=R0>
        <TD CLASS="R0C9" COLSPAN=10>
            <SPAN STYLE="white-space:nowrap;max-width:0;">
                Унифицированная&nbsp;форма&nbsp;№&nbsp;ТОРГ-12
                <BR>Утверждена&nbsp;постановлением&nbsp;Госкомстата&nbsp;России&nbsp;от&nbsp;
                25.12.98&nbsp;№&nbsp;132
            </SPAN>
        </TD>
        <TD><DIV STYLE="position:relative; height:21px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:21px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R1>
        @for ($i = 0; $i < 6; $i++)
            <TD CLASS="R1C0"><SPAN></SPAN></TD>
        @endfor
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R1C7"><SPAN></SPAN></TD>
        <TD CLASS="R1C7"><SPAN></SPAN></TD>
        <TD CLASS="R1C9"><SPAN STYLE="white-space:nowrap;max-width:0;">Коды</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R2>
        <TD CLASS="R2C0"><SPAN></SPAN></TD>
        <TD CLASS="R2C1" COLSPAN=5 ROWSPAN=2>
            {{$data->organization->shipper}}
        </TD>
        <TD CLASS="R2C7" COLSPAN=3><SPAN
                STYLE="white-space:nowrap;max-width:0;">Форма&nbsp;по&nbsp;ОКУД&nbsp;</SPAN>
        </TD>
        <TD CLASS="R2C9"><SPAN STYLE="white-space:nowrap;max-width:0;">0330212</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R2>
        <TD CLASS="R3C0"><SPAN></SPAN></TD>
        <TD CLASS="R3C6"><SPAN></SPAN></TD>
        <TD CLASS="R3C7" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">по&nbsp;ОКПО</SPAN></TD>
        <TD CLASS="R3C9"><SPAN>{{$data->organization->okpo}}</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD CLASS="R4C0" COLSPAN=2><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R4C2" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">организация-грузоотправитель,&nbsp;адрес,&nbsp;телефон,&nbsp;факс,&nbsp;банковские&nbsp;реквизиты</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R4C7"><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R4C7"><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R4C9" ROWSPAN=2><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:11px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R2>
        <TD CLASS="R3C0"><DIV STYLE="position:relative;width: 100%; overflow:hidden;height:0;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R5C1" COLSPAN=6><DIV STYLE="position:relative; height:0;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R5C7"><DIV STYLE="position:relative; width: 100%; overflow:hidden;height:0;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R5C7"><DIV STYLE="position:relative; width: 100%; overflow:hidden;height:0;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; width: 100%; overflow:hidden;height:0;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;overflow:hidden;height:0;">&nbsp;</DIV></TD>
    </TR>
    <TR CLASS=R6>
        <TD CLASS="R6C0" COLSPAN=2 STYLE="border-left: #ffffff 0 none; "><DIV STYLE="position:relative; height:auto;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R6C2" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">структурное&nbsp;подразделение</SPAN></TD>
        <TD CLASS="R6C7" COLSPAN=3><SPAN STYLE="white-space:nowrap;max-width:0;">Вид&nbsp;деятельности&nbsp;по&nbsp;ОКДП</SPAN></TD>
        <TD CLASS="R6C9"><DIV STYLE="position:relative; height:auto;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:auto;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:auto;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R7>
        <TD CLASS="R7C0"><SPAN></SPAN></TD>
        <TD CLASS="R7C1">Грузополучатель</TD>
        <TD CLASS="R7C2" COLSPAN=5>
            {{$data->contractor->consignee}}
        </TD>
        <TD CLASS="R7C7" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">по&nbsp;ОКПО</SPAN></TD>
        <TD CLASS="R7C9"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->contractor->okpo}}</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD CLASS="R8C0"><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R8C1"><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R4C2" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">организация,&nbsp;адрес,&nbsp;телефон,&nbsp;факс,&nbsp;банковские&nbsp;реквизиты</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R8C7"><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R8C7"><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R8C9" ROWSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->organization->okpo}}</SPAN>
        </TD>
        <TD><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:11px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R2>
        <TD CLASS="R3C0"><SPAN></SPAN></TD>
        <TD CLASS="R9C1">Адрес доставки</TD>
        <TD CLASS="R2C1" COLSPAN=5>{{$data->contractor->delivery_address}}</TD>
        <TD CLASS="R3C7"><SPAN></SPAN></TD>
        <TD CLASS="R3C7"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD CLASS="R8C1" COLSPAN=2><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R4C2" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">адрес&nbsp;доставки</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R10C7"><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R10C7"><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:11px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R7>
        <TD CLASS="R7C7" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Поставщик</SPAN></TD>
        <TD CLASS="R7C2" COLSPAN=5>
           {{$data->organization->supplier}}
        </TD>
        <TD CLASS="R7C7" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">по&nbsp;ОКПО</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD CLASS="R8C0"><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R8C1"><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R4C2" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">организация,&nbsp;адрес,&nbsp;телефон,&nbsp;факс,&nbsp;банковские&nbsp;реквизиты</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R8C7"><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R8C7"><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R8C9" ROWSPAN=2>
            <SPAN STYLE="white-space:nowrap;max-width:0;">
                {{$data->contractor->okpo}}
            </SPAN>
        </TD>
        <TD><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:11px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R7>
        <TD CLASS="R7C7" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Плательщик</SPAN></TD>
        <TD CLASS="R7C2" COLSPAN=5>
            {{$data->contractor->buyer}}
        </TD>
        <TD CLASS="R7C7" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">по&nbsp;ОКПО</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD CLASS="R8C0"><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R8C1"><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R4C2" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">организация,&nbsp;адрес,&nbsp;телефон,&nbsp;факс,&nbsp;банковские&nbsp;реквизиты</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C8" ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">номер</SPAN></TD>
        <TD CLASS="R8C9" ROWSPAN=2>
            <DIV class="align-middle">
                <SPAN>
                    {{$data->basis->number}}
                </SPAN>
            </DIV>
        </TD>
        <TD><DIV STYLE="position:relative; height:11px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:11px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R2>
        <TD CLASS="R3C7" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Основание</SPAN></TD>
        <TD CLASS="R15C2" COLSPAN=5><SPAN STYLE="white-space:nowrap;max-width:0;">Договор</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:16px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R2>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R16C1"><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R16C2" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">договор,&nbsp;заказ-наряд</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R16C8"><SPAN STYLE="white-space:nowrap;max-width:0;">дата</SPAN></TD>
        <TD CLASS="R3C9">
            <SPAN STYLE="white-space:nowrap;max-width:0;">
                {{$data->basis->date}}
            </SPAN>
        </TD>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:16px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R2>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R17C3"><SPAN STYLE="white-space:nowrap;max-width:0;">Номер&nbsp;документа</SPAN></TD>
        <TD CLASS="R17C3"><SPAN STYLE="white-space:nowrap;max-width:0;">Дата&nbsp;составления</SPAN></TD>
        <TD CLASS="R5C7" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Транспортная&nbsp;накладная</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R16C8"><SPAN STYLE="white-space:nowrap;max-width:0;">номер</SPAN></TD>
        <TD CLASS="R3C9"><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:16px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R2>
        <TD CLASS="R18C2" COLSPAN=3><SPAN STYLE="white-space:nowrap;max-width:0;">ТОВАРНАЯ&nbsp;НАКЛАДНАЯ&nbsp;&nbsp;</SPAN></TD>
        <TD CLASS="R18C3">
            <SPAN STYLE="white-space:nowrap;max-width:0;">
                {{$packingList->number}}
            </SPAN>
        </TD>
        <TD CLASS="R18C4">
            <SPAN STYLE="white-space:nowrap;max-width:0;">
                {{$packingList->date}}
            </SPAN>
        </TD>
        <TD CLASS="R5C2"><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R16C8"><SPAN STYLE="white-space:nowrap;max-width:0;">дата</SPAN></TD>
        <TD CLASS="R3C9"><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:16px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R2>
        <TD CLASS="R19C7" COLSPAN=9><SPAN STYLE="white-space:nowrap;max-width:0;">Вид&nbsp;операции</SPAN></TD>
        <TD CLASS="R19C9"><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:16px;overflow:hidden;"></DIV></TD>
    </TR>
</TABLE>
