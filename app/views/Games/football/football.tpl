<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Cyber</title>
    <script type="text/javascript" src="{{@BASE}}/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="{{@BASE}}/js/adapter.min.js"></script>
    <script type="text/javascript" src="{{@BASE}}/js/janus.js"></script>
    <script type="text/javascript">
        var selectedStream = 5;
    </script>
    <script type="text/javascript" src="{{@BASE}}/js/streamingtest.js"></script>
    <script type="text/javascript" src="{{@BASE}}/js/football/phaser.js"></script>
    <script type="text/javascript" src="{{@BASE}}/js/football/socket.io.js"></script>
    <script type="text/javascript" src="{{@BASE}}/js/bbplayer.js"></script>
    <style type="text/css">
        body {
            margin: 0;
        }
    </style>

    <style>
        .video_view {
            position: absolute;
            width: 320px;
            height: 220px;
            background-color: black;
            right: 0;
            top: 0;
        }
    </style>

</head>
<body style="background-color: gray">

<script type="text/javascript" src="{{@BASE}}/js/football/main2.js"></script>

{*<div class = "video_view"><div id = "stream"></div></div>*}
<div class = "player" style="width: 200px">
    <script>
        const player = new BBPlayer();
        player.layer = {
            rngName: "loto20_80",       //loto rng name
            quality: 3                  //video quality ( 0 - worse / 2 - better )
        };
        player.addPort(document.querySelector(".player"));
    </script>
</div>

<div style="margin: 50px auto 0; width: 1300px; color: white; text-align: center; font-size: 40px">
    <span id="mess_ball">1Выпал шар: -</span>
</div>

<div style="margin: 20px auto 0; width: 1300px; color: white; text-align: center; font-size: 40px">
    <span>   {{ @teams.0.team.club }}</span> - <span>{{ @teams.1.team.club }}   </span>
</div>
<div style="margin: 20px auto 0; width: 1300px; color: white; text-align: center; font-size: 40px">
    <span id="score">0:0</span>
</div>
<div id="football" style="margin: 10px auto;width: 1300px; height: 600px;"></div>
<div id="message" style="margin: 0 auto; width: 1300px; color: white; text-align: center; font-size: 40px"></div>
</body>

</html>