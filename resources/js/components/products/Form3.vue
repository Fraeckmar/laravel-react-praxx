<template>
	<form @submit.prevent="submitHandle">
		<div class="row">
			<div class="col-12 mb-2">
				<div class="form-group">
					<label>Date and Time</label>
					<input type="datetime-local" v-model="datetime" class="form-control">
					<span class="text-danger" v-show="this.hasError">This field is required.</span>
				</div>
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>                        
	</form>
</template>

<script>
import datetime from 'vuejs-datetimepicker';
export default {
	data() {
		return {
			hasError: false,
			datetime: null
		}
	},
	props: ['propProduct'],
	components: {
		datetime
	},
	methods: {
		submitHandle() {
			this.hasError = this.datetime ? false : true
			if (this.datetime) {
				this.$emit('step3-submit', this.datetime)
			}
		}
	},
	mounted() {
		if (this.propProduct.hasOwnProperty('datetime')) {
			this.datetime = this.propProduct.datetime
		}
	}
}
</script>

<style>

</style>