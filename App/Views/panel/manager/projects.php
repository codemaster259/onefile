<div class="row">
    <div class="crumb">
        <span class="item"><a href="./">Taskboard</a></span>
        <span class="item">Administrar Proyectos</span>
    </div>
    <div class="col-lg-12">
        <h1 class="page-header">Administrar Proyecto</h1>
    </div>
</div>

<div class="row">
    
    <div class="col-lg-12 automargin">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>Mis Proyectos</strong></h3>
            </div>
            <div class="panel-body">
                
                <div class="panel clearfix">
                    <h5 class="pull-left">
                        Total <strong id="proyectos_total">0</strong> proyecto(s)
                    </h5>
                    <span class="pull-right">
                        Agregar
                        <button id="proyectos_agregar_open" data-toggle="modal" data-target="#modal_proyectos_agregar" class="btn btn-circle btn-primary"><i class="fa fa-plus fa-fw"></i></button>
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class='text-center'>Titulo</th>
                                <th class='text-center'>Lider</th>
                                <th class='text-center'>Prioridad</th>
                                <th class='text-center'>Estado</th>
                                <th class='text-center'>Fecha</th>
                                <th class='text-center'>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="proyectos_lista">

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    
</div>

<div class="modal fade" id="modal_proyectos_agregar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                <h4 class="modal-title" id="myModalLabel">Agregar Proyecto</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control campo_proyecto" placeholder="Nombre" id="proyectos_nombre_add" type="text">
                </div>
                <div class="form-group">
                    <textarea class="form-control campo_proyecto" placeholder="Descripcion" id="proyectos_descripcion_add"></textarea>
                </div>
                <div class="form-group">
                    <h5><strong>Prioridad</strong></h5>
                    <select class="form-control campo_proyecto" id="proyectos_prioridad_add" data-ui="select">
                        <option value="">Seleccione</option>
                        <option value="0">Baja</option>
                        <option value="1">Media</option>
                        <option value="2">Alta</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="proyectos_agregar_btn">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_proyectos_editar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                <h4 class="modal-title" id="myModalLabel">Editar Proyecto</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control campo_proyecto"id="proyectos_id_edit" type="hidden">
                    <input class="form-control campo_proyecto" placeholder="Nombre" id="proyectos_nombre_edit" type="text">
                </div>
                <div class="form-group">
                    <textarea class="form-control campo_proyecto" placeholder="Descripcion" id="proyectos_descripcion_edit"></textarea>
                </div>
                <div class="form-group">
                    <h5><strong>Prioridad</strong></h5>
                    <select class="form-control campo_proyecto" id="proyectos_prioridad_edit" data-ui="select">
                        <option value="">Seleccione</option>
                        <option value="0">Baja</option>
                        <option value="1">Normal</option>
                        <option value="2">Alta</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="proyectos_actualizar_btn">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_proyectos_eliminar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog max-400" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                <h4 class="modal-title" id="myModalLabel">Eliminar Proyecto</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h5>Elminar proyecto?</h5>
                    <input class="form-control campo_proyecto"id="proyectos_id_delete" type="hidden">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="proyectos_eliminar_btn">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<script>
onload(function(){

    $("#proyectos_agregar_open").on("click", function(){
        limpiar_campos(".campo_proyecto");
    });
    $("#proyectos_agregar_btn").on("click", function(){
        proyectos_agregar();
    });
    $("#proyectos_actualizar_btn").on("click", function(){
        proyectos_actualizar();
    });
    $("#proyectos_eliminar_btn").on("click", function(){
        proyectos_eliminar();
    });
    
    $("#link_lider").on("click", function(){
        proyectos_lista()
    });
    
    $("#link_colaborador").on("click", function(){
        proyectos_lista()
    });
    
    proyectos_lista();
});

function proyectos_lista()
{
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("proyectos_lista"),
        "dataType": "json",
        "beforeSend": function () {
            showLoader();
        },
        "data":{
            "type": 1
        }
    };

    $.ajax(settings).done(function(response){
        
        $("#proyectos_lista").html("");
        
        var temp = "<tr>";
            temp += "<td>{{name}}</td>";
            temp += "<td class='text-center'>{{username}}</td>";
            temp += "<td class='text-center'><span class='label label-{{priority-label}} label-lg' >{{priority}}</span></td>";
            temp += "<td class='text-center'>{{status}}</td>";
            temp += "<td class='text-center'>{{created}}</td>";
            temp += "<td class='text-center'>{{actions}}</td>";
            temp += "</tr>";
            
        var actions = "";
            actions += "<a class='btn btn-circle btn-primary' title='Asignar Tareas' href='administrar?project_id={{project_id}}'><i class='fa fa-tasks fa-fw'></i></a>";
            actions += " ";
            actions += "<button class='btn btn-circle btn-success' title='Editar Proyecto' onclick='proyectos_editar({{project_id}});'><i class='fa fa-edit fa-fw'></i></button>";
            actions += " ";
            actions += "<button class='btn btn-circle btn-danger' title='Eliminar Proyecto' onclick='proyectos_elminar_modal({{project_id}})'><i class='fa fa-trash fa-fw'></i></button>";

        var data = response.data;
        
        data.forEach(function(p){
            
            var a = new Template(actions)
                    .replace("project_id", p.project_id);
            
            var row = new Template(temp)
                    .replace("name", p.name)
                    .replace("username", p.username)
                    .replace("project_id", p.project_id)
                    .replace("priority-label", p.priority, ['info','success','danger'])
                    .replace("priority", p.priority, ['Baja','Normal','Alta'])
                    .replace("status", p.status, ['Activo','Finalizado'])
                    .replace("actions", a.value())
                    .replace("created", new DateFormatter(p.created).getDateTime());
            
            $("#proyectos_lista").append(row.value());
        });
        
        $("#proyectos_total").html(data.length);
        
        hideLoader();
    });
}

