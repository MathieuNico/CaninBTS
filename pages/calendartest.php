<?php
$datas = json_decode('[{"id":1,"title":"The 1","start":"2023-11-22 11:00","end":"2023-11-22 12:00","url":"https://google.fr","color":"red"},{"id":2,"title":"The 2","start":"2023-11-22 14:00","end":"2023-11-22 15:00","url":"https://google.fr","color":"blue"},{"id":3,"title":"The 3","start":"2023-11-22 18:00","end":"2023-11-22 19:00","url":"https://google.fr","color":"white","textColor":"black"}]');

// echo("<pre>");
// echo("<code>");
// var_dump($datas);
// echo("</code>");
// echo("</pre>");

$final_array = json_encode($datas);
echo("<pre>");
echo("<code>");
var_dump($final_array);
echo("</code>");
echo("</pre>");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FullCalendar</title>
</head>
<body style="background-color: #888; text-align: center;">
    <h1>FullCalendar</h1>

    <input id="event-datas" type="hidden" value='<?php echo $final_array; ?>'>

    <div id="calendar" style="max-width:80%;"></div>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script>

        let test = document.querySelector("#event-datas").value;
        let events = JSON.parse(test);
        console.log(events);
        console.log( JSON.stringify(events) )

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: { center: 'dayGridMonth,timeGridWeek' }, // buttons for switching between views
                initialView: 'dayGridMonth',
                events: events,
                locale: 'fr',
                // slotDuration: '02:00'
            });
            calendar.render();
        });

    </script>
</body>
</html>