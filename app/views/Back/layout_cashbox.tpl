<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Аукцион Онлайн</title>
    <meta name="DESCRIPTION" content="Аукцион"/>
    <meta name="KEYWORDS" content="Аукцион"/>
    <link href="{{@BASE}}/resource/css/bootstrap.css" rel="stylesheet">
    <link href="{{@BASE}}/resource/css/jumbotron.css" rel="stylesheet">
    <link href="{{@BASE}}/resource/css/thema.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{@BASE}}/js/main.js"></script>
    <script src="{{@BASE}}/resource/js/bootstrap.min.js"></script>
    <script src="{{@BASE}}/js/mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="{{@BASE}}/js/mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <script src="{{@BASE}}/js/mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="{{@BASE}}/js/mask/jquery.inputmask.numeric.extensions.js" type="text/javascript"></script>
    <script src="{{@BASE}}/js/mask/jquery.inputmask.custom.extensions.js" type="text/javascript"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{@BASE}}././index.php">КАССА</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <form action="../../../index.php" class="navbar-form navbar-right" method="POST">
                <div class="form-group" style="color: white;">Вы вошли как:</div>
                <div class="form-group">
                    <a href="{{@BASE}}" class="btn btn-link">{{@client->email}}</a>
                </div>
                <div class="form-group">
                    <a href="{{@BASE}}/./logout.html" class="btn btn-danger">Выйти</a>
                </div>
            </form>
        </div>
    </div>
</nav>

<div class="jumbotron myjumb">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="{{@BASE}}/resource/images/uddomami.jpeg">
            </div>
        </div>
    </div>
</div>

<div class="jumbotron myjumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <include href="Back/menu_admin.tpl"/>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <check if="{{isset(@content_template)}}">
                <true>
                    <include href="{{@content_template}}"/>
                </true>
            </check>
        </div>
    </div>

    <hr>

    <footer class="footer">
        <div class="container container-footer">
            <div class="col-md-12 text-center">
                уд-аукцион.рф
            </div>
        </div>
    </footer>
</div>

</body>
</html>