<template>
  <div class="min-vh-100 px-2 py-3 shadow">
    <router-link active-class="active" class="btn btn-outline-secondary px-3 py-2 w-100" :to='{name: "product.list"}'>Products <i class="fa fa-list"></i></router-link>
    <router-link active-class="active" class="btn btn-outline-secondary px-3 py-2 w-100 my-1" :to='{name: "product.add"}'>Add Product <i class="fa fa-plus"></i></router-link>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>