<template>
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product: Step {{ this.currentStep }}</h4>
                </div>
                <div class="card-body">
                    <Form1 :propProduct="{}" v-on:step1-submit="step1Submit" v-if="this.currentStep == 1" />
                    <Form2 :propProduct="{}" v-on:step2-submit="step2Submit" v-if="this.currentStep == 2" />
                    <Form3 :propProduct="{}" v-on:step3-submit="submitHandle" v-if="this.currentStep == 3"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form1 from './Form1'
import Form2 from './Form2'
import Form3 from './Form3'
import API from '../api/API'

export default {
    name:"add-step-1",
    data(){
        return {
            unfillFields: [],
            currentStep: 1,
            fileFormData: null,
            product:{
                name:"",
                description:"",
                category: "",
				datetime: "",
                images: []
            }
        }
    },
    components: {
        Form1,
        Form2,
        Form3
    },
    methods:{
        step1Submit(data) {
            for (let field in data) {
                this.product[field] = data[field]
            }
            this.currentStep++
        },
        step2Submit(formData) {
            this.fileFormData = formData
            this.currentStep++
        },
        submitHandle(datetime){
            this.product.datetime = datetime
            let defaultParams = API.defaults.params;
            API.defaults.params = {name: this.product.name.toLowerCase(), user_id: defaultParams.user_id}

            API.post('uploadImages', 
                this.fileFormData.formData, 
                this.fileFormData.config
            )
            .then((res) => {
                this.product.images = res.data
                API.defaults.params = defaultParams
                API.post('products', this.product)
                .then((res) => {
                    this.$router.push({name: 'product.list'})
                })
                .catch((err) => {
                    console.log(err)
                })
            })
            .catch((err) => {
                console.log(err)
            })

            // API.post('products', this.product)
            // .then((res) => {
            //     console.log(res)
            //     this.$router.push({name: 'product.list'})
            // })
            // .catch((err) => {
            //     console.log(err)
            // })
        }
    }
}
</script>