import Axios from "axios";

new Vue({
    el: '#sup',
    created: function(){
        this.clients();
    },
    data:{
        clients: []
    },

    methods:{
        getClients: function(){
            var urlClients = 'client/{client}/list';
            Axios.get(urlClients).then(response => {
                this.clients = response.data
            })
        }
    },
});