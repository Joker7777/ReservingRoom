import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const Form = {
    namespaced: true,
    state: {
        today: new Date(2018, 6, 8), // 中心となる日付をそのうちどこかで制御、これは初期値
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
                }
            },
            {
                name: '終了',
                start: {
                    hour: 22,
                    minute: 50,
                }
            }
        ],
        BookList: {
            2:{
                9: { // 火曜8限　きききき
                    name: 'きききき',
                },
            },
        }
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