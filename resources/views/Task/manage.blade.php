<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ShareEffort</title>
        <!-- Fonts -->
        <link rel="preload" href="https://fonts.googleapis.com/css?family=Nunito:200,600" as="style" onload="this.onload=null;this.rel='stylesheet'"/>
        <link rel="stylesheet" href="{{ asset('/css/manage.css') }}" />
        
    </head>
    <body>
        <x-app-layout>
            <div class="manage body">
            <!--現在の目標-->
            <div id="goal_create">
                <h2>目標設定</h2>
                <div class="goal_create">
                    <p id="close_goal_create">×</p>
                    <form action="{{ route('goal.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>あなたの目標は？？</p>
                        <input type="text" name="goal[goal]" required="required"/><br>
                        <p>いつまで？</p>
                        <input type="date" name="goal[date]" required="required"/><br>
                        <input type="hidden" name="goal[user_id]" value="{{ Auth::id() }}"/>
                        <input type="submit" value="保存" />
                    </form>
                </div>
            </div>
            <div id="plan_create">
                <p id="close_plan_create">×</p>
                <h2>プランの作成</h2>
                <div class="plan">
                    <form action="{{ route('plan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>作業概要</p>
                        <input type="text" name="plan[name]" required="required"/><br>
                        <p>いつからいつまで？</p>
                        <input type="date" name="plan[start]" required="required"/>
                        <input type="date" name="plan[end]" required="required"/><br>
                        <p>かかる時間は？</p>
                        <input type="integer" name="plan[duration]"/><br>
                        <p>どこからどこまで</p>
                        <input type="integer" name="plan[rangeS]"/>〜
                        <input type="integer" name="plan[rangeE]"/><br>
                        単位：<input type="string" name="plan[rangeUnit]"/><br>
                        <p>何時に取り組む？</p>
                        <input type="time" name="plan[routine_time]"/><br>
                        <p>何日ごと？</p>
                        <input type="integer" name="plan[interval]" required="required"/><br>
                        <p>どのゴールのため？？</p>
                        <select name="plan[goal_id]" required="required">
                            <option></option>
                            
                            @foreach ($not_achived_goals_of_mine as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->goal }}</option>
                            @endforeach
                            
                        </select><br>
                        <input type="submit" value="保存" />
                    </form>
                </div>
            </div>
            <div id="edit_event">
                <p id="close_edit_event">×</p>
                <h2>タスクの編集</h2>
                <form>
                    @csrf
                    <p>タスク名</p>
                    <input type="text" name="task[]" required="required" /><br>
                    <p>実施日</p>
                </form>
            </div>
            <div class="goals">
                <h1>現在の目標</h1>
                <div class="header">
                    <button class="button04" id="goal_create_button">Goal</button>
                    <button class="button04" id="plan_create_button">Plan</button>
                </div>
                <div>
                    
                    @if (count($my_goals)==0)
                        <p>今の目標はありません。</p>
                    @else
                    <div class="button11 prev_goal_button"><a>↑</a></div>
                    <table>
                        @foreach ($my_goals as $goal)
                        <tr class="my_goal_plan">
                            <th class="my_goal">
                                <form action="{{ route('goal.delete', ['goal_id' => $goal->id ]) }}" id="form_{{ $goal->id }}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="button" onclick="deleteGoal({{ $goal->id }})">×</button>
                                </form>
                                <h2 class="goal_name"> {{ $goal->goal }} </h2>
                                <p> {{ \Carbon\Carbon::parse($goal->date)->format('Y年m月d日') }} </p>
                                <p>あと<strong>{{ \Carbon\Carbon::parse($goal->date)->diffInDays(\Carbon\Carbon::today()) }}日</strong></p>
                            @if ($goal->achived == 0)
                                <p>未達成</p>
                            @else
                                <p>達成</p>                                
                            @endif
                            </th>
                            <th class="button11 prev_plan_button"><a><</a></th>
                            @foreach ($my_plans as $plan)
                                @if ($plan->goal_id == $goal->id)
                            <th class="my_plan">
                                <form action="{{ route('plan.delete', ['plan_id' => $plan->id ]) }}" id="form_{{ $plan->id }}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="button" onclick="deletePlan({{ $plan->id }})">×</button>
                                </form>
                                <h2>{{ $plan->name }}</h2>
                                <p>{{ $plan->start }}〜{{ $plan->end }}</p>
                                <p>1回{{ $plan->duration }}分</p>
                                <p>範囲：{{ $plan->rangeS . $plan->rangeUnit ."〜". $plan->rangeE . $plan->rangeUnit }}</p>
                                <p>毎日{{ $plan->routine_time }}に実施</p>
                                <p>{{ $plan->interval }}日ごと</p>
                            </th>
                                @endif
                            @endforeach
                            <th class="button11 next_plan_button"><a>></a></th>
                        </tr>
                        @endforeach
                        
                        
                        </div>
                        
                    </table>
                    <div class="button11 next_goal_button"><a>↓</a></div>
                    @endif
                </div>
            <div class="body">
                <h2>Task</h2>
                <div id="app">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        </x-app-layout>
    </body>
        <script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>
        <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script defer src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/index.global.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.15/index.global.min.js"></script>
        <script defer>
            document.addEventListener("DOMContentLoaded", function() {
                var calendarEl = document.getElementById("calendar");
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: "dayGridMonth"
                });
                calendar.render();
            });

        </script>
    <script defer>
        function showEventDialog(info){
            console.log(info.event.title +"ok");
            //$("#edit_event").css("display", "block");
        }
        
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
                noEventsContent: "案件はありません",
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
                        html: true,
                    });
                },
                eventClick: function (info) {
                    if (info.el.classList.contains("fc-h-event")) {
                        showEventDialog(info); // モーダルウィンドウの関数
                    }
                }
            });
            calendar.render();
        });
        
    </script>
        <script defer>
            function deleteGoal(id){
                'use strict'
                
                if (confirm('削除すると復元できません。\n本当に削除しますか？')){
                    document.getElementById(`form_${id}`).submit();
                }
            }
            function deletePlan(id){
                'use strict'
                
                if (confirm('削除すると復元できません。\n本当に削除しますか？')){
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    <script src="/js/manage.js"></script>
</html>