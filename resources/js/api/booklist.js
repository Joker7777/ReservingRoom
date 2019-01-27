import { callbackify } from 'util';

const axios = require('axios');
const API_URI = '/api/booklist';

export default {
    /**
     * 表示する1週間分の予約リストを取得
     * 
     * @param {Object} dateObj 取得する週の日曜日のDateオブジェクト
     * @param {*} callback 
     */
    getBookList(dateObj, callback) {
        let dateString = dateObj.getFullYear()
            + '-' + dateObj.getMonth()
            + '-' + dateObj.getDate()

        axios.get(API_URI + '/' + dateString)
            .then((response) => {
                callback(response.data)
            })
            .catch((error) => {
                console.error(error)
            })
    },
    addBook(obj, callback) {
        axios.post(API_URI + '/1', obj)
            .then((response) => {
                callback(true)
            })
            .catch((error) => {
                console.error(error)
                callback(false)
            })
    },
    updateBook(obj, callback) {
        axios.post(API_URI + '/2/', obj)
            .then((response) => {
                callback(true)
            })
            .catch((error) => {
                console.error(error)
                callback(false)
            })
    },
    deleteBook(id, callback) {
        axios.delete(API_URI + '/3/' + id)
            .then((response) => {
                console.log(response)
                callback(true)
            })
            .catch((error) => {
                console.error(error)
                callback(false)
            })
    }
}