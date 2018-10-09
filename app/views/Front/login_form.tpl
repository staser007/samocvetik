<script type="text/javascript" language="JavaScript">
    $(function(){

        $('#loginform').submit(function(){
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(data, textStatus, jqXHR){
                    $('#authblock').load(_base+'/load/authblock');
                },
                error: function(jqXHR, textStatus, errorThrown){
                    if(jqXHR.responseJSON != undefined){
                        errorThrown = jqXHR.responseJSON.description;
                    }

                    $('#loginform').after('<div class="alert alert-warning fade in">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                        '<strong>'+textStatus+'</strong> '+errorThrown+'</div>');
                },
                timeout: 10000,
                cache: false
            });
            return false;
        });
    });
</script>

<form id="loginform" action="ajax/login" class="login">
    <input type="text" placeholder="email" name="login" id="login">
    <input type="password" placeholder="Password" name="password" id="password">
    <input type="submit" value="Login">
</form>
<a href="{{ @BASE }}/reg.html">Регистрация</a>
