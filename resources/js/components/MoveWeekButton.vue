<template>
<div class="move-week-button clearfix">
    <button
        id="move-pre-week"
        @click="movePreWeek()">
        <span>前の週へ</span>
    </button>
    <button
        id="move-next-week"
        @click="moveNextWeek()">
        <span>次の週へ</span>
    </button>
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
@import '../../sass/_button';

.move-week-button {
    width: 100%;
    padding: 10px;

    @mixin move-button ($position) {
        display: inline-block;
        width: 80px;
        height: 30px;
        padding: 5px;
        cursor: pointer;
        border: none;
        color: white;

        @if $position == left {
            background:
                linear-gradient(135deg,  transparent 20%, $green 0%),
                linear-gradient(45deg, transparent 20%, $green 0%);
            background-position: top left, bottom left;
            background-size: 100% 50%; // 横 縦　分割
            background-repeat: no-repeat;
        } @else {
            background:
                linear-gradient(225deg, transparent 20%, $green 0%),
                linear-gradient(315deg, transparent 20%, $green 0%);
            background-position: top right, bottom right;
            background-size: 100% 50%; // 横 縦　分割
            background-repeat: no-repeat;
        }
    }

    #move-pre-week {
        @include move-button(left);

        float: left;    
        text-align: right;
        // 右揃え、左矢印
    }
    #move-next-week {
        @include move-button(right);

        float: right;
        text-align: left;
        // 左揃え、右矢印
    }
}
</style>

