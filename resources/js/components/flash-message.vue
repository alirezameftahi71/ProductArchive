<template>
  <div v-if="false"></div>
</template>

<script>
export default {
  created() {
    this.$root.$on("show-flash-message", this.show);
  },
  methods: {
    show(config) {
      this.$bvToast.toast(config.message, {
        title: config.title,
        autoHideDelay: 5000,
        variant: config.variant
      });
    }
  }
};
</script>

<style lang="scss" scoped></style>
