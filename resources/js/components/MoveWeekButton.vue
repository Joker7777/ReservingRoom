<template>
<div class="move-week-button clearfix">
    <div
        id="move-pre-week"
        @click="movePreWeek()">
        <span>前の週へ</span>
    </div>
    <div
        id="move-next-week"
        @click="moveNextWeek()">
        <span>次の週へ</span>
    </div>
</div>
</template>
<script>
export default {
    methods: {
        movePreWeek () { // 呼ばれた時にbookListロードし直す必要
            let stdDate = this.$store.state.Form.stdDate
            this.$store.commit('Form/stdDate',
                new Date (
                    stdDate.getFullYear(),
                    stdDate.getMonth(),
                    stdDate.getDate() - 7
                )
            )
        },
        moveNextWeek () {
            let stdDate = this.$store.state.Form.stdDate
            this.$store.commit('Form/stdDate',
                new Date (
                    stdDate.getFullYear(),
                    stdDate.getMonth(),
                    stdDate.getDate() + 7
                )
            )
        }
    }
}
</script>
<style lang="scss" scoped>
@import '../../sass/variables';

.move-week-button {
    width: 100%;
    padding: 10px;

    %move-button {
        display: inline-block;
        width: 100px;
        height: 30px;
        padding: 5px;
        background-color: $green;
        color: white;
    }

    #move-pre-week {
        @extend %move-button;

        float: left;
        text-align: right;
        // 右揃え、左矢印
    }
    #move-next-week {
        @extend %move-button;

        float: right;
        text-align: left;
        // 左揃え、右矢印
    }
}
</style>

