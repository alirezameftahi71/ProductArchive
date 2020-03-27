<template>
    <footer class="container-fluid text-center bg-dark text-light">
        &copy; {{ '2017' != date ? `2017 - ${date}` : '2017' }} Alireza Meftahi | All Rights Reserved
    </footer>
</template>

<script>
    export default {
        computed: {
            date() {
                return new Date().getFullYear();
            }
        }
    }
</script>

<style lang="scss">
    footer {
        padding: 1rem;
        position: static;
        bottom: 0;
    }
</style>