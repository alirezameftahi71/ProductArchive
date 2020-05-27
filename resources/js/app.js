import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";
import VueRouter from "vue-router";

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueAxios, axios);

const files = require.context("./", true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split("/").pop().split(".")[0], files(key).default));

const router = new VueRouter({
  mode: "history",
  routes: []
});

new Vue({
  router,
  el: "#app",
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
