<template>
  <div v-if="false"></div>
</template>

<script>
export default {
  created() {
    this.$root.$on("item-delete-clicked", this.show);
  },
  methods: {
    async show() {
      const confirmed = await this.$bvModal.msgBoxConfirm("Are you sure you want to delete this record?", {
        title: "Delete Item",
        okVariant: "danger",
        okTitle: "YES",
        cancelTitle: "NO",
        footerClass: "p-2",
        hideHeaderClose: true
      });
      if (confirmed) {
        this.$root.$emit("delete-confirmed");
      }
    }
  }
};
</script>

<style lang="scss" scoped></style>
