<div class="row">
    <div class="crumb">
        <span class="item"><a href="./">Taskboard</a></span>
        <span class="item">Tareas</span>
    </div>
    <div class="col-lg-12">
        <h1 class="page-header">Tareas</h1>
    </div>
</div>

<div class="row">
    
    <div class="col-md-4">
        <div class="panel panel-yellow">
            <div class="panel-heading clearfix">
                <h4 class="pull-left">
                    Pendientes  <span class="text-muted">(<span id="tareas_pendientes_total">-</span>)</span>
                </h4>
            </div>
            <div class="list-group tareas_lista" id="tareas_pendientes">
                <div class="list-group-item clearfix">
                    <span>Cargando...</span>
                </div>
            </div>
                
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading clearfix">
                <h4 class="pull-left">
                    En Ejecucion  <span class="text-muted">(<span id="tareas_ejecucion_total">-</span>)</span>
                </h4>
            </div>
            <div class="list-group tareas_lista" id="tareas_ejecucion">
                <div class="list-group-item clearfix">
                    <span>Cargando...</span>
                </div>
            </div>
                
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="panel panel-green">
            <div class="panel-heading clearfix">
                <h4 class="pull-left">
                    Finalizadas  <span class="text-muted">(<span id="tareas_finalizadas_total">-</span>)</span>
                </h4>
            </div>
            <div class="list-group tareas_lista" id="tareas_finalizadas">
                <div class="list-group-item clearfix">
                    <span>Cargando...</span>
                </div>
            </div>
                
        </div>
    </div>
    
</div>
<script>
onload(function(){
    
    tareas_lista();
    
});

function tareas_lista()
{
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("tareas_usuario"),
        "dataType": "json",
        "beforeSend": function () {
            showLoader();
        }
    };

    $.ajax(settings).done(function(response){
       
        $(".tareas_lista").html("");
        
        var none = "<div class='list-group-item clearfix'>No hay tareas en esta lista</div>";
        
        var pending = "<div class='list-group-item clearfix'>";
            pending += "<span>{{name}}</span>";
            pending += "<span class='pull-right'>";
            
            pending += "<button class='btn btn-primary btn-circle pull-right'><i class='fa fa-arrow-right'></i></button>";
            
            pending += "</span>";
            pending += "</div>";
            
        var ongoing = "<div class='list-group-item clearfix'>";
            ongoing += "<span>{{name}}</span>";
            ongoing += "<span class='pull-right'>";
            
            ongoing += "<button class='btn btn-success btn-circle pull-right'><i class='fa fa-arrow-right'></i></button>";
            
            ongoing += "</span>";
            ongoing += "</div>";
            
        var finished = "<div class='list-group-item clearfix'>";
            finished += "<span>{{name}}</span>";
            finished += "<span class='pull-right'>";
            
            finished += "<span class='btn btn-primary btn-circle'><i class='fa fa-arrow-left'></i></span>";
            finished += "<span class='btn btn-success btn-circle'><i class='fa fa-check'></i></span>";
            
            finished += "</span>";
            finished += "</div>";
            

        var data = response.data;
        
        var pend = 0;
        var ong = 0;
        var fin = 0;
        
        data.forEach(function(t){
            
            var status = t.status;
            
            var template = "";
            
            switch(status)
            {
                case 1: 
                    template = pending;
                    pend++;
                break;
                case 2: 
                    template = ongoing;
                    ong++;
                break;
                case 3: 
                    template = finished;
                    fin++;
                break;
            }
            
            var row = new Template(template)
                    .replace("name", t.name)
                    .replace("task_id", p.project_id)
                    .replace("priority-label", t.priority, ['info','success','danger'])
                    .replace("priority", t.priority, ['Baja','Normal','Alta'])
                    .replace("status", t.status-1, ['Pendiente','En Ejecucion','Finalizado'])
                    .replace("actions", a.value())
                    .replace("created", new DateFormatter(p.created).getDateTime());
            
            switch(status)
            {
                case 1: 
                    $("#tareas_pendientes").append(row.value());
                break;
                case 2: 
                    $("#tareas_ejecucion").append(row.value());
                break;
                case 3: 
                    $("#tareas_finalizadas").append(row.value());
                break;
            }
            
            
        });
        
        if(pend == 0)
        {
            $("#tareas_pendientes").html(none);
        }
        if(ong == 0)
        {
            $("#tareas_ejecucion").html(none);
        }
        if(fin == 0)
        {
            $("#tareas_finalizadas").html(none);
        }

        $("#tareas_pendientes_total").html(pend);
        $("#tareas_ejecucion_total").html(ong);
        $("#tareas_finalizadas_total").html(fin);
        
        hideLoader();
    });
}
</script>