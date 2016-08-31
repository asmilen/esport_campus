@extends('frontend')

@section('content')
    <div class="content v-1 v12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Vòng 1: thi kiến thức esports &nbsp;</h2>
                    <div class="time">
                        Thời gian: <span id="timer"></span>
                    </div>
                    {!! Form::open(['method' => 'POST','url' => 'vong-1/buoc-2']) !!}
                    <div class="ask-item">
                        <div class="ask">
                            Câu {{$current + 1}}/21: {{$question->question}}
                        </div>
                        <div class="aswer inline-radio">
                            <div class="radioholder">
                                <input type="radio" name="answer" value="{{$question->answers[0]->id}}" >
                                <label for=""><span>A</span>{{$question->answers[0]->answer}}</label>
                            </div>
                            <div class="radioholder">
                                <input type="radio" name="answer" value="{{$question->answers[1]->id}}">
                                <label for=""><span>B</span>{{$question->answers[1]->answer}}</label>
                            </div>
                            <div class="radioholder">
                                <input type="radio" name="answer" value="{{$question->answers[2]->id}}">
                                <label for=""><span>C</span>{{$question->answers[2]->answer}}</label>
                            </div>
                            <div class="radioholder">
                                <input type="radio" name="answer" value="{{$question->answers[3]->id}}">
                                <label for=""><span>D</span>{{$question->answers[3]->answer}}</label>
                            </div>
                        </div>
                        <button class="ask-nxt btn btn-default">
                            Câu tiếp theo
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')

    <script type="text/javascript">
        var Timer;
        var TotalSeconds;
        function CreateTimer(TimerID, Time) {
            Timer = document.getElementById(TimerID);
            TotalSeconds = Time;

            UpdateTimer()
            window.setTimeout("Tick()", 1000);
        }

        function Tick() {
            if (TotalSeconds <= 0) {
                //  alert("Time's up!")
                return;
            }

            TotalSeconds -= 1;
            UpdateTimer()
            window.setTimeout("Tick()", 1000);
        }

        function UpdateTimer() {
            var Seconds = TotalSeconds;

            var Days = Math.floor(Seconds / 86400);
            Seconds -= Days * 86400;

            var Hours = Math.floor(Seconds / 3600);
            Seconds -= Hours * (3600);

            var Minutes = Math.floor(Seconds / 60);
            Seconds -= Minutes * (60);
            var TimeStr = LeadingZero(Minutes) + ":" + LeadingZero(Seconds);
            Timer.innerHTML = TimeStr;
        }
        function LeadingZero(Time) {
            return (Time < 10) ? "0" + Time : + Time;
        }
    </script>
    <script type="text/javascript">window.onload = CreateTimer("timer",{{$remain_time}});</script>
@endsection