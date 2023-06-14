@foreach($data->pages as $key => $page)
    <TABLE style="width:100%; height:0; " CELLSPACING=0>
        <COL WIDTH=7>
        <COL WIDTH=201>
        <COL WIDTH=149>
        <COL WIDTH=113>
        <COL WIDTH=80>
        <COL WIDTH=107>
        <COL WIDTH=70>
        <COL WIDTH=112>
        <COL WIDTH=127>
        <COL WIDTH=87>
        <COL>
        <TR CLASS=R36>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R36C1" COLSPAN=10><SPAN STYLE="white-space:nowrap;max-width:0;">СВЕДЕНИЯ&nbsp;О&nbsp;ГРУЗЕ</SPAN></TD>
            <TD></TD>
        </TR>
        <TR CLASS=R53>
            <TD><DIV STYLE="position:relative; height:28px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD CLASS="R53C1">Краткое наименование груза</TD>
            <TD CLASS="R53C2">С грузом следуют документы</TD>
            <TD CLASS="R53C2">Вид упаковки</TD>
            <TD CLASS="R53C4">Кол. мест</TD>
            <TD CLASS="R53C5">Способ опреде- <BR>ления массы</TD>
            <TD CLASS="R53C4">Код груза</TD>
            <TD CLASS="R53C1">Номер контейнера</TD>
            <TD CLASS="R53C1">Класс груза</TD>
            <TD CLASS="R53C4">Масса брутто</TD>
            <TD><DIV STYLE="position:relative; height:28px;width: 100%; overflow:hidden;"><SPAN></SPAN></DIV></TD>
            <TD><DIV STYLE="width:100%;height:28px;overflow:hidden;"></DIV></TD>
        </TR>
        <TR CLASS=R54>
            <TD><SPAN></SPAN></TD>
            <TD CLASS="R54C1">1</TD>
            <TD CLASS="R54C2">2</TD>
            <TD CLASS="R54C2">3</TD>
            <TD CLASS="R54C4">4</TD>
            <TD CLASS="R54C5">5</TD>
            <TD CLASS="R54C4">6</TD>
            <TD CLASS="R54C1">7</TD>
            <TD CLASS="R54C1">8</TD>
            <TD CLASS="R54C4">9</TD>
            <TD><SPAN></SPAN></TD>
            <TD></TD>
        </TR>

        @foreach($page['production'] as $product)
            <TR CLASS=R55>
                <TD><SPAN></SPAN></TD>
                <TD CLASS="R55C1">{{$product->full_name}}</TD>
                <TD CLASS="R55C1">Товарная накладная №{{$number}} Счет-фактура №{{$billNumber}} от {{$date}}</TD>
                <TD CLASS="R55C3"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$product->okei->unit}}</SPAN></TD>
                <TD CLASS="R55C4"><SPAN STYLE="white-space:nowrap;max-width:0;">{{$product->count_places}}</SPAN></TD>
                <TD CLASS="R55C5"><SPAN></SPAN></TD>
                <TD CLASS="R55C6"><SPAN></SPAN></TD>
                <TD CLASS="R55C7"><SPAN></SPAN></TD>
                <TD CLASS="R55C8"><SPAN></SPAN></TD>
                <TD CLASS="R55C9"><SPAN></SPAN></TD>
                <TD><SPAN></SPAN></TD>
                <TD></TD>
            </TR>
        @endforeach
    </TABLE>
    @if(array_key_last($data->pages) !== $key)
        <p style="page-break-after: always;"></p>
    @endif
@endforeach
