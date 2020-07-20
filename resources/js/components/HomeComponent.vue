<template>
    <div class="container mt-5 mx-auto px-4 pt-8" v-on:loadMe="loadMe">
            <!-- Le cas où la base de données est vide --->
            <div v-if="modules.length == 0" class="text-center">
                <h1 class="text-lg text-danger">La liste des modules est vide !</h1>
            </div>
        <!--- Grid --->
            <div class="mx-auto grid grid-cols-3  mt-2">
                <div  v-for="el in modules" :key="el.id" class="card conatainer mx-auto" style="width: 18rem; border : solid black 1px">
                    <div class="card-body">
                        <router-link :to="{ name: 'details', params: { id: el.id }}">
                            <h3 class="card-title text-bold text-black">{{ el.name }}</h3>
                        </router-link> <!--- Lien vers le composant--->
                        <h6 class="card-subtitle mb-2 text-muted">Type : {{ el.type }}</h6>
                        <p class="card-text">{{ el.description }}</p>
                        <button @click="update(el)"  class="btn btn-info">Modifier</button> <!--Modifier le module---->
                        <button @click="destroy(el.id)"  class="btn btn-danger">Supprimer</button> <!--Supprimer le module---->
                    </div>
                </div>
            </div>
            <!---/ Grid --->

            <!-- Modal -->
        <div class="modal fade" id="moduleModal" tabindex="-1" role="dialog" aria-labelledby="moduleModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form @submit.prevent="saveChanges()">
                                <div class="modal-body">

                                    <form>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="name">Nom</label>
                                                <input v-model="form.name" name="name" type="text" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="number">Numero</label>
                                                <input v-model="form.number" name="number" type="number"  class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea v-model="form.description" class="form-control" name="description" placeholder="Description"  cols="50" rows="10"></textarea>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="type">Type</label>
                                                <input v-model="form.type" name="type" type="text" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="temperature">Temperature</label>
                                                <input v-model="form.temperature" name="temperature" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="operatingtime">Operatingtime</label>
                                                <input v-model="form.operatingtime" name="operatingtime" type="number" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="dataM">Data</label>
                                                <input v-model="form.dataM" name="dataM" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="state">Etat de marche</label>
                                            <input v-model="form.state" name="state" type="text" class="form-control">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Fermer</button>
                                    <button  type="submit" class="btn btn-success">Enregistrer les modifications</button>
                                </div>
                            </form>

                        </div>
            </div>
        </div>
</div>

</template>

<script>
    export default {
        data() {
            return {
                modules : {},
                form : new Form({
                    dataM : '',
                    description : '',
                    id : '',
                    name : '',
                    number : '',
                    operatingtime : '',
                    state : '',
                    temperature : '',
                    type : ''
                }),
            }
        },

        methods: {
            // Afficher les modules
            loadModules() {
                axios.get("/module")
                .then (( {data} ) => (this.modules = data))
                .catch( () => {console.error()})
            },

            // Afficher le modal odifier les informations
            update(id){
                this.form.fill(id);
                $("#moduleModal").modal('show');
            },

            // Supprimer le module
            destroy(id){
                Swal.fire({
                    title: 'Suppression du module ',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Supprimer',
                    cancelButtonText : 'Annuler'
                    }).then((result) => {
                        // Send request to the server
                    if(result.value){
                            this.form.delete('module/'+id)
                        .then( () => {
                            Toast.fire({
                            icon: 'success',
                            title: 'Module supprimé avec succès'
                            })
                        })
                        .catch( () => {
                                Swal('Erreur', 'Problème servenue !', 'warning')
                        })
                    }
                    })
            },
            
            // Enregistrer les modifications
            saveChanges(){
                this.form.put("module/" + this.form.id)
                .then( ({data}) => {
                    Toast.fire({
                            icon: 'success',
                            title: 'Module modifié avec succès'
                            })
                    $("#moduleModal").modal('hide');
                    this.$emit('loadMe',data);                    
                })
                .catch( () => {console.error()})
            },

            // Vérifier si la température d'un module est élevée
            checkModule() {
                axios.get('/check')
                    .then(({data}) =>{
                        if(data.length >= 1){
                        Vue.$toast.open({
                            message: 'La température de ' + data[0].name + ' est trop élevée !',
                            type: 'error',
                            position : 'top-right',
                            duration : 5000
                        });
                        }
                    })
                
            },

            loadMe(){
                this.modules = data;
            }

        },

        mounted() {
            this.loadModules();
        },

        created() {
            setInterval(() => {
                this.loadModules();
            }, 4000); // consulter la base de données chaque 4000 ms
            setInterval(() => {
                this.checkModule();
            }, 60000); // vérifier la température chaque 60000 ms
        }
    }
</script>
