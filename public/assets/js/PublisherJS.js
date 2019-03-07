
const PublisherJS = {
    subscribers: [],
    subscribe: function(e, l){
        if(!this.subscribers[e])
        {
            this.subscribers[e] = [];
        }
        this.subscribers[e].push(l);
    },
    fire: function(event, data){
        this.subscribers[event].forEach(function(subscriber){
            subscriber(event, data);
        });
    }
};

PublisherJS.subscribe("saludo",function(e,d){
    console.log(e, d);
});

PublisherJS.subscribe("despedida",function(e,d){
    alert(e + " -> " + JSON.stringify(d));
});


PublisherJS.fire("saludo", {hola:"jose"});