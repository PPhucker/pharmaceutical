<div class="print table-responsive">
    <div id="document-template"
         style="zoom: 100%">
        <link href="{{ asset('css/templates/documents/shipment/protocol.css') }}"
              rel="stylesheet">
        <table style="width: 100%">
            <tr>
                <td style="text-align: right">
                    Приложение
                    <br>
                    к Правилам формирования отпускных цен на лекарственные препараты, включенные в
                    <br>
                    перечень жизненно необходимых
                    и важнейших лекарственных препаратов,
                    <br>
                    организациями оптовой торговли, аптечными
                    организациями, индивидуальными
                    <br>
                    предпринимателями и медицинскими организациями
                    <br>
                    (в ред. Постановления Правительства РФ от 24.09.2020 № 1541)
                    <br><br>
                </td>
            </tr>
        </table>
        <table class="blank" style="width: 100%">
            <tr>
                <td class="blank" colspan=22 style="font-size: 11pt;padding-bottom:10px;"><b>ПРОТОКОЛ</b></td>
            </tr>
            <tr>
                <td class="blank" colspan=22 style="font-size: 11pt;padding-bottom:10px;">{{"№ $number от $date"}}</td>
            </tr>
            <tr>
                <td class="blank" colspan=22 style="font-size: 9pt;padding-bottom:10px;"><b>согласования цен поставки
                        лекарственных препаратов, включенных в перечень жизненно необходимых и важнейших лекарственных
                        препаратов</b></td>
            </tr>
            <tr>
                <td class="blank" colspan=22 style="font-size: 11pt;border-bottom: 1px solid #000000">
                    {{$data->organization->supplier}}
                </td>
            </tr>
            <tr>
                <td class="blank" colspan=22 style="font-size: 8pt;padding-bottom:10px;">поставщик
                    (организация оптовой торговли)
                </td>
            </tr>
            <tr>
                <td class="blank" colspan=22 style="font-size: 11pt;border-bottom: 1px solid #000000">
                    {{$data->contractor->buyer}}
                </td>
            </tr>
            <tr>
                <td class="blank" colspan=22 style="font-size: 8pt;padding-bottom:10px;">получатель
                    (организация оптовой торговли или организация розничной торговли)
                </td>
            </tr>
        </table>

        @foreach($data->pages as $key => $page)
            <table class="protocol" @if($key > 0) style="margin-top: 1cm" @endif>
                <tr>
                    <td class="protocol" rowspan="2" style="width:70px">Международное<br>непатентованное<br>наименование<br>(химическое<br>или<br>группировочное)
                    </td>
                    <td class="protocol" rowspan="2" style="width:150px">Торговое наименование,<br>лекарственная
                        форма,<br>дозировка,<br>количество в<br>потребительской<br>упаковке, штриховой
                        код
                    </td>
                    <td class="protocol" rowspan="2" style="width:30px">Серия</td>
                    <td class="protocol" rowspan="2" style="width:80px">Производитель</td>
                    <td class="protocol" rowspan="2" style="font-size: 6pt">
                        Зарегист-<br>рированная<br>предель-<br>ная<br>отпускная
                        цена<br>производи-<br>теля (рублей)
                    </td>
                    <td class="protocol" colspan="2">Фактическая отпускная цена, установленная
                        производителем (рублей)
                    </td>
                    <td class="protocol" rowspan="2" style="font-size: 6pt">Дата<br>реали-<br>зации<br>производи-<br>телем
                    </td>
                    <td class="protocol" colspan="3">Отпускная<br>цена<br>организации<br>оптовой<br>торговли
                    </td>
                    <td class="protocol" colspan="2">Размер<br>оптовой<br>надбавки<br>организации<br>оптовой<br>торговли
                    </td>
                    <td class="protocol" colspan="3">Отпускная<br>цена<br>организации<br>оптовой<br>торговли
                    </td>
                    <td class="protocol" colspan="2">Суммарный<br>размер<br>оптовых<br>надбавок<br>организаций<br>оптовой<br>торговли
                    </td>
                    <td class="protocol" colspan="2">Размер<br>розничной<br>надбавки<br>организации<br>розничной<br>торговли
                    </td>
                    <td class="protocol" colspan="2">Размер<br>розничной<br>надбавки<br>организации<br>розничной<br>торговли
                    </td>
                </tr>
                <tr>
                    <td class="protocol">без<br>НДС<br>(рублей)</td>
                    <td class="protocol">с<br>НДС<br>рублей)</td>
                    <td class="protocol">УСН/<br>ЕНВД<br>(рублей)</td>
                    <td class="protocol">без<br>НДС<br>(рублей)</td>
                    <td class="protocol">с<br>НДС<br>(рублей)</td>
                    <td class="protocol">в<br>процентах</td>
                    <td class="protocol">в<br>рублях</td>
                    <td class="protocol">УСН/<br>ЕНВД<br>(рублей)</td>
                    <td class="protocol">без НДС<br>(рублей)</td>
                    <td class="protocol">с НДС<br>(рублей)</td>
                    <td class="protocol">в<br>процентах</td>
                    <td class="protocol">в<br>рублях</td>
                    <td class="protocol">в<br>процентах</td>
                    <td class="protocol">в<br>рублях</td>
                    <td class="protocol">УСН/<br>ЕНВД<br>(рублей)</td>
                    <td class="protocol">без<br>НДС<br>(рублей)</td>
                </tr>
                <tr>
                    <td class="protocol">1</td>
                    <td class="protocol">2</td>
                    <td class="protocol">3</td>
                    <td class="protocol">4</td>
                    <td class="protocol">5</td>
                    <td class="protocol">6</td>
                    <td class="protocol">7</td>
                    <td class="protocol">8</td>
                    <td class="protocol">9</td>
                    <td class="protocol">10</td>
                    <td class="protocol">11</td>
                    <td class="protocol">12</td>
                    <td class="protocol">13</td>
                    <td class="protocol">14</td>
                    <td class="protocol">15</td>
                    <td class="protocol">16</td>
                    <td class="protocol">17</td>
                    <td class="protocol">18</td>
                    <td class="protocol">19</td>
                    <td class="protocol">20</td>
                    <td class="protocol">21</td>
                    <td class="protocol">22</td>
                </tr>

                @foreach($page['production'] as $productKey => $product)
                    <tr>
                        <td class="protocol">{{$product->international_name}}</td>
                        <td class="protocol" style="text-align:left">
                            {{$product->full_name}}
                        </td>
                        <td class="protocol"
                            style="text-align:left;font-size: 6pt">{{$product->series}}</td>
                        <td class="protocol" style="text-align:left">ООО "РОСБИО", Россия,
                            Санкт-Петербург,
                            Мельничная ул, дом №12 литер А
                        </td>
                        <td class="protocol">{{$product->protocol_prices->register_price}}</td>
                        <td class="protocol">{{$product->protocol_prices->fact_price_without_nds}}</td>
                        <td class="protocol">{{$product->protocol_prices->fact_price}}</td>
                        <td class="protocol">
                            {{$protocol->date}}
                        </td>
                        <td class="protocol" style="font-size: 6pt"></td>
                        <td class="protocol">{{$product->protocol_prices->selling_price_without_nds}}</td>
                        <td class="protocol">
                            {{$product->protocol_prices->selling_price}}
                        </td>
                        <td class="protocol">
                            {{$product->protocol_prices->allowance_percent}}
                        </td>
                        <td class="protocol">
                            {{$product->protocol_prices->allowance}}
                        </td>
                        <td class="protocol">

                        </td>
                        <td class="protocol"></td>
                        <td class="protocol"></td>
                        <td class="protocol"></td>
                        <td class="protocol"></td>
                        <td class="protocol"></td>
                        <td class="protocol"></td>
                        <td class="protocol"></td>
                        <td class="protocol"></td>
                        <td class="protocol"></td>
                    </tr>
                @endforeach

            </table>
            @if(array_key_last($data->pages) !== $key)
                <p style="page-break-after: always;"></p>
            @endif
        @endforeach
        <br><br><br>
        <table class="blank" style="font-size: 8pt; width: 100%">
            <tr>
                <td class="blank" style="width: 15mm"></td>
                <td style="border-bottom: 1px solid #000000;" class="blank"></td>
                <td class="blank" style="width: 15mm"></td>
                <td style="border-bottom: 1px solid #000000; width: 50mm" class="blank"></td>
                <td class="blank" style="width: 15mm"></td>
                <td class="blank" style="width: 15mm"></td>
                <td style="border-bottom: 1px solid #000000" class="blank"></td>
                <td class="blank" style="width: 15mm"></td>
                <td style="border-bottom: 1px solid #000000; width: 50mm" class="blank"></td>
                <td class="blank" style="width: 15mm"></td>
            </tr>
            <tr>
                <td class="blank"></td>
                <td style="padding-bottom:30px;" class="blank">(подпись уполномоченного лица
                    поставщика - организации оптовой торговли)
                </td>
                <td class="blank"></td>
                <td style="padding-bottom:30px;" class="blank">Ф.И.О.</td>
                <td class="blank"></td>
                <td class="blank"></td>
                <td style="padding-bottom:30px;" class="blank">(подпись уполномоченного лица
                    получателя - организации оптовой торговли)
                </td>
                <td class="blank"></td>
                <td style="padding-bottom:30px;" class="blank">Ф.И.О.</td>
                <td class="blank"></td>
            </tr>
            <tr>
                <td class="blank"></td>
                <td class="blank">М.П.</td>
                <td class="blank"></td>
                <td class="blank">
                    <nobr>{{$date}}</nobr>
                </td>
                <td class="blank"></td>
                <td class="blank"></td>
                <td class="blank">М.П.</td>
                <td class="blank"></td>
                <td class="blank"></td>
            </tr>
        </table>
    </div>
</div>
