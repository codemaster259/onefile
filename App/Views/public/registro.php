<div class="container">
    <div class="row">
        <div class="col-sm-6 automargin pt20">
            <div class="login-panel panel panel-default panel-shadow">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-user-plus fa-fw"></i> Registrarse</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <input class="form-control campo_registro" placeholder="Usuario" name="username" id="username" type="text" autofocus>
                    </div>
                    <div class="form-group">
                        <input class="form-control campo_registro" placeholder="Contraseña" name="password" id="password" type="password" value="">
                    </div>
                    <div class="form-group">
                        <input class="form-control campo_registro" placeholder="Repetir Contraseña" name="password2" id="password2" type="password" value="">
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <!-- Change this to a button or input when using this as a form -->
                    <button class="btn btn-success" id="registro_btn">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$(function(){
    $("#registro_btn").on("click", function(){
        registrar_usuario();
    });

    function registrar_usuario()
    {
        $(".invalid").removeClass("invalid");

        var username = $("#username").val().trim();
        var password = $("#password").val().trim();
        var password2 = $("#password2").val().trim();

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

        if(!password2)
        {
            mostrarNotificacion("warning","Estimado Usuario", "Debe repetir la contraseña");
            $("#password2").addClass("invalid");
            return;
        }

        if(password != password2)
        {
            mostrarNotificacion("warning","Estimado Usuario", "Las contraseñas deben ser identicas");
            $("#password").addClass("invalid");
            $("#password2").addClass("invalid");
            return;
        }

        var settings = {
            "type": "POST",
            "cache": false,
            "url": getApiUrl("registrar_usuario"),
            "dataType": "json",
            "data": {
                "username": username,
                "password": password,
                "autologin": true
            },
            "beforeSend": function () {
                showLoader();
            }
        };

        $.ajax(settings).done(function(response){

            var codigo = response.codigo;

            if(codigo == 10)
            {
                mostrarNotificacion("success","Estimado Usuario", "Usuario '"+username+"' registrado! Ya puede iniciar sesion!");
                setTimeout(function(){reload()}, 1000);
            }

            if(codigo == 20)
            {
                mostrarNotificacion("danger","Estimado Usuario", "Usuario '"+username+"' ya registrado!");
                $("#username").addClass("invalid");
            }

            if(codigo == 30)
            {
                mostrarNotificacion("danger","Estimado Usuario", "Error al registrar el usuario!");
            }

            hideLoader();
        });
    }
});
</script>