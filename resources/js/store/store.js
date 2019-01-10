import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const Form = {
    namespaced: true,
    state: {
        today: new Date(), // 起点はサーバ
        stdDate: new Date(), // 初期値、移動で変化、サーバで
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
            2: {
                9: { // 火曜8限　きききき
                    // 編集可能事項を全て含む
                    name: 'きききき',
                    everyWeek: false,
                    onceTimeData: {
                        year: 2018,
                        month: 6,
                        date: 10,
                    },
                    everyWeekData: {

                    },
                },
            },
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
    mutation: {

    },
    actions: {
    }
}

export default new Vuex.Store({
    modules: {
        Form,
    }
})