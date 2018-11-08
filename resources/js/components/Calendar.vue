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
                    :book="getBookList[index_day][index_frame]" />
            </td>
        </tr>
    </table>
</div>
</template>
<script>
import Booking from './Booking.vue'

export default {
    name: 'calendar',
    components: {
        Booking,
    },
    props: {
        today: {
            type: Date,
            default: new Date()
        }
    },
    data () {
        return {
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
}
</style>