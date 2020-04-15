<template>
    <div>
        <div v-if="alertUser.message!==''" :class="'callout '+this.state ">
            <h5>{{alertUser.title}}</h5>
            <pre>{{alertUser.message}}</pre>
            <button class="button alert" @click="alertUser.message=''">Fermer</button>
        </div>
        <div id="reveal-dialog" class="reveal" data-reveal>
            <form>
                <fieldset class="fieldset">
                <legend>{{this.type}}</legend>
                    <label for="name">Name</label>
                    <input type="text" name="name" v-model="roleToAdd.name">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" v-model="roleToAdd.slug">
                    <label for="permissions">Selectionner permissions</label>
                    <multiselect name="permissions" v-model="chosenPerms" :options="perms" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" ></multiselect>

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
          role:function(o, n){
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
                    "name":"",
                    "slug":"",
                    "permissions":""
                },
                perms:[],
                chosenPerms:[],
                alertUser:{
                    title:'',
                    message:''
                },
            };
        },
        methods: {
            initContent(){
                this.getPermissions();
                if(this.role){
                    this.type = "Editer";
                    this.button_type = "warning";
                    this.roleToAdd = this.role;
                    this.chosenPerms = this.role.permissions;
                }
            },
            openModal() {
                this.form.open();
            },
            addRole(){
                this.prepareData();
                axios.post('/api/roles', this.prepareData(),{headers: {
                    "Authorization": this.$session.get('token')
                }}).then(data=>{
                    this.alertUser.title = "Succès !";
                    this.alertUser.message = "Le role a été ajouté avec succès !";
                    this.state = "success";
                }).catch(error=>{
                    if(error.response.status !==500){
                        this.state = "alert";
                        this.alertUser.title = "Echec !";
                        if(error.response.status === 401){
                            this.alertUser.message = "Vous n'êtes pas authentifié !";
                        }
                        if(error.response.status === 422){
                            for(let index in error.response.data.errors)
                                this.alertUser.message += error.response.data.errors[index]+"\n"
                        }
                    }
                });
            },
            updateRole(){
                axios.put('/api/roles/'+this.roleToAdd.id,this.prepareData(),{headers: {
                        "Authorization": this.$session.get('token')
                    }}).then(data=>{
                    this.alertUser.title = "Succès !";
                    this.alertUser.message = "Le role a été modifié avec succès !";
                    this.state = "success";

                }).catch(error=>{
                    if(error.response.status !==500){
                        this.state = "alert";
                        this.alertUser.title = "Echec !";
                        if(error.response.status === 401){
                            this.alertUser.message = "Vous n'êtes pas authentifié !";
                        }
                        if(error.response.status === 422){
                            for(let index in error.response.data.errors)
                                this.alertUser.message += error.response.data.errors[index]+"\n"
                        }
                    }
                });
            },
            getPermissions(){
                axios.get('/api/permissions',{headers: {
                        "Authorization": this.$session.get('token')
                    }}).then(data=>{
                        this.perms = data.data.data;
                })
            },
            prepareData(){
                return {
                    "name":this.roleToAdd.name,
                    "slug":this.roleToAdd.slug,
                    "permissions":JSON.stringify(this.chosenPerms)
                };
            }
        },
        destroyed() {
            this.form.destroy();
        },
    };
</script>

