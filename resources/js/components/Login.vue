<template>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label class="text-info">Email:</label><br>
                                <input type="text" class="form-control" v-model="email">
                            </div>
                            <div class="form-group">
                                <label class="text-info">Password:</label><br>
                                <input type="password" class="form-control" v-model="password">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info btn-md"
                                        @click.prevent="login()">
                                    Submit
                                </button>
                            </div>
                            <div id="register-error" class="alert alert-danger" role="alert" v-if="error">
                                Wrong credentials
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
        data(){
            return{
                email: '',
                password: '',
                error: false
            }
        },
        methods:{
            login(){
                let _this = this;
                let secret = document.head.querySelector('meta[name="client-secret"]');
                let data = {
                    client_id: 2,
                    client_secret: secret.content,
                    grant_type: 'password',
                    username: _this.email,
                    password: _this.password
                };
                axios.post('/oauth/token', data).then((response)=>{
                    _this.error = false;
                    localStorage.setItem('access_token', response.data.access_token);
                    let get_user = _this.$auth.setUser();
                    get_user.then((val) => {
                        _this.$router.push({name: 'list'})
                    })
                }).catch(()=>{
                    _this.error = true;
                });
            },
        }
    }
</script>

<style scoped>
    body {
        margin: 0;
        padding: 0;
        background-color: #17a2b8;
        height: 100vh;
    }
    #login .container #login-row #login-column #login-box {
        margin-top: 120px;
        max-width: 600px;
        height: 320px;
        border: 1px solid #9C9C9C;
        background-color: #EAEAEA;
    }
    #login .container #login-row #login-column #login-box #login-form {
        padding: 20px;
    }
    #login .container #login-row #login-column #login-box #login-form #register-link {
        margin-top: -50px;
    }
    #register-error {
        margin-top: 80px;
    }
</style>
