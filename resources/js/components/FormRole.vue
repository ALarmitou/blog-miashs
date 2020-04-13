<template>
    <div>
        <div class="row">
            <div id="reveal-dialog" class="reveal" data-reveal>
                <form>
                    <fieldset class="fieldset">
                    <legend>{{this.type}}</legend>
                        <label for="libelle">Libelle</label>
                        <input type="text" name="libelle" v-model="roleToAdd.libelle">
                        <a v-if="!this.role" v-on:click="addRole()" v-bind:class="'button '+this.button_type" data-close>
                            Ajouter
                        </a>
                        <a v-else v-on:click="updateRole()" v-bind:class="'button '+this.button_type" data-close>
                            Editer
                        </a>
                    </fieldset>
                </form>
            </div>
            <p>
                <a v-on:click="openModal()" v-bind:class="'button '+ this.button_type">{{this.type}}</a>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props:["role"],
        mounted() {
            this.form = new Foundation.Reveal($('#reveal-dialog'), {
                animationIn: 'scale-in-up',
            });
           this.initContent();
        },
        watch:{
          post:function(o, n){
              if(o.id !== n.id) {
                  this.initContent();
              }
          }
        },
        data() {
            return {
                type:"Ajouter",
                button_type:'primary',
                roleToAdd:{
                "libelle":""
                },
            };
        },
        methods: {
            initContent(){
                if(this.role){
                    this.type = "Editer";
                    this.button_type = "warning";
                    this.roleToAdd = this.role;
                }
            },
            openModal() {
                this.form.open();
            },
            addRole(){
                axios.post('/api/roles', this.roleToAdd,{headers: {
                    "Authorization": this.$session.get('token')
                }}).then(data=>{
                    console.log(data);
                }).catch(error=>{
                    console.log(error);
                });
            },
            updateRole(){
                axios.put('/api/roles/'+this.roleToAdd.id, this.roleToAdd,{headers: {
                        "Authorization": this.$session.get('token')
                    }}).then(data=>{
                    console.log(data);

                }).catch(error=>{
                    console.log(error);
                });
            }
        },
        destroyed() {
            this.form.destroy();
        },
    };
</script>

