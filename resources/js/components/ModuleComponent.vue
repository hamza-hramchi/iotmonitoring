<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-lg text-bold">{{ infos.name }} / Numéro : {{ infos.number }} </div>

                    <div class="card-body">
                        <p class="card-text">{{ infos.description }} </p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"> Température : {{infos.temperature }} </li>
                            <li class="list-group-item">
                                Durée de fonctionnement : {{infos.operatingtime }}
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{infos.operatingtime }} %</div>
                                </div>
                            </li>
                            <li class="list-group-item"> Type : {{ infos.type }} </li>
                            <li class="list-group-item"> Nombre de données envoyées : {{ infos.dataM }} </li>
                            <li class="list-group-item"> Etat de marche : {{infos.state }} </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                id : this.$route.params.id,
                infos : {},
            }
        },

        methods : {
            // Les informations de module
            getDetails() {
                axios.get('/module/' + this.id)
                    .then( ({data}) => {
                        this.infos = data;
                    })
            }
        },
        mounted() {
            this.getDetails();
        }
    }
</script>
