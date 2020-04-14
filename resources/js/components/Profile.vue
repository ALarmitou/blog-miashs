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
        props:['user','roles','posts'],
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
                editing:true
            }
        },
        methods:{
          editProfile:function(){
              axios.put("/api/users/"+this.profile.id,this.profile,{headers: {
                      "Authorization": this.$session.get('token')
                  }}).then(data=>{
              }).catch(error=>{
                  console.log(error.response.data);
              })
          },
            changePassword:function(){
                axios.put("/api/users/"+this.profile.id+"/password",this.password_change,{headers: {
                        "Authorization": this.$session.get('token')
                    }}).then(data=>{
                    console.log(data);
                }).catch(error=>{
                    console.log(error.response.data);
                })
            }
        },
        mounted(){
            $(this.$el).foundation();
            this.profile = JSON.parse(this.user);
            this.clean_roles = JSON.parse(this.roles);
            this.own_posts = JSON.parse(this.posts);
        }
    }
</script>

<style scoped>

</style>
