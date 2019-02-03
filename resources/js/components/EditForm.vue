<template>
<transition name="modal">
    <div class="modal-mask">
    <div class="container modal-container">
        <div class="modal-header">
            <h3 class="header">予約</h3>
            <div id="close" @click="close">&times;</div>
        </div>
        <div class="modal-body">
            <div class="input-name">
                <label for="name">バンド名, 使用用途</label>
                <input type="text" id="name" v-model="book.name">
            </div>
            <div class="input-times">
                <span id="day" v-if="book.everyWeek">使用曜日: {{ DayList[book.everyWeekDay] }}曜日</span>
                <span v-else>
                    <div>使用日: </div>
                    <span id="date" class="indent">{{ dateFormat }}</span>
                </span>
                <span id="frame" class="indent">{{ TimeTable[book.frame].name }}</span>
            </div>
            <div v-if="book.everyWeek">
                <label for="until">期間: </label><br>
                <input type="date" id="since" class="indent" v-model="book.everyWeekStartDate">
                ~
                <input type="date" id="until" class="indent" v-model="book.everyWeekEndDate">
            </div>
            <div>
                <input
                    type="checkbox"
                    id="every-week"
                    v-model="book.everyWeek"
                    @click="changeEveryWeek">
                <label for="every-week">毎週予約</label>
            </div>
            <div>
                <label for="representative">代表者名</label>
                <input
                    type="text"
                    id="representative"
                    v-model="book.representative">
            </div>
        </div>
        <div class="modal-footer">
            <button
                type="button"
                id="remove"
                v-if="!params.empty"
                @click="remove">
                予約を取り消す
            </button>
            <button type="button" id="save" @click="save">{{ submit }}</button>
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
            book: {
                name: '',
                oneTimeDate: this.params['date'],
                everyWeekStartDate: this.params['date'],
                everyWeekEndDate: this.params['date'],
                everyWeekDay: this.params['day'],
                frame: this.params['frame'],
                everyWeek: false,
                id: null,
                representative: '',
            },
        }
    },
    created () {
        if (!this.params.empty) {
            let book = this.$store.state.Form.bookList[this.params['day']][this.params['frame']]
            this.$set(this.book, 'name', book.name)
            this.$set(this.book, 'everyWeek', book.every_week !== 0)
            this.$set(this.book, 'id', book.id)
            this.$set(this.book, 'representative', book.representative)
            if (this.book.everyWeek) {
                this.$set(this.book, 'everyWeekStartDate', book.every_week_start_date)
                this.$set(this.book, 'everyWeekEndDate', book.every_week_end_date)
            } else {
                this.$set(this.book, 'oneTimeDate', book.one_time_date)
            }
        }
    },
    computed: {
        DayList () {
            return this.$store.state.Form.DayList
        },
        TimeTable () {
            return this.$store.state.Form.TimeTable
        },
        submit () {
            if (this.params.empty) {
                return '予約する'
            } else {
                return '変更する'
            }
        },
        dateFormat () {
            let date = new Date(this.book.oneTimeDate)
            let month = date.getMonth() + 1
            return date.getFullYear() + '年 '
                + month + '月 '
                + date.getDate() + '日  '
                + this.DayList[date.getDay()] + '曜日'
        }
    },
    methods: {
        close () {
            this.$emit('close')
        },
        changeEveryWeek () {
            this.$set(this.book, 'everyWeek', !this.book.everyWeek)
        },
        save () {
            if (this.params.empty) {
                this.$store.dispatch('Form/addBook', this.book)
            } else {
                this.$store.dispatch('Form/updateBook', this.book)
            }
            this.close()
        },
        remove () {
            if (this.params.empty) {
                this.close ()
            } else {
                this.$store.dispatch('Form/deleteBook', this.book.id)
                this.close()
            }
        }
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables';
@import '../../sass/button';

#close {
    padding: 10px;
    background-color: $gray;
    font-size: large;
    cursor: pointer;
}
#remove {
    @include button($red);
}
#save {
    @include button($green);
}
input, select {
    border: thin solid $gray;
}
.indent {
    margin-left: 10px;
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

