<template>
    <div>
        <categories-menu :active="category"></categories-menu>
        <div v-for="post in posts" class="blog-post">
            <h3><a :href="'/articles/'+post.post_name">{{post.post_title}}</a> <small>{{post.post_date}}</small></h3>
            <p>{{post.post_content.substring(0,50)+"..."}}
                <a :href="'/articles/'+post.post_name">Voir plus</a>
            </p>
            <div class="callout">
                <ul class="menu simple">
                    <li>Auteur: {{post.author.name}}</li>
                    <li>Commentaires: {{post.comments.length}}</li>
                </ul>
            </div>
        </div>
        <div v-if="this.links !=={}" class="row">
            <button :disabled="links.prev===null" type="button" class="columns small-4 button" v-on:click="getPosts(links.prev)">Précedent</button>
            <div class="columns small-4"></div>
            <button :disabled="links.next===null" type="button" class="columns small-4 button" v-on:click="getPosts(links.next)">Suivant</button>
        </div>
    </div>
</template>

<script>
    import CategoriesMenu from "./CategoriesMenu";
    export default {
        components: {CategoriesMenu},
        data:function(){
            return {
                posts:[],
                links:{},
                category:null,
            }
        },
        methods:{
          getPosts:function(url="/api/front/posts"){
              axios.get(url).then(data=>{
                  this.posts = data.data.data;
                  this.links = data.data.links;

              });
          },
            getPostsByCategory:function(category) {
              this.category = category;
                axios.get("/api/posts/category/" + category).then(data => {
                    this.posts = data.data.data;
                    this.links = data.data.links;
                });
            }
        },
        mounted() {
            this.getPosts();
            let self = this;
            window.session.$on("fetchCategory",function(category){
                self.getPostsByCategory(category);
            });
        }
    }
</script>

<style scoped>

</style>
