<template>
    <tr>
        <td v-for="content in role">
            <p>{{content}}</p>
        </td>
        <td align="center">
            <form-role v-bind:role="this.role"></form-role>
            <ask-delete type="role" v-bind:item_id="role.id" tell-admin="updateAdmin"></ask-delete>
        </td>
    </tr>
</template>

<script>
    import AskDelete from "./AskDelete";
    export default {
        components: {AskDelete},
        props:['role']
    }
</script>

<style scoped>

</style>
