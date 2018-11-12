<template>
<div
    class=booking-box
    @click="toEditForm" >
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
        day: {
            type: Number,
        },
        frame: {
            type: Number,
        }
    },
    methods: {
        toEditForm () {
            this.$emit('click-book',
                {
                    'day': this.day,
                    'frame': this.frame
                }
            )
        }
    }
}
</script>
<style lang="scss" scoped>
@import '../../sass/variables';

.booking-box {
    size: 100%;
    background-color: $blue;
}
</style>
