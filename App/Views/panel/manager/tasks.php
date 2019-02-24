<div class="row">
    <div class="crumb">
        <span class="item"><a href="./">Taskboard</a></span>
        <span class="item"><a href="administrar">Administrar Proyectos</a></span>
        <span class="item">Administrar Tareas</span>
    </div>
    <div class="col-lg-12">
        <h1 class="page-header">Administrar Tareas</h1>
    </div>
</div>

<div class="row">
    
    <div class="col-lg-12 automargin">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h4 class="pull-left">
                    Proyecto <strong id="proyecto_nombre"></strong>
                </h4>
                <span class="pull-right">
                    Volver
                    <a href="administrar" class="btn btn-circle btn-primary"><i class="fa fa-arrow-left fa-fw"></i></a>
                </span>
            </div>
            <div class="panel-body">
                <input type="hidden" id="project_id" value="<?php echo $project_id;?>">
                <div class="well" id="proyecto_descripcion"></div>
                
                <div class="panel clearfix">
                    <h5 class="pull-left">
                        Total <strong id="tareas_total">0</strong> tarea(s)
                    </h5>
                    <span class="pull-right">
                        Agregar
                        <button id="tareas_agregar_open" data-toggle="modal" data-target="#modal_tareas_agregar" class="btn btn-circle btn-primary"><i class="fa fa-plus fa-fw"></i></button>
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class='text-center'>Titulo</th>
                                <th class='text-center'>Prioridad</th>
                                <th class='text-center'>Estado</th>
                                <th class='text-center'>Encargado</th>
                                <th class='text-center'>Fecha</th>
                                <th class='text-center'>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tareas_lista">

                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.panel-body -->
        </div>
    </div>
    
</div>

<div class="modal fade" id="modal_tareas_agregar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                <h4 class="modal-title" id="myModalLabel">Agregar Tarea</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control campo_tarea" placeholder="Nombre" id="tareas_nombre_add" type="text">
                </div>
                <div class="form-group">
                    <textarea class="form-control campo_tarea" placeholder="Descripcion" id="tareas_descripcion_add"></textarea>
                </div>
                <div class="form-group">
                    <h5><strong>Prioridad</strong></h5>
                    <select class="form-control campo_tarea" id="tareas_prioridad_add" data-ui="select">
                        <option value="">Seleccione</option>
                        <option value="0">Baja</option>
                        <option value="1">Media</option>
                        <option value="2">Alta</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="tareas_agregar_btn">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_tareas_editar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                <h4 class="modal-title" id="myModalLabel">Editar Tarea</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control campo_tarea"id="tareas_id_edit" type="hidden">
                    <input class="form-control campo_tarea" placeholder="Nombre" id="tareas_nombre_edit" type="text">
                </div>
                <div class="form-group">
                    <textarea class="form-control campo_tarea" placeholder="Descripcion" id="tareas_descripcion_edit"></textarea>
                </div>
                <div class="form-group">
                    <h5><strong>Prioridad</strong></h5>
                    <select class="form-control campo_tarea" id="tareas_prioridad_edit" data-ui="select">
                        <option value="">Seleccione</option>
                        <option value="0">Baja</option>
                        <option value="1">Normal</option>
                        <option value="2">Alta</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="tareas_actualizar_btn">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_tareas_eliminar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog max-400" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                <h4 class="modal-title" id="myModalLabel">Eliminar Tarea</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h5>Eliminar Tarea?</h5>
                    <input class="form-control campo_tarea"id="tareas_id_delete" type="hidden">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="tareas_eliminar_btn">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_tareas_asignar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog max-400" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                <h4 class="modal-title" id="myModalLabel">Asignar Tarea</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h5>Buscar Usuario</h5>
                    <input class="form-control campo_tarea" id="tareas_id_asign" type="hidden">
                    <input class="form-control campo_tarea" id="tareas_user_id_asign" type="hidden">
                    <div class="form-group">
                        <input class="form-control campo_tarea" placeholder="Buscar Usuario" id="tareas_usuario_buscar" type="text">
                    </div>
                    <div id="tareas_usuario_lista" class="list-group" style="max-height:150px;overflow-y: auto;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="tareas_asignar_btn">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<script>

onload(function(){
        
    $("#tareas_agregar_open").on("click", function(){
        limpiar_campos(".campo_tarea");
    });
    $("#tareas_agregar_btn").on("click", function(){
        tareas_agregar();
    });
    $("#tareas_actualizar_btn").on("click", function(){
        tareas_actualizar();
    });
    $("#tareas_eliminar_btn").on("click", function(){
        tareas_eliminar();
    });
    $("#tareas_usuario_buscar").on("keydown", function(e){
        if(e.keyCode == 13) tareas_buscar_usuario();
    });
    $("#tareas_asignar_btn").on("click",function(){
        tareas_asignar();
    });
    
    proyecto_detalles();
});

