<template>
    <div>
        <div v-if="alertUser.message!==''" :class="'callout '+this.state ">
            <h5>{{alertUser.title}}</h5>
            <pre>{{alertUser.message}}</pre>
            <a :href="'/articles/'+this.updatedData.post_name">{{updatedData.post_title}}</a>
            <button class="button alert" @click="alertUser.message=''">Fermer</button>
        </div>
        <div id="reveal-dialog" class="reveal" data-reveal>
            <form>
                <fieldset class="fieldset">
                <legend>{{this.type}}</legend>
                    <label for="post_title">Title</label>
                    <input type="text" name="post_title" v-model="post.post_title">
                    <label for="post_name">Name</label>
                    <input type="text" name="post_name" v-model="post.post_name">
                    <label for="post_content">Content</label>
                    <input type="text" name="post_content" v-model="post.post_content">
                    <label for="post_category">Category</label>
                    <input type="text" name="post_category" v-model="post.post_category">
                    <label for="files">Selectionner fichiers</label>
                    <multiselect name="files" v-model="post.photos" :options="photosToChoose" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="post_title" track-by="post_title" ></multiselect>
                    <label for="new_photos">Ajouter de nouveau fichiers</label>
                    <input type="file" multiple="multiple" name="new_photos" :id="'new_photos['+this.post_id+']'" @change="filesToUpload">
                    <a v-if="!this.post_id" v-on:click="addPost()" v-bind:class="'button '+this.button_type" data-close>
                        Ajouter
                    </a>
                    <a v-else v-on:click="updatePost()" v-bind:class="'button '+this.button_type" data-close>
                        Editer
                    </a>
                </fieldset>
            </form>
        </div>
        <p>
            <a v-on:click="openModal()" v-bind:class="'button '+ this.button_type">{{this.type}} un post</a>
        </p>
    </div>
</template>

<script>
    export default {
        //props:["post","photos"],
        props:["post_id"],
        data:function() {
            return {
                type:"Ajouter",
                button_type:'primary',
                photosToChoose:[],
                post:{
                    "post_title":"",
                    "post_content":"",
                    "post_name":"",
                    "post_category":"",
                    "post_type":'article',
                    "user_id":this.$session.get("user").id
                },
                databasePhotos:[],
                postToSend: new FormData,
                alertUser:{
                    title:'',
                    message:''
                },
                updatedData:""
            };
        },
        mounted() {
            this.initContent();
            this.form = new Foundation.Reveal($('#reveal-dialog'), {
                animationIn: 'scale-in-up',
            });
        },
        watch:{
          post_id:function(o, n){
              if(o !== n) {
                  this.initContent();
              }
          }
        },
        methods: {
            initContent(){
                this.getPhotos();
                if(this.post_id){
                    this.type = "Editer";
                    this.button_type = "warning";
                    this.getPost();
                }
            },
            openModal() {
                this.form.open();
            },
            addPost(){
                this.prepareData();
                axios.post('/api/posts', this.postToSend,{headers: {
                    "Authorization": this.$session.get('token')
                }}).then(data=>{
                    this.updatedData = data.data;
                    this.alertUser.title = "Succès !";
                    this.alertUser.message = "Le post a été ajouté avec succès !";
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
            updatePost(){
                this.prepareData();
                this.postToSend.append("_method","PUT");
                axios.post('/api/posts/'+this.post.id, this.postToSend,
                    {
                        headers: {
                        "Authorization": this.$session.get('token')
                    }
                    }).then(data=>{
                    this.updatedData = data.data;
                    this.alertUser.title = "Succès !";
                    this.alertUser.message = "Le post a été modifié avec succès !";
                    this.state = "success";
                    }).catch(error=>{
                        console.log(error.response.data);
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
            getPost(){
                axios.get("/api/posts/"+this.post_id,{headers: {
                        "Authorization": this.$session.get('token')
                    }}).then(data=>{
                        this.post = data.data;
                }).catch(error=>{
                    console.log(error.response.data);
                })
            },
            getPhotos(){
              axios.get('/api/files',{headers: {
                      "Authorization": this.$session.get('token')
                  }}).then(data=>{
                      this.photosToChoose = data.data.data;
                });
            },
            filesToUpload:function(event){
                let files = event.target.files || event.dataTransfer.files;
                if (!files.length)
                    return;
                for (let index = files.length - 1; index >= 0; index--) {
                    this.postToSend.append("new_photos[]",files[index]);
                }
                document.getElementById("new_photos["+this.post.id+"]").value = [];
            },
            prepareData:function(){
                for(let index in this.post){
                    if(index ==="author"){
                        this.postToSend.append("user_id",this.post[index].id);
                    }else{
                        this.postToSend.append(index,this.post[index]);
                    }
                }
                if(this.post.photos.length>0){
                    let chosenPhotos = [];
                    for(let index in this.post.photos){
                        chosenPhotos.push(this.post.photos[index].id);
                    }
                    console.log(chosenPhotos);
                    this.postToSend.append("photos",JSON.stringify(chosenPhotos));
                }
            }
        },
        destroyed() {
            this.form.destroy();
        },
    };
</script>


<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

