<template>
    <ul class="menu align-center">
        <li v-for="model in models" :class="isActive(model.toLowerCase())" >
            <a :href="'/admin/'+model.toLowerCase()">{{model}}</a></li>
    </ul>
</template>

<script>
    export default {
        data(){
            return{
                models:[]
            };
        },
        methods:{
            getModels:function(){
                axios.get("/api/admin-menu",{headers:{
                    "Authorization":this.$session.get('token')
                    }}).then(data=>{
                        this.models = data.data;
                })
            },
            isActive:function(model){
                return window.location.href.includes(model) ? "is-active" :"";
            }
        },
        mounted(){
            this.getModels();
        }
    }
</script>

<style scoped>

</style>
