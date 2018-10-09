<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Cyber</title>
    <script type="text/javascript" src="{{@BASE}}/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="{{@BASE}}/js/adapter.min.js"></script>
    <script type="text/javascript" src="{{@BASE}}/js/janus.js"></script>
    <script type="text/javascript">
        var selectedStream = 0;
    </script>
    <script type="text/javascript" src="{{@BASE}}/js/streamingtest.js"></script>
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


<div class = "video_view"><div id = "stream"></div></div>

</body>

</html>