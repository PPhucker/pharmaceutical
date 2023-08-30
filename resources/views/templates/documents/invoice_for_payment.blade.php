<link href="{{ asset('css/templates/documents/invoice_for_payment.css') }}" rel="stylesheet">
<div id="document-template" class="table-responsive" style="zoom: 100%">
    <TABLE style="width:100%; height:0; " CELLSPACING=0>
        <colgroup>
            <COL WIDTH=7>
            @for($i=0;$i<=37;$i++)
                <COL WIDTH=21>
            @endfor
            <COL WIDTH=7>
            <COL>
        </colgroup>
        <TR CLASS=R0>
            <TD><DIV STYLE="position:relative; height:46px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD CLASS="R0C1" COLSPAN=37>
                    <SPAN STYLE="white-space:nowrap;max-width:0;">
                        Внимание! Оплата данного счета означает согласие с условиями поставки товара. Уведомление об оплате
                        <BR>обязательно, в противном случае не гарантируется наличие товара на складе. Товар отпускается по факту
                        <BR>прихода денег на р/с Поставщика, самовывозом, при наличии доверенности и паспорта.
                    </SPAN>
            </TD>
            <TD><DIV STYLE="position:relative; height:46px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD><DIV STYLE="position:relative; height:46px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD><DIV STYLE="width:100%;height:46px;overflow:hidden;"></DIV></TD>
        </TR>
        <TR CLASS=R1>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R1C1"><SPAN></SPAN></TD>
            @for($i=0;$i<=17;$i++)
                <TD CLASS="R1C2"><SPAN></SPAN></TD>
            @endfor
            <TD CLASS="R1C1"><SPAN></SPAN></TD>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            <TD CLASS="R1C1"><SPAN></SPAN></TD>
            @for($i=0;$i<=15;$i++)
                <TD CLASS="R1C2"><SPAN></SPAN></TD>
            @endfor
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD>&nbsp;</TD>
        </TR>
        <TR CLASS=R1>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R2C1" COLSPAN=18 ROWSPAN=2>
                {{$data->organization->bank->name}}
            </TD>
            <TD CLASS="R2C19" COLSPAN=3><SPAN STYLE="white-space:nowrap;max-width:0;">БИК</SPAN></TD>
            <TD CLASS="R2C22" COLSPAN=16>
                <SPAN STYLE="white-space:nowrap;max-width:0;">
                    {{$data->organization->bank->BIC}}
                </SPAN>
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R3>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R3C19" COLSPAN=3 ROWSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Сч.&nbsp;№</SPAN></TD>
            <TD CLASS="R3C22" COLSPAN=16 ROWSPAN=2>
                <SPAN STYLE="white-space:nowrap;max-width:0;">
                    {{$data->organization->bank->correspondent_account}}
                </SPAN>
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R4>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R4C1" COLSPAN=18><SPAN STYLE="white-space:nowrap;max-width:0;">Банк&nbsp;получателя</SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R1>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R5C1" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">ИНН</SPAN></TD>
            <TD CLASS="R5C3" COLSPAN=7>
                <SPAN STYLE="white-space:nowrap;max-width:0;">
                    {{$data->organization->INN}}
                </SPAN>
            </TD>
            <TD CLASS="R5C1" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">КПП</SPAN></TD>
            <TD CLASS="R5C3" COLSPAN=7>
                <SPAN STYLE="white-space:nowrap;max-width:0;">
                    {{$data->organization->kpp}}
                </SPAN>
            </TD>
            <TD CLASS="R5C19" COLSPAN=3 ROWSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">Сч.&nbsp;№</SPAN>
            </TD>
            <TD CLASS="R5C19" COLSPAN=16 ROWSPAN=4>
                <SPAN STYLE="white-space:nowrap;max-width:0;">
                    {{$data->organization->bank->payment_account}}
                </SPAN>
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R4>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R6C1" COLSPAN=18 ROWSPAN=2>
                {{$data->organization->legal_form->full}} {{$data->organization->name}}
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R4>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD>&nbsp;</TD>
        </TR>
        <TR CLASS=R4>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R4C1" COLSPAN=18><SPAN
                    STYLE="white-space:nowrap;max-width:0;">Получатель</SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR>
            @for($i=0; $i<39; $i++)
                <TD><SPAN></SPAN></TD>
            @endfor
            <TD>&nbsp;</TD>
        </TR>
        <TR CLASS=R0>
            <TD><DIV STYLE="position:relative; height:46px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD CLASS="R10C1" COLSPAN=37>
                <SPAN STYLE="white-space:nowrap;max-width:0;">
                    Счет на оплату №{{$data->invoice->number}} от {{$data->invoice->date}}
                </SPAN>
            </TD>
            <TD><DIV STYLE="position:relative; height:46px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD><DIV STYLE="position:relative; height:46px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV>
            </TD>
            <TD><DIV STYLE="width:100%;height:46px;overflow:hidden;"></DIV></TD>
        </TR>
        <TR>
            @for($i=0; $i<39; $i++)
                <TD><SPAN></SPAN></TD>
            @endfor
            <TD>&nbsp;</TD>
        </TR>
        <TR CLASS=R12>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R12C1" COLSPAN=6><SPAN STYLE="white-space:nowrap;max-width:0;">Поставщик:</SPAN></TD>
            <TD CLASS="R12C7" COLSPAN=31>
                {{$data->organization->supplier}}
            </TD>
            <TD CLASS="R12C38"><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R1>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R13C1"><SPAN></SPAN></TD>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            <TD CLASS="R13C5"><SPAN></SPAN></TD>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            <TD CLASS="R13C5"><SPAN></SPAN></TD>
            @for($i = 0; $i < 30; $i++)
                <TD CLASS="R1C2"><SPAN></SPAN></TD>
            @endfor
            <TD><SPAN></SPAN></TD>
            <TD>&nbsp;</TD>
        </TR>
        <TR CLASS=R12>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R12C1" COLSPAN=6><SPAN STYLE="white-space:nowrap;max-width:0;">Грузоотправитель:</SPAN>
            </TD>
            <TD CLASS="R12C7" COLSPAN=31>
                {{$data->organization->shipper}}
            </TD>
            <TD CLASS="R12C38"><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR>
            @for($i = 0; $i < 39; $i++)
                <TD><SPAN></SPAN></TD>
            @endfor
            <TD>&nbsp;</TD>
        </TR>
        <TR CLASS=R12>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R12C1" COLSPAN=6><SPAN
                    STYLE="white-space:nowrap;max-width:0;">Покупатель:</SPAN></TD>
            <TD CLASS="R12C7" COLSPAN=31>
                {{$data->contractor->buyer}}
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R1>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R13C1"><SPAN></SPAN></TD>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            <TD CLASS="R13C5"><SPAN></SPAN></TD>
            @for($i = 0; $i < 33; $i++)
                <TD><SPAN></SPAN></TD>
            @endfor
            <TD>&nbsp;</TD>
        </TR>
        <TR CLASS=R12>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R12C1" COLSPAN=6><SPAN STYLE="white-space:nowrap;max-width:0;">Грузополучатель:</SPAN>
            </TD>
            <TD CLASS="R12C7" COLSPAN=31>
                {{$data->contractor->consignee}}
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR>
            @for($i = 0; $i < 39; $i++)
                <TD><SPAN></SPAN></TD>
            @endfor
            <TD>&nbsp;</TD>
        </TR>
    </TABLE>
    <TABLE style="width:100%; height:0; " CELLSPACING=0>
        <COL WIDTH=7>
        @for($i = 0; $i < 37; $i++)
            <COL WIDTH=21>
        @endfor
        <COL>
        <TR CLASS=R1>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            <TD CLASS="R20C1" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">№</SPAN></TD>
            <TD CLASS="R20C3" COLSPAN=21><SPAN
                    STYLE="white-space:nowrap;max-width:0;">Товары&nbsp;(работы,&nbsp;услуги)</SPAN>
            </TD>
            <TD CLASS="R20C3" COLSPAN=3><SPAN STYLE="white-space:nowrap;max-width:0;">Кол-во</SPAN>
            </TD>
            <TD CLASS="R20C3" COLSPAN=2><SPAN STYLE="white-space:nowrap;max-width:0;">Ед.</SPAN>
            </TD>
            <TD CLASS="R20C3" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">Цена</SPAN>
            </TD>
            <TD CLASS="R20C33" COLSPAN=5><SPAN STYLE="white-space:nowrap;max-width:0;">Сумма</SPAN>
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        @foreach($data->production as $product)
            <TR CLASS=R4>
                <TD CLASS="R4C2"><SPAN></SPAN></TD>
                <TD CLASS="R21C1" COLSPAN=2><SPAN
                        STYLE="white-space:nowrap;max-width:0;">{{$product->key}}</SPAN></TD>
                <TD CLASS="R21C3" COLSPAN=21>
                    {{$product->full_name}}
                </TD>
                <TD CLASS="R21C24" COLSPAN=3>
                    <SPAN STYLE="white-space:nowrap;max-width:0;">
                        {{$product->quantity}}
                    </SPAN>
                </TD>
                <TD CLASS="R21C27" COLSPAN=2>
                    <SPAN STYLE="white-space:nowrap;max-width:0;">
                        {{$product->okei}}
                    </SPAN>
                </TD>
                <TD CLASS="R21C24" COLSPAN=4>
                    <SPAN STYLE="white-space:nowrap;max-width:0;">
                        {{$product->price}}
                    </SPAN>
                </TD>
                <TD CLASS="R21C33" COLSPAN=5>
                    <SPAN STYLE="white-space:nowrap;max-width:0;">
                        {{$product->sum}}
                    </SPAN>
                </TD>
                <TD><SPAN></SPAN></TD>
                <TD></TD>
            </TR>
        @endforeach
        <TR CLASS=R22>
            <TD CLASS="R22C0"><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            @for($i = 0; $i < 28; $i++)
                <TD CLASS="R22C1"><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV>
            @endfor
            <TD CLASS="R22C29"><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            @for($i = 0; $i < 3; $i++)
                <TD CLASS="R22C30"><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            @endfor
            <TD CLASS="R22C29">
                <DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;">
                    <SPAN></SPAN></DIV>
            </TD>
            @for($i = 0; $i < 4; $i++)
                <TD CLASS="R22C30"><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            @endfor
            <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;">&nbsp;</DIV></TD>
        </TR>
        <TR CLASS=R1>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            @for($i = 0; $i < 28; $i++)
                <TD CLASS="R23C1"><SPAN></SPAN></TD>
            @endfor
            <TD CLASS="R23C29" COLSPAN=4><SPAN STYLE="white-space:nowrap;max-width:0;">Итого:</SPAN></TD>
            <TD CLASS="R23C29" COLSPAN=5>
                <SPAN STYLE="white-space:nowrap;max-width:0;">
                    {{$data->total->numeric}}
                </SPAN>
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R1>
            <TD CLASS="R23C29" COLSPAN=33>
                <SPAN STYLE="white-space:nowrap;max-width:0;">
                    В&nbsp;том&nbsp;числе&nbsp;НДС {{$data->total->nds->persent}}%:
                </SPAN>
            </TD>
            <TD CLASS="R23C29" COLSPAN=5>
                <SPAN STYLE="white-space:nowrap;max-width:0;">
                    {{$data->total->nds->sum}}
                </SPAN>
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R1>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            @for($i = 0; $i < 27; $i++)
                <TD CLASS="R24C1"><SPAN></SPAN></TD>
            @endfor
            <TD CLASS="R23C29" COLSPAN=5><SPAN STYLE="white-space:nowrap;max-width:0;">Всего&nbsp;к&nbsp;оплате:</SPAN></TD>
            <TD CLASS="R23C29" COLSPAN=5>
                <SPAN STYLE="white-space:nowrap;max-width:0;">
                    {{$data->total->numeric}}
                </SPAN>
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
    </TABLE>
    <TABLE style="width:100%; height:0; " CELLSPACING=0>
        <COL WIDTH=7>
        @for($i = 0; $i < 37; $i++)
            <COL WIDTH=21>
        @endfor
        <COL WIDTH=7>
        <COL>
        <TR CLASS=R1>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R1C1" COLSPAN=37>
                <SPAN STYLE="white-space:nowrap;max-width:0;">
                    Всего наименований {{count($data->production)}}, на сумму {{$data->total->numeric}} руб.
                </SPAN>
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R1>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R24C1" COLSPAN=37>
                <SPAN STYLE="white-space:nowrap;max-width:0;">
                    {{$data->total->word}}
                </SPAN>
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R22>
            @for($i = 0; $i < 40; $i++)
                <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            @endfor
        </TR>
        <TR CLASS=R22>
            <TD>
                <DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;">
                    <SPAN></SPAN></DIV>
            </TD>
            @for($i = 0; $i < 37; $i++)
            <TD CLASS="R22C30">
                <DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV>
            </TD>
            @endfor
            <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD><DIV STYLE="position:relative; height:9px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;">&nbsp;</DIV></TD>
        </TR>
        <TR>
            @for($i = 0; $i < 40; $i++)
            <TD><SPAN></SPAN></TD>
            @endfor
            <TD>&nbsp;</TD>
        </TR>
        <TR CLASS=R1>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R31C1" COLSPAN=5><SPAN STYLE="white-space:nowrap;max-width:0;">Руководитель</SPAN></TD>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            <TD CLASS="R31C7" COLSPAN=9><SPAN STYLE="white-space:nowrap;max-width:0;">Исполнительный&nbsp;директор</SPAN></TD>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            @for($i = 0; $i < 9; $i++)
            <TD CLASS="R31C17"><SPAN></SPAN></TD>
            @endfor
            <TD CLASS="R31C26"><SPAN></SPAN></TD>
            <TD CLASS="R31C27"><SPAN></SPAN></TD>
            <TD CLASS="R31C7" COLSPAN=10>
                <SPAN STYLE="white-space:nowrap;max-width:0;">
                    {{$data->director}}
                </SPAN>
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R4>
            <TD><SPAN></SPAN></TD>
            @for($i = 0; $i < 6; $i++)
            <TD CLASS="R4C2"><SPAN></SPAN></TD>
            @endfor
            <TD CLASS="R32C7" COLSPAN=9><SPAN STYLE="white-space:nowrap;max-width:0;">должность</SPAN></TD>
            <TD CLASS="R4C2"><SPAN></SPAN></TD>
            <TD CLASS="R32C7" COLSPAN=10><SPAN STYLE="white-space:nowrap;max-width:0;">подпись</SPAN></TD>
            <TD CLASS="R32C7"><SPAN></SPAN></TD>
            <TD CLASS="R32C7" COLSPAN=10><SPAN STYLE="white-space:nowrap;max-width:0;">расшифровка&nbsp;подписи</SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R1>
            <TD><SPAN></SPAN></TD>
            @for($i = 0; $i < 5; $i++)
            <TD CLASS="R31C1"><SPAN></SPAN></TD>
            @endfor
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            @for($i = 0; $i < 8; $i++)
            <TD CLASS="R33C8"><SPAN></SPAN></TD>
            @endfor
            @for($i = 0; $i < 9; $i++)
            <TD CLASS="R33C16"><SPAN></SPAN></TD>
            @endfor
            <TD CLASS="R33C8"><SPAN></SPAN></TD>
            <TD CLASS="R33C8"><SPAN></SPAN></TD>
            <TD CLASS="R33C16"><SPAN></SPAN></TD>
            <TD CLASS="R33C28"><SPAN></SPAN></TD>
            @for($i = 0; $i < 9; $i++)
            <TD CLASS="R33C8"><SPAN></SPAN></TD>
            @endfor
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD>&nbsp;</TD>
        </TR>
        <TR CLASS=R1>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R31C1" COLSPAN=7><SPAN STYLE="white-space:nowrap;max-width:0;">Главный&nbsp;(старший)&nbsp;бухгалтер</SPAN></TD>
            @for($i = 0; $i < 8; $i++)
            <TD CLASS="R33C8"><SPAN></SPAN></TD>
            @endfor
            <TD CLASS="R1C2"><SPAN></SPAN></TD>
            @for($i = 0; $i < 9; $i++)
            <TD CLASS="R31C17"><SPAN></SPAN></TD>
            @endfor
            <TD CLASS="R31C26"><SPAN></SPAN></TD>
            <TD CLASS="R31C27"><SPAN></SPAN></TD>
            <TD CLASS="R31C7" COLSPAN=10>
                <SPAN STYLE="white-space:nowrap;max-width:0;">
                    {{$data->bookkeeper}}
                </SPAN>
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R4>
            <TD><SPAN></SPAN></TD>
            @for($i = 0; $i < 16; $i++)
            <TD CLASS="R4C2"><SPAN></SPAN></TD>
            @endfor
            <TD CLASS="R32C7" COLSPAN=10><SPAN STYLE="white-space:nowrap;max-width:0;">подпись</SPAN></TD>
            <TD CLASS="R32C7"><SPAN></SPAN></TD>
            <TD CLASS="R32C7" COLSPAN=10><SPAN STYLE="white-space:nowrap;max-width:0;">расшифровка&nbsp;подписи</SPAN>
            </TD>
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R3>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R3C1" COLSPAN=5><SPAN></SPAN></TD>
            @for($i = 0; $i < 4; $i++)
            <TD CLASS="R36C6"><SPAN></SPAN></TD>
            @endfor
            @for($i = 0; $i < 5; $i++)
            <TD CLASS="R36C10"><SPAN></SPAN></TD>
            @endfor
            @for($i = 0; $i < 23; $i++)
            <TD CLASS="R36C15"><SPAN></SPAN></TD>
            @endfor
            <TD><SPAN></SPAN></TD>
            <TD><SPAN></SPAN></TD>
            <TD>&nbsp;</TD>
        </TR>
    </TABLE>
</div>
