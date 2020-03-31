import { BootstrapVue, IconsPlugin } from "bootstrap-vue";

window.Vue = require("vue");
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

const files = require.context("./", true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split("/").pop().split(".")[0].toLowerCase(), files(key).default));

new Vue({
  el: "#app",
  created() {
    this.setAxiosRequestInterceptors();
    this.setAxiosResponseInterceptors();
  },
  methods: {
    setAxiosRequestInterceptors() {
      axios.interceptors.request.use(
        config => {
          this.showLoading();
          return config;
        },
        error => {
          this.hideLoading();
          return Promise.reject(error);
        }
      );
    },
    setAxiosResponseInterceptors() {
      axios.interceptors.response.use(
        response => {
          this.hideLoading();
          return response;
        },
        error => {
          this.hideLoading();
          return Promise.reject(error);
        }
      );
    },
    showLoading() {
      document.querySelector(".loader").classList.add("is-active");
    },
    hideLoading() {
      document.querySelector(".loader").classList.remove("is-active");
    }
  }
});
