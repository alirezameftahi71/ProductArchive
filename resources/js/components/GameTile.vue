<template>
  <div class="column">
    <div class="tile">
      <a :href="`/?id=${item.id}`">
        <img :id="item.id" :src="item.cover_pic ? `storage/${item.cover_pic}` : 'storage/assets/default.png'" />
        <div class="overlay">
          <p class="tile-label">{{ item.name }}</p>
        </div>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    item: Object
  }
};
</script>

<style lang="scss">
/* Create four equal columns that sits next to each other */
.column {
  -ms-flex: 20%;
  flex: 20%;
  max-width: 20%;
  padding: 2.5px;

  .tile {
    position: relative;

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
    }

    &:hover {
      .overlay {
        opacity: 1;
      }
    }
  }

  img {
    width: 100%;
    height: 420px;
    opacity: 0.8;
    cursor: pointer;

    &:hover {
      opacity: 1;
    }
  }
}

/* Responsive layout - makes a three column-layout instead of four columns */
@media screen and (max-width: 1200px) {
  .column {
    -ms-flex: 25%;
    flex: 25%;
    max-width: 25%;
  }
}

/* Responsive layout - makes a three column-layout instead of four columns */
@media screen and (max-width: 1000px) {
  .column {
    -ms-flex: 33.333%;
    flex: 33.333%;
    max-width: 33.333%;
  }
}

/* Responsive layout - makes a two column-layout instead of four columns */
@media screen and (max-width: 800px) {
  .column {
    -ms-flex: 50%;
    flex: 50%;
    max-width: 50%;
  }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    -ms-flex: 100%;
    flex: 100%;
    max-width: 100%;

    img {
      height: 600px;
    }
  }
}
</style>
