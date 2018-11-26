<template>
<div id="calendar">
    <table class="table table-bordered">
        <tr>
            <th>時間</th>
            <th v-for="(date, index) in getDates" :key="index">
                <span>
                    {{ getDayName(date) }}<br>
                </span>
                <span>
                    {{ date.getMonth() }} / {{ date.getDate() }}
                </span>
            </th>
        </tr>
        <tr
            v-for="(frame, index_frame) in TimeFrames"
            :key="index_frame"
            v-if="index_frame < 10">
            <th>
                {{ frame.name }}
            </th>
            <td
                v-for="(DayName, index_day) in DayList"
                :key="index_day">
                <booking
                    v-if="BookExist(index_day, index_frame)"
                    :book="getBookList[index_day][index_frame]"
                    :day="index_day"
                    :frame="index_frame"
                    @click-book="editStatus" />
                <div
                    class="empty"
                    v-else
                    @click="editStatus({'day': index_day, 'frame': index_frame})">
                    storeの形式を変更したため、v-ifが常にTrue、文字がないから表示されないだけ
                </div>
            </td>
        </tr>
    </table>
    <edit-form
        v-if="editting"
        :book="getBookList[editIndex['day']][editIndex['frame']]"
        @close="close" />
</div>
</template>
<script>
import Booking from './Booking.vue'
import EditForm from './EditForm.vue'

export default {
    name: 'calendar',
    components: {
        Booking,
        EditForm,
    },
    props: {
        today: {
            type: Date,
            default: new Date()
        }
    },
    data () {
        return {
            editting: false,
            editIndex: {
                'day': null,
                'frame': null,
            }
        }
    },
    computed: {
        DayList () {
            return this.$store.state.Form.DayList
        },
        getDates () { // 日付など返す
            var date = new Array(7) 
            for (var i = 1; this.today.getDay() - i >= 0; i++) { // 昨日まで
                date[this.today.getDay() - i] = new Date (
                    this.today.getFullYear(),
                    this.today.getMonth(),
                    this.today.getDate() - i
                )
            }
            for (var i = 0; i + this.today.getDay() < 7; i++) { // 今日から
                date[this.today.getDay() + i] = new Date (
                    this.today.getFullYear(),
                    this.today.getMonth(),
                    this.today.getDate() + i
                )
            }
            return date
        },
        TimeFrames () {
            return this.$store.state.Form.TimeTable
        },
        getBookList (day, time) {
            // console.log(this.$store.state.Form.BookList[day][time])
            return this.$store.state.Form.BookList//[day][time]
        },
    },
    methods: {
        BookExist (day, time) {
            var BookList = this.$store.state.Form.BookList

            if (BookList[day] === undefined) {
                return false
            } else if (BookList[day][time] === undefined) {
                return false
            } else {
                return true
            }
        },
        getDayName (date) {
            return this.DayList[date.getDay()]
        },
        editStatus (param) {
            console.log(param)
            this.editting = true
            this.editIndex['day'] = param['day']
            this.editIndex['frame'] = param['frame']
        },
        close () {
            this.editting = false
            this.editIndex['day'] = null
            this.editIndex['frame'] = null
        }
    }
}
</script>
<style lang="scss" scoped>
@import '../../sass/variables';

th {
    color: #fff;
    background-color: $green;
}
td {
    width: 12.5%;

    empty { // 空欄になぜか高さを持たせられない
        display: block;
        width: 100%;
        height: 50px;
    }
}
</style>