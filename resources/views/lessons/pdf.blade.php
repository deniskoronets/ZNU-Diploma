<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<table>
    @foreach ($daysOfWeek as $dayId => $dayText)
        <tr>
            <td class='weekDayName' style='font-size: 35px; width: 50px;' colspan="5">{{ $dayText }}</td>
        </tr>
        @if (empty($lessons[$dayId]))
            <tr>
                <td><i>DSR</i></td>
            </tr>
        @endif
        @foreach ($lessons[$dayId] as $lesson)
            <tr>
                <td>{{ $lesson->time_start }}</td>
                <td>{{ $lesson->is_numerator ? 'числитель' : 'знаменатель' }}</td>
                <td>{{ $lesson->discipline->name }}</td>
                <td>{{ $lesson->faculty->name }}, {{ $lesson->group->name }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5"></td>
        </tr>
    @endforeach
</table>