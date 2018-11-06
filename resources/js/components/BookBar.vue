<template>
<div id="book-bar" class="sticky-top">
    <div>部室予約</div>
    <form>
        <input type="text">
        <button type="submit">予約</button>
    </form>
</div>
</template>
<script>
export default {
    name: 'book-bar',
}
</script>
<style lang="scss" scoped>
#book-bar {
    padding: 10px;
    background-color: #0f0;
}
</style>

