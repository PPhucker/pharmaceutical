<TABLE style="width:100%; height:0; " CELLSPACING=0>
    <COL WIDTH=7>
    <COL WIDTH=83>
    <COL WIDTH=43>
    <COL WIDTH=98>
    <COL WIDTH=33>
    <COL WIDTH=56>
    <COL WIDTH=42>
    <COL WIDTH=58>
    <COL WIDTH=87>
    <COL WIDTH=116>
    <COL WIDTH=122>
    <COL WIDTH=83>
    <COL WIDTH=108>
    <COL WIDTH=110>
    <COL>
    <TR CLASS=R36>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R36C1" COLSPAN=14><SPAN STYLE="white-space:nowrap;max-width:0;">II&nbsp;ТРАНСПОРТНЫЙ&nbsp;РАЗДЕЛ</SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R20>
        <TD CLASS="R37C0"><SPAN></SPAN></TD>
        <TD CLASS="R37C0" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Срок&nbsp;доставки&nbsp;груза</SPAN></TD>
        <TD CLASS="R37C3" COLSPAN=2 style="width:50px"><SPAN STYLE="white-space:nowrap;max-width:0;"></SPAN></TD>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <TD CLASS="R37C12"><SPAN STYLE="white-space:nowrap;max-width:0;">ТТН&nbsp;№</SPAN></TD>
        <TD CLASS="R37C13"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$number}}</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R38>
        <TD CLASS="R38C0"><SPAN></SPAN></TD>
        <TD CLASS="R38C1"><SPAN STYLE="white-space:nowrap;max-width:0;">Организация</SPAN></TD>
        <TD CLASS="R38C2" COLSPAN=10>
            {{$data->contractor->consignee}}
        </TD>
        <TD CLASS="R38C12"><SPAN></SPAN></TD>
        <TD CLASS="R38C13" ROWSPAN=3><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R20>
        <TD CLASS="R37C0"><SPAN></SPAN></TD>
        <TD CLASS="R37C0" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Автомобиль</SPAN></TD>
        <TD CLASS="R39C3" COLSPAN=3><SPAN>САМОВЫВОЗ {{$waybill->car_model}}</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R20C1" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Государственный&nbsp;№</SPAN></TD>
        <TD CLASS="R37C3" COLSPAN=3><SPAN>{{$waybill->state_car_number}}</SPAN></TD>
        <TD CLASS="R37C12" ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">К&nbsp;путевому&nbsp;<BR>листу&nbsp;№</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R20>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R20C2" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">марка</SPAN></TD>
        <TD CLASS="R37C0"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD COLSPAN=2><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R38>
        <TD CLASS="R38C0"><SPAN></SPAN></TD>
        <TD CLASS="R38C0" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Заказчик&nbsp;(&nbsp;плательщик)</SPAN></TD>
        <TD CLASS="R41C3" COLSPAN=9>{{$data->contractor->buyer}}</TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R41C13" ROWSPAN=2><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R20>
        <TD CLASS="R37C0"><SPAN></SPAN></TD>
        <TD CLASS="R37C0"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R20C2" COLSPAN=9><SPAN STYLE="white-space:nowrap;max-width:0;">наименование,&nbsp;адрес,&nbsp;номер&nbsp;телефона,&nbsp;банковские&nbsp;реквизиты</SPAN>
        </TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R20>
        <TD CLASS="R37C0"><SPAN></SPAN></TD>
        <TD CLASS="R37C0"><SPAN STYLE="white-space:nowrap;max-width:0;">Водитель</SPAN></TD>
        <TD CLASS="R37C3" COLSPAN=4><SPAN>{{$waybill->driver}}</SPAN></TD>
        <TD CLASS="R37C0" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Удостоверение&nbsp;№</SPAN></TD>
        <TD CLASS="R37C3" COLSPAN=2><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R43C12" ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Код</SPAN></TD>
        <TD CLASS="R43C13" ROWSPAN=2><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R20>
        <TD CLASS="R37C0"><SPAN></SPAN></TD>
        <TD CLASS="R37C0" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Лицензионная&nbsp;карточка</SPAN>
        </TD>
        <TD CLASS='@if($waybill->licence_card === 'standard') R44C3 @else R44C4 @endif'>
            <SPAN STYLE="white-space:nowrap;max-width:0;">стандартная</SPAN>
        </TD>
        <TD CLASS='@if($waybill->licence_card === 'limited') R44C3 @else R44C4 @endif' COLSPAN=2>
            <SPAN STYLE="white-space:nowrap;max-width:0;">ограниченная</SPAN>
        </TD>
        <TD CLASS="R37C0" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Вид&nbsp;перевозки</SPAN></TD>
        <TD CLASS="R37C3" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">
                @if($waybill->type_of_transportation === 'automotive') Автомобильный @else Ручное перемещение @endif
            </SPAN>
        </TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R20>
        <TD CLASS="R37C0"><SPAN></SPAN></TD>
        <TD CLASS="R37C0"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R20C2" COLSPAN=3><SPAN STYLE="white-space:nowrap;max-width:0;">ненужное&nbsp;зачеркнуть</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R20C1"><SPAN></SPAN></TD>
        <TD CLASS="R45C13" ROWSPAN=2><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R20>
        <TD CLASS="R37C0"><SPAN></SPAN></TD>
        <TD CLASS="R37C0" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Регистрационный&nbsp;№</SPAN></TD>
        <TD CLASS="R37C4"><SPAN></SPAN></TD>
        <TD CLASS="R46C4"><SPAN STYLE="white-space:nowrap;max-width:0;">Серия&nbsp;</SPAN></TD>
        <TD CLASS="R37C4"><SPAN></SPAN></TD>
        <TD CLASS="R46C4"><SPAN STYLE="white-space:nowrap;max-width:0;">№</SPAN></TD>
        <TD CLASS="R37C4"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R47>
        <TD CLASS="R47C0"><SPAN></SPAN></TD>
        <TD CLASS="R47C0"><SPAN STYLE="white-space:nowrap;max-width:0px;">Пункт&nbsp;погрузки</SPAN></TD>
        <TD CLASS="R47C2" COLSPAN=4>{{$data->organization->shipping_address}}</TD>
        <TD CLASS="R47C6" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Пункт&nbsp;разгрузки</SPAN></TD>
        <TD CLASS="R47C2" COLSPAN=4>{{$data->contractor->delivery_address}}</TD>
        <TD CLASS="R47C12" ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Маршрут&nbsp;№</SPAN></TD>
        <TD CLASS="R47C13" ROWSPAN=2><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R20>
        <TD CLASS="R37C0"><SPAN></SPAN></TD>
        <TD CLASS="R37C0"><SPAN></SPAN></TD>
        <TD CLASS="R20C2" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">адрес,&nbsp;номер&nbsp;телефона</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R20C2" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">адрес,&nbsp;номер&nbsp;телефона</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R20>
        <TD CLASS="R37C0"><SPAN></SPAN></TD>
        <TD CLASS="R37C0"><SPAN STYLE="white-space:nowrap;max-width:0;">Переадресовка</SPAN></TD>
        <TD CLASS="R49C2" COLSPAN=3><SPAN></SPAN></TD>
        <TD CLASS="R20C1"><SPAN STYLE="white-space:nowrap;max-width:0;">1.&nbsp;прицеп</SPAN></TD>
        <TD CLASS="R49C6" COLSPAN=3><SPAN>{{$waybill->trailer_1}}</SPAN></TD>
        <TD CLASS="R20C1"><SPAN STYLE="white-space:nowrap;max-width:0;">Государственный&nbsp;№</SPAN></TD>
        <TD CLASS="R49C6" COLSPAN=2><SPAN>{{$waybill->state_trailer_1_number}}</SPAN></TD>
        <TD CLASS="R49C12"><SPAN STYLE="white-space:nowrap;max-width:0;">Гаражный&nbsp;№</SPAN></TD>
        <TD CLASS="R20C14"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R50>
        <TD CLASS="R50C0"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R50C2" COLSPAN=3 ROWSPAN=2>наименование и адрес нового грузополучателя, номер распоряжения, подпись ответственного лица</TD>
        <TD CLASS="R50C5"><SPAN STYLE="white-space:nowrap;max-width:0;">2.&nbsp;прицеп</SPAN></TD>
        <TD CLASS="R50C6" COLSPAN=3><SPAN>{{$waybill->trailer_2}}</SPAN></TD>
        <TD CLASS="R50C5"><SPAN STYLE="white-space:nowrap;max-width:0;">Государственный&nbsp;№</SPAN></TD>
        <TD CLASS="R50C6" COLSPAN=2><SPAN>{{$waybill->state_trailer_2_number}}</SPAN></TD>
        <TD CLASS="R50C12"><SPAN STYLE="white-space:nowrap;max-width:0;">Гаражный&nbsp;№</SPAN></TD>
        <TD CLASS="R50C13"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R20>
        <TD CLASS="R37C0"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R51C5"><SPAN></SPAN></TD>
        <TD CLASS="R51C5"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD>&nbsp;</TD>
    </TR>
</TABLE>
