<template>
    <fieldset class="card">
        <div class="card-divider">Créer un nouveau compte</div>
        <fieldset class="card-section">
            <form>
                <fieldset>
                    <label for="name" class="col-md-4 col-form-label text-md-right">Votre nom :</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" v-model="user.name"  required autocomplete="name" autofocus>

                        <span v-if="this.error.name !==''" class="invalid-feedback" role="alert">
                            <strong>{{this.error.name}}</strong>
                        </span>
                    </div>
                </fieldset>

                <fieldset>
                    <label for="email" class="col-md-4 col-form-label text-md-right">Votre adresse email</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email"v-model="user.email"  required autocomplete="email">

                        <span v-if="this.error.email !==''" class="invalid-feedback" role="alert">
                            <strong>{{this.error.email}}</strong>
                        </span>
                    </div>
                </fieldset>

                <fieldset>
                    <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" v-model="user.password"  required autocomplete="new-password">

                        <span v-if="this.error.password !==''" class="invalid-feedback" role="alert">
                            <strong>{{this.error.password}}</strong>
                        </span>
                    </div>
                </fieldset>

                <fieldset>
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmer mot de passe</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" v-model="user.password_confirmation" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <span v-if="this.error.password_confirmation !==''" class="invalid-feedback" role="alert">
                            <strong>{{this.error.password_confirmation}}</strong>
                        </span>
                </fieldset>

                <fieldset>
                    <div class="columns">
                        <button type="button" class="button primary" @click="register">
                            S'enregistrer
                        </button>
                    </div>
                </fieldset>
            </form>
        </fieldset>
    </fieldset>
</template>

<script>
    export default {
        props:['redirect','register_route'],
        data(){
            return {
                user:{
                    name:"",
                    email:"",
                    password:"",
                    password_confirmation:""
                },
                error:{
                    name:"",
                    email:"",
                    password:"",
                    password_confirmation:""
                }
            }
        },
        methods:{
            register:function(){
                if(this.checkPassword()) {
                    axios.post(this.register_route, this.user).then(data => {
                        this.$session.start();
                        this.$session.set('token', "Bearer " + data.data.token);
                        window.location.href = this.redirect;
                    }).catch(error => {
                        if (error.response.status === 422) {
                            this.assignErrors(error.response.data.errors);
                        }
                    });
                }
            },
            assignErrors:function(errors){
                this.error.name = errors.name[0];
                this.error.email = errors.email[0];
                this.error.password = errors.password[0];
            },
            checkPassword:function(){
                if(!this.user.password===this.password_confirmation){
                    this.error.password_confirmation = "Les mots de passe ne coïncident pas."
                    return false;
                }
                return true;
            },
        }
    }
</script>

<style scoped>

</style>
