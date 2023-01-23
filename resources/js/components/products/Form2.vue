<template>
	<form @submit.prevent="submitHandle">
		<div class="row">
			<div class="col-12 mb-2">
				<div class="form-group">
					<label>Product Images</label>
					<input type="file" class="form-control" multiple @change="selectionChange" />
					<span class="text-danger" v-show="this.hasError">Must put image(s) of product.</span>
					<div v-if="imagesUrl.length">
						<div class="row">
							<div class="col-sm-2 my-2" :key="imgSrc" v-for="imgSrc of imagesUrl"><img class="w-100" :src="imgSrc" /></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Next</button>
			</div>
		</div>                        
	</form>
</template>

<script>
import API from '../api/API'
export default {
	data() {
		return {
			hasError: false,
			selectedImages: [],
			imagesName: [],
			imagesUrl: [],
			formData: new FormData
		}
	},
	props: ['propProduct'],
	methods: {
		selectionChange(e) {
			this.selectedImages = e.target.files
		},
		submitHandle() {
			this.hasError = this.selectedImages.length ||  this.imagesName.length ? false : true
			if (!this.hasError) {
				if (this.selectedImages.length) {
					for (let i=0; i<this.selectedImages.length; i++) {
						this.formData.append('images[]', this.selectedImages[i])
					}
				}
				const config = { 
					headers: { 'Content-Type' : 'multipart/form-data' } 
				}
				this.$emit('step2-submit', {
					formData: this.formData,
					config : config
				})
			}			
		}
	},
	mounted() {
		if (this.propProduct.hasOwnProperty('images') && this.propProduct.images.length) {
			this.imagesName = this.propProduct.images
			this.imagesUrl = this.propProduct.imagesUrl
		}
		console.log(this.propProduct)
	}
}
</script>

<style>

</style>