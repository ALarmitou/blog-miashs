<template>
    <div>
        <table class="scroll">
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
            <button :disabled="links.prev===null" type="button" class="columns small-4 button" v-on:click="getData(links.prev)">Précedent</button>
            <div class="columns small-4"></div>
            <button :disabled="links.next===null" type="button" class="columns small-4 button" v-on:click="getData(links.next)">Suivant</button>
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
                axios.get(url,{headers: {
                        "Authorization": this.$session.get('token')
                    }}).then(data=>{
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
            window.session.$on('updateAdmin', function() {
                self.getData();
            })
        }
    }
</script>

<style scoped>

</style>
