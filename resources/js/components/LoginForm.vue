<template>
    <div class="card">
        <div class="card-divider">Se connecter</div>
        <div class="card-section">
            <form>
                <fieldset>
                    <label for="email"  class="column text-md-right">Email</label>

                    <div  class="column">
                        <input id="email" type="email" class="form-control" name="email" v-model="user.email" required autocomplete="email" autofocus>

                        <span v-if="this.error.email !==''" class="invalid-feedback" role="alert">
                            <strong>{{this.error.email}}</strong>
                        </span>
                    </div>
                </fieldset>

                <fieldset>
                    <label for="password" class="column text-md-right">Mot de passe</label>

                    <div  class="column">
                        <input id="password" type="password" class="form-control" v-model="user.password" name="password" required autocomplete="current-password">
                        <span v-if="this.error.password !==''" class="invalid-feedback" role="alert">
                            <strong>{{ this.error.password }}</strong>
                        </span>
                    </div>
                </fieldset>


                <fieldset>
                    <div class="column">
                        <button type="button" class="button primary" @click="login">
                            Login
                        </button>

                        <a class="button warning" href="">
                            Mot de passe oublié
                        </a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props:['redirect','login_route'],
        data(){
            return {
                user:{
                    email:"",
                    password:""
                },
                error:{
                    email:"",
                    password:""
                }
            }
        },
        methods:{
          login:function(){
            axios.post(this.login_route, this.user).then(data=>{
                this.$session.start();
                this.$session.set('token',"Bearer "+data.data.token);
                console.log(data.data.token);
                //window.location.href = this.redirect;
            }).catch(error=>{
                if (error.response.status === 422){
                    this.assignErrors(error.response.data.errors);
                }
            });
          },
          assignErrors:function(errors){
              this.error.email = errors.email[0];
              this.error.password = errors.password[0];
              console.log(this.error)
          }
        }
    }
</script>

<style scoped>

</style>
