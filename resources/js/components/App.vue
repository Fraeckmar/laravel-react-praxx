<script>
import Header from './layout/Header'
import Sidebar from './layout/Sidebar'
import Content from './layout/Content'
import Login from './user/Login'

export default {
	data() {
		return {
			user: sessionStorage.getItem('user') ? JSON.parse(sessionStorage.getItem('user')) : null
		}
	},
	components: {
		Header,
		Sidebar,
		Content,
		Login
	},
	methods: {
		isLoggedin() {
			return this.user != null ? true : false
		}
	},
	mounted() {
		console.log('user')
		console.log(this.user)
		if (this.user === null) {
			this.$router.push({ path: 'login' })
		}
		if (this.isLoggedin()) {
			console.log('user is logged in')
		} else {
			console.log('not loggged in')
		}
	}
}
</script>

<template>
	<div v-if="this.isLoggedin()">
		<div class="row">
			<div class="col-12">
				<Header />
			</div>
			<div class="col-lg-2 col-md-3">
				<Sidebar />
			</div>
			<div class="col-lg-10 col-md-9">
				<Content />
			</div>
		</div>
	</div>
	<div v-else>
		<Content />
	</div>	
</template>