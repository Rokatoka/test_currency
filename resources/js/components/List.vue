<template>
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item">
                Choose Date: <datepicker v-model="date"></datepicker>
            </li>
            <li class="list-group-item">
                <table class="table" v-if="currencies.length > 0">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Date</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="currency in currencies">
                        <td>{{currency.name}}</td>
                        <td>{{currency.rate}}</td>
                        <td>{{currency.date}}</td>
                        <td>
                            <router-link :to="{name: 'item', params:{name: currency.name}}" tag="button" class="btn btn-primary">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                                        <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                            </router-link>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <span v-else>No data</span>
            </li>
            <li class="list-group-item d-flex justify-content-center" v-if="page !== last_page && currencies.length > 0">
                <ul class="pagination">
                    <li class="page-item">
                        <button class="page-link"
                                @click="getCurrencies">
                            More
                        </button>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    export default {
        components:{
            Datepicker
        },
        data(){
            return {
                currencies: [],
                page: 1,
                last_page: 0,
                has_next: false,
                date: new Date()
            }
        },
        watch:{
            date(){
                this.currencies = [];
                this.page = 1;
                this.has_next = false;
                this.last_page = 0;
                this.getCurrencies();
            }
        },
        methods:{
            getCurrencies(){
                let _this = this;
                _this.page = _this.has_next ? _this.page + 1 : _this.page;
                let data = {
                    page: _this.page,
                    date: _this.date
                };
                axios.get('/api/currencies', {params: data, headers:{
                        Accept: 'application/json',
                        Authorization: localStorage.getItem('access_token') ? "Bearer " + localStorage.getItem('access_token') : '',
                    }}).then((res) => {
                    _this.currencies = _this.currencies.concat(res.data.data.data);
                    _this.has_next = res.data.data.next_page_url;
                    _this.last_page = res.data.data.last_page;
                }).catch((err) => {
                    console.log(err)
                })
            }
        },
        mounted() {
            this.getCurrencies();
        }
    }
</script>
