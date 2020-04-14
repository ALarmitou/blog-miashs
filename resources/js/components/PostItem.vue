<template>
    <tr>
        <td v-for="content in post">
            <p v-if="post.post_type==='article'&&content.length>50">{{content.substring(0,50)+"..."}}</p>
            <img v-else-if="post.post_type==='file' && content ===post.post_name" :src="imgPath+'/'+content" alt="">
            <p v-else>{{content}}</p>
        </td>
        <td align="center">
            <form-post :post="this.post"></form-post>
            <ask-delete type="post" :item_id="post.id" tell-admin="updateAdmin"></ask-delete>
        </td>
    </tr>
</template>

<script>
    import AskDelete from "./AskDelete";
    export default {
        components: {AskDelete},
        props:['post','imgPath']
    }
</script>

<style scoped>

</style>
