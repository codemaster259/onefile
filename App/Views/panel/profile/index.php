<div class="row">
    <div class="crumb">
        <span class="item"><a href="./">Taskboard</a></span>
        <span class="item">Perfil</span>
    </div>
    <div class="col-lg-12">
        <h1 class="page-header text-center">Perfil</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-md-6 automargin">
        <div class="panel panel-black panel-shadow ">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user fa-fw"></i> Datos del Usuario: <strong><?php echo $username;?></strong></h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <input class="form-control" placeholder="Nombre" name="nombre" id="nombre" type="text" value="<?php echo $nombre;?>">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Apellido" name="apellido" id="apellido" type="text" value="<?php echo $apellido;?>">
                </div>
            </div>
            <div class="panel-footer text-center">
                <!-- Change this to a button or input when using this as a form -->
                <button class="btn btn-success" id="userdata_btn">Actualizar</button>
            </div>
        </div>
    </div>
    <div class="col-md-6 automargin">
        <div class="panel panel-black panel-shadow ">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-key fa-fw"></i> Actualizar Contraseña</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <input class="form-control campo_password" placeholder="Contraseña Actual" id="password_old" type="password">
                </div>
                <div class="form-group">
                    <input class="form-control campo_password" placeholder="Contraseña" id="password" type="password">
                </div>
                <div class="form-group">
                    <input class="form-control campo_password" placeholder="Repetir Contraseña" id="password2" type="password">
                </div>
            </div>
            <div class="panel-footer text-center">
                <!-- Change this to a button or input when using this as a form -->
                <button class="btn btn-success" id="password_btn">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
    $("#userdata_btn").on("click", function(){
        perfil_cambiar_datos();
    });
    $("#password_btn").on("click", function(e){
        perfil_cambiar_password();
    });

    function perfil_cambiar_datos()
    {
        $(".invalid").removeClass("invalid");

        var nombre = $("#nombre").val().trim();
        var apellido = $("#apellido").val().trim();

        if(!nombre)
        {
            mostrarNotificacion("warning", "Estimado Usuario", "El nombre no puede estar en blanco");
            $("#nombre").addClass("nombre");
            return;
        }

        if(!apellido)
        {
            mostrarNotificacion("warning", "Estimado Usuario", "El apellido no puede estar en blanco");
            $("#apellido").addClass("apellido");
            return;
        }

        var settings = {
            "type": "POST",
            "cache": false,
            "url": getApiUrl("perfil_cambiar_datos"),
            "dataType": "json",
            "data": {
                "nombre": nombre,
                "apellido": apellido
            },
            "beforeSend": function () {
                showLoader();
            }
        };

        $.ajax(settings).done(function(response){

            var codigo = response.codigo;

            if(codigo == 10)
            {
                mostrarNotificacion("success", "Estimado Usuario", "Datos actualizados correctamente");
                load_user_info();
            }

            if(codigo == 20)
            {
                mostrarNotificacion("danger", "Estimado Usuario", "Error al actualizar los datos");
            }
            hideLoader();
        });
    }

    function perfil_cambiar_password()
    {
        $(".invalid").removeClass("invalid");

        var password_old = $("#password_old").val().trim();
        var password = $("#password").val().trim();
        var password2 = $("#password2").val().trim();

        if(!password_old)
        {
            mostrarNotificacion("warning","Estimado Usuario", "Debe ingresar la contraseña actual");
            $("#password_old").addClass("invalid");
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
            "url": getApiUrl("perfil_cambiar_password"),
            "dataType": "json",
            "data": {
                "password_old": password_old,
                "password": password
            },
            "beforeSend": function () {
                showLoader();
            }
        };

        $.ajax(settings).done(function(response){

            var codigo = response.codigo;

            if(codigo == 10)
            {
                mostrarNotificacion("success", "Estimado Usuario", " actualizada correctamente");
                limpiar_campos(".campo_password");
            }

            if(codigo == 20)
            {
                mostrarNotificacion("danger", "Estimado Usuario", "Error al actualizar la Contraseña");
            }

            if(codigo == 30)
            {
                mostrarNotificacion("danger", "Estimado Usuario", "La Contraseña actual es incorrecta");
                $("#password_old").addClass("invalid");
            }

            hideLoader();
        });
    }

});
</script>