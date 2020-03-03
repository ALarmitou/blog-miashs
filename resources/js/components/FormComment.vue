<template>
    <div>
        <div v-if="this.success == true" class="callout success">
            <b>Commentaire ajouté !</b>
        </div>
        <form method="post" action="">
            <fieldset class="fieldset">
                <legend>Ajouter un commentaire</legend>
                <label for="comment_name">Name</label>
                <input type="text" name="comment_name" v-model="comment_name">
                <div class="callout alert" v-if="this.comment_name_error != ''">
                    <p class="help-text">{{this.comment_name_error}}</p>
                </div>
                <label for="comment_email">Email</label>
                <input type="text" name="comment_email" v-model="comment_email">
                <div class="callout alert" v-if="this.comment_email_error != ''">
                    <p class="help-text">{{this.comment_email_error}}</p>
                </div>
                <label for="comment_content">Comment</label>
                <input type="text" name="comment_content" v-model="comment_content">
                <div class="callout alert" v-if="this.comment_content_error != ''">
                    <p class="help-text">{{this.comment_content_error}}</p>
                </div>
                <a class="button expanded" v-on:click="addCommentToPost()">Ajouter commentaire</a>
            </fieldset>
        </form>
    </div>
</template>

<script>
    export default {
        props:['add_comment','post_id'],
        data() {
            return {
                comment_name: "",
                comment_email: "",
                comment_content: "",
                comment_name_error:'',
                comment_email_error:'',
                comment_content_error:'',
                success: false
            }
        },
        methods:{
            addCommentToPost:function(){
                this.clearErrors();
                axios.post('/api/comments',this.getCommentToSend())
                    .then(data=>{
                        this.success = true;
                        window.events.$emit("updateComments","test");
                    })
                    .catch(error => {
                        if (error.response.status == 422){
                            this.getErrors(error.response.data.errors);
                        }
                    });
            },
            getCommentToSend:function(){
                return {
                    post_id:this.post_id,
                    comment_name: this.comment_name,
                    comment_email: this.comment_email,
                    comment_content: this.comment_content,

                };
            },
            getErrors:function(errors){
                for(let error in errors){
                    if(error.includes('name')){
                        this.comment_name_error = errors[error][0];
                    }
                    if(error.includes('email')){
                        this.comment_email_error = errors[error][0];
                    }
                    if(error.includes('content')){
                        this.comment_content_error = errors[error][0];
                    }
                }
            },
            clearErrors:function(){
                this.comment_name_error = "";
                this.comment_content_error = "";
                this.comment_email_error = "";
            }
        },
        mounted() {

        }
    }
</script>
