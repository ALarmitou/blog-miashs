<template>
    <table>
        <thead>
            <tr>
                <th v-for="header in this.headers">{{header}}</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in this.collection">
                <td v-for="value in item">{{value}}</td>
                <td>
                    <form-post v-bind:post_id="item.id"></form-post>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    import FormPost from './FormPost';
    export default {
        props:['api_to_fetch', 'type'],
        data(){
            return {
                headers:[],
                collection:{}
            };
        },
        methods:{
            getData:function(){
                axios.get(this.api_to_fetch).then(data=>{
                    this.getHeaders(data.data[0]);
                    this.collection = data.data;
                });
            },
            getHeaders:function(datas){
                for(let data in datas){
                    this.headers.push(data.replace(this.type+"_", "").toUpperCase());
                }
            }
        },
        mounted() {
            this.getData();
        }
    }
</script>

<style scoped>

</style>
