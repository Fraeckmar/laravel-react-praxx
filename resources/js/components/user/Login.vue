<template>
	<div class="login-page mt-5">
		<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-8 mx-auto">
						<h1 class="text-center my-1">LOGIN</h1>
						<div class="card card-body">
							<form @submit.prevent="doLogin">
								<div class="mb-3">
									<label>Username / Email</label>
									<input v-model="username" type="text" class="form-control" placeholder="Email" autocomplete="username" required />
								</div>
								<div class="mb-3">
									<label>Password</label>
									<input v-model="password" type="password" class="form-control" placeholder="Password" autocomplete="password" required />
								</div>
								<div class="mb-3">
									<label class="form-check-label" role="button">
										<input v-model="rememberMe" type="checkbox" class="form-check-input" value="yes"/> Remember Me?
									</label>
								</div>
								<div>
									<button type="submit" class="btn btn-primary w-100">Submit</button>
								</div>
							</form>							
						</div>
					</div>
				</div>
		</div>
  </div>
</template>


<script>
import API from '../api/API'
export default {
	data() {
		return {
			username: "",
			password: "",
			rememberMe: false,
			user: sessionStorage.getItem('user') ? JSON.parse(sessionStorage.getItem('user')) : null
		}
	},
	mounted() {
		if (this.user != null) {
			this.$router.push({ path: '/' })
		}		
	},
	methods: {
		doLogin() {
			API.post('login', {
				username: this.username,
				password: this.password,
				rememberMe: this.rememberMe
			})
			.then((res) => {
				sessionStorage.setItem('user', JSON.stringify(res.data))
				location.reload()
			})
			.catch((err) => {
				console.log(err.response)
			})
		}
	}
}
</script>