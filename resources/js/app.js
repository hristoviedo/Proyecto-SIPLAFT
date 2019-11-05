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
//Elemento raíz para la generaldades de la página [No Implementado]
const app = new Vue({
    el: '#app',
});

import Axios from "axios";

//Elemento raíz para supervisor
var vm = new Vue({
    el: '#sup', // id donde se implementa Vue
    // Cuando se crea la instancia se ejecutan las siguientes funciones
    created: function(){
        this.getClients(); // Carga la lista de clientes compaginados
        this.getClientsAll(); // Carga la lista de todos los clientes en un mismo arreglo
    },
    data:{
        clients: [], // Arreglo que contiene la lista de clientes según paginación
        clientsAll: [], // Arreglo que contiene la lista de todos los clientes
        chosenClient:[], // Arreglo que contiene un solo registro de cliente mostrado en la tarjeta [card]
        // Objeto que contiene los atributos de la paginación
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page':0,
            'last_page':0,
            'from':0,
            'to':0,
        },
        offset: 4, // Indica la cantidad de paginación a la izquierda y derecha de la actual
        property: '', // Variable que determina la búsqueda del usuario
        viewAll: false,
    },
    computed:{
        // Realiza la búsqueda, en el arreglo [clientsAll] según la propiedad que el usuario indique [property]
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
        // Retorna la página que está activa
        isActived: function(){
            return this.pagination.current_page;
        },
        // Asigna el número de páginas en la paginación
        pagesNumber: function(){
            // Si no hay página, retorna vacío
            if(!this.pagination.to){
                return [];
            }

            // Si [from] - [offset] es menor que uno, entonces [from] es uno
            var from = this.pagination.current_page - this.offset;
            if(from < 1){
                from = 1;
            }

            // Si [to] es mayor o igual que [last_page], entonces [to] es [last_page]
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }

            // mientras [from] sea menor o igual a [to] entonces el [pagesArray] guardará [from]
            var pagesArray = [];
            while(from <= to){
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
    },
    methods:{
        showEverything: function(){
            this.property = ' ';
            this.viewAll = !this.viewAll;
        },
        // Llama a la ruta /list y usa [page] como variable opcional para cargar los registros de clientes en MySQL
        getClients: function(page){
            var urlClients = 'list?page='+page;
            Axios.get(urlClients).then(response => {
                this.clients = response.data.clients.data,
                this.pagination = response.data.pagination
            });
        },
        // Llama a la ruta list/index2 para cargar los registros de todos los clientes en MySQL
        getClientsAll: function(){
            var urlClientsAll = 'list/index2';
            Axios.get(urlClientsAll).then(response => {this.clientsAll = response.data});
        },
        // Agrega un objeto cliente de [clients] para ser visto en la card
        addClient: function(index){
           this.chosenClient = {client:this.clients[index]};
        },

        // Agrega un objeto cliente de [searchClientsAll] para ser visto en la card
        addClientAll: function(index){
           this.chosenClient = {client:this.searchClientAll[index]};
        },

        // Deja vacío el arreglo [chosenClient] y la card desaparece
        deleteClient: function(){
            this.chosenClient = '';
        },

        // Realiza el cambio de página
        changePage: function(page){
            this.pagination.current_page = page;
            this.getClients(page);
        },

        // Da formato a las cantidades de dinero
        formatPrice: function(value) {
            let val = (value/1).toFixed(2).replace(',', '.');
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },

        // Asigna color según el riesgo del cliente en la paginación
        riskColor: function(index){
            if (this.clients[index].risk == 'CRITICO') {
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
        //Asigna color según el riesgo del cliente en las búsquedas
        riskColorAll: function(index){
            if (this.searchClientAll[index].risk == 'CRITICO') {
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
        // Asigna color según el riesgo del cliente en la card
        riskColorCard: function(index){
            if (this.chosenClient[index].risk == 'CRITICO') {
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

        // Asigna la imagen según el riesgo del cliente en la card
        riskImageCard: function(index){
            if (this.chosenClient[index].risk == 'CRITICO') {
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

//Elemento raíz para colaborador [No Implementado]
var vm = new Vue({
    el: '#col',
    data:{
    },
});
