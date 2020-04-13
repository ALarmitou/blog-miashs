<template>
    <div>
        <div id="reveal-dialog" class="reveal" data-reveal>
            <form>
                <fieldset class="fieldset">
                <legend>{{this.type}}</legend>
                    <label for="post_title">Title</label>
                    <input type="text" name="post_title" v-model="postToAdd.post_title">
                    <label for="post_name">Name</label>
                    <input type="text" name="post_name" v-model="postToAdd.post_name">
                    <label for="post_content">Content</label>
                    <input type="text" name="post_content" v-model="postToAdd.post_content">
                    <label for="post_category">Category</label>
                    <input type="text" name="post_category" v-model="postToAdd.post_category">
                    <a v-if="!this.post" v-on:click="addPost()" v-bind:class="'button '+this.button_type" data-close>
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
        props:["post"],
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
                postToAdd:{
                "post_title":"",
                "post_content":"",
                "post_name":"",
                "post_category":"",
                "user_id":this.$session.get("user").id
                },
            };
        },
        methods: {
            initContent(){
                if(this.post){
                    this.type = "Editer";
                    this.button_type = "warning";
                    if(typeof this.post === "string")
                        this.postToAdd = JSON.parse(this.post);
                    else
                        this.postToAdd = this.post;
                }
            },
            openModal() {
                this.form.open();
            },
            addPost(){
                axios.post('/api/posts', this.postToAdd,{headers: {
                    "Authorization": this.$session.get('token')
                }}).then(data=>{
                    console.log(data);
                }).catch(error=>{
                    console.log(error);
                });
            },
            updatePost(){
                axios.put('/api/posts/'+this.postToAdd.id, this.postToAdd,{headers: {
                        "Authorization": this.$session.get('token')
                    }}).then(data=>{
                    console.log(data);

                }).catch(error=>{
                    console.log(error);
                });
            }
        },
        destroyed() {
            this.form.destroy();
        },
    };
</script>

