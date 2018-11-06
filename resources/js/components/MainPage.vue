<template>
<div id="main">
    <book-bar />
    <time-table />
</div>
</template>
<script>
import BookBar from './BookBar.vue'
import TimeTable from './TimeTable.vue'

export default {
    name: 'main-page',
    components: {
        BookBar,
        TimeTable
    }
}
</script>