function proyecto_detalles()
{
    var project_id = $("#project_id").val();
    
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("proyectos_editar"),
        "dataType": "json",
        "beforeSend": function () {
            showLoader();
        },
        "data":{
            "project_id": project_id
        }
    };
    
    $.ajax(settings).done(function(response){
        
        var codigo = response.codigo;
        
        if(codigo == 10)
        {
            var data = response.data;
            
            $("#proyecto_nombre").html(data.name);
            $("#proyecto_descripcion").html(nl2br(data.description));
            
            tareas_lista();
        }
        if(codigo == 20)
        {
            mostrarNotificacion("warning", "Estimado Usuario", "Proyecto no encontrado");
        }
        hideLoader();
    });
}

function tareas_lista()
{
    var project_id = $("#project_id").val();
    
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("tareas_lista"),
        "dataType": "json",
        "beforeSend": function () {
            showLoader();
        },
        "data":{
            "project_id": project_id
        }
    };

    $.ajax(settings).done(function(response){
        
        $("#tareas_lista").html("");
        
        var temp = "<tr>";
            temp += "<td>{{name}}</td>";
            temp += "<td class='text-center'><span class='label label-{{priority-label}} label-lg' >{{priority}}</span></td>";
            temp += "<td class='text-center'>{{status}}</td>";
            temp += "<td class='text-center'>{{username}}</td>";
            temp += "<td class='text-center'>{{created}}</td>";
            temp += "<td class='text-center'>{{actions}}</td>";
            temp += "</tr>";
            
        var actions = "";
            actions += "<a class='btn btn-circle btn-primary' title='Asignar Usuario' onclick='tareas_asignar_modal({{task_id}});'><i class='fa fa-user fa-fw'></i></a>";
            actions += " ";
            actions += "<button class='btn btn-circle btn-success' title='Editar Proyecto' onclick='tareas_editar({{task_id}});'><i class='fa fa-edit fa-fw'></i></button>";
            actions += " ";
            actions += "<button class='btn btn-circle btn-danger' title='Eliminar Proyecto' onclick='tareas_elminar_modal({{task_id}})'><i class='fa fa-trash fa-fw'></i></button>";

        var data = response.data;
        
        data.forEach(function(p){
            
            var a = new Template(actions)
                    .replace("task_id", p.task_id);
            
            var row = new Template(temp)
                    .replace("name", p.name)
                    .replace("username", p.username || "(Sin Asignar)")
                    .replace("task_id", p.task_id)
                    .replace("priority-label", p.priority, ['info','success','danger'])
                    .replace("priority", p.priority, ['Baja','Normal','Alta'])
                    .replace("status", p.status, ['Creada','En Ejecucion','En Revision', 'Finalizada'])
                    .replace("actions", a.value())
                    .replace("created", new DateFormatter(p.created).getDateTime());
            
            $("#tareas_lista").append(row.value());
        });
        
        $("#tareas_total").html(data.length);
        
        hideLoader();
    });
}

function tareas_agregar()
{
    $(".invalid").removeClass("invalid");
    
    var project_id = $("#project_id").val();
    var nombre = $("#tareas_nombre_add").val().trim();
    var descripcion = $("#tareas_descripcion_add").val().trim();
    var prioridad = $("#tareas_prioridad_add").val();
    
    if(!nombre)
    {
        mostrarNotificacion("warning", "Estimado Usuario", "El nombre no puede estar en blanco");
        $("#tareas_nombre_add").addClass("invalid");
        return;
    }
    
    if(!prioridad)
    {
        mostrarNotificacion("warning", "Estimado Usuario", "Selecione una prioridad");
        $("#tareas_prioridad_add").addClass("invalid");
        return;
    }
    
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("tareas_agregar"),
        "dataType": "json",
        "data": {
            "project_id": project_id,
            "name": nombre,
            "description": descripcion,
            "priority": prioridad,
        },
        "beforeSend": function () {
            showLoader();
        }
    };

    $.ajax(settings).done(function(response){
        
        var codigo = response.codigo;

        if(codigo == 10)
        {
            mostrarNotificacion("success", "Estimado Usuario", "Tarea '" + nombre + "' creado correctamente");
            modal_close("modal_tareas_agregar");
            tareas_lista();
        }

        if(codigo == 20)
        {
            mostrarNotificacion("danger", "Estimado Usuario", "Error al agregar la tarea");
        }
        hideLoader();
    });
}

function tareas_editar(task_id)
{    
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("tareas_editar"),
        "dataType": "json",
        "data": {
            "task_id": task_id,
        },
        "beforeSend": function () {
            showLoader();
        }
    };
    
    limpiar_campos(".campo_tarea");
    modal_open("modal_tareas_editar");
    $(".invalid").removeClass("invalid");

    $.ajax(settings).done(function(response){
        
        var codigo = response.codigo;

        if(codigo == 10)
        {
            var task = response.data;
            $("#tareas_id_edit").val(task.task_id);
            $("#tareas_nombre_edit").val(task.name);
            $("#tareas_descripcion_edit").val(task.description);
            $("#tareas_prioridad_edit").val(task.priority).dispatch("change");
        }

        if(codigo == 20)
        {
            mostrarNotificacion("danger", "Estimado Usuario", "No existe la tarea");
        }
        hideLoader();
    });
}

