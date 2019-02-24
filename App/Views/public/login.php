<div class="container">
    <div class="row">
        <div class="max-500 automargin">
            <div class="login-panel panel panel-black panel-shadow">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-sign-in fa-fw"></i> Iniciar Sesion</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <input class="form-control" placeholder="Usuario" name="username" id="username" type="text" autofocus>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Contraseña" name="password" id="password" type="password" value="">
                    </div>
                    <div class="form-group">
                        <img src="" class="center-block" id="captcha_img" style="min-height:50px;"/>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="captcha_reload_btn" title="Recargar Captcha"><i class="fa fa-refresh"></i>
                            </button>
                        </span>
                        <input class="form-control" data-input="uppercase" placeholder="Captcha" name="captcha" id="captcha" type="text" value="">
                    </div>
                    <div class="form-group">
                        <label class="btn btn-success">
                            <input name="remember" type="checkbox" class="tooglebox" id="remember" value="1">
                            <span class="tip"></span> Recordarme?                        
                        </label>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <button class="btn btn-success" id="login_btn">Iniciar Sesion!</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
    
    $("#captcha_reload_btn").on("click", function(){
        captcha_reload();
    });
    
    $("#login_btn").on("click", function(){
        login_usuario();
    });
    
    $("#password").on("keydown", function(e){
        if(e.keyCode == 13)
        {
            login_usuario();
        }
    });
    
    captcha_reload();
    
    function captcha_reload()
    {
        $("#captcha_img").attr("src",'captcha?_=' + makeID());
    }

    function login_usuario()
    {
        $(".invalid").removeClass("invalid");

        var username = $("#username").val().trim();
        var captcha = $("#captcha").val().trim();
        var password = $("#password").val().trim();
        var remember = $("#remember").prop("checked") ? 1 : 0;

        if(!username)
        {
            mostrarNotificacion("warning","Estimado Usuario", "Debe ingresar un nombre de usuario");
            $("#username").addClass("invalid");
            return;
        }

        if(!password)
        {
            mostrarNotificacion("warning","Estimado Usuario", "Debe ingresar una contraseña");
            $("#password").addClass("invalid");
            return;
        }

        if(!captcha)
        {
            mostrarNotificacion("warning","Estimado Usuario", "Debe ingresar las letras del captcha");
            $("#captcha").addClass("invalid");
            return;
        }

        var settings = {
            "type": "POST",
            "cache": false,
            "url": getApiUrl("login_usuario"),
            "dataType": "json",
            "data": {
                "username": username,
                "password": password,
                "captcha": captcha.toUpperCase(),
                "remember": remember
            },
            "beforeSend": function () {
                showLoader();
            }
        };

        $.ajax(settings).done(function(response){

            var codigo = response.codigo;

            if(codigo == 10)
            {
                mostrarNotificacion("success", "Estimado Usuario", "Datos correctos! Redirigiendo!");
                setTimeout(function(){reload()}, 1000);
            }

            if(codigo == 20)
            {
                mostrarNotificacion("danger", "Estimado Usuario", "Usuario '"+username+"' no registrado!");
                $("#username").addClass("invalid");
            }

            if(codigo == 30)
            {
                mostrarNotificacion("danger", "Estimado Usuario", "Contraseña incorrecta!");
                $("#password").addClass("invalid");
            }

            if(codigo == 40)
            {
                mostrarNotificacion("danger", "Estimado Usuario", "Usuario '"+username+"' Bloqueado!");
                $("#username").addClass("invalid");
            }
            
            if(codigo == 50)
            {
                mostrarNotificacion("danger", "Estimado Usuario", "Captcha Incorrecto!");
                $("#captcha").addClass("invalid");
                captcha_reload();
            }

            hideLoader();
        });
    }
});
</script>