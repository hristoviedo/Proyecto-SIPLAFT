/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

import Axios from "axios";

var vm = new Vue({
    el: '#sup',
    created: function(){
        this.getClients();
        this.getClientsAll();
    },
    data:{
        clients: [],
        clientsAll: [],
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
        searchClientAll: function(){
            return this.clientsAll.filter((index) => {
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
        getClientsAll: function(){
            var urlClientsAll = 'list/index2';
            Axios.get(urlClientsAll).then(response => {this.clientsAll = response.data});
        },
        addClient: function(index){
           this.chosenClient = {client:this.clients[index]};
        },

        addClientAll: function(index){
           this.chosenClient = {client:this.searchClientAll[index]};
        },

        deleteClient: function(){
            this.chosenClient = '';
        },

        changePage: function(page){
            this.pagination.current_page = page;
            this.getClients(page);
        },

        formatPrice: function(value) {
            let val = (value/1).toFixed(2).replace(',', '.');
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        riskColor: function(index){
            if (this.clients[index].risk == 'CRÍTICO') {
                return {'background-color':'rgba(255, 0, 0, 0.7)'};
            } else if(this.clients[index].risk == 'ALTO') {
                return {'background-color':'rgba(255, 127, 16, 0.7)'};
            } else if(this.clients[index].risk == 'SIGNIFICATIVO') {
                return {'background-color':'rgba(255, 255, 0, 0.7)'};
            } else if(this.clients[index].risk == 'MODERADO') {
                return {'background-color':'rgba(102, 102, 102, 0.7)'};
            } else if(this.clients[index].risk == 'BAJO') {
                return {'background-color':'rgba(0, 128, 0, 0.7)'};
            } else {
                return {'background-color':'rgba(50, 75, 200, 0.7)'};
            }
        },
        riskColorAll: function(index){
            if (this.searchClientAll[index].risk == 'CRÍTICO') {
                return {'background-color':'rgba(255, 0, 0, 0.7)'};
            } else if(this.searchClientAll[index].risk == 'ALTO') {
                return {'background-color':'rgba(255, 127, 16, 0.7)'};
            } else if(this.searchClientAll[index].risk == 'SIGNIFICATIVO') {
                return {'background-color':'rgba(255, 255, 0, 0.7)'};
            } else if(this.searchClientAll[index].risk == 'MODERADO') {
                return {'background-color':'rgba(102, 102, 102, 0.7)'};
            } else if(this.searchClientAll[index].risk == 'BAJO') {
                return {'background-color':'rgba(0, 128, 0, 0.7)'};
            } else {
                return {'background-color':'rgba(50, 75, 200, 0.7)'};
            }
        },
        riskColorCard: function(index){
            if (this.chosenClient[index].risk == 'CRÍTICO') {
                return {'background-color':'rgba(255, 0, 0, 0.3)'};
            } else if(this.chosenClient[index].risk == 'ALTO') {
                return {'background-color':'rgba(255, 127, 16, 0.3)'};
            } else if(this.chosenClient[index].risk == 'SIGNIFICATIVO') {
                return {'background-color':'rgba(255, 255, 0, 0.3)'};
            } else if(this.chosenClient[index].risk == 'MODERADO') {
                return {'background-color':'rgba(102, 102, 102, 0.3)'};
            } else if(this.chosenClient[index].risk == 'BAJO') {
                return {'background-color':'rgba(0, 128, 0, 0.3)'};
            } else {
                return {'background-color':'rgba(50, 75, 200, 0.3)'};
            }
        },
        riskImageCard: function(index){
            if (this.chosenClient[index].risk == 'CRÍTICO') {
                return "img/critico.png";
            } else if(this.chosenClient[index].risk == 'ALTO') {
                return "img/alto.png";
            } else if(this.chosenClient[index].risk == 'SIGNIFICATIVO') {
                return "img/significativo.png";
            } else if(this.chosenClient[index].risk == 'MODERADO') {
                return "img/moderado.png";
            } else if(this.chosenClient[index].risk == 'BAJO') {
                return "img/bajo.png";
            }
        }
    },
});

var vm = new Vue({
    el: '#col',
    data:{
    },
});
