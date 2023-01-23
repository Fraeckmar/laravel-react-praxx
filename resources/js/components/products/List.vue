<template>
    <div class="row">
        <div class="col-12">
            <h4>Products</h4>
            <table class="table table-bordered-less shadow">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Date and Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody v-if="products.length > 0">
                    <tr v-for="product in products" :key="product.id">
                        <td>{{ product.name }}</td>
                        <td>{{ product.description }}</td>
                        <td>{{ product.category }}</td>
                        <td>{{ product.datetime }}</td>
                        <td>
                            <router-link :to='{name:"product.edit",params:{id:product.id}}' class="btn btn-sm btn-info mx-1">Edit</router-link>
                            <button type="button" @click="deleteProduct(product.id)" class="btn btn-sm btn-danger mx-1">Delete</button>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td colspan="4" align="center">No Categories Found.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import API from '../api/API'

export default {
    name:"Product List",
    data(){
        return {
            products:[]
        }
    },
    mounted(){
        this.getProducts()
    },
    methods:{
        async getProducts(){
            await API.get('products')
            .then((res) => {
                this.products = res.data.data
            }).catch((err) => {
                console.log(err)
            })
        },
        async deleteProduct(id){
            if(confirm("Are you sure to delete this product?")){
                await API.delete('products/'+id)
                .then(res => {
                    this.products = this.products.filter(product => product.id != id)
                })
                .catch(err => {
                    console.log(err)
                })
            }
        }
    }
}
</script>