function tareas_actualizar()
{
    $(".invalid").removeClass("invalid");
    
    var task_id = $("#tareas_id_edit").val();
    var nombre = $("#tareas_nombre_edit").val().trim();
    var descripcion = $("#tareas_descripcion_edit").val().trim();
    var prioridad = $("#tareas_prioridad_edit").val();
    
    if(!nombre)
    {
        mostrarNotificacion("warning", "Estimado Usuario", "El nombre no puede estar en blanco");
        $("#tareas_nombre_edit").addClass("invalid");
        return;
    }
    
    if(!prioridad)
    {
        mostrarNotificacion("warning", "Estimado Usuario", "Selecione una prioridad");
        $("#tareas_prioridad_edit").addClass("invalid");
        return;
    }
    
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("tareas_actualizar"),
        "dataType": "json",
        "data": {
            "task_id": task_id,
            "name": nombre,
            "description": descripcion,
            "priority": prioridad,
        },
        "beforeSend": function () {
            showLoader();
        }
    };

    $.ajax(settings).done(function(response){
        
        var codigo = response.codigo;

        if(codigo == 10)
        {
            mostrarNotificacion("success", "Estimado Usuario", "Tarea '" + nombre + "' actualizado correctamente");
            modal_close("modal_tareas_editar");
            tareas_lista();
        }

        if(codigo == 20)
        {
            mostrarNotificacion("danger", "Estimado Usuario", "Error al actualizar la tarea");
        }
        hideLoader();
    });
}

function tareas_elminar_modal(id)
{
    $("#tareas_id_delete").val(id)
    modal_open("modal_tareas_eliminar");
}

function tareas_eliminar()
{
    var task_id = $("#tareas_id_delete").val();
    
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("tareas_eliminar"),
        "dataType": "json",
        "data": {
            "task_id": task_id,
        },
        "beforeSend": function () {
            showLoader();
        }
    };

    $.ajax(settings).done(function(response){
        
        var codigo = response.codigo;

        if(codigo == 10)
        {
            mostrarNotificacion("success", "Estimado Usuario", "Tarea eliminado correctamente");
            modal_close("modal_tareas_eliminar");
            tareas_lista();
        }

        if(codigo == 20)
        {
            mostrarNotificacion("danger", "Estimado Usuario", "Error al eliminar la tarea");
        }
        hideLoader();
    });
}

function tareas_buscar_usuario()
{
    var username = $("#tareas_usuario_buscar").val().trim();
    
    if(username.length < 3)
    {
        return;
    }
    
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("usuarios_lista"),
        "dataType": "json",
        "data": {
            "username": username
        },
        "beforeSend": function () {
            showLoader();
        }
    };
    
    $.ajax(settings).done(function(response){
        
        
        var codigo = response.codigo;
        
        var user = "<label class='list-group-item radiotab' onclick='makeItActive(this);' data-user_id='{{user_id}}'>";
        user += "{{name}} ({{username}})";
        user += "</label>";
        
        if(codigo == 10)
        {
            $("#tareas_usuario_lista").html("");
            
            var data = response.data;
            
            data.forEach(function(u){
                
                var a = new Template(user)
                    .replace("user_id", u.user_id)
                    .replace("name", u.name || "-sin nombre-")
                    .replace("username", u.username);
            
                $("#tareas_usuario_lista").append(a.value());
            });
            
            if(data.length == 0)
            {
                $("#tareas_usuario_lista").html("<div class='list-group-item'>No hay coincidencias</div>");
            }
        }
        
        hideLoader();
    });
}

function makeItActive(el){
    $(".radiotab").removeClass("active");
    $(el).addClass("active");
    $("#tareas_user_id_asign").val($(el).data("user_id"));
}

function tareas_asignar_modal(id)
{
    limpiar_campos(".campo_tarea");
    
    $("#tareas_id_asign").val(id);
    $("#tareas_usuario_lista").html("");
    
    modal_open("modal_tareas_asignar");
}

function tareas_asignar()
{
    var user_id = $("#tareas_user_id_asign").val();
    var task_id = $("#tareas_user_id_asign").val();
    
    if(!user_id)
    {
        mostrarNotificacion("warning", "Estimado Usuario", "Selecione un usuario");
        return;
    }
    
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("tareas_usuario_asignar"),
        "dataType": "json",
        "data": {
            "user_id": user_id,
            "task_id": task_id
        },
        "beforeSend": function () {
            showLoader();
        }
    };
    
    $.ajax(settings).done(function(response){
        
        var codigo = response.codigo;
        
        if(codigo == 10)
        {
            mostrarNotificacion("success", "Estimado Usuario", "Tarea eliminado correctamente");
            modal_close("modal_tareas_asignar");
            tareas_lista();
        }
        
        if(codigo == 20)
        {
            mostrarNotificacion("danger", "Estimado Usuario", "Error al asignar el usuario");
        }
    });
}
</script>