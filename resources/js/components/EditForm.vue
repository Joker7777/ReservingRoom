<template>
<transition name="modal">
    <div class="modal-mask">
        <div class="container modal-container">
            <div class="modal-header">
                <h3 class="header">予約</h3>
                <div class="close" @click="close">&;</div>
            </div>
            <div class="modal-body">
                <div class="input-name">
                    <span label="name">バンド名, 使用用途: </span>
                    <input type="text" name="name" :value="book.name">
                </div>
                <div class="input-date" v-if="!EveryWeek">
                    <span label="date">使用日: </span>
                    {{ book.date }}
                    <select name="date-year" :value="book.date.year">
                        <option
                            v-for="year in years"
                            :key="year"
                            :value="year">
                            {{ year }}
                        </option>
                    </select>
                    年
                    <select name="date-month" :value="book.date.month">
                        <option
                            v-for="month in 12"
                            :key="month">
                            {{ month }}
                        </option>
                    </select>
                    月
                    <select name="date-date">
                        <option
                            v-for="date in dates"
                            :key="date">
                        </option>
                    </select>
                    日  
                </div>
                <div class="input-day" v-if="EveryWeek">
                    <span label="day">使用曜日: </span>
                    <select name="day">
                        <option
                            v-for="(DayName, key) in DayList"
                            :key="key">
                            {{ DayName }}
                        </option>
                    </select>
                </div>
                <input type="checkbox" @click="changeEveryWeek">
                うまくいってない
            </div>
        </div>
    </div>
</transition>
</template>

<script>
export default {
    props: {
        book: {
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
        years () {
            // var arr = [...Array(new Date.getFullYear()+1).keys()].map(i=>i+2017)
            // console.log(new Date.getFullYear() + 1)
            // console.log(arr)
            // return arr
        }
    },
    methods: {
        close () {
            this.$emit('close')
        },
        changeEveryWeek () {
            EveryWeek = !EveryWeek
        }
    }
}
</script>

<style lang="scss" scoped>
.modal{
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
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }
}
</style>

