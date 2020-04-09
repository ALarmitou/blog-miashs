<template>
    <div>
        <div class="row">
            <div id="reveal-dialog" class="reveal" data-reveal>
                <h4>Êtes-vous sûr de supprimer ce {{type}} ?</h4>
                <div class="row">
                    <a class="columns small-4 button alert" v-on:click="deleteItem()" data-close>Supprimer</a>
                    <div class="columns small-4"></div>
                    <a class="columns small-4 button secondary" data-close>Annuler</a>
                </div>
            </div>
            <p>
                <a v-on:click="openModal()" class="button alert ">Supprimer</a>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props:["type","item_id","tellAdmin"],
        mounted() {
            this.modal = new Foundation.Reveal($('#reveal-dialog'), {
                animationIn: 'scale-in-up',
            });
        },
        data() {
            return {
            };
        },
        methods: {
            openModal() {
                this.modal.open();
            },
            deleteItem(){
                axios.delete('/api/'+this.type+'s/'+this.item_id).then(data=>{
                    window.session.$emit(this.tellAdmin,"do-it");
                });
            }
        },
        destroyed() {
            this.modal.destroy();
        },
    };
</script>

