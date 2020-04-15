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
                    <input type="text" name="name" v-model="userToAdd.name">
                    <label for="email">Email</label>
                    <input type="text" name="email" v-model="userToAdd.email">
                    <label for="roles">Selectionner rôles</label>
                    <multiselect name="roles" v-model="userToAdd.roles" :options="allRoles" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" ></multiselect>
                    <label for="permissions">Selectionner permissions</label>
                    <multiselect name="permissions" v-model="userToAdd.permissions" :options="allPerms" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" ></multiselect>
                    <a v-on:click="updateUser()" v-bind:class="'button '+this.button_type" data-close>
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
        props:["user"],
        mounted() {
            this.form = new Foundation.Reveal($('#reveal-dialog'), {
                animationIn: 'scale-in-up',
            });
            this.initContent();
            this.getRoles();
            this.getPerms();
        },
        watch:{
          user:function(o, n){
              if(o.id !== n.id) {
                  this.initContent();
              }
          }
        },
        data() {
            return {
                type:"Ajouter",
                button_type:'primary',
                userToAdd:{
                    "name":"",
                    "email":"",
                    "roles":[],
                    "permissions":[]
                },
                allRoles:[],
                allPerms:[],
                alertUser:{
                    title:'',
                    message:''
                },
            };
        },
        methods: {
            initContent(){
                if(this.user){
                    this.type = "Editer";
                    this.button_type = "warning";
                    this.userToAdd = this.user;
                }
            },
            openModal() {
                this.form.open();
            },
            updateUser(){
                axios.put('/api/users/'+this.userToAdd.id, this.prepareData(),{headers: {
                        "Authorization": this.$session.get('token')
                    }}).then(data=>{
                    this.alertUser.title = "Succès !";
                    this.alertUser.message = "L'utilisateur a été modifié avec succès !";
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
            getRoles(){
                axios.get("/api/roles/all",{headers: {
                        "Authorization": this.$session.get('token')
                    }}).then(data=>{
                   this.allRoles = data.data.data
                });
            },
            getPerms(){
                axios.get("/api/permissions",{headers: {
                        "Authorization": this.$session.get('token')
                    }}).then(data=>{
                    this.allPerms = data.data.data;
                });
            },
            prepareData(){
                return {
                    "name":this.userToAdd.name,
                    "email":this.userToAdd.name,
                    "roles":JSON.stringify(this.userToAdd.roles),
                    "permissions":JSON.stringify(this.userToAdd.permissions)
                };
            }
        },
        destroyed() {
            this.form.destroy();
        },
    };
</script>

