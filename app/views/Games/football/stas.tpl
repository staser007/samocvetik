<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Cyber</title>
    <script type="text/javascript" src="{{@BASE}}/js/football/phaser.js"></script>
    <script type="text/javascript" src="{{@BASE}}/js/football/socket.io.js"></script>
    <style type="text/css">
        body {
            margin: 0;
        }
    </style>

    <script src = "{{@BASE}}/js/video_player/jwplayer.js"></script>
    <script>jwplayer.key="5OlkuBtRyZFkjKrFLhbIGi7MFNhF6DCkYW2DVA==";</script>

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
<script type="text/javascript" src="{{@BASE}}/js/football/main1.js"></script>




<div class = "video_view"><div id = "video_player_id"></div></div>

<script>
    jwplayer("video_player_id").setup({
        file: "rtmp://aa.video.ttwlimitada.com:1935/livestream/m_bingo_clear_600",
        autostart: true,
        controls: false,
        width: "100%",
        aspectratio: "4:3",
        stretching: "exactfit",
        mute: false,
        rtmp: { bufferlength: 0.5 }
    });
</script>

<div style="margin: 50px auto 0; width: 1300px; color: white; text-align: center; font-size: 40px">
    <span id="mess_ball">Выпал шар: -</span>
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