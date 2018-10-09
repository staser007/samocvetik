<!DOCTYPE html>
<html>
<head>
    <title>Samocvetik | {{@ERROR.code}}</title>

</head>

<body>
<div class="error">
    <div class="container">
        <div class="error-main">
            <h3>{{ @ERROR.code }}<span>error</span>
                <h5>{{ @ERROR.text }}</h5>
                <p>{{ @ERROR.status }}</p>
                <check if="{{ @DEBUG > 0 }}">
                    <p style="text-align: left">
                    <repeat group="{{ explode('[', @ERROR.trace) }}" key="{{@key}}" value="{{@value}}">
                        <check if="{{ @value }}">
                            [{{@value}}<br>
                        </check>
                    </repeat>
                    </p>
                </check>
                <a href="{{@BASE}}/index.html">BACK TO HOME</a>
        </div>
    </div>
</div>
</body>
</html>