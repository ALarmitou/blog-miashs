<template>
    <div class="grid-container">
        <div class="row">
            <div class="column medium-3">
                <ul class="vertical tabs" data-tabs id="example-tabs">
                    <li class="tabs-title is-active"><a href="#profile" aria-selected="true">Mon profil</a></li>
                    <li class="tabs-title"><a href="#password">Changer mon mot de passe</a></li>
                    <li class="tabs-title"><a href="#posts">Mes posts</a></li>
                    <li class="tabs-title"><a href="#roles">Rôles</a></li>
                </ul>
            </div>
            <div class="column medium-9">
                <div class="tabs-content vertical" data-tabs-content="example-tabs">
                    <div class="tabs-panel is-active" id="profile">
                        <div class="card">
                            <div class="card-divider">Mon profil</div>
                            <div class="card-section">
                                <form>
                                    <label for="name">Nom</label>
                                    <input type="text" name="name" v-model="profile.name" :disabled="editing">
                                    <label for="name">Email</label>
                                    <input type="text" name="name" v-model="profile.email" :disabled="editing">
                                    <div id="row">
                                        <button @click="editing=!editing" type="button" class="button warning">Editer</button>
                                        <button @click="editProfile()" type="button" class="button primary">Mettre à jour</button>
                                    </div>
                                </form>
                                <div v-if="profileEdited.message!==''" :class="'callout '+this.state ">
                                    <h5>{{profileEdited.title}}</h5>
                                    <pre>{{profileEdited.message}}</pre>
                                    <button class="button alert" @click="profileEdited.message=''">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tabs-panel" id="password">
                        <div class="card">
                            <div class="card-divider">Changer mon mot de passe</div>
                            <div class="card-section">
                                <form>
                                    <label for="password">Mot de passe</label>
                                    <input type="password" name="password" v-model="password_change.password">
                                    <label for="password_confirmation">Répétez le mot de passe</label>
                                    <input type="password" name="password_confirmation" v-model="password_change.password_confirmation">
                                    <button @click="changePassword()" type="button" class="button primary">Changer mon mot de passe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tabs-panel" id="posts">
                        <div class="card">
                            <div class="card-divider">Mes posts</div>
                            <div class="card-section">
                                <ul class="menu vertical">
                                    <li v-for="post in own_posts"><a :href="'/articles/'+post.post_name">{{post.post_title}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tabs-panel" id="roles">
                    <div class="card">
                        <div class="card-divider">Mes rôles</div>
                        <div class="card-section">
                            <ul class="menu">
                                <li v-for="role in clean_roles">{{role.name}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data:function(){
            return {
                profile:{
                },
                password_change:{
                    password:'',
                    password_confirmation:''
                },
                clean_roles:[],
                own_posts:[],
                editing:true,
                profileEdited:{
                    title:"",
                    message:""
                },
                passwordChanged:{
                    title:"",
                    message:""
                },
            }
        },
        methods:{
          editProfile:function(){
              axios.put("/api/users/"+this.profile.id,this.profileToUpdate(),{headers: {
                      "Authorization": this.$session.get('token')
                  }}).then(data=>{
                  this.$session.set('user',data.data);
                  this.profileEdited.title="Réussite!"
                  this.profileEdited.message="Votre profil a été modifié!"
              }).catch(error=>{
                  this.profileEdited.title="Echec!"
                  for(let an_error in error.response.data.errors)
                      this.profileEdited.message+=error.response.data.errors[an_error]
              })
          },
            changePassword:function(){
                axios.put("/api/users/"+this.profile.id+"/password",this.password_change,{headers: {
                        "Authorization": this.$session.get('token')
                    }}).then(data=>{
                    this.passwordChanged.title="Réussite!"
                    this.passwordChanged.message="Votre mot de passe a été modifié!"
                }).catch(error=>{

                    this.passwordChanged.title="Echec!"
                    for(let an_error in error.response.data)
                        this.passwordChanged.message+=error.response.data[an_error].error
                })
            },
            getOwnPosts:function(){
              axios.get("/api/users/"+this.profile.id+"/posts",{headers: {
                      "Authorization": this.$session.get('token')
                  }}).then(data=>{
                  this.own_posts=data.data;
              });
            },
            profileToUpdate:function(){
              return {
                  "name":this.profile.name,
                  "email":this.profile.email
              }
            }
        },
        mounted(){
            this.profile = this.$session.get("user");
            this.clean_roles = this.profile.roles;
            this.getOwnPosts();
        }
    }
</script>

<style scoped>

</style>
