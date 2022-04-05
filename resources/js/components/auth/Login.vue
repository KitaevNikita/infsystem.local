<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Авторизация</div>

                    <div class="card-body">
                        <form action="#" @submit.prevent="handleLogin">
                            <div>
                              <div class="mb-3">
                                <label for="email" class="form-label">Почта</label>
                                <input type="email" class="form-control" :class="emailClasses" id="email" name="email" v-model="loginForm.email" required>
                                <div class="invalid-feedback" v-if="isAnyEmailErrors">
                                  {{ loginFormErrors.email[0] }}
                                </div>
                              </div>
                              <div class="mb-3">
                                <label for="password" class="form-label">Пароль</label>
                                <input type="password" class="form-control" :class="passwordClasses" id="password" name="password" v-model="loginForm.password" required>
                                <div class="invalid-feedback" v-if="isAnyPasswordErrors">
                                  {{ loginFormErrors.password[0] }}
                                </div>
                              </div>
                              <button type="submit" class="btn btn-primary text-white text-center" :disabled="loading">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-if="loading"></span>
                                    <span v-if="loading">&nbsp;Загрузка...</span>
                                    <span v-if="!loading">Войти</span>
                              </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            loginForm: {
                email: '',
                password: ''
            },
            loginFormErrors: {
                email: [],
                password: []
            },
            loading: false
        }
    },
    computed: {
        isAnyEmailErrors() {
            return this.loginFormErrors.email.length > 0
        },
        emailClasses() {
            return {
                'is-invalid': this.isAnyEmailErrors,
                'is-valid': !this.isAnyEmailErrors,
            }
        },
        isAnyPasswordErrors() {
            return this.loginFormErrors.password.length > 0
        },
        passwordClasses() {
            return {
                'is-invalid': this.isAnyPasswordErrors,
                'is-valid': !this.isAnyPasswordErrors,
            }
        }
    },
    methods: {
        handleLogin() {
            this.loading = true
            axios.get('/sanctum/csrf-cookie')
                .then(response => {
                    axios.post('/login', this.loginForm)
                        .then(response => {
                            this.clearLoginFormErrors()
                            this.getAuthorizedUser()
                            this.redirectAfterAuthorization()
                        }).catch(error => {
                            console.log(error)
                            if(error.response.data.errors.email)
                            {
                                this.loginFormErrors.email.push(error.response.data.errors.email[0])
                            }
                            if(error.response.data.errors.password)
                            {
                                this.loginFormErrors.password.push(error.response.data.errors.password[0])
                            }
                            this.loading = false
                        });
                }).catch(error => {
                    console.log(error)
                });
        },
        clearLoginFormErrors() {
            this.loginFormErrors.email = []
            this.loginFormErrors.password = []
        },
        getAuthorizedUser() {
            axios.get('/api/user')
                .then(response => {
                    console.log(response)
                }).catch(error => {
                    console.log(error)
                    console.log("Невозможно получить пользователя")
                });
        },
        redirectAfterAuthorization()
        {
            window.location.replace('/home')
        }
    }
}
</script>