<template>
  <b-row id="grid-container">
    <b-col v-for="item in collection" v-bind:key="item.id" class="py-3" xl="4" lg="4" md="6" sm="12">
      <tile :item="item" :isSelected="selectedItems.some(x => x.id === item.id)" @tileClicked="onTileClick"></tile>
    </b-col>
  </b-row>
</template>

<script>
export default {
  props: {
    collection: Array
  },
  data() {
    return {
      selectedItems: []
    };
  },
  methods: {
    onTileClick(item) {
      if (this.selectedItems.some(x => x.id === item.id)) {
        this.selectedItems = this.selectedItems.filter(x => x.id !== item.id);
      } else {
        this.selectedItems.push(item);
      }
    }
  }
};
</script>

<style lang="scss" scoped></style>
