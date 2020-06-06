<template>
  <div class="tile" :class="{ 'is-selected': isSelected }" @click.prevent="$emit('tileClicked', item)" @dblclick="onDoubleClick">
    <a :href="itemHomeUrl">
      <img :id="item.id" :src="item.cover_pic ? `storage/${item.cover_pic}` : 'storage/assets/default.png'" />
      <tile-overlay :name="item.name" :showLabel="isSelected"></tile-overlay>
    </a>
  </div>
</template>

<script>
export default {
  props: {
    item: Object,
    isSelected: Boolean
  },
  methods: {
    onDoubleClick() {
      this.$root.redirectTo(this.itemHomeUrl);
    }
  },
  computed: {
    itemHomeUrl() {
      return `/?id=${this.item.id}`;
    }
  }
};
</script>

<style lang="scss" scoped>
.tile {
  position: relative;
  box-shadow: 0px 12px 22px 1px #414141;
  img {
    width: 100%;
    height: 460px;
    opacity: 0.7;
    transition: 0.5s ease;
    cursor: pointer;

    &:hover {
      opacity: 1;
    }
  }
  &.is-selected {
    // box-shadow: 0px 0px 25px 10px #414141;
    box-shadow: 5px 17px 27px 6px #414141;
    background-color: #3490dc;
    img {
      opacity: 0.5;
    }
  }
}
</style>
