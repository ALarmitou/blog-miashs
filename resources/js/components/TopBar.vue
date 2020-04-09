<template>
    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="menu">
                <li class="menu-text">Blog</li>
                <li><a href="/">Home</a></li>
                <li><a href="/articles">Articles</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </div>
        <div class="top-bar-right">
            <ul v-if="!this.user" class="menu dropdown" data-dropdown-menu>

                <li>
                    <a class="nav-link" href="/login">Se connecter</a>
                </li>
                <li>
                    <a class="nav-link" href="/register">S'enregistrer</a>
                </li>
            </ul>
            <ul v-else class="menu dropdown" data-dropdown-menu>
                <li>
                    <a>{{ this.clean_user.name }}</a>
                    <ul class="menu vertical">
                        <li>
                            <a @click="logout()">
                                Se déconnecter
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props:["user"],
        data:function() {
            return {
                clean_user:{}
            }
        },
        methods:{
          logout:function(){
              axios.post("/logout").then(data=>{
                  this.$session.destroy();
              }).catch(error=>{
                  console.log("error")
              })
          }
        },
        mounted(){
            $(this.$el).foundation();
            this.clean_user = JSON.parse(this.user);
        }
    }
</script>

<style scoped>

</style>
