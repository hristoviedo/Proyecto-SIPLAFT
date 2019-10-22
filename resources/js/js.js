import Axios from "axios";

new Vue({
    el: '#sup',
    created: function(){
        this.getClients();
    },
    mounted: function(){
        this.addProperty();
    },
    data:{
        clients: [
        ],
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page':0,
            'last_page':0,
            'from':0,
            'to':0,
        },
        offset: 3,
    },
    computed:{
        isActived: function(){
            return this.pagination.current_page;
        },
        pagesNumber: function(){
            if(!this.pagination.to){
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if(from < 1){
                from = 1;
            }

            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while(from <= to){
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
    },
    methods:{
        getClients: function(page){
            var urlClients = 'list?page='+page;
            Axios.get(urlClients).then(response => {
                // this.clients = response.data,
                this.clients = response.data.clients.data,
                this.pagination = response.data.pagination
            });
        },

        addProperty: function(){
            for(i in this.clients){
                // this.clients[client].isVisible = false;
                Vue.set(this.clients[i], 'isVisible', false);
            };
        },

        changePage:function(page){
            this.pagination.current_page = page;
            this.getClients(page);
        },

    },
});