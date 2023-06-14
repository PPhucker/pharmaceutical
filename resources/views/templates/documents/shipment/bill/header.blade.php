<TABLE style="width:100%; height:0; " CELLSPACING=0>
    <COL WIDTH=6>
    <COL WIDTH=155>
    <COL WIDTH=38>
    <COL WIDTH=45>
    <COL WIDTH=21>
    <COL WIDTH=120>
    <COL WIDTH=27>
    <COL WIDTH=77>
    <COL WIDTH=45>
    <COL WIDTH=49>
    <COL WIDTH=50>
    <COL WIDTH=82>
    <COL WIDTH=10>
    <COL WIDTH=50>
    <COL WIDTH=72>
    <COL WIDTH=225>
    <COL WIDTH=25>
    <COL WIDTH=5>
    <COL>
    <TR CLASS=R0>
        <TD>
            <DIV STYLE="position:relative; height:14px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV>
        </TD>
        @for($i = 0; $i < 6; $i++)
            <TD CLASS="R0C1"><DIV STYLE="position:relative; height:14px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        @endfor
        <TD CLASS="R0C1" COLSPAN=5 ROWSPAN=3 ALIGN=LEFT VALIGN=TOP STYLE="padding-left: 0"><IMG
                SRC="{{asset('images/marketing/documents/bills/code.png')}}" ALT="" width=299 height=52 style="margin-left:2pt;margin-top:1pt;">
        </TD>
        @for($i = 0; $i < 3; $i++)
            <TD CLASS="R0C1"><DIV STYLE="position:relative; height:14px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        @endfor
        <TD CLASS="R0C15" COLSPAN=2 ROWSPAN=3><SPAN
                STYLE="white-space:nowrap;max-width:0;">
                Приложение&nbsp;№&nbsp;1
                <BR>к&nbsp;постановлению&nbsp;Правительства&nbsp;Российской&nbsp;Федерации
                <BR>&nbsp;от&nbsp;26&nbsp;декабря&nbsp;2011&nbsp;г.&nbsp;№&nbsp;1137
                <BR>(в&nbsp;редакции&nbsp;постановления&nbsp;Правительства&nbsp;Российской&nbsp;Федерации
                <BR>&nbsp;от&nbsp;2&nbsp;апреля&nbsp;2021&nbsp;г.&nbsp;№&nbsp;534)
            </SPAN>
        </TD>
        <TD CLASS="R0C16"><DIV STYLE="position:relative; height:14px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="position:relative; height:14px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:14px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R1>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R1C1"><SPAN STYLE="white-space:nowrap;max-width:0;">СЧЕТ-ФАКТУРА&nbsp;&nbsp;№</SPAN></TD>
        <TD CLASS="R1C2" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">{{$number}}</SPAN></TD>
        <TD CLASS="R1C1"><SPAN STYLE="white-space:nowrap;max-width:0;">от</SPAN></TD>
        <TD CLASS="R1C5"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$date}}</SPAN></TD>
        <TD CLASS="R1C6"><SPAN STYLE="white-space:nowrap;max-width:0;">(1)</SPAN></TD>
        <TD CLASS="R1C7"><SPAN></SPAN></TD>
        <TD CLASS="R1C7"><SPAN></SPAN></TD>
        <TD CLASS="R1C7"><SPAN></SPAN></TD>
        <TD CLASS="R1C15"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R1>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R1C1"><SPAN STYLE="white-space:nowrap;max-width:0;">ИСПРАВЛЕНИЕ&nbsp;№</SPAN></TD>
        <TD CLASS="R1C5" COLSPAN=2><SPAN></SPAN></TD>
        <TD CLASS="R1C1"><SPAN STYLE="white-space:nowrap;max-width:0;">от</SPAN></TD>
        <TD CLASS="R1C5"><SPAN></SPAN></TD>
        <TD CLASS="R2C6"><SPAN STYLE="white-space:nowrap;max-width:0;">(1а)</SPAN></TD>
        <TD CLASS="R2C7"><SPAN></SPAN></TD>
        <TD CLASS="R2C7"><SPAN></SPAN></TD>
        <TD CLASS="R2C7"><SPAN></SPAN></TD>
        <TD CLASS="R1C15"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R0>
        <TD>
            <DIV STYLE="position:relative; height:14px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV>
        </TD>
        <TD CLASS="R3C1">
            <DIV STYLE="position:relative; height:14px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV>
        </TD>
        @for($i = 0; $i < 13; $i++)
            <TD CLASS="R3C2"><DIV STYLE="position:relative; height:14px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        @endfor
        <TD CLASS="R0C15"><DIV STYLE="position:relative; height:14px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R0C15"><DIV STYLE="position:relative; height:14px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R0C16" COLSPAN=2><DIV STYLE="position:relative; height:14px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:14px;overflow:hidden;"></DIV></TD>
    </TR>
    <TR CLASS=R4>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R4C1" COLSPAN=2>Продавец</TD>
        <TD CLASS="R4C3" COLSPAN=13>Продавец: {{$data->organization->name}}</TD>
        <TD CLASS="R4C16"><SPAN STYLE="white-space:nowrap;max-width:0;">(2)</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R4C1" COLSPAN=2>Адрес</TD>
        <TD CLASS="R4C3" COLSPAN=13>Адрес: {{$data->organization->registered->get('index') . ', ' . $data->organization->registered->get('address')}}</TD>
        <TD CLASS="R4C16"><SPAN STYLE="white-space:nowrap;max-width:0;">(2а)</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R4C1" COLSPAN=2>ИНН/КПП продавца</TD>
        <TD CLASS="R4C3" COLSPAN=13>ИНН/КПП продавца: {{$data->organization->inn  . '/' . $data->organization->kpp}}</TD>
        <TD CLASS="R4C16"><SPAN STYLE="white-space:nowrap;max-width:0;">(2б)</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R4C1" COLSPAN=2>Грузоотправитель и его адрес</TD>
        <TD CLASS="R4C3" COLSPAN=13>Грузоотправитель и его адрес: {{$data->organization->shipper}}</TD>
        <TD CLASS="R7C16"><SPAN STYLE="white-space:nowrap;max-width:0;">(3)</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R4C1" COLSPAN=2>Грузополучатель и его адрес</TD>
        <TD CLASS="R4C3" COLSPAN=13>Грузополучатель и его адрес: {{$data->contractor->consignee}}</TD>
        <TD CLASS="R7C16"><SPAN STYLE="white-space:nowrap;max-width:0;">(4)</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R4C1" COLSPAN=2>К платежно-расчетному документу №</TD>
        <TD CLASS="R4C3" COLSPAN=13>К платежно-расчетному документу № от</TD>
        <TD CLASS="R7C16"><SPAN STYLE="white-space:nowrap;max-width:0;">(5)</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R4C1" COLSPAN=2>Документ об отгрузке</TD>
        <TD CLASS="R4C3" COLSPAN=13>№ п/п 1 № {{$data->packing_list->number . ' от ' . $data->packing_list->date}}</TD>
        <TD CLASS="R7C16"><SPAN STYLE="white-space:nowrap;max-width:0;">(5а)</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R4C1" COLSPAN=2>Покупатель</TD>
        <TD CLASS="R4C3" COLSPAN=13>Покупатель: {{$data->contractor->name}}</TD>
        <TD CLASS="R7C16"><SPAN STYLE="white-space:nowrap;max-width:0;">(6)</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R4C1" COLSPAN=2>Адрес</TD>
        <TD CLASS="R4C3" COLSPAN=13>Адрес: {{$data->contractor->registered->get('index') . ', ' . $data->contractor->registered->get('address')}}</TD>
        <TD CLASS="R7C16"><SPAN STYLE="white-space:nowrap;max-width:0;">(6а)</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R4C1" COLSPAN=2>ИНН/КПП покупателя</TD>
        <TD CLASS="R4C3" COLSPAN=13>ИНН/КПП покупателя: {{$data->contractor->inn . '/' . $data->contractor->kpp}}</TD>
        <TD CLASS="R7C16"><SPAN STYLE="white-space:nowrap;max-width:0;">(6б)</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R14>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R14C1" COLSPAN=2 style="border-left: 0; border-top: 0; border-right: 0;border-bottom: 0;"><SPAN STYLE="white-space:nowrap;max-width:0;">Валюта:&nbsp;наименование,&nbsp;код</SPAN></TD>
        <TD CLASS="R14C3" COLSPAN=13><SPAN STYLE="white-space:nowrap;max-width:0;">Валюта:&nbsp;Российский&nbsp;рубль,&nbsp;643</SPAN></TD>
        <TD CLASS="R14C16"><SPAN STYLE="white-space:nowrap;max-width:0;">(7)</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R14>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R15C1" COLSPAN=8>Идентификатор государственного контракта, договора (соглашения) (при наличии)</TD>
        <TD CLASS="R15C7" COLSPAN=7><SPAN></SPAN></TD>
        <TD CLASS="R15C16" COLSPAN=3><SPAN STYLE="white-space:nowrap;max-width:0;">(8)</SPAN></TD>
        <TD></TD>
    </TR>
</TABLE>
