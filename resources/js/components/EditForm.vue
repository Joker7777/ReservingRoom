<template>
<transition name="modal">
    <div class="modal-mask">
        <div class="container modal-container">
            <div class="modal-header">
                <h3 class="header">予約</h3>
                {{book}}
                <div class="close" @click="close">&times;</div>
            </div>
            <div class="modal-body">
                <div class="input-name">
                    <span label="name">バンド名, 使用用途: </span>
                    <input type="text" name="name" v-model="book.name">
                    {{ book }}
                </div>
                <input-date />
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
                <input
                    type="checkbox"
                    id="every-week"
                    @click="changeEveryWeek">
                <label for="every-week">毎週予約</label>
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
        book () {
            let booklist = this.$store.state.Form.BookList
            if (booklist[this.day] != undefined) {
                if (booklist[this.day][this.frame] != undefined) {
                    return this.$store.state.Form.BookList[this.day][this.frame]
                }
            }
            let template = this.$store.state.Form.BookTemplate
            console.log(template)
            template['date'] = {
                year: this.params['date']['year'],
                month: this.params['date']['month'],
                date: this.params['date']['date'],
            }
            return template
        },
        years () {
            let year = new Date().getFullYear()
            let arr = [...Array(year-2018+2).keys()].map(v => v+2018)
            return arr
        },
        dates () {
            return new Date(this.book.date.year, this.book.date.month, 0).getDate();
        }
    },
    methods: {
        close () {
            this.$emit('close')
        },
        changeEveryWeek () {
            this.EveryWeek = !this.EveryWeek
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

