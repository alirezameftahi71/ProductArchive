<template></template>

<script>
export default {
  created() {
    this.$root.$on("item-delete-clicked", this.show);
  },
  methods: {
    async show() {
      const confirmed = await this.$bvModal.msgBoxConfirm("Are you sure you want to delete this item?", {
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
