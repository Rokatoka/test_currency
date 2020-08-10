export default function (Vue){
    Vue.auth = {
        setUser(){
            return new Promise((resolve, reject) => {
                axios.get('/api/user',  {
                    headers: {
                        Authorization: "Bearer " + localStorage.getItem('access_token'),
                        Accept: 'application/json'
                    }
                }).then((res)=>{
                    localStorage.setItem('user', JSON.stringify(res.data));
                    resolve(res.data);
                })
            })
        },

    };

    Object.defineProperties(Vue.prototype, {
        $auth: {
            get() {
                return Vue.auth;
            }
        }
    })
}
