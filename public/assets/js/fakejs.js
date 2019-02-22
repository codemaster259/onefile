'use strict'

var Emitter = function(){}
Emitter.instance = null;
/**
 * 
 * @returns {Emitter.instance|Emitter}
 */
Emitter.get = function(){
        if(!Emitter.instance)
        {
            Emitter.instance = new Emitter();
        }
        
        return Emitter.instance;
    }

Emitter.prototype = {
    _data:{},
    on: function(el, evt, fn){
        this._data[evt] = this._data[evt] || [];
        
        this._data[evt].push({element: el, func: fn});
    },
    off: function(el, evt, fn){
        this._data[evt] = this._data[evt] || [];
        
        this._data[evt] = this._data[evt].filter(function(d){ return !(d.element == el && d.func == fn);});
    },
    dispatch: function(el, evt, data){
        this._data[evt] = this._data[evt] || [];
                
        this._data[evt].forEach(function(d){
            if(d.element == el)
            {
                d.func({element:el, event: evt, data: data});
            }
        });
    }
};

var mit = new Emitter();

;(function(){
    
    var Common = {
        extend: function(base, custom){
            
            var copy = JSON.parse(JSON.stringify(base));
            
            for (var key in custom)
            {
                if (custom.hasOwnProperty(key))
                {
                    copy[key] = custom[key];
                }
            }
            
            return copy;
        },
        addEvent: function(el, evt, fn){
            el.addEventListener(evt, fn);
        },
        removeEvent: function(el, evt, fn){
            el.removeEventListener(evt, fn);
        },
        addClass: function(el, clazz){
            el.classList.add(clazz);
        },
        removeClass: function(el, clazz){
            el.classList.remove(clazz);
        },
        addProp: function(el, key, value){
            el.setAttribute(key, value);
        },
        removeProp: function(el, key){
            el.removeAttribute(key);
        },
        hasProp: function(el, key){
            return el.hasAttribute(key);
        },
        getProp: function(el, key){
            var v = el.getAttribute(key);
            
            if(v == "undefined") return null;
            
            if(v == null) return null;
            
            if(v.trim().toLowerCase() == "true")
            {
                return true;
            }
            
            if(v.trim().toLowerCase() == "false")
            {
                return false;
            }
            
            return v;
        },
        addData: function(el, key, value){
            return Common.addProp(el, "data-"+key, value);
        },
        removeData: function(el, key){
            return Common.removeProp(el, "data-"+key);
        },
        getData: function(el, key){
            return Common.getProp(el, "data-"+key);
        },
        trigger: function(el, evt){
            if ((el[evt] || false) && typeof el[evt] == 'function')
            {
                el[evt].call(el);
            }
        }
    };
    
    /**
     * SelectUI
     */
    var SelectUI = function(el, options){
        
        this.el = el;
        
        this.init(options);
        
        el._SelectUI = this;
    };
    
    SelectUI.defaults = {
        hideOnBlur: true,
        listen: false,
        customClass: null,
    };
    
    SelectUI.instance = function(el){
        return (el._SelectUI) ? true : false;
    };
    
    SelectUI.publicMethods = ["open", "close", "toggle", "destroy", "change", "changeValue", "highlight", "reload"];
    
    SelectUI.prototype = {
        init: function(options){
        
            this.settings = Common.extend(SelectUI.defaults, options);
            
            this.opened = false;
                        
            this.disabled = false;
            
            this.selectedIndex = -1;
            this.highlightedIndex = -1;
            
            this.lastSelectedIndex = null;
            
            this.build();
        },
        build: function(){
                        
            this.select = document.createElement("div");
            Common.addData(this.select, "element", "select");
            Common.addClass(this.select, "selectUI");
            if(this.settings.customClass)
            {
                Common.addClass(this.select, this.settings.customClass);    
            }
            
            
            Common.addProp(this.select, "tabindex", this.el.tabIndex);
            
            if(this.el.id)
            {
                Common.addData(this.select, "id", this.el.id);
            }
            
                        
            this.input = document.createElement("div");
            Common.addData(this.input, "element", "input");
            Common.addClass(this.input, "input");
            
            
            if(!this.settings.customClass)
            {
                Common.addClass(this.input, "inputUI");
            }
            
            
            this.list = document.createElement("ul");
            Common.addData(this.list, "element", "list");
            Common.addClass(this.list, "list");
            
            if(!this.settings.customClass)
            {
                Common.addClass(this.list, "listUI");
            }
            
            this.hidden = document.createElement("div");
            Common.addData(this.hidden, "element", "hidden");
            
            this.reload();
            
            this.select.appendChild(this.input);
            this.select.appendChild(this.list);
            this.select.appendChild(this.hidden);
            this.el.parentElement.insertBefore(this.select, this.el);
            
            this.hidden.append(this.el);
            
            if(!this.disabled)
            {
                this.events();
            }
        },
        updateScroll: function(){
                        
            var top = this.list.scrollTop;
            var height = this.list.offsetHeight;
            
            var min = this.optionsLi[this.highlightedIndex].offsetTop;
            var itemHeight = this.optionsLi[this.highlightedIndex].offsetHeight;          
            
            var that = this;
            
            sube();
            function sube(){
                
                if(min - that.list.scrollTop < 0)
                {
                    that.list.scrollTop -=4;
                    setTimeout(sube, 20);
                }
            }
            
            baja();
            function baja(){
                if(min + itemHeight- that.list.scrollTop > height)
                {
                    that.list.scrollTop += 4;
                    setTimeout(baja, 20);
                }
            }
        },
        listen: function(){
            
            if(this.lastSelectedIndex != this.el.selectedIndex)
            {
                this.lastSelectedIndex = this.el.selectedIndex;
                this.reload();
                return true;
            }
            
            return false;
        },
        open: function(){
            this.opened = true;
            Common.addClass(this.select, "open");
            this.highlightedIndex = this.selectedIndex;
            this.highlight();
            this.updateScroll();
        },
        close: function(){
            this.opened = false;
            Common.removeClass(this.select, "open");
        },
        toggle: function(){
            this.opened ? this.close() : this.open();
        },
        highlight: function(){
                        
            this.optionsLi.forEach(function(d){
                Common.removeClass(d, "highlight");
            });
            
            Common.addClass(this.optionsLi[this.highlightedIndex], "highlight");
            this.updateScroll();
        },
        destroy: function(){
            
            this.select.parentNode.append(this.el);
            
            this.select.remove();
            
            delete this.el.F_FakeSelect;
            
            delete this;
        },
        change: function(index){
            
            if(Common.getProp(this.options[index],"disabled") != null)
            {
                return;
            }
            
            this.el.selectedIndex = index;
            this.reload();
        },
        changeValue: function(value){
            
            this.el.value = value;
            this.reload();
        },
        reload: function(){
            
            var that = this;
            
            this.list.innerHTML = "";
            
            this.options = this.el.querySelectorAll("option");
            
            this.optionsLi = new Array();
               
            if(Common.hasProp(this.el, "disabled"))
            {
                this.disabled = true;
                Common.addClass(this.select, "disabled");
            }
            
            this.options.forEach(function(d,i,a){
                
                var li = document.createElement("div");
                Common.addData(li, "element", "option");
                Common.addClass(li, "option");
                
                if(!that.settings.customClass)
                {
                    Common.addClass(li, "optionUI");
                }
                
                Common.addData(li, "value",d.value);
                Common.addData(li, "index", i);
                
                li.innerText =  d.innerText || d.innerHTML;
                
                if(Common.hasProp(d, "disabled"))
                {
                    Common.addData(li, "disabled", true);
                }
                
                that.optionsLi.push(li); 
            });
            
            this.optionsLi.forEach(function(d,i,a){
                
                that.list.appendChild(d);
                
                if(Common.getData(d, "disabled") !== true)
                {
                    Common.addEvent(d, "click", function(){

                        that.el.value = Common.getData(d, "value");
                        
                        that.reload();
                    });
                    
                    Common.addEvent(d, "mousemove", function(e){

                       that.highlightedIndex = i;
                       that.highlight();
                    });
                    
                }else{
                    Common.addEvent(d, "click", function(e){
                        e.cancelBubble = true;
                    });
                }
            });
            
            if(this.optionsLi[this.el.selectedIndex])
            {   
                this.selectedIndex = this.el.selectedIndex;
                this.highlightedIndex = this.el.selectedIndex;
                Common.addData(this.optionsLi[this.selectedIndex], "selected", true);
                this.input.innerText = this.options[this.selectedIndex].innerText;
            }
        },
        events: function(){
            
            var that = this;
            
            Common.addEvent(this.el, "change", function(){
                that.reload();
            });
            
            Common.addEvent(this.el, "change", function(){
                that.reload();
            });
            
            Common.addEvent(this.select, "blur", function(){
                if(that.settings.hideOnBlur)
                {
                    that.close();
                }
            });
            
            //keydown
            Common.addEvent(this.select, "keydown", function(e){
                
                //down
                if(e.keyCode == 40)
                {
                    e.preventDefault();
                    var val = that.highlightedIndex;
                    var temp = that.highlightedIndex;
                    
                    while(true)
                    {
                        if(!that.options[temp+1])
                        {
                            break;
                        }
                        
                        if(!that.options[temp+1].disabled)
                        {
                            temp++;
                            break;
                        }else{
                            
                            if(temp+1 < that.options.length - 1)
                            {
                                temp++;    
                            }else{                                
                                break;
                            }
                        }
                    }
                    
                    that.highlightedIndex = temp;
                    
                    if(val != temp)
                    {
                        if(that.opened)
                        {
                            that.change(temp);
                            that.highlight();
                        }else{
                            that.change(temp);
                            that.close();
                            that.reload();
                        }
                    }
                }
                
                //up
                if(e.keyCode == 38)
                {
                    e.preventDefault();
                    var val = that.highlightedIndex;
                    var temp = that.highlightedIndex;

                    while(true)
                    {
                        if(!that.options[temp-1])
                        {
                            break;
                        }
                        
                        if(!Common.hasProp(that.options[temp-1], "disabled"))
                        {
                            temp--;
                            break;
                        }else{
                            
                            if(temp-1 > 0)
                            {
                                temp--;    
                            }else{
                                break;
                            }
                        }
                    }
                    
                    that.highlightedIndex = temp;
                    
                    if(val != temp)
                    {
                        if(that.opened)
                        {
                            that.change(temp);
                            that.highlight();
                        }else{
                            that.change(temp);
                            that.close();
                            that.reload();
                        }
                    }
                }
                
                //ok
                if(e.keyCode == 13)
                {                    
                    if(that.opened)
                    {
                        that.el.value = that.options[that.highlightedIndex].value;
                        that.close();
                        that.reload();
                    }else{
                        that.toggle();
                    }
                }
            });
            
            //click
            Common.addEvent(this.select, "click", function(){
                that.toggle();
            });
            
            if(that.settings.listen)
            {
                setInterval(function(){
                    var listen = that.listen();
                    //console.log(listen ? 'cambio' : 'no cambio');
                }, 500);
            }
        }
    };
    
    window.SelectUI = function(el, options, param){
        
        if(typeof el == "object")
        {
            //console.log("is object")
            
            if(!options || typeof options == "object")
            {
                console.log("options is object")
                if(!SelectUI.instance(el))
                {
                    new SelectUI(el, options);
                }else{
                    el._SelectUI.reload();
                }
            }
            
            if(typeof options == "string")
            {
                //console.log(options + " is string")
                if(!SelectUI.instance(el))
                {
                    console.log("no instance");
                    new SelectUI(el, options, param);
                }
                                
                if(SelectUI.publicMethods.indexOf(options) != -1)
                {
                    console.log(options + " exists");
                    el._SelectUI[options](param);
                }else{
                    console.log(options + " no exists");
                }
            }
            
        }else{
        
            //console.log("is string");
            document.querySelectorAll(el).forEach(function(d,i,a){

                if(!options || typeof options == "object")
                {
                    if(!SelectUI.instance(d))
                    {
                        new SelectUI(d, options);
                    }else{
                        d._SelectUI.reload();
                    }
                }

                if(typeof options == "string")
                {
                    if(!SelectUI.instance(d))
                    {
                        new SelectUI(d, options);
                    }

                    if(SelectUI.publicMethods.indexOf(options) != -1)
                    {
                        d._SelectUI[options](param);
                    }
                }
            });
        }
    };
    
    /**
     * SwitchUI
     */
    var SwitchUI = function(el, options){
        
        this.el = el;
        
        this.init(options);
        
        el._SwitchUI = this;
    };
    
    SwitchUI.defaults = {
        
    };
    
    SwitchUI.instance = function(el){
        return (el._SwitchUI) ? true : false;
    };
    
    SwitchUI.prototype = {
        init: function(options){
        
            this.settings = Common.extend(SwitchUI.defaults, options);
            
            this.disabled = false;
                                    
            this.build();
        },
        build: function(){
            
            this.checkbox = document.createElement("label");
            Common.addClass(this.checkbox, "switchUI");
            Common.addProp(this.checkbox, "tabindex", "1");
            
            //this.hidden = document.createElement("div");
            Common.addClass(this.el, "switchUI-hidden");
            
            this.lever = document.createElement("span");
            Common.addClass(this.lever, "switchUI-lever");
            
            this.el.parentElement.appendChild(this.checkbox);
            this.checkbox.appendChild(this.el);
            this.checkbox.appendChild(this.lever);
            
            if(Common.getProp(this.el, "disabled") != null)
            {
                this.disabled = true;
                Common.addClass(this.checkbox, "disabled");
            }
            
            if(!this.disabled)
            {
                this.events();
            }
        },
        events: function(){
            
            var that = this;
            
            Common.addEvent(this.checkbox, "keydown", function(e){
                
                if(e.keyCode == 32)
                {
                    if(!that.disabled)
                    {
                        that.el.checked = !that.el.checked;
                    }
                }
            });
        }
    };
    
    window.SwitchUI = function(el, options){
        
        document.querySelectorAll(el).forEach(function(d,i,a){
                        
            if(!options || typeof options == "object")
            {
                if(!SwitchUI.instance(d))
                {
                    new SwitchUI(d, options);
                }
            }
        });
    };
    
    /**
     * RadioUI
     */
    var RadioUI = function(el, options){
        
        this.el = el;
        
        this.init(options);
        
        el._RadioUI = this;
    };
    
    RadioUI.defaults = {
        
    };
    
    RadioUI.instance = function(el){
        return (el._SwitchUI) ? true : false;
    };
    
    RadioUI.prototype = {
        init: function(options){
        
            this.settings = Common.extend(SwitchUI.defaults, options);
            
            this.disabled = false;
                                    
            this.build();
        },
        build: function(){
            
            this.radio = document.createElement("label");
            Common.addClass(this.radio, "radioUI");
            Common.addProp(this.radio, "tabindex", "1");
            
            Common.addClass(this.el, "radioUI-hidden");
            
            this.lever = document.createElement("span");
            Common.addClass(this.lever, "radioUI-lever");
            
            this.el.parentElement.appendChild(this.radio);
            this.radio.appendChild(this.el);
            this.radio.appendChild(this.lever);
            
            if(Common.getProp(this.el, "disabled") != null)
            {
                this.disabled = true;
                Common.addClass(this.radio, "disabled");
            }
            
            if(!this.disabled)
            {
                this.events();
            }
        },
        events: function(){
            
            var that = this;
            
            Common.addEvent(this.radio, "keydown", function(e){
                if(e.keyCode == 32)
                {
                    if(!that.disabled)
                    {
                        that.el.checked = !that.el.checked;
                    }
                }
            });
        }
    };
    
    window.RadioUI = function(el, options){
        
        document.querySelectorAll(el).forEach(function(d,i,a){
                        
            if(!options || typeof options == "object")
            {
                if(!RadioUI.instance(d))
                {
                    new RadioUI(d, options);
                }
            }
        });
    };
}());