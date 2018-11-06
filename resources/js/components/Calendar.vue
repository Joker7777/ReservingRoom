<template>
<div id="calendar">
    <div id="time-table">

    </div>
    <table class="table table-bordered">
        <tr>
            <th v-for="(day_name, index) in day_list" :key="index">
                {{ day_name }}
            </th>
        </tr>
        <tr>
            <th>
            </th>
        </tr>
    </table>
</div>
</template>
<script>
export default {
    name: 'calendar',
    data () {
        return {
            day_list: ['日', '月', '火', '水', '木', '金', '土'],
            today: new Date (),
        }
    },
    computed: {
        day () {
            return this.day_list[this.today.getDay()]
        }
    }
}
</script>
<style lang="scss" scoped>

</style>