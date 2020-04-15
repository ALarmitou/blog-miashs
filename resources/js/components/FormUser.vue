<template>
    <div>
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

                    <a v-if="!this.user" v-on:click="addUser()" v-bind:class="'button '+this.button_type" data-close>
                        Ajouter
                    </a>
                    <a v-else v-on:click="updateUser()" v-bind:class="'button '+this.button_type" data-close>
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
                allPerms:[]
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
            addUser(){
                axios.post('/api/users', this.prepareData(),{headers: {
                    "Authorization": this.$session.get('token')
                }}).then(data=>{
                    console.log(data);
                }).catch(error=>{
                    console.log(error);
                });
            },
            updateUser(){
                axios.put('/api/users/'+this.userToAdd.id, this.prepareData(),{headers: {
                        "Authorization": this.$session.get('token')
                    }}).then(data=>{
                    console.log(data);

                }).catch(error=>{
                    console.log(error.response.data);
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

