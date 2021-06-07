<template>
    <form v-show="showCardList">
        <div class="form-group row">
            <div class="card">
                <div class="card-body">
                    <div class="col" v-for="(card, index) in cardAllData" :key="index">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" v-model="selected"
                                name="cardname" :id="cardIndexData[index]" :value="card.last">
                            <label class="form-check-label" :for="cardIndexData[index]" >
                                {{ card.cardName }}:{{ card.full }}
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" v-model="selected"
                                name="cardname" :id="cardLastData" value="add">
                            <label class="form-check-label" :for="cardLastData">
                                新增信用卡
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <input type="button" class="btn btn-primary" :id="sendId" name="send" value="送出" @click="changeCard()">
                    </div>

                </div>
            </div>
        </div>
        <card-add-data v-if="showModal" @close="showModal = false" @send-card="sendCard"></card-add-data>
    </form>
</template>

<script>
import CardAddData from './AddData.vue'
import swal from 'sweetalert'

export default {
    components:{
        'card-add-data' : CardAddData
    },
    props:{
        cardData:{
            type:Array
        },

        cardSelected:{
            type:String
        },

        isShow:{
            type:Boolean
        },

        productIndex:{
            type:Number
        },
    },
    data:function(){
        return {
             'cardLastData' : '',
             'sendId' : 'send' + this.productIndex,
             'selected' : this.cardSelected,
             'btnSuccess' : 'btn btn-success',
             'btnDanger' : 'btn btn-danger',
             'showModal': false,
             'showCardList' : this.isShow,
             'isError' : false,
             'isRepeat' : false
        }
    },
    computed: {
        cardAllData(){
            let cardArray = []
            let cardData = this.cardData
            _.forEach(cardData, function (value, key) {
                _.mapKeys(value, function(card, cardkey){
                    cardArray.push(card)
                })
            })

            return cardArray
        },
        
        cardIndexData(){
            let cardIdArray = []
            let cardName = 'cardname' + this.productIndex + '_'
            let length = this.cardData.length
            this.cardLastData = cardName + length
            for (let i = 0; i < length; i++) {
                let id = cardName + i
                cardIdArray.push(id)
            }
            return  cardIdArray
        },

        selectedData(){
            let obj = 'add'
            let selected = this.selected
             _.forEach(this.cardData, function (value, key) {
                _.mapKeys(value, function(card, cardkey){
                    let cardLast = value[cardkey].last
                    if(selected == cardLast){
                        obj = value
                        return
                    }
                })
            })
            return obj
        }
    },
    watch:{
        isShow(newVal, oldVal){
            if(newVal == true){
                this.selected = this.cardSelected
            }
            this.showCardList = newVal
        }
    },
    methods: {
        changeCard(){
            if(this.selectedData == 'add'){
                this.showModal = true
            }else{
                this.$emit('save-card', false, this.selectedData)
            }
        },
        sendCard(message, CardObj){
            let isError = false

            if(message != ''){
                isError = true
                this.messageText = message
            }else{
                let cardData = this.cardData
                _.forEach(cardData, function (value, key) {
                    _.mapKeys(value, function(card, cardkey){
                        if(CardObj.full == card.full){
                            isError = true
                            return
                        }
                    })
                })

                if(!isError){
                    this.messageText = '新增成功!'
                    this.showModal = false
                    this.$emit('save-card', true, CardObj)
                }else{
                    this.messageText = '卡號有重複!'
                }
            }

            if(this.messageText != ''){
                swal({
                    title: this.messageText,
                    confirmButtonColor: '#e6b930',
                    icon: !isError ? 'success':'error',
                    showCloseButton: true
                })
            }
                
            this.isError = isError
            
        },
        closeMessage(){
            if(!this.isError){
                this.showCardList = false
            }
        }
    },
}
</script>