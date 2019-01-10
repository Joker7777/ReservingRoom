<template>
<div id="main">
    <calendar
        class="container" />
</div>
</template>
<script>
import BookBar from './BookBar.vue'
import Calendar from './Calendar.vue'

export default {
    name: 'main-page',
    components: {
        BookBar,
        Calendar
    },
    computed: {
    }
}
</script>
