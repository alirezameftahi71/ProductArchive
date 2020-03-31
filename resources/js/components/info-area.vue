<template>
  <div id="info-area" class="col-lg-9 col-md-9">
    <h3 class="mt-4 mb-4 d-none d-md-block">The Archive</h3>
    <hr class="d-none d-md-block" />
    <br class="d-block d-md-none" />
    <div class="row">
      <div class="col-lg-8 col-md-7 order-2 order-md-1 mt-4">
        <info-grid :item="dataItem"></info-grid>
      </div>
      <div class="col-lg-4 col-md-5 order-1 order-md-2">
        <div class="container-fluid">
          <img id="cover-pic" class="img-fluid" :src="coverPic" alt="Product Cover" width="265" height="320" />
        </div>
        <div class="container-fluid toolbar">
          <button class="btn pt-1 icon" @click="deleteItem()">
            <i class="fas fa-trash-alt"></i>
          </button>
          <button class="btn pt-1 icon" @click="heartItem()">
            <i class="fas fa-thumbs-up"></i>
          </button>
          <button class="btn pt-1 icon" @click="editItem()">
            <i class="fas fa-edit"></i>
          </button>
          <button class="btn pt-1 icon" @click="markItem()" :class="{ 'i-green': !!+dataItem.checked }">
            <i class="fas fa-check-circle"></i>
          </button>
        </div>
      </div>
    </div>
    <hr class="d-none d-md-block" />
    <div class="container-fluid">
      <p id="description">{{ dataItem.description }}</p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    item: Object
  },
  data() {
    return {
      dataItem: this.item
    };
  },
  computed: {
    coverPic() {
      return !!this.dataItem ? `storage/${this.dataItem.cover_pic}` : "storage/assets/default.png";
    }
  },
  created() {
    this.$root.$on("selection-changed", item => (this.dataItem = item));
    this.$root.$on("delete-confirmed", () => this.$root.$emit("item-deleted", this.dataItem));
  },
  methods: {
    editItem() {
      window.location.replace(`/edit/${this.dataItem.id}`);
    },
    async deleteItem() {
      this.$root.$emit("item-delete-clicked", this.dataItem);
    },
    async markItem() {
      await axios.post(`/api/games/toggleChecked/${this.dataItem.id}`);
      const fetchResponse = await axios.get(`/api/games/${this.dataItem.id}`);
      this.dataItem = fetchResponse.data;
    },
    heartItem() {
      // TODO: implement this functionality
    }
  }
};
</script>

<style lang="scss">
#info-area {
  height: inherit;
  overflow-y: auto;
}

#cover-pic-container {
  height: 340px;
}

@media screen and (max-width: 47.99em) {
  #info-area {
    height: unset;
    overflow: hidden;
  }
}
</style>
