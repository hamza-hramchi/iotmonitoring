<template>
    <div class="">
        <form @submit.prevent="addModule"> <!--Valider le formulaire sans actualiser la page--->
            <!-- Nav tabs -->
            <div class="tabs-wrapper">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link waves-light active" data-toggle="tab" href="#part1" role="tab">1 ère partie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-light" data-toggle="tab" href="#part2" role="tab">2 ème partie</a>
                    </li>
                </ul>
            </div>
            <!-- Tab panels -->
            <div class="tab-content">
                <!--Panel 1-->
                <div class="tab-pane fade in show active" id="part1" role="tabpanel">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="name">Nom</label>
                            <input v-model="form.name" name="name" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>

                        </div>
                        <div class="col-md-3 form-group">
                            <label for="number">Numero</label>
                            <input v-model="form.number" name="number" type="number"  class="form-control" :class="{ 'is-invalid': form.errors.has('number') }">
                            <has-error :form="form" field="number"></has-error>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="type">Type</label>
                            <input v-model="form.type" name="type" type="text"  class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                            <has-error :form="form" field="type"></has-error>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea v-model="form.description" name="description" id="" cols="50" rows="10" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                        <has-error :form="form" field="description"></has-error>
                    </div>
                </div>
                <!--/.Panel 1-->

                <!--Panel 2-->
                <div class="tab-pane fade" id="part2" role="tabpanel">
                       <div class="form-group">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    <input  type="checkbox"  v-model="checked_temperature" class="custom-control-input" id="temperature">
                                    <label class="custom-control-label" for="temperature">Temperature</label>
                                <div v-if="checked_temperature==true" class="custom-control mt-1">
                                    <input type="number" v-model="form.temperature" class="form-control" placeholder="La température">
                                </div>
                                </div>
                                </li>
                                <li class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" v-model="checked_operatingtime"   class="custom-control-input" id="operatingtime">
                                    <label class="custom-control-label" for="operatingtime">Durée de fonctionnement</label>
                                    <div v-if="checked_operatingtime==true" class="custom-control mt-1">
                                    <input type="number" v-model="form.operatingtime" class="form-control" placeholder="La durée de fonctionnement">
                                </div>
                                </div>
                                </li>
                                <li class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" v-model="checked_dataM"  class="custom-control-input" id="dataM">
                                    <label class="custom-control-label" for="dataM">Nombre de données envoyées</label>
                                    <div v-if="checked_dataM==true" class="custom-control mt-1">
                                    <input type="number" v-model="form.dataM" class="form-control" placeholder="Le nombre de données envoyées">
                                </div>
                                </div>
                                </li>
                                <li class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" v-model="checked_state" class="custom-control-input" id="state" >
                                    <label class="custom-control-label" for="state">Etat de marche</label>
                                    <div v-if="checked_state==true" class="custom-control mt-1">
                                    <input type="text" v-model="form.state" class="form-control" placeholder="Etat de marche">
                                </div>
                                </div>
                                </li>
                               
                            </ul>
                        </div>
                </div>
                <!--/.Panel 2-->
                <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Ajouter le module {{ form.name }}</button>
                </div>
            </div>
           
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                checked_temperature : '',
                checked_operatingtime : '',
                checked_dataM : '',
                checked_state : '',
                form : new Form({
                    name  :'',
                    number : '',
                    type : '',
                    description : '',
                    temperature : '',
                    operatingtime : '',
                    dataM : '',
                    state : ''
                }),
            }
        },
        methods : {
            // Ajouter un nouveau module
            addModule() {
                this.form.post('/module')
                .then( ({data}) => {
                    Toast.fire({
                            icon: 'success',
                            title: 'Module ajouté avec succès'
                            }) ;
                    this.$emit('loadMe');
                })
                
                .catch( () => {console.error()})
            }
        },
        mounted() {
        },
    }
</script>
