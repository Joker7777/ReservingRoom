<template>
<div id="main">
    <book-bar />
    <calendar
        class="container"
        :today="today" />
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
        today () {
            return this.$store.state.Form.today
        }
    }
}
</script>
