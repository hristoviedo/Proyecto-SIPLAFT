import Axios from "axios";

var vm = new Vue({
    el: '#sup',
    created: function(){
        this.getClients();
    },
    data:{
        clients: [],
        chosenClient:[],
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page':0,
            'last_page':0,
            'from':0,
            'to':0,
        },
        offset: 3,
        property: '',
    },
    computed:{
        searchClient: function(){
            return this.clients.filter((index) => {
                return index.identity.toUpperCase().includes(this.property.toUpperCase()) ||
                index.name.toUpperCase().includes(this.property.toUpperCase()) ||
                index.email.toUpperCase().includes(this.property.toUpperCase()) ||
                index.workplace.toUpperCase().includes(this.property.toUpperCase()) ||
                index.funding.toUpperCase().includes(this.property.toUpperCase()) ||
                index.risk.toUpperCase().includes(this.property.toUpperCase()) ||
                index.nationality.toUpperCase().includes(this.property.toUpperCase()) ||
                index.activity.toUpperCase().includes(this.property.toUpperCase())
            });
        },
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

        addClient: function(index){
           this.chosenClient = {client:this.clients[index]};
        },

        deleteClient: function(){
            this.chosenClient = '';
        },

        changePage: function(page){
            this.pagination.current_page = page;
            this.getClients(page);
        },

    },
});