<template>
    <span> {{ formatDate }} </span>
</template>

<script>
    export default {
        props: ['date'],
        computed: {
            formatDate() {
                return moment(this.date).locale('en').format('MMMM DD[,] YYYY');
            }
        }
    }
</script>