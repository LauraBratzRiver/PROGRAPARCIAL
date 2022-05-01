<template>
    <div id="appCliente">
        <div class="row">
            <div class="col col-md-4">
                <!--<vue-resizable :fit-parent="fit" :dragSelector="selector" :width="500">-->
                <div class="card text-white" id="carCliente">
                    <div class="card-header bg-primary">
                        Registro de Clientes
                        <button type="button" class="btn-close text-end" @click="cerrarForm"></button>
                    </div>
                    <div class="card-body text-dark">
                        <form method="post" @submit.prevent="guardarCliente" @reset="nuevoCliente">
                            <div class="row p-1">
                                <div class="col col-md-3">Codigo:</div>
                                <div class="col col-md-4">
                                    <input title="Ingrese el codigo" v-model="Cliente.codigo" pattern="[0-9]{3,10}" required type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="col col-md-3">Nombre:</div>
                                <div class="col">
                                    <input title="Ingrese el nombre" v-model="Cliente.nombre" pattern="[A-Za-zñÑáéíóúü ]{3,75}" required type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="col col-md-3">Direccion:</div>
                                <div class="col">
                                    <input title="Ingrese la direccion" v-model="Cliente.direccion" pattern="[A-Za-zñÑáéíóúü ]{3,100}" required type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="col col-md-3">Telefono:</div>
                                <div class="col col-md-4">
                                    <input title="Ingrese el tel" v-model="Cliente.telefono" pattern="[0-9]{4}-[0-9]{4}" required type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="col col-md-3">DUI:</div>
                                <div class="col">
                                    <input title="Ingrese el DUI" v-model="Cliente.dui" pattern="[0-9]{8}-[0-9]{1}" required type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="col text-center">
                                    <div v-if="Cliente.mostrar_msg" class="alert alert-primary alert-dismissible fade show" role="alert">
                                        {{ Cliente.msg }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col text-center">
                                    <input class="btn btn-success" type="submit" value="Guardar">
                                    <input class="btn btn-warning" type="reset" value="Nuevo">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--</vue-resizable>-->
            </div>
            <div class="col col-md-8">
                <!--<vue-resizable :dragSelector="selector" :width="600">-->
                <div class="card text-white" id="carBuscarCliente">
                    <div class="card-header bg-primary">
                        Busqueda de Clientes
                        <button type="button" @click="cerrarForm" class="btn-close" data-bs-dismiss="alert" data-bs-target="#carBuscarCliente" aria-label="Close"></button>
                    </div>
                    <div class="card-body">
                        <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        Buscar: <input @keyup="buscandoCliente" v-model="buscar" placeholder="buscar aqui" class="form-control" type="text" >
                                    </th>
                                </tr>
                                <tr>
                                    <th>CODIGO</th>
                                    <th>NOMBRE</th>
                                    <th>DIRECCION</th>
                                    <th>TEL</th>
                                    <th>DUI</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in Clientes" @click='modificarCliente( item )' :key="item.idCliente">
                                    <td>{{item.codigo}}</td>
                                    <td>{{item.nombre}}</td>
                                    <td>{{item.direccion}}</td>
                                    <td>{{item.telefono}}</td>
                                    <td>{{item.dui}}</td>
                                    <td>
                                        <button class="btn btn-danger" @click="eliminarCliente(item)">Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--</vue-resizable>-->
            </div>
        </div>
    </div>
</template>

<script>
    //Vue.component('vue-resizable', VueResizable.default);
    export default {
        props : ['form'],
         data:()=>{
            return {
                selector: '.card',
                fit: false,
                buscar:'',
                Clientes:[],
                Cliente:{
                    accion : 'nuevo',
                    mostrar_msg : false,
                    msg : '',
                    id : 0,
                    idCliente : '',
                    codigo: '',
                    nombre: '',
                    direccion: '',
                    telefono: '',
                    dui: ''
                }
            }
        },
        methods:{
            cerrarForm(){
                this.form['Cliente'].mostrar = false;
            },
            async sincronizarDatosServidor(Cliente, metodo, url){
                await axios({
                    method : metodo,
                    url,
                    data : Cliente
                })
                .then(resp=>{
                    if(Cliente.accion=='nuevo'){
                        Cliente.id = resp.data.id;
                        this.insertarLocal(Cliente);//actualizar el id del Cliente que se genero en el servidor con laravel y mysql
                    }
                    this.Cliente.msg = `Cliente procesado ${data.msg}`;
                })
                .catch(err=>{
                    this.Cliente.msg = `Error al procesar el Cliente ${err}`;
                })
            },
            insertarLocal(Cliente){
                let store = this.abrirStore('Cliente', 'readwrite'),
                    query = store.put(Cliente);
                query.onsuccess = e=>{
                    this.nuevoCliente();
                    this.obtenerDatos();
                    this.Cliente.msg = 'Cliente procesado con exito';
                };
                query.onerror = e=>{
                    this.Cliente.msg = `Error al procesar el Cliente ${e.target.error}`;
                };
            },
            buscandoCliente(){
                this.obtenerDatos(this.buscar);
            },
            eliminarCliente(Cliente){
                if( confirm(`Esta seguro de eliminar el Cliente ${Cliente.nombre}?`) ){
                    Cliente.accion = 'eliminar';
                    let store = this.abrirStore('Cliente', 'readwrite'),
                        query = store.delete(Cliente.idCliente),
                        metodo = 'DELETE',
                        url = `/Cliente/${Cliente.id}`;
                    this.sincronizarDatosServidor(Cliente, metodo, url);
                    query.onsuccess = e=>{
                        this.nuevoCliente();
                        this.obtenerDatos();
                        this.Cliente.msg = 'Cliente eliminado con exito';
                    };
                    query.onerror = e=>{
                        this.Cliente.msg = `Error al eliminar el Cliente ${e.target.error}`;
                    };
                }
                this.nuevoCliente();
            },
            modificarCliente(datos){
                this.Cliente = JSON.parse(JSON.stringify(datos));
                this.Cliente.accion = 'modificar';
            },
            guardarCliente(){
                let metodo = 'PUT',
                    url = `/Cliente/${this.Cliente.id}`;
                if(this.Cliente.accion=="nuevo"){
                    this.Cliente.idCliente = generarIdUnicoFecha();
                    metodo = 'POST';
                    url = '/Cliente';
                }
                let Cliente = JSON.parse(JSON.stringify(this.Cliente));
                this.sincronizarDatosServidor(Cliente, metodo, url);
                this.insertarLocal(Cliente);
            },
            obtenerDatos(valor=''){
                let store = this.abrirStore('Cliente', 'readonly'),
                    data = store.getAll();
                data.onsuccess = e=>{
                    if( data.result.length<=0 ){
                        fetch(`Cliente`, 
                            {credentials: 'same-origin'})
                            .then(res=>res.json())
                            .then(data=>{
                                this.Clientes = data;
                                data.map(Cliente=>{
                                    let store = this.abrirStore('Cliente', 'readwrite'),
                                        query = store.put(Cliente);
                                    query.onsuccess = e=>{
                                        console.log(`Cliente ${Cliente.nombre} guardado`);
                                    };
                                    query.onerror = e=>{
                                        console.log(`Error al guardar el Cliente ${e.target.error}`);
                                    };
                                });
                            })
                            .catch(err=>{
                                this.Cliente.msg = `Error al guardar el Cliente ${err}`;
                            });
                    }
                    this.Clientes = data.result.filter(Cliente=>Cliente.nombre.toLowerCase().indexOf(valor.toLowerCase())>-1);
                };
                data.onerror = e=>{
                    this.Cliente.msg = `Error al obtener los Clientes ${e.target.error}`;
                };
            },
            nuevoCliente(){
                this.Cliente.accion = 'nuevo';
                this.Cliente.msg = '';
                this.Cliente.idCliente = '';
                this.Cliente.codigo = '';
                this.Cliente.nombre = '';
                this.Cliente.direccion = '';
                this.Cliente.telefono = '';
                this.Cliente.dui = '';
            },
            abrirStore(store, modo){
                return db.transaction(store, modo).objectStore(store);
            }
        },
        created(){
            //this.obtenerDatos();
        },
    }
</script>