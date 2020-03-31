import './_bootstrap';
import './_tagmanager';

new Vue({
    el: '#app',
    created() {
        this.setAxiosRequestInterceptors();
        this.setAxiosResponseInterceptors();
    },
    methods: {
        setAxiosRequestInterceptors() {
            axios.interceptors.request.use(config => {
                this.showLoading();
                return config;
            }, error => {
                this.hideLoading();
                return Promise.reject(error);
            });
        }, 
        setAxiosResponseInterceptors() {
            axios.interceptors.response.use(response => {
                this.hideLoading();
                return response;
            }, error => {
                this.hideLoading();
                return Promise.reject(error);
            });
        },
        showLoading() {
            document.querySelector('.loader').classList.add('is-active');
        },
        hideLoading() {
            document.querySelector('.loader').classList.remove('is-active');
        }
    }
});
