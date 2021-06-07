import cardList from "./components/card/List.vue"
import cardMessage from "./components/card/Message.vue"

let app = new Vue({
    el: "#app",
    components: {
        "card-list": cardList,
        "card-message": cardMessage
    },
    data: {
        items: [],
        cardItems: [],
        showErrorMessage: false,
        errorMessageText: "",
        url: '/card'
    },
    mounted() {
        axios.post(this.url).then((response) => {
            this.items = response.data.items
            this.cardItems = response.data.cardItems
        }).catch((error) => {
            if (error.response) {
                console.log(error.response.data);
                console.log(error.response.status);
                console.log(error.response.headers);
            } else {
                console.log('Error', error.message);
            }
        })
    },
    computed: {
        cardData() {
            const data = []
            const cardItems = this.cardItems
            const items = this.items

            _.forEach(cardItems, (value, key) => {
                let isUse = false
                _.mapKeys(value, (card, cardkey) => {
                    _.forEach(items, (obj) => {
                        if (cardkey === obj.card && obj.status === "1") {
                            isUse = true
                        }
                    })

                    const obj = {
                        cardName: card.cardName,
                        cardNumber: card.full,
                        cardId: card.cardName + key,
                        cardValue: card.last,
                        isUseCard: isUse,
                    }
                    data.push(obj)
                })
            })
            return data
        },
    },
    methods: {
        saveCardData(cardObj, index) {
            const length = this.cardItems.length
            const id = Math.random().toString(36).substr(6)
            this.cardItems.push(id)
            const itenObj = {}
            itenObj[id] = cardObj
            this.cardItems[length] = itenObj
            this.items[index].card = id
        },
        deleteCardData(index) {
            try {
                this.cardData.splice(index, 1)
                this.cardItems.splice(index, 1)
            } catch (e) {
                this.showErrorMessage = true
                this.errorMessageText = "刪除失敗!"
            }
        },
    },
})