<template>
    <div class="input-date" v-if="!EveryWeek">
        <span label="date">使用日: </span>
        <select name="date-year" v-model.number="book.date.year">
            <option
                v-for="year in years"
                :key="year"
                :value="year">
                {{ year }}
            </option>
        </select>
        年
        <select name="date-month" v-model.number="book.date.month">
            <option
                v-for="month in 12"
                :key="month">
                {{ month }}
            </option>
        </select>
        月
        <select name="date-date" v-model.number="book.date.date">
            <option
                v-for="date in dates"
                :key="date">
                {{ date }}
            </option>
        </select>
        日
    </div>
</template>
