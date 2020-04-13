<template>
    <div>
        <div class="row">
            <div id="reveal-dialog" class="reveal" data-reveal>
                <form>
                    <fieldset class="fieldset">
                    <legend>{{this.type}}</legend>
                        <label for="name">name</label>
                        <input type="text" name="name" v-model="userToAdd.name">
                        <label for="email">Name</label>
                        <input type="text" name="email" v-model="userToAdd.email">
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
                userToAdd:{
                "name":"",
                "email":"",
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
            addUser(){
                axios.post('/api/users', this.userToAdd,{headers: {
                    "Authorization": this.$session.get('token')
                }}).then(data=>{
                    console.log(data);
                }).catch(error=>{
                    console.log(error);
                });
            },
            updateUser(){
                axios.put('/api/users/'+this.userToAdd.id, this.userToAdd,{headers: {
                        "Authorization": this.$session.get('token')
                    }}).then(data=>{
                    console.log(data);

                }).catch(error=>{
                    console.log(error.response.data);
                });
            }
        },
        destroyed() {
            this.form.destroy();
        },
    };
</script>

