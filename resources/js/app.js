import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";
import VueRouter from "vue-router";

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueAxios, axios);

window.axios = axios;

const files = require.context("./", true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split("/").pop().split(".")[0], files(key).default));

const router = new VueRouter({
  mode: "history",
  routes: []
});

new Vue({
  router,
  el: "#app",
  data() {
    return {
      axiosInterceptorsRequest: null,
      axiosInterceptorsResponse: null
    };
  },
  created() {
    this.setAxiosRequestInterceptors();
    this.setAxiosResponseInterceptors();
  },
  methods: {
    ejectAxiosInterceptors() {
      this.axios.interceptors.request.eject(this.axiosInterceptorsRequest);
      this.axios.interceptors.response.eject(this.axiosInterceptorsResponse);
    },
    setAxiosRequestInterceptors() {
      this.axiosInterceptorsRequest = this.axios.interceptors.request.use(
        config => {
          this.showLoading();
          return config;
        },
        error => {
          this.hideLoading();
          this.showErrorFlashMessage(error);
          return Promise.reject(error);
        }
      );
    },
    setAxiosResponseInterceptors() {
      this.axiosInterceptorsResponse = this.axios.interceptors.response.use(
        response => {
          this.hideLoading();
          return response;
        },
        error => {
          this.hideLoading();
          this.showErrorFlashMessage(error);
          return Promise.reject(error);
        }
      );
    },
    showErrorFlashMessage(error) {
      this.$root.$emit("show-flash-message", {
        title: error.response.statusText,
        message: error.response.data.message,
        variant: "danger"
      });
    },
    showFlashMessage(config) {
      this.$root.$emit("show-flash-message", {
        title: config.title,
        message: config.message,
        variant: config.variant
      });
    },
    showLoading() {
      document.querySelector(".loader").classList.add("is-active");
    },
    hideLoading() {
      document.querySelector(".loader").classList.remove("is-active");
    }
  }
});
