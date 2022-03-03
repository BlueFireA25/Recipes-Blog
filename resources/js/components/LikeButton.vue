<template>
    <div>
        <span class="like-btn" @click="likeRecipe" :class="{ 'like-active' : isActive }"></span>

        <p>{{ amountLikes }} They like this recipe</p>
    </div>
</template>

<script>
    export default {
        props: ['recipeId', 'like','likes'],
        data() {
            return {
                isActive: this.like,
                totalLikes: this.likes
            }
        },
        methods: {
            likeRecipe() {
                axios.post('/recipes/' + this.recipeId)
                .then(answer => {
                    if(answer.data.attached.length > 0) {
                        this.$data.totalLikes++;
                    } else {
                        this.$data.totalLikes--;
                    }

                    this.isActive = !this.isActive;
                })
                .catch(error => {
                    if(error.response.status === 401) {
                        window.location = '/register';
                    }
                });
            }
        },
        computed: {
            amountLikes: function() {
                return this.totalLikes;
            }
        }
    }
</script>