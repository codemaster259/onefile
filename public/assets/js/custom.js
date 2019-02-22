$(function(){
    $(document).on("input", function(e){
        
        var that = $(e.target);
        
        if(that.data("input"))
        {
            var type = that.data("input");

            switch(type)
            {
                case "uppercase":
                    that.val(that.val().toUpperCase());
                break;
                
                case "numeric":
                    that.val(that.val().replace(/[^0-9]/g,''));
                break;
                
                case "alphanum":
                    //that.val(that.val().replace(/[^a-zA-Z0-9ñÑ]/g,''));
                    that.val(that.val().replace(/[^\w\d]/g,''));
                break;
            }
        }
    });
});

(function(jq){
    
    jq.fn["dispatch"] = function(evt){
        this.each(function(){
            this.dispatchEvent(new Event(evt));
        });
    };
    
    jq.fn["uppercase"] = function(){

        this.on("input", function(e){

            $(this).val(this.value.toUpperCase());

        });
        return this;
    };
    
    jq.fn["numeric"] = function(){

        this.on("input", function(e){

            $(this).val(this.value.replace(/[^0-9]/g,''));

        });
        return this;
    };

    jq.fn["alphanum"] = function(){

        this.on("input", function(e){

            $(this).val(this.value.replace(/[^a-zA-Z0-9ñÑ]/g,''));

        });
        return this;
    };
    
}($));

function makeID()
{
    var dt = new Date().getTime();
    //UUIDv4
    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c){
        var r = (dt + Math.random()*16)%16 | 0;
        dt = Math.floor(dt/16);
        return (c=='x' ? r :(r&0x3|0x8)).toString(16);
    });
    return uuid;
}

function Template(str)
{
    this.str = str;
    var openToken = "{{";
    var closeToken = "}}";
    
    this.parts = [];
    
    this.setTokens = function(o,c){
        openToken = o;
        closeToken = c;
    };
    
    this.replace = function(token, value, values){
        
        var c = {
            token: token,
            value: value,
            values: values
        };
        
        this.parts.push(c);
        
        return this;
    };
    
    function parse(str, parts)
    {
        parts.forEach(function(i){
            
            var token = i.token;
            var value = i.value;
            
            if(i.values && i.values[i.value])
            {
                value = i.values[i.value];
            }
        
            str = str.split(openToken + token + closeToken).join(value);
        });
        
        return str;
    }
    
    this.value = function(){
        return parse(this.str, this.parts);
    };
}

function Crumb(home)
{    
    home = home || "Home";
    this.pieces = [];
    
    this.pieces.push({label: home, link : "./"});
    
    function parse(pieces, clazz){
        clazz = clazz || null;
        
        var crumb = document.createElement("div");
        crumb.classList.add("crumb");
        if(clazz)
        {
            crumb.classList.add(clazz.trim());    
        }
        
        pieces.forEach(function(p){
            var i = document.createElement("span");
            i.classList.add("item");
            var l = "";
            if(p.link)
            {
                l = document.createElement("a");
                l.setAttribute("href", p.link);
                l.textContent = p.label;
            }else{
                l = document.createTextNode(p.label);
            }
            i.appendChild(l);
            crumb.appendChild(i);
        });
        
        return crumb;
    }
    
    this.add = function(label, link){
        
        this.pieces.push({label: label, link: link});
        return this;
    };
    
    this.value = function(clazz){
        return parse(this.pieces, clazz);
    };
}

function DateFormatter(str)
{
    this.original = str;
    this.date = null;
    this.time = null;
    
    function parseDate(str)
    {
        var parsed = str.split("-").reverse().join("-");
        
        return parsed;
    }
    
    function parseTime(str)
    {
        var parsed = str.split(":");
        
        var h = parsed[0];
        var m = parsed[1];
        var s = parsed[2];
        var ampm = "AM";
        
        if(h > 12)
        {
            ampm = "PM";
            h -= 12;
        }
        
        if(h == 0)
        {
            h = "12";
        }
        
        return h + ":" + m + " " + ampm;
    }
    
    function parse(str, self)
    {
        var value = str.split(" ");
        self.date = parseDate(value[0]);
        self.time = parseTime(value[1]);
    }
    
    this.getDate = function(){
        parse(this.original, this);
        return this.date;
    };
    
    this.getTime = function(){
        parse(this.original, this);
        return this.date;
    };
    
    this.getDateTime = function(){
        parse(this.original, this);
        return this.date + " " + this.time;
    };
}

function showLoader(){
    $("#loader").removeClass("oculto");
}

function hideLoader(){
    $("#loader").addClass("oculto");
    //load_user_info();
}

function getApiUrl(path){
    
    return path;
}

function mostrarNotificacion(type, title, text, time)
{
    time = parseInt(time) || 3000;
    
    $("#alert-panel").removeClass("oculto");
    
    var template = "<div class='alert alert-{{type}} alert-dismissible' "+Date.now()+">";
    
        template += "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
        
        template += title ? "<h4 class='modal-title'>{{title}}</h4>" : "";
        
        template += text ? "{{text}}" : "";
    
        template += "</div>";
    
    var alertBox = $(new Template(template).replace("type", type).replace("title", title).replace("text", text).value());
    
    alertBox.hide();
    
    $("#alert-panel").append(alertBox);
    
    
    alertBox.slideDown(300).delay(time).slideUp(300, function(){
        alertBox.remove();
        
        if( $("#alert-panel").children().length == 0)
        {
             $("#alert-panel").addClass("oculto");
        }
    });
}

function modal_close(id)
{
    var modal = $("#"+id);
    
    var btn = $("<span style='display:none;' data-dismiss='modal'>X</span>");
    
    modal.append(btn);
    
    btn.click().remove();
}

function modal_open(id)
{
    var btn = $("<span style='display:none;' data-toggle='modal' data-target='#"+ id +"'>X</span>");
    $(document.body).append(btn);
    btn.click().remove();
}

function load_user_info()
{
    if(!LOGGED)
    {
        return;
    }
    
    var settings = {
        "type": "POST",
        "cache": false,
        "url": getApiUrl("perfil_info"),
        "dataType": "json",
    };

    $.ajax(settings).done(function(response){
        
        if(response.codigo == 10)
        {
            var userdata = response.data;
            
            $("#info_username").html(userdata.name + " ("+userdata.username+")");
        }
        
        if(response.codigo == 30)
        {
            alert("NO user_id! REVISA!");
        }
    });
}

function nl2br(str)
{
    return str.replace(/(?:\r\n|\r|\n)/g, '<br>');
}

function limpiar_campos(qs)
{
    console.log("limpiar_campos " + qs);
    $(qs).val("").dispatch("change");
}

function reload(path)
{
    path = path || "";
    
    var base = document.querySelector("base").href;
    
    window.location.href = base + path;
    return;
}

onload(function(){
    load_user_info();
    
    $(".datepicker-field").datepicker({
        language:'es', 
        clearBtn: true, 
        todayBtn:'linked', 
        todayHighlight: true,
        startDate: new Date()
    });
    
    SelectUI("[data-ui='select']", {
        customClass: 'select-bs'
    });
});

/*
function makeElement(type, props, text) {
 const el = document.createElement(type);
 
 Object.keys(props).forEach(prop => {
  el[prop] = props[prop];
 });
 
 const textNode = document.createTextNode(text);
 
 el.appendChild(textNode);
 
 return el;
}
const h1 = (...args) => makeElement(`h1`, ...args);
*/