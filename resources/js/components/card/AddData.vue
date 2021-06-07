<template>
	<transition name="modal">
		<div class="modal-mask">
			<div class="modal-wrapper">
				<div class="modal-container">
					<div class="modal-header">
						<slot name="header">
							<h3>新增信用卡</h3>
						</slot>
					</div>
					<div class="modal-body">
						<slot name="body">
							<div class="form-group">
								<label for="cardName">輸入信用卡名稱</label>
									<input type="text" v-model="cardName" class="form-control"
										id="cardName" style="width: 93%">
							</div>
							<div class="form-check form-check-inline">
								<input type="text" v-model="card1"  class="form-control"
										size="4" maxlength="4">
							</div>
							<div class="form-check form-check-inline">
									-
							</div>
							<div class="form-check form-check-inline">
								<input type="text" v-model="card2" class="form-control"
										size="4" maxlength="4">
								</div>
							<div class="form-check form-check-inline">
									-
							</div>
							<div class="form-check form-check-inline">
								<input type="text" v-model="card3" class="form-control"
										size="4" maxlength="4">
							</div>
							<div class="form-check form-check-inline">
									-
							</div>
							<div class="form-check form-check-inline">
								<input type="text" v-model="card4" class="form-control"
										size="4" maxlength="4">
							</div>
						</slot>
					</div>
					<div class="modal-footer">
						<slot name="footer">
							<div class="form-check form-check-inline">
								<input type="button" class="btn btn-primary" id="cancel" name="cancel"
										value="取消" @click="$emit('close')">
							</div>
							<div class="form-check form-check-inline">
								<input type="button" class="btn btn-primary" id="save" name="save"
										value="儲存" @click="checkCardData()">
								</div>
						</slot>
					</div>
				</div>
			</div>
		</div>
	</transition>
</template>

<style>
	.modal-container{
		width:480px
	}
</style>

<script>
export default {
	data() {
		return {
			cardName: '',
			card1: '',
			card2: '',
			card3: '',
			card4: '',
		}
	},
	computed: {
		cardData() {
			const obj = {}
			obj.cardName = this.cardName
			obj.full = `${this.card1}-${this.card2}-${this.card3}-${this.card4}`
			obj.last = this.card4
			obj.first = this.card1
			return obj
		},
	},
	methods: {
		checkCardData() {
			let message = ''
			const data = this.cardData
			if (data.cardName === '') {
				message = '信用卡名稱不能為空'
			} else if (data.full.length < 19) {
				message = '卡號請輸入16碼數字'
			} else if (/[A-Za-z\u4e00-\u9fa5]/.test(data.full)) {
				message = '卡號不能輸入中英文'
			}

			if (message === '') {
				const cardNum = _.split(data.full, '-')
				_.forEach(cardNum, (value) => {
					if (value.length !== 4) {
						message = '每個卡號區間請輸入4碼數字'
						return
					}
				})
			}

			this.$emit('send-card', message, data)
		},
	},
}
</script>