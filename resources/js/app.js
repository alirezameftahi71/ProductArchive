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
  el: "#app",
  router,
  data() {
    return {
      showLoadingOverlay: false
    };
  },
  created() {
    this.setAxiosRequestInterceptors();
    this.setAxiosResponseInterceptors();
  },
  methods: {
    setAxiosRequestInterceptors() {
      this.axios.interceptors.request.use(
        config => {
          this.showLoading();
          return config;
        },
        error => {
          this.hideLoading();
          this.showErrorMessage(error);
          return Promise.reject(error);
        }
      );
    },
    setAxiosResponseInterceptors() {
      this.axios.interceptors.response.use(
        response => {
          this.hideLoading();
          return response;
        },
        error => {
          this.hideLoading();
          this.showErrorMessage(error);
          return Promise.reject(error);
        }
      );
    },
    showErrorMessage(error) {
      this.showFlashMessage({
        title: error.response.statusText,
        message: error.response.data.message,
        variant: "danger"
      });
    },
    showSuccessMessage(message) {
      this.showFlashMessage({
        title: "Success",
        message: message,
        variant: "success"
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
      this.showLoadingOverlay = true;
    },
    hideLoading() {
      this.showLoadingOverlay = false;
    }
  }
});
