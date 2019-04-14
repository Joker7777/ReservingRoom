const axios = require('axios');
const API_URI = '/api/booklist';

export default {
    /**
     * 表示する1週間分の予約リストを取得
     * 
     * @param {Object} dateObj 取得する週の日曜日のDateオブジェクト
     * @param {*} callback 
     */
    getBookList(dateString, callback) {
        axios.get(API_URI + '/' + dateString)
            .then((response) => {
                console.log(reponse)
                callback(response.data)
            })
            .catch((error) => {
                console.error(error)
            })
    },
    addBook(obj, callback) {
        axios.post(API_URI + '/1', obj)
            .then((response) => {
                console.log(response)
                callback(true)
            })
            .catch((error) => {
                if (error.response.status == 409) {
                    // conflict
                    callback(false) // あとでerror.response.dataを返すように
                } else {
                    console.error(error)
                    callback(false)
                }
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
                callback(true)
            })
            .catch((error) => {
                console.error(error)
                callback(false)
            })
    }
}