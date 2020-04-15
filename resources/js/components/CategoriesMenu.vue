<template>
    <ul class="menu align-center">
        <li v-for="category in categories" :class="isActive(category.post_category)" >
            <a @click="sendCategory(category.post_category)">{{category.post_category}}</a>
        </li>
    </ul>
</template>

<script>
    export default {
        props:['active'],
        data:function(){
            return {
                categories:[]
            }
        },
        methods:{
            getCategories:function(){
                axios.get("/api/posts/all/categories").then(data=>{
                   this.categories = data.data;
                });
            },
            sendCategory:function(category){
                window.session.$emit("fetchCategory",category);
            },
            isActive:function(category){
                if(this.active) {
                    if (this.active === category) {
                        return 'is-active'
                    }
                }
            }
        },
        mounted() {
            this.getCategories();
        }
    }
</script>

<style scoped>

</style>
