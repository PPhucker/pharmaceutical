<TABLE style="width:100%; height:0; " CELLSPACING=0>
    <COL WIDTH=7>
    <COL WIDTH=171>
    <COL WIDTH=607>
    <COL WIDTH=64>
    <COL WIDTH=88>
    <COL WIDTH=116>
    <COL>
    <TR CLASS=R0>
        <TD CLASS="R0C5" COLSPAN=6>
            <SPAN STYLE="white-space:nowrap;max-width:0;">
                Типовая&nbsp;межотраслевая&nbsp;форма&nbsp;№&nbsp;1-Т&nbsp;
                <BR>Утверждена&nbsp;постановлением&nbsp;Госкомстата&nbsp;России&nbsp;от&nbsp;28.11.97&nbsp;№78
            </SPAN>
        </TD>
        <TD><DIV STYLE="position:relative; height:28px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:28px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R1>
        @for($i = 0; $i < 5; $i++)
            <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        @endfor
        <TD CLASS="R1C5"><SPAN STYLE="white-space:nowrap;max-width:0;">Коды</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:16px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV>
        </TD><TD><DIV STYLE="width:100%;height:16px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R2>
        <TD CLASS="R2C4" COLSPAN=5><SPAN STYLE="white-space:nowrap;max-width:0;">Форма&nbsp;по&nbsp;ОКУД&nbsp;</SPAN>
        </TD>
        <TD CLASS="R2C5"><SPAN STYLE="white-space:nowrap;max-width:0;">0345009</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:26px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:26px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R2>
        <TD><DIV STYLE="position:relative; height:26px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:26px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R3C2" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">ТОВАРНО-ТРАНСПОРТНАЯ&nbsp;НАКЛАДНАЯ&nbsp;&nbsp;</SPAN></TD>
        <TD CLASS="R3C4"><SPAN STYLE="white-space:nowrap;max-width:0;">№</SPAN></TD>
        <TD CLASS="R3C5"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$number}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:26px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:26px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R2>
        <TD CLASS="R4C4" COLSPAN=5><SPAN STYLE="white-space:nowrap;max-width:0;">Дата&nbsp;составления</SPAN></TD>
        <TD CLASS="R4C5"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$date}}</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:26px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:26px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R5>
        <TD CLASS="R5C1" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;"><BR>Грузоотправитель</SPAN></TD>
        <TD CLASS="R5C2" COLSPAN=2>
            {{$data->organization->shipper}}
        </TD>
        <TD CLASS="R5C1"><SPAN STYLE="white-space:nowrap;max-width:0;">по&nbsp;ОКПО</SPAN></TD>
        <TD CLASS="R5C5"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->organization->okpo}}</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R6>
        <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R6C1"><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R6C2" COLSPAN=2>полное наименование организации, адрес, номер телефона</TD>
        <TD CLASS="R6C1"><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R6C5" ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->contractor->okpo}}</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV>
        </TD><TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R7>
        <TD CLASS="R7C1" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;"><BR>Грузополучатель</SPAN></TD>
        <TD CLASS="R7C2" COLSPAN=2>{{$data->contractor->consignee}}</TD>
        <TD CLASS="R7C1"><SPAN STYLE="white-space:nowrap;max-width:0;">по&nbsp;ОКПО</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R6>
        <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R6C1"><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R6C2" COLSPAN=2>полное наименование организации, адрес, номер телефона</TD>
        <TD CLASS="R6C1"><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R8C5" ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">{{$data->contractor->okpo}}</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R7>
        <TD CLASS="R7C1" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;"><BR>Плательщик</SPAN></TD>
        <TD CLASS="R7C2" COLSPAN=2>{{$data->contractor->buyer}}</TD>
        <TD CLASS="R7C1"><SPAN STYLE="white-space:nowrap;max-width:0;">по&nbsp;ОКПО</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R6>
        <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R10C2" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">полное&nbsp;наименование&nbsp;организации,&nbsp;адрес,&nbsp;банковские&nbsp;реквизиты</SPAN></TD>
        <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R11>
        <TD><DIV STYLE="position:relative; height:20px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R11C1" COLSPAN=6><SPAN STYLE="white-space:nowrap;max-width:0;">I&nbsp;ТОВАРНЫЙ&nbsp;РАЗДЕЛ&nbsp;(заполняется&nbsp;грузоотправителем)</SPAN></TD>
        <TD><DIV STYLE="width:100%;height:20px;overflow:hidden;"></DIV></TD>
    </TR>
</TABLE>
