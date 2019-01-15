<template>
<div class="move-week-button">
    <div
        id="move-pre-week"
        v-if="moveTo == 'pre'"
        @click="movePreWeek()">
        前の週へ
    </div>
    <div
        id="move-next-week"
        v-else
        @click="moveNextWeek()">
        次の週へ
    </div>
</div>
</template>
<script>
export default {
    props: {
        moveTo: {
            type: String,
        }
    },
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
.move-week-button {
    position: relative;
    display: inline-block;
    width: 100px;
    height: 30px;
    background-color: green;
    color: white;
    // 縦中央揃え

    #move-pre-week {
        left: 10px;
        width: 100%;
        // 右揃え、左矢印
    }
    #move-next-week {
        right: 10px; // なんかうごかないなぜ
        width: 100%;
        // 左揃え、右矢印
    }
}
</style>

