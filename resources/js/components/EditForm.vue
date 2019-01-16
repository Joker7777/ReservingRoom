<template>
<transition name="modal">
    <div class="modal-mask">
    <div class="container modal-container">
        <div class="modal-header">
            <h3 class="header">予約</h3>
            <div class="close" @click="close">&times;</div>
        </div>
        <div class="modal-body">
            <div class="input-name">
                <label for="name">バンド名, 使用用途: </label>
                <input type="text" id="name" v-model="name">
            </div>
            <div class="input-times">
                <div class="input-day" v-if="EveryWeek">
                    <label for="day">使用曜日: </label>
                    <select id="day" >
                        <option
                            v-for="(DayName, key) in DayList"
                            :key="key">
                            {{ DayName }}
                        </option>
                    </select>
                </div>
                <div class="input-date" v-else>
                    <label for="date">使用日: </label>
                    <input type="date" id="date">
                </div>
                <div class="input-frame">
                    <select id="frame">
                        <option
                            v-for="(frame, index) in TimeTable"
                            :key="index"
                            :next="TimeTable[index+1]">
                            {{ frame.name }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="input-until" v-if="EveryWeek">
                <label for="until">期間: </label>
                <input type="date" id="since">
                ~
                <input type="date" id="until">
            </div>
            <div>
                <input
                    type="checkbox"
                    id="every-week"
                    @click="changeEveryWeek">
                <label for="every-week">毎週予約</label>
            </div>
        </div>
    </div>
    </div>
</transition>
</template>

<script>
export default {
    props: {
        params: {
            type: Object,
        }
    },
    data () {
        return {
            EveryWeek: false // 毎週予約か
        }
    },
    computed: {
        DayList () {
            return this.$store.state.Form.DayList
        },
        TimeTable () {
            return this.$store.state.Form.TimeTable
        },
        name: {
            get () {
                return this.$store.state.Form.bookList[this.params['day']][this.params['frame']][name]
            },
            set (value) {
                this.$store.commit('Form/updateBook', {
                    day: this.params['day'],
                    frame: this.params['frame'],
                    key: 'name',
                    data: value
                })
            }
        },
    },
    methods: {
        close () {
            if (this.params['empty']) {
                this.$store.commit('Form/resetBook', {
                    day: this.params['day'],
                    frame: this.params['frame']
                }) // 追加しようとしたデータを削除
            }
            this.$emit('close')
        },
        changeEveryWeek () {
            this.EveryWeek = !this.EveryWeek
        }
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables';

.input-times {
    div {
        display: inline-block;
        margin-right: 10px;
    }
}
input, select {
    border: thin solid $gray;
}

.modal {
    &-enter-active, &-leave-active {
        transition: opacity 1s;
    }
    &-enter, &-leave-to {
        opacity: 0;
    }
    &-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }
    &-container {
        margin: 0px auto;
        padding: 20px 30px;
        background-color: $body-bg;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }
}
</style>

