<template>
    <tr>
        <td v-for="content in user">
            <ul v-if="content ===user.roles || content===user.permissions">
                <li v-for="otheritem in content">{{otheritem.name}}</li>
            </ul>
            <p v-else>{{content}}</p>
        </td>
        <td align="center">
            <form-user v-bind:user="this.user"></form-user>
            <ask-delete type="user" v-bind:item_id="user.id" tell-admin="updateAdmin"></ask-delete>
        </td>
    </tr>
</template>

<script>
    import AskDelete from "./AskDelete";
    export default {
        components: {AskDelete},
        props:['user']
    }
</script>

<style scoped>

</style>
