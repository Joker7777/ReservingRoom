<template>
    <div id="main" class="container">
        <calendar />

        <button class="btn-success" >yeee</button>
    </div>
</template>
<script>
    import Calendar from './Calendar.vue';

    export default {
        name: 'time-table',
        components: {
            Calendar,
        }
    }
</script>
<style lang="scss" scoped>
    // #main {
    //     position: relative;
    //     top: 0;
    //     right: 0;
    //     bottom: 0;
    //     left: 0;
    //     width: 80%;
    //     margin: auto;
    // }

</style>