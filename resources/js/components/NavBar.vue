<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="navbar-brand">Hello {{username}}</div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <button class="btn btn-outline-danger my-2 my-sm-0" @click.prevent="logout()">Log out</button>
            </form>
        </div>
    </nav>
</template>

<script>
    export default{
        computed:{
            username(){
                let user = JSON.parse(localStorage.getItem('user'));
                return user.name;
            }
        },
        methods:{
            logout(){
                localStorage.removeItem('user');
                localStorage.removeItem('access_token');
                this.$router.push({name: 'login'})
            }
        }
    }
</script>
