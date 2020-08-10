<template>
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item">
                Choose Date: <datepicker v-model="date"></datepicker>
            </li>
            <li class="list-group-item">
                <table class="table" v-if="currency">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{currency.name}}</td>
                        <td>{{currency.rate}}</td>
                        <td>{{currency.date}}</td>
                    </tr>
                    </tbody>
                </table>
                <span v-else>No data</span>
            </li>
        </ul>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    export default {
        props:['name'],
        components:{
            Datepicker
        },
        data(){
            return {
                currency: null,
                date: new Date()
            }
        },
        watch:{
            date(){
                this.currency = null;
                this.getCurrency();
            }
        },
        methods:{
            getCurrency(){
                let _this = this;
                let data = {
                    name: _this.name,
                    date: _this.date
                };
                axios.get('/api/currency', {params: data, headers:{
                        Accept: 'application/json',
                        Authorization: localStorage.getItem('access_token') ? "Bearer " + localStorage.getItem('access_token') : '',
                    }}).then((res) => {
                    _this.currency = res.data.data;
                }).catch((err) => {
                    console.log(err)
                })
            }
        },
        mounted() {
            this.getCurrency();
        }
    }
</script>
