<template>
<div class=booking-box>
    {{ book.name }}
</div>
</template>
<script>
export default {
    name: 'booking',
    props: {
        book: {
            type: Object,
        },
    },
}
</script>
<style lang="scss" scoped>
@import '../../sass/variables';

.booking-box {
    size: 100%;
    background-color: $blue;
}
</style>
