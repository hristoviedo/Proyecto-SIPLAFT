require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import Axios from "axios";

import moment from 'moment';
moment.locale('ES');

//*************************************************** Elemento raíz para supervisor clientes ***************************************************
var vm = new Vue({
    el: '#sup_clients', // id donde se implementa Vue
    // Cuando se crea la instancia se ejecutan las siguientes funciones
    created: function(){
        this.getClientXCompany(); // Carga la lista de todos los clientes y el nombre de la empresa que lo registró en un mismo arreglo
        this.getClients(); // Carga la lista de clientes compaginados
        this.getClientsAll(); // Carga la lista de todos los clientes en un mismo arreglo
    },
    data:{
        clients: [], // Arreglo que contiene la lista de clientes según paginación
        clientXCompanies: [], // Arreglo que contiene la lista de clientes y empresa
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
        offset: 5, // Indica la cantidad de paginación a la izquierda y derecha de la actual
        property: '', // Variable que determina la búsqueda del usuario
    },
    computed:{
        // Realiza la búsqueda, en el arreglo [clientsAll] según la propiedad que el usuario indique [property]
        searchClientAll: function(){
            return this.clientsAll.filter((index) => {
                return index.client_identity.toUpperCase().includes(this.property.toUpperCase().trim()) ||
                index.client_name.toUpperCase().includes(this.property.toUpperCase().trim()) ||
                index.client_email.toUpperCase().includes(this.property.toUpperCase().trim()) ||
                index.client_workplace.toUpperCase().includes(this.property.toUpperCase().trim()) ||
                index.client_workstation.toUpperCase().includes(this.property.toUpperCase().trim()) ||
                index.client_salary.toUpperCase().includes(this.property.toUpperCase().trim()) ||
                index.client_funding.toUpperCase().includes(this.property.toUpperCase().trim()) ||
                index.client_risk.toUpperCase().includes(this.property.toUpperCase().trim()) ||
                index.client_nationality.toUpperCase().includes(this.property.toUpperCase().trim())||
                index.client_activity.toUpperCase().includes(this.property.toUpperCase())
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
        // Asigna un espacio a [property] para mostrar todos los registros.
        showEverything: function(){
            this.property = ' ';
        },
        // Limpia el valor de [property] para mostrar la paginación.
        showpagination: function(){
            this.property = '';
        },
        // Llama a la ruta /list-clients y usa [page] como variable opcional para cargar los registros de clientes en MySQL
        getClients: function(page){
            var urlClients = 'list-clients?page='+page;
            Axios
            .get(urlClients)
            .then(response => {
                this.clients = response.data.clients.data,
                this.pagination = response.data.pagination
            })
            .catch(err => {
                console.log(err);
            });
        },
        // Llama a la ruta /list-clients/indexAll para cargar los registros de todos los clientes en MySQL
        getClientsAll: function(){
            var urlClientsAll = 'list-clients/indexAll';
            Axios
            .get(urlClientsAll)
            .then(response => {
                this.clientsAll = response.data
            })
            .catch(err => {
                console.log(err);
            });
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

        // Llama a la ruta /list-clientxcompany/indexAll para cargar los registros de todos los clientes y compañias relacionadas en MySQL
        getClientXCompany: function(){
            var urlClientXCompany = 'list-clientxcompany/indexAll';
            Axios
            .get(urlClientXCompany)
            .then(response => {
                this.clientXCompanies = response.data
            })
            .catch(err => {
                console.log(err);
            });
        },
        // Llama a la ruta /list-users/indexCompany para cargar los registros de todos las compañias en MySQL
        getCompanies: function(){
            var urlCompanies = 'list-users/indexCompany';
            Axios
            .get(urlCompanies)
            .then(response => {
                this.companies = response.data
            })
            .catch(err => {
                console.log(err);
            });
        },

        // Asigna color según el riesgo del cliente en la paginación
        riskColor: function(index){
            if (this.clients[index].client_risk == 'CRITICO') {
                return {'background-color':'rgba(255, 0, 0, 0.7)'};
            } else if(this.clients[index].client_risk == 'ALTO') {
                return {'background-color':'rgba(255, 127, 16, 0.7)'};
            } else if(this.clients[index].client_risk == 'SIGNIFICATIVO') {
                return {'background-color':'rgba(255, 255, 0, 0.7)'};
            } else if(this.clients[index].client_risk == 'MODERADO') {
                return {'background-color':'rgba(102, 102, 102, 0.7)'};
            } else if(this.clients[index].client_risk == 'BAJO') {
                return {'background-color':'rgba(0, 128, 0, 0.7)'};
            } else {
                return {'background-color':'rgba(50, 75, 200, 0.7)'};
            }
        },
        //Asigna color según el riesgo del cliente en las búsquedas
        riskColorAll: function(index){
            if (this.searchClientAll[index].client_risk == 'CRITICO') {
                return {'background-color':'rgba(255, 0, 0, 0.7)'};
            } else if(this.searchClientAll[index].client_risk == 'ALTO') {
                return {'background-color':'rgba(255, 127, 16, 0.7)'};
            } else if(this.searchClientAll[index].client_risk == 'SIGNIFICATIVO') {
                return {'background-color':'rgba(255, 255, 0, 0.7)'};
            } else if(this.searchClientAll[index].client_risk == 'MODERADO') {
                return {'background-color':'rgba(102, 102, 102, 0.7)'};
            } else if(this.searchClientAll[index].client_risk == 'BAJO') {
                return {'background-color':'rgba(0, 128, 0, 0.7)'};
            } else {
                return {'background-color':'rgba(50, 75, 200, 0.7)'};
            }
        },
        // Asigna color según el riesgo del cliente en la card
        riskColorCard: function(index){
            if (this.chosenClient[index].client_risk == 'CRITICO') {
                return {'background-color':'rgba(255, 0, 0, 0.3)'};
            } else if(this.chosenClient[index].client_risk == 'ALTO') {
                return {'background-color':'rgba(255, 127, 16, 0.3)'};
            } else if(this.chosenClient[index].client_risk == 'SIGNIFICATIVO') {
                return {'background-color':'rgba(255, 255, 0, 0.3)'};
            } else if(this.chosenClient[index].client_risk == 'MODERADO') {
                return {'background-color':'rgba(102, 102, 102, 0.3)'};
            } else if(this.chosenClient[index].client_risk == 'BAJO') {
                return {'background-color':'rgba(0, 128, 0, 0.3)'};
            } else {
                return {'background-color':'rgba(50, 75, 200, 0.3)'};
            }
        },

        // Asigna la imagen según el riesgo del cliente en la card
        riskImageCard: function(index){
            if (this.chosenClient[index].client_risk == 'CRITICO') {
                return "img/critico.png";
            } else if(this.chosenClient[index].client_risk == 'ALTO') {
                return "img/alto.png";
            } else if(this.chosenClient[index].client_risk == 'SIGNIFICATIVO') {
                return "img/significativo.png";
            } else if(this.chosenClient[index].client_risk == 'MODERADO') {
                return "img/moderado.png";
            } else if(this.chosenClient[index].client_risk == 'BAJO') {
                return "img/bajo.png";
            }
        }
    },
});

//*************************************************** Elemento raíz para supervisor transacciones ***************************************************
var vm = new Vue({
    el: '#sup_trans', // id donde se implementa Vue
    // Cuando se crea la instancia se ejecutan las siguientes funciones
    created: function(){
        this.getTransactions(); // Carga la lista de clientes compaginados
        this.getTransactionsAll(); // Carga la lista de clientes compaginados
    },
    data:{
        transactionsAll:[], // Arreglo que contiene todos los registros de transacciones
        transactions:[], // Arreglo que contiene un solo registro de transacción
        chosenTransactions:[], // Arreglo que contiene un solo registro de transaccion mostrado en la tarjeta [card]
        // Objeto que contiene los atributos de la paginación
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page':0,
            'last_page':0,
            'from':0,
            'to':0,
        },
        offset: 5, // Indica la cantidad de paginación a la izquierda y derecha de la actual
        property: '', // Variable que determina la búsqueda del usuario
    },
    computed:{
        // Realiza la búsqueda, en el arreglo [clientsAll] según la propiedad que el usuario indique [property]
        searchTransactionsAll: function(){
            return this.transactionsAll.filter((index) => {
                return index.transaction_operation_date.toUpperCase().includes(this.property.toUpperCase().trim()) ||
                index.client_name.toUpperCase().includes(this.property.toUpperCase().trim()) ||
                index.client_identity.toUpperCase().includes(this.property.toUpperCase().trim()) ||
                index.company_name.toUpperCase().includes(this.property.toUpperCase().trim()) ||
                index.user_name.toUpperCase().includes(this.property.toUpperCase().trim())
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
        // Asigna un valor a [property] para mostrar todos los registros.
        showEverything: function(){
            this.property = ' ';
        },
        // Limpia el valor de [property] para mostrar la paginación.
        showpagination: function(){
            this.property = '';
        },
        // Llama a la ruta list-trans y usa [page] como variable opcional para cargar los registros de las transacciones en MySQL
        getTransactions: function(page){
            var urlTransactions = 'list-trans?page='+page;
            Axios
            .get(urlTransactions)
            .then(response => {
                this.transactions = response.data.transactions.data,
                this.pagination = response.data.pagination
            })
            .catch(err => {
                console.log(err);
            });;
        },
        // Llama a la ruta list-trans/indexAll para cargar los registros de todas las transacciones en MySQL
        getTransactionsAll: function(){
            var urlTransactionsAll = 'list-trans/indexAll';
            Axios
            .get(urlTransactionsAll)
            .then(response => {
                this.transactionsAll = response.data
            })
            .catch(err => {
                console.log(err);
            });
        },

        // Agrega un objeto transaccion de [transaction] para ser visto en la card
        addTransaction: function(index){
           this.chosenTransactions = {transaction:this.transactions[index]};
        },

        // Agrega un objeto transaction de [searchClientsAll] para ser visto en la card
        addTransactionsAll: function(index){
           this.chosenTransactions = {transaction:this.searchTransactionsAll[index]};
        },

        // Deja vacío el arreglo [chosenTransactions] y la card desaparece
        deleteTransactions: function(){
            this.chosenTransactions = '';
        },

        // Realiza el cambio de página
        changePage: function(page){
            this.pagination.current_page = page;
            this.getTransactions(page);
        },

        // Da formato a las cantidades de dinero
        formatPrice: function(value) {
            let val = (value/1).toFixed(2).replace(',', '.');
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },

        // Da formato a valores booleanos
        formatBool: function(value) {
            if (value == 1) {
                return 'SÍ';
            } else if(value == 0) {
                return 'NO'
            } else {
                return 'NO DISPONIBLE';
            }
        },
        // Da formato a la fecha de transacción (mes)
        formatDate: function(value) {
            var month = moment(value).format("MMMM - YYYY");
            return month.toUpperCase();
        },
    },
});

//********************************************************** Elemento raíz para colaborador *********************************************************

var vm = new Vue({
    el: '#col',
    data:{
        activityArray: ['','TRABAJADOR ASALARIADO','COMERCIANTE INDIVIDUAL / INDEPENDIENTE', 'NEGOCIO INFORMAL', 'PEP', 'SIN FINES DE LUCRO (ONGS)'],
        fundingArray: ['','FINANCIAMIENTO BANCO','AUTOFINANCIADO TRANSF. DE CTA DEL CLIENTE', 'AUTOFINANCIADO TRANSF. DE TERCEROS', 'DEPÓSITO EN EFECTIVO EN CTAS DE LA EMPRESA', 'EFECTIVO'],
        name:'',
        households: '',
        age: '',
        activity: '',
        funding: '',
        risk: '',
        scoreRisk: 0,
        percActivity:  0.25,
        percFunding:  0.3,
        percAge:  0.25,
        percHouseholds:  0.2,
    },
    computed:{
    },
    methods:{
        calculateRisk: function() {
            this.scoreRisk = 0;
            if(this.age >= 66){
                this.scoreRisk = this.scoreRisk + 1*this.percAge;
            }else if(this.age >= 56 && this.age <= 65){
                this.scoreRisk = this.scoreRisk + 2*this.percAge;
            }else if(this.age >= 46 && this.age <= 55){
                this.scoreRisk = this.scoreRisk + 3*this.percAge;
            }else if(this.age >= 36 && this.age <= 45){
                this.scoreRisk = this.scoreRisk + 4*this.percAge;
            }else if(this.age >= 18 && this.age <= 55){
                this.scoreRisk = this.scoreRisk + 5*this.percAge;
            }
            if(this.households > 7){
                this.scoreRisk = this.scoreRisk + 5*this.percHouseholds;
            }else if(this.households >= 6 && this.households <= 7){
                this.scoreRisk = this.scoreRisk + 4*this.percHouseholds;
            }else if(this.households >= 4 && this.households <= 5){
                this.scoreRisk = this.scoreRisk + 3*this.percHouseholds;
            }else if(this.households >= 2 && this.households <= 3){
                this.scoreRisk = this.scoreRisk + 2*this.percHouseholds;
            }else if(this.households >= 1){
                this.scoreRisk = this.scoreRisk + 1*this.percHouseholds;
            }

            if(this.funding == 'EFECTIVO'){
                this.scoreRisk = this.scoreRisk + 5*this.percFunding;
            }else if(this.funding == 'DEPÓSITO EN EFECTIVO EN CTAS DE LA EMPRESA'){
                this.scoreRisk = this.scoreRisk + 4*this.percFunding;
            }else if(this.funding == 'AUTOFINANCIADO TRANSF. DE TERCEROS'){
                this.scoreRisk = this.scoreRisk + 3*this.percFunding;
            }else if(this.funding == 'AUTOFINANCIADO TRANSF. DE CTA DEL CLIENTE'){
                this.scoreRisk = this.scoreRisk + 2*this.percFunding;
            }else if(this.funding == 'FINANCIAMIENTO BANCO'){
                this.scoreRisk = this.scoreRisk + 1*this.percFunding;
            }

            if(this.activity == 'SIN FINES DE LUCRO (ONGS)'){
                this.scoreRisk = this.scoreRisk + 5*this.percActivity;
            }else if(this.activity == 'PEP'){
                this.scoreRisk = this.scoreRisk + 4*this.percActivity;
            }else if(this.activity == 'NEGOCIO INFORMAL'){
                this.scoreRisk = this.scoreRisk + 3*this.percActivity;
            }else if(this.activity == 'COMERCIANTE INDIVIDUAL / INDEPENDIENTE'){
                this.scoreRisk = this.scoreRisk + 2*this.percActivity;
            }else if(this.activity == 'TRABAJADOR ASALARIADO'){
                this.scoreRisk = this.scoreRisk + 1*this.percActivity;
            }

            if(this.scoreRisk >= 4 && this.scoreRisk<= 5){
                this.risk = 'CRITICO';
            }else if(this.scoreRisk >= 3 && this.scoreRisk < 4){
                this.risk = 'ALTO';
            }else if(this.scoreRisk >= 2 && this.scoreRisk < 3){
                this.risk = 'SIGNIFICATIVO';
            }else if(this.scoreRisk > 1 && this.scoreRisk < 2){
                this.risk = 'MODERADO';
            }else if(this.scoreRisk > 0 && this.scoreRisk <= 1){
                this.risk = 'BAJO';
            }
        },

        // Asigna color según el riesgo del cliente en la preevaluación
        riskColor: function(){
            if (this.risk == 'CRITICO') {
                return {'background-color':'rgba(255, 0, 0, 0.3)'};
            } else if(this.risk == 'ALTO') {
                return {'background-color':'rgba(255, 127, 16, 0.3)'};
            } else if(this.risk == 'SIGNIFICATIVO') {
                return {'background-color':'rgba(255, 255, 0, 0.3)'};
            } else if(this.risk == 'MODERADO') {
                return {'background-color':'rgba(102, 102, 102, 0.3)'};
            } else if(this.risk == 'BAJO') {
                return {'background-color':'rgba(0, 128, 0, 0.3)'};
            }
        },

        // Da formato a las cantidades de dinero
        formatPrice: function(value) {
            let val = (value/1).toFixed(2).replace(',', '.');
            val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return val;
        },
        clearProperty: function() {
            this.name = '',
            this.households = '',
            this.age = '',
            this.activity = '',
            this.funding = '',
            this.risk = '',
            this.scoreRisk = ''
        },
    },
});


//*************************************************** Elemento raíz para administrador usuarios ***************************************************
var vm = new Vue({
    el: '#adm_users', // id donde se implementa Vue
    // Cuando se crea la instancia se ejecutan las siguientes funciones
    created: function(){
        this.getRoles(); // Carga la lista de clientes compaginados
        this.getCompanies(); // Carga la lista de clientes compaginados
        this.getUsersAll(); // Carga la lista de clientes compaginados
    },
    data:{
        usersAll:[], // Arreglo que contiene un solo registro de cliente mostrado en la tarjeta [card]
        companiesAll:[], // Arreglo que contiene un solo registro de cliente mostrado en la tarjeta [card]
        rolesAll:[], // Arreglo que contiene un solo registro de cliente mostrado en la tarjeta [card]
        errors:[], // Arreglo que contiene un solo registro de cliente mostrado en la tarjeta [card]
        mostrar: false,
        name: '',
        email: '',
        company: '',
        role: '',
        password: '',
    },
    computed:{
    },
    methods:{
        clearProperty: function() {
            this.name = '',
            this.email = '',
            this.password = '',
            this.role = '',
            this.company = '',
            this.errors = []
        },
        // Llama a la ruta list/index2 para cargar los registros de todos los clientes en MySQL
        mostrarDiv: function(){
            this.mostrar = !this.mostrar;
        },

        // Llama a la ruta list/index2 para cargar los registros de todos los clientes en MySQL
        createUser: function(index){
            var url = 'users/'+id;
            axios.post(url,{
                name: this.name,
                email: this.email,
                password: this.password,
                role: this.role,
                company: this.company,
            }).then(response => {
            this.getUsersAll();
            this.clearProperty();
            alert("Usuario modificado con éxito");
            }).catch(error => {
                this.errors = error.response.data
        });
        },
        // Llama a la ruta list/index2 para cargar los registros de todos los clientes en MySQL
        deleteUser: function(id){
            if (!confirm("¿Está seguro de eliminar al usuario? No podrá revertir la acción")) {
                return false;
            }
            var url = 'users/'+id;
            axios.delete(url).then(response => {
            this.getUsersAll();
            alert("Usuario eliminado con éxito")
        });
        },
        // Llama a la ruta list/index2 para cargar los registros de todos los clientes en MySQL
        getUsersAll: function(){
            var urlUsersAll = 'list-users/indexAll';
            Axios
            .get(urlUsersAll)
            .then(response => {
                this.usersAll = response.data
            })
            .catch(err => {
                console.log(err);
            });
        },
        // Llama a la ruta list/index2 para cargar los registros de todos los clientes en MySQL
        getCompanies: function(){
            var urlCompanies = 'list-companies/indexAll';
            Axios
            .get(urlCompanies)
            .then(response => {
                this.companiesAll = response.data
            })
            .catch(err => {
                console.log(err);
            });
        },
        // Llama a la ruta list/index2 para cargar los registros de todos los clientes en MySQL
        getRoles: function(){
            var urlRoles = 'list-roles/indexAll';
            Axios
            .get(urlRoles)
            .then(response => {
                this.rolesAll = response.data
            })
            .catch(err => {
                console.log(err);
            });
        },

        // Da formato a valores booleanos
        formatBool: function(value) {
            if (value == 1) {
                return 'SÍ';
            } else if(value == 0) {
                return 'NO'
            } else {
                return 'NO DISPONIBLE';
            }
        },
    },
});
