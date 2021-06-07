<template>
	<div class="row" style="margin-bottom: 60px;">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Card title</h5>
					<p class="card-text">商品：{{ selectItem.name }}</p>
					<p class="card-text">價錢：{{ selectItem.price }}</p>
					<p v-show="isStatus" class="card-text">卡號末四碼：{{ cardSelected }}</p>
					<p class="card-text">刷卡時間：{{ selectItem.datetime }}</p>
					<div class="row" style="margin-bottom: 20px;">
						<div class="col-8">
							<p class="card-text">信用卡名稱：{{ cardName }}</p>
						</div>
						<div class="col-2">
							<input type="button" :class="btnEdit"
								:value="editText" @click="changeCard()"/>
						</div>
					</div>
					<card-select :is-show="isShow" :card-data="cardData" :product-index="productIndex"
						:card-selected="cardSelected" @save-card="saveCard"></card-select>
					<input type="button" :class="isStatus ? btnDanger : btnSuccess"
						:disabled="isDisabled" :value="isStatus ? dangerText : successText"
						@click="changeStatus(selectItem.status)"/>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import CardSelect from './Select.vue'

export default {
	components: {
		'card-select': CardSelect
	},
	props: {
		item: {
			type:Object
		},

		cardData: {
			type:Array
		},

		productIndex: {
			type:Number
		},
	},
	data() {
		return {
			selectItem: this.item,
			btnSuccess: 'btn btn-success',
			btnDanger: 'btn btn-danger',
			btnEdit: 'btn btn-primary',
			successText: '啟用',
			dangerText: '停止',
			editText: '編輯',
			isShow: false,
			isStatus: this.item.status == '1',
			messageText: '',
			isDisabled: false,
		}
	},
	computed: {
		itemData() {
			const select = this.selectItem
			const item = _.find(this.cardData, select.card)
			this.isDisabled = false
			return item
		},

		cardName() {
			const itemData = this.itemData
			const item = this.item
			const key = _.findKey(itemData, (e, key) => {
				return key == item.card
			})

			let name = (key === undefined || key === null) ? '' : itemData[key].cardName

			if (name === '') {
				name = '未綁卡'
				this.isDisabled = true
			}

			return name
		},
		
		cardSelected() {
			const itemData = this.itemData
			const item = this.item
			const key = _.findKey(itemData, (e, key) => {
				return key == item.card 
			})
			
			const selected = (key === undefined || key === null) ? '' : itemData[key].last

			return selected
		},
	},
	methods: {
		changeStatus(status) {
			if (status === '0') {
				this.item.status = '1'
				this.isStatus = true
			} else {
				this.item.status = '0'
				this.isStatus = false
			}
		},
		changeCard() {
			if (this.isShow) {
				this.isShow = false
			} else {
				this.isShow = true
			}
		},
		saveCard(isAdd, CardObj) {
			this.isShow = false
			if (!isAdd) {
				let key = ''
				_.mapKeys(CardObj, (card, cardkey) => {
					key = cardkey
				})

				this.selectItem.card = key
			} else {
				this.$emit('save-new-card', CardObj, this.productIndex)
			}
		},
	},
}
</script>