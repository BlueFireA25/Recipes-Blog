<template>
    <input type="submit" 
    class="btn btn-danger d-block w-100 mb-2" 
    value="Delete"
    @click="deleteRecipe">
</template>

<script>
    export default {
        props: ['recipeId'],
        methods: {
            deleteRecipe(){
                this.$swal({
                    title: '¿Do you want to delete this recipe?',
                    text: "Once deleted, it cannot be recovered",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const params = {
                            id: this.recipeId
                        }

                        // Send the request to the server
                        axios.post(`/recipes/${this.recipeId}`, {params, _method: 'delete'})
                        .then(answer => {
                            this.$swal({
                                title: 'Recipe deleted',
                                text: 'Recipe removed',
                                icon: 'success'
                            });

                            // Delete recipe from DOM
                            this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                        })
                        .catch(error => {
                            console.log(error);
                        })
                    }
                })
            }
        }
    }
</script>