function proyectos_agregar_modal()
{
    $("#proyectos_prioridad_add").dispatch("change");
}

function proyectos_agregar()
{
    $(".invalid").removeClass("invalid");
    
    var nombre = $("#proyectos_nombre_add").val().trim();
    var descripcion = $("#proyectos_descripcion_add").val().trim();
    var prioridad = $("#proyectos_prioridad_add").val();
    
    if(!nombre)
    {
        mostrarNotificacion("warning", "Estimado Usuario", "El nombre no puede estar en blanco");
        $("#proyectos_nombre_add").addClass("invalid");
        return;
    }
    
    if(!prioridad)
    {
        mostrarNotificacion("warning", "Estimado Usuario", "Selecione una prioridad");
        $("[data-id='proyectos_prioridad_add']").addClass("invalid");
        return;
    }
    
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("proyectos_agregar"),
        "dataType": "json",
        "data": {
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
            mostrarNotificacion("success", "Estimado Usuario", "Proyecto '" + nombre + "' creado correctamente");
            modal_close("modal_proyectos_agregar");
            proyectos_lista();
        }

        if(codigo == 20)
        {
            mostrarNotificacion("danger", "Estimado Usuario", "Error al agregar el proyecto");
        }
        hideLoader();
    });
}

function proyectos_editar(id)
{
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("proyectos_editar"),
        "dataType": "json",
        "data": {
            "project_id": id,
        },
        "beforeSend": function () {
            showLoader();
        }
    };
    
    limpiar_campos(".campo_proyecto");
    modal_open("modal_proyectos_editar");
    $(".invalid").removeClass("invalid");

    $.ajax(settings).done(function(response){
        
        var codigo = response.codigo;

        if(codigo == 10)
        {
            var proyecto = response.data;
            $("#proyectos_id_edit").val(proyecto.project_id);
            $("#proyectos_nombre_edit").val(proyecto.name);
            $("#proyectos_descripcion_edit").val(proyecto.description);
            $("#proyectos_prioridad_edit").val(proyecto.priority).dispatch("change");
        }

        if(codigo == 20)
        {
            mostrarNotificacion("danger", "Estimado Usuario", "No existe el proyecto");
        }
        
        hideLoader();
    });
}

function proyectos_actualizar()
{
    $(".invalid").removeClass("invalid");
    
    var project_id = $("#proyectos_id_edit").val();
    var nombre = $("#proyectos_nombre_edit").val().trim();
    var descripcion = $("#proyectos_descripcion_edit").val().trim();
    var prioridad = $("#proyectos_prioridad_edit").val();
    
    if(!nombre)
    {
        mostrarNotificacion("warning", "Estimado Usuario", "El nombre no puede estar en blanco");
        $("#proyectos_nombre_edit").addClass("invalid");
        return;
    }
    
    if(!prioridad)
    {
        mostrarNotificacion("warning", "Estimado Usuario", "Selecione una prioridad");
        $("[data-id='proyectos_prioridad_edit']").addClass("invalid");
        return;
    }
    
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("proyectos_actualizar"),
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
            mostrarNotificacion("success", "Estimado Usuario", "Proyecto '" + nombre + "' actualizado correctamente");
            modal_close("modal_proyectos_editar");
            proyectos_lista();
        }

        if(codigo == 20)
        {
            mostrarNotificacion("danger", "Estimado Usuario", "Error al actualizar el proyecto");
        }
        hideLoader();
    });
}

function proyectos_elminar_modal(id)
{
    $("#proyectos_id_delete").val(id)
    modal_open("modal_proyectos_eliminar");
}

function proyectos_eliminar()
{
    var project_id = $("#proyectos_id_delete").val();
    
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("proyectos_eliminar"),
        "dataType": "json",
        "data": {
            "project_id": project_id,
        },
        "beforeSend": function () {
            showLoader();
        }
    };

    $.ajax(settings).done(function(response){
        
        var codigo = response.codigo;

        if(codigo == 10)
        {
            mostrarNotificacion("success", "Estimado Usuario", "Proyecto eliminado correctamente");
            modal_close("modal_proyectos_eliminar");
            proyectos_lista();
        }

        if(codigo == 20)
        {
            mostrarNotificacion("danger", "Estimado Usuario", "Error al eliminar el proyecto");
        }
        hideLoader();
    });
}
</script>