<template>
    <div>
        <table>
            <thead>
            <tr>
                <th v-for="header in this.headers">{{header}}</th>
                <th width="200">ACTIONS</th>
            </tr>
            </thead>
            <tbody>
                <slot name="collection" v-bind:collection="collection">
                    <tr v-for="item in this.collection">
                                <td>to remove</td>
                    </tr>
                </slot>
            </tbody>
        </table>
        <div v-if="this.links !=={}" class="row">
            <button type="button" class="columns small-4 button" v-on:click="getData(links.prev)">Prev</button>
            <div class="columns small-4"></div>
            <button type="button" class="columns small-4 button" v-on:click="getData(links.next)">Next</button>
        </div>
    </div>
</template>

<script>
    export default {
        props:['api_to_fetch', 'type'],
        data(){
            return {
                headers:[],
                collection:{},
                links:{}
            };
        },
        methods:{
            getData:function(url=this.api_to_fetch){
                axios.get(url).then(data=>{
                    this.links = data.data.links;
                    if(this.headers.length === 0) {
                        this.getHeaders(data.data.data[0]);
                    }
                    this.collection = data.data.data;
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
            let self = this;
            window.events.$on('updateAdminPosts', function() {
                self.getData();
            })
        }
    }
</script>

<style scoped>

</style>
