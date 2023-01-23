<template>
	<form @submit.prevent="submitHandle">
		<div class="row">
			<div class="col-12 mb-2">
				<div class="form-group">
					<label>Product Name</label>
					<input type="text" class="form-control" v-model="product.name">
					<span class="text-danger" v-show="this.unfillFields.includes('name')">This field is required.</span>
				</div>
			</div>
			<div class="col-12 mb-2">
				<div class="form-group">
					<label>Description</label>
					<input type="text" class="form-control" v-model="product.description">
					<span class="text-danger" v-show="this.unfillFields.includes('description')">This field is required.</span>
				</div>
			</div>
			<div class="col-12 mb-2">
				<div class="form-group">
					<label>Category</label>
					<select class="form-select" v-model="product.category">
						<option :key="cat" v-for="cat in categories" :value="cat"> {{ cat }} </option>
					</select>
					<span class="text-danger" v-show="this.unfillFields.includes('category')">This field is required.</span>
				</div>
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Next</button>
			</div>
		</div>                        
	</form>
</template>

<script>
export default {
	data() {
		return {
			unfillFields: [],
			product: {
				name: "",
				description: "",
				category: ""
			},
			categories: ['Gold', 'Silver']
		}
	},
	props: ['propProduct'],
	methods: {
		submitHandle() {
			this.unfillFields = []
			let validateFields = ['name', 'description', 'category']
			for (let field of validateFields) {
					if (!this.product[field]) {
							this.unfillFields.push(field)
					}                    
			}
			if (!this.unfillFields.length) {
				this.$emit('step1-submit', this.product)
			}
		}
	},
	updated() {
		this.product = this.propProduct
	}
}
</script>

<style>

</style>