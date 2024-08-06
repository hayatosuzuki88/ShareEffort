<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ShareEffort</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/index.global.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.15/index.global.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var calendarEl = document.getElementById("calendar");
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: "dayGridMonth"
                });
                calendar.render();
            });

        </script>
    </head>
    <body>
        <x-app-layout>
            
            <x-slot name="header">
                Task
            </x-slot>
            
            <div class="routines">
                <h2>Task</h2>
                <div id="app">
                    <div id="calendar"></div>
                </div>
            </div>
        
        </x-app-layout>
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var calendarEl = document.getElementById("calendar");
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: "dayGridMonth",
                locale: "ja",
                height: "auto",
                firstDay: 1,
                headerToolbar: {
                    left: "dayGridMonth,listMonth",
                    center: "title",
                    right: "today prev,next"
                },
                buttonText: {
                    today: "今月",
                    month: "月",
                    list: "リスト"
                },
                //noEventsContent: "案件はありません",
                eventSources: [ // ←★追記
                    {
                    url: "/get_events",
                    },
                ],
                eventSourceFailure () { // ←★追記
                    console.error("エラーが発生しました。");
                },
                eventMouseEnter (info) { // ←★追記
                    $(info.el).popover({
                        title: info.event.title,
                        content: info.event.extendedProps.description,
                        trigger: "hover",
                        placement: "top",
                        container: "body",
                        html: true
                    });
                }
            });
            calendar.render();
        });
    </script>
</html>