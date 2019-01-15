import Vue from 'vue'
import Vuex from 'vuex'

import BookListAPI from '../api/booklist'

Vue.use(Vuex)

const Form = {
    namespaced: true,
    state: {
        today: new Date(),
        stdDate: new Date(), // 初期値today
        DayList: ['日', '月', '火', '水', '木', '金', '土'],
        TimeTable: [
            {
                name: '0限',
                start: {
                    hour: 8,
                    minute: 0,
                }
            },
            {
                name: '1限',
                start: {
                    hour: 9,
                    minute: 0,
                }
            },
            {
                name: '2限',
                start: {
                    hour: 10,
                    minute: 40,
                }
            },
            {
                name: '昼休み',
                start: {
                    hour: 12,
                    minute: 10,
                }
            },
            {
                name: '3限',
                start: {
                    hour: 13,
                    minute: 0,
                }
            },
            {
                name: '4限',
                start: {
                    hour: 14,
                    minute: 40,
                }
            },
            {
                name: '5限',
                start: {
                    hour: 16,
                    minute: 20,
                }
            },
            {
                name: '6限',
                start: {
                    hour: 18,
                    minute: 0,
                }
            },
            {
                name: '7限',
                start: {
                    hour: 19,
                    minute: 40,
                }
            },
            {
                name: '8限',
                start: {
                    hour: 21,
                    minute: 20,
                },
                end: {
                    hour: 22,
                    minute: 50,
                }
            },
        ],
        bookList: {
        },
        bookTemplate: {
            name: '',
            everyWeek: false,
            onceTimeData: {
                year: null,
                month: null,
                date: null,
            },
            everyWeekData: {
            },
        },
        selectedBook: null,
    },
    mutations: {
        bookList (state, list) {
            list.forEach(element => {
                console.log(element)
                if (element['every_week_id'] == true) {
                    var day = element['every_week_day']
                } else {
                    var day = new Date(element['one_time_date']).getDay()
                }
                if (state.bookList[day]) {
                    Vue.set(state.bookList[day], [element['frame']], element)
                } else {
                    let frame = element['frame']
                    Vue.set(state.bookList, day, {[frame]: element})
                }
            });
        },
        stdDate (state, dateObj) {
            state.stdDate = dateObj
        }
    },
    actions: {
        getBookList ({state, commit}) {
            BookListAPI.getBookList(state.stdDate, (list) => {
                commit('bookList', list) // bookListのデータ
            })
        }
    }
}

export default new Vuex.Store({
    modules: {
        Form,
    }
})