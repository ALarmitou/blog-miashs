<template>
<div>
    <div v-for="comment in this.comments" class="callout">
        <h6>{{comment.comment_name}}<small>{{comment.comment_email}}</small></h6>
        <p>{{comment.comment_content}}</p>
        <small>{{comment.comment_date}}</small>
        <ask-delete v-if="can_delete" type="comment" v-bind:item_id="comment.id" tell-admin="updateComments"></ask-delete>
    </div>
</div>
</template>

<script>
    export default {
        props:['can_delete','post_id'],
        data(){
            return {
                'comments': [],
            }
        },
        methods:{
            getComments(){
                axios.get("/api/posts/"+this.post_id+"/comments").then(data=>{
                   this.comments = data.data;
                });
            },
        },
        mounted() {
            this.getComments();
            let self = this;
            window.session.$on('updateComments', function() {
                self.getComments();
            })
        }
    }
</script>

<style scoped>

</style>
