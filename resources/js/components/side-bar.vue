<template>
  <div class="items-sidenav h-100">
    <b-input-group class="mb-3">
      <b-form-input type="search" placeholder="Search..." @input="onSearch($event)"></b-form-input>
      <b-input-group-append is-text id="btn-search" title="Search">
        <b-icon icon="search"></b-icon>
      </b-input-group-append>
    </b-input-group>

    <b-list-group id="list-items" class="list-group">
      <b-list-group-item
        v-for="item in dataItems"
        :key="item.id"
        :id="item.id"
        class="btn list-group-item no-rounded-corners"
        :class="{ active: item.id === activeItem.id }"
        @click="onItemClick"
        >{{ item.name }}</b-list-group-item
      >
    </b-list-group>
  </div>
</template>

<script>
export default {
  props: {
    items: Array
  },
  data() {
    return {
      dataItems: this.items,
      activeItem: this.items && this.items.length ? this.items[0] : null
    };
  },
  mounted() {
    this.$root.$on("item-deleted", this.onItemDeleted);
    this.$root.$on("selection-changed", item => (this.activeItem = item));
    this.makeFirstItemActive();
  },
  methods: {
    selectionChanged(currentSelectedId) {
      this.axios
        .get(`/api/games/${currentSelectedId}`)
        .then(response => {
          this.$router.push({ path: "/", query: { id: response.data.id } });
          this.$root.$emit("selection-changed", response.data);
        })
        .catch(error => {
          console.error(error);
        });
    },
    onItemDeleted(item) {
      const nearestItem = this.getNearestItem(
        this.dataItems,
        this.dataItems.findIndex(x => x.id === item.id)
      );
      this.dataItems = this.dataItems.filter(x => x.id !== item.id);
      this.$root.$emit("selection-changed", nearestItem);
    },
    getNearestItem(array, currentIndex) {
      const previousItem = array[currentIndex - 1];
      const nextItem = array[currentIndex + 1];
      return previousItem || nextItem;
    },
    onSearch(keyword) {
      this.dataItems = this.items.filter(x => x.name.toLowerCase().includes(keyword.toLowerCase()));
    },
    onItemClick(event) {
      const element = event.target;
      this.selectionChanged(element.getAttribute("id"));
    },
    makeFirstItemActive() {
      const urlParams = new URLSearchParams(window.location.search);
      const sentId = urlParams.get("id");
      this.activeItem = this.dataItems.length ? (sentId ? this.dataItems.find(x => x.id === +sentId) : this.dataItems[0]) : {};
      sentId && document.getElementById(this.activeItem.id).scrollIntoView();
    }
  }
};
</script>

<style lang="scss" scoped>
@import "../../sass/variables";

#btn-search {
  cursor: pointer;
}

.items-sidenav {
  background-color: $milk;

  #list-items {
    height: calc(100% - 4em);
    overflow-y: auto;
    overflow-x: hidden;
    .list-group-item {
      background-color: $lightmilk;
      &.active {
        background-color: $darkindigo;
        border-color: $darkindigo;
      }
      &:hover:not(.active) {
        background-color: $darkmilk;
      }
      &:not(.active) {
        color: #15072f;
      }
    }
  }

  #search-box {
    border-color: #ced4da !important;
  }
}

@media screen and (max-width: 47.99em) {
  .items-sidenav {
    height: auto !important;
    margin-bottom: 1.3em;

    .list-group {
      height: 15.625em !important;
    }
  }
}
</style>
