<template>
    <tr>
        <td v-for="content in post">
            <p v-if="content.length>50">{{content.substring(0,50)+"..."}}</p>
            <p v-else>{{content}}</p>
        </td>
        <td align="center">
            <form-post v-bind:post="this.post"></form-post>
            <ask-delete type="post" v-bind:item_id="post.id" tell-admin="updateAdmin"></ask-delete>
        </td>
    </tr>
</template>

<script>
    import AskDelete from "./AskDelete";
    export default {
        components: {AskDelete},
        props:['post']
    }
</script>

<style scoped>

</style>
