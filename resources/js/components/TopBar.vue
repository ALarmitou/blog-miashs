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
            <ul v-if="this.clean_user != null" class="menu dropdown" data-dropdown-menu>
                <li>
                    <a>{{ this.clean_user.name }}</a>
                    <ul class="menu vertical">
                        <li>
                            <a href="/my-profile">
                                Mon profil
                            </a>
                        </li>
                        <li v-if="isAdmin()">
                            <a href="/admin">
                                Tableau de bord admin
                            </a>
                        </li>
                        <li>
                            <a @click="logout()">
                                Se déconnecter
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul v-else class="menu" data-dropdown-menu>

                <li>
                    <a class="nav-link" href="/login">Se connecter</a>
                </li>
                <li>
                    <a class="nav-link" href="/register">S'enregistrer</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data:function(){
            return {
                clean_user:{}
            }
        },
        methods:{
            logout:function(){
                axios.post("/logout").then(data=>{
                  this.$session.destroy();
                  window.location.href = "/";
                });
            },
            isAdmin:function(){
                for(let index in this.clean_user.roles){
                    if(this.clean_user.roles[index].slug=="admin")
                        return true;
                }
                return false;
            }
        },
        mounted(){
            if(this.$session.exists() && this.$session.get("user"))
                this.clean_user = this.$session.get("user");
            else
                this.clean_user = null
        }
    }
</script>

<style scoped>

</style>
