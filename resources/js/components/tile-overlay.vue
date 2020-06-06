<template>
  <div class="overlay" :class="{ 'show-label': showLabel }">
    <p class="tile-label">{{ name }}</p>
  </div>
</template>

<script>
export default {
  props: {
    name: String,
    showLabel: Boolean
  }
};
</script>

<style lang="scss" scoped>
.overlay {
  display: table;
  position: absolute;
  bottom: 0;
  background: #00000080;
  color: #f1f1f1;
  width: 100%;
  height: 30%;
  transition: 0.5s ease;
  opacity: 0;
  font-size: 20px;
  padding: 20px;
  text-align: center;

  .tile-label {
    display: table-cell;
    vertical-align: middle;
  }

  &.show-label {
    opacity: 1;
  }

  &:hover {
    opacity: 1;
  }
}
</style>
