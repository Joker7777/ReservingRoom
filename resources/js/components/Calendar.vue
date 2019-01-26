<template>
<div id="calendar">
    <move-week-button />
    <div class="result">
        {{ result }}
    </div>
    <table class="table table-bordered">
        <tr>
            <th>時間</th>
            <th v-for="(date, index) in getDates" :key="index">
                <span>
                    {{ getDayName(date) }}<br>
                </span>
                <span>
                    {{ date.getMonth()+1 }} / {{ date.getDate() }}
                </span>
            </th>
        </tr>
        <tr
            v-for="(frame, indexFrame) in TimeFrames"
            :key="indexFrame">
            <th>
                {{ frame.name }}
            </th>
            <td
                v-for="(date, index) in getDates"
                :key="index">
                <div
                    class="book"
                    v-if="bookExist(index, indexFrame)"
                    @click="editStatus({'date': date, 'day': index, 'frame': indexFrame, 'empty': false})">
                    {{ getBookList[index][indexFrame].name }}
                </div>
                <div
                    class="empty"
                    v-else
                    @click="editStatus({'date': date, 'day': index, 'frame': indexFrame, 'empty': true})">
                    &#9675;
                </div>
            </td>
        </tr>
    </table>
    <edit-form
        v-if="editting"
        :params="editParam"
        @close="close" />
</div>
</template>
<script>
import EditForm from './EditForm.vue'
import MoveWeekButton from './MoveWeekButton'

export default {
    name: 'calendar',
    components: {
        EditForm,
        MoveWeekButton
    },
    created () {
        this.$store.dispatch('Form/getBookList')
    },
    data () {
        return {
            editting: false,
            editParam: {
                'day': null,
                'frame': null,
                'date': null,
                'empty': false,
            },
        }
    },
    computed: {
        result () {
            setTimeout(this.$store.commit, 3000, 'Form/resetResult')
            return this.$store.state.Form.result
        },
        DayList () {
            return this.$store.state.Form.DayList
        },
        getDates () { // 日付など返す
            var stdDate = this.$store.state.Form.stdDate
            var date = new Array(7) 
            for (var i = 1; stdDate.getDay() - i >= 0; i++) { // 昨日まで
                date[stdDate.getDay() - i] = new Date (
                    stdDate.getFullYear(),
                    stdDate.getMonth(),
                    stdDate.getDate() - i
                )
            }
            for (var i = 0; i + stdDate.getDay() < 7; i++) { // 今日から
                date[stdDate.getDay() + i] = new Date (
                    stdDate.getFullYear(),
                    stdDate.getMonth(),
                    stdDate.getDate() + i
                )
            }
            this.$store.commit('Form/stdDate',
                new Date(
                    stdDate.getFullYear(),
                    stdDate.getMonth(),
                    stdDate.getDate() - stdDate.getDay()
                )
            )
            return date
        },
        TimeFrames () {
            return this.$store.state.Form.TimeTable
        },
        getBookList () {
            return this.$store.state.Form.bookList
        },
    },
    methods: {
        bookExist (day, time) {
            var bookList = this.$store.state.Form.bookList

            if (bookList[day] === undefined) {
                return false
            } else if (bookList[day][time] === undefined) {
                return false
            } else {
                return true
            }
        },
        getDayName (date) {
            return this.DayList[date.getDay()]
        },
        editStatus (param) {
            this.editting = true
            this.editParam['day'] = param['day']
            this.editParam['frame'] = param['frame']
            let tmpDate = new Date(param['date'].getTime())
            tmpDate = new Date(tmpDate.setDate(param['date'].getDate() + 1))
            this.editParam['date'] = tmpDate.toISOString().match(/\d+-\d+-\d+/)[0]
            if (param['empty']) {
                this.editParam['empty'] = true
            }
        },
        close () {
            this.editting = false
            this.editParam['day'] = null
            this.editParam['frame'] = null
            this.editParam['date'] = null
            this.editParam['empty'] = false
        }
    }
}
</script>
<style lang="scss" scoped>
@import '../../sass/variables';

table {
    height: 100%;
    th {
        color: #fff;
        background-color: $green;
    }
    td {
        width: 12.5%; // 100/7
        padding: 2px;

        .book {
            width: 100%;
            height: 100%;
        }

        .empty {
            width: 100%;
            height: 100%;
            background-color: rgba($blue, 0.2);
        }
    }
}
</style>