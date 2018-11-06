<template>
<div id="calendar">
    <div id="time-table">

    </div>
    <table class="table table-bordered">
        <tr>
            <th>時間</th>
            <th v-for="(DayName, index) in DayList" :key="index">
                {{ DayName }}
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
                <booking v-if="BookExist(index_day, index_frame)"/>
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
    data () {
        return {
            DayList: ['日', '月', '火', '水', '木', '金', '土'],
            today: new Date (),
        }
    },
    computed: {
        day () {
            return this.DayList[this.today.getDay()]
        },
        TimeFrames () {
            return this.$store.state.Form.TimeTable
        },
    },
    methods: {
        BookExist (day, time) {
            console.log(day, time)
            var res = this.$store.dispatch(
                'Form/BookExist',
                {
                    'day': day,
                    'time': time,
                }
            )
            console.log(res)
            return res
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
</style>