<template>
    <table>
        <tr>
            <th v-for="header in this.headers">{{header}}</th>
        </tr>
        <tr v-for="item in this.collection">
            <td v-for="value in item">{{value}}</td>
        </tr>
    </table>
</template>

<script>
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
