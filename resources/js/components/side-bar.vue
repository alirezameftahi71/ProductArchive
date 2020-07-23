<template>
  <div class="items-sidenav h-100">
    <b-input-group class="mb-3">
      <b-form-input type="search" placeholder="Search..." @input="onSearch($event)"></b-form-input>
      <b-input-group-append is-text id="btn-search" title="Search">
        <b-icon icon="search"></b-icon>
      </b-input-group-append>
    </b-input-group>
    <div id="list-items" class="list-group">
      <b-button
        v-for="item in dataItems"
        :key="item.id"
        :id="item.id"
        class="btn list-group-item list-group-item-action no-rounded-corners border"
        @click="onItemClick"
        v-html="item.name"
      ></b-button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    items: Array
  },
  data() {
    return {
      dataItems: this.items
    };
  },
  mounted() {
    this.$root.$on("item-deleted", this.onItemDeleted);
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
      nearestItem && document.querySelector(`#list-items #${CSS.escape(nearestItem.id)}`).classList.add("active");
      this.$root.$emit("selection-changed", nearestItem);
    },
    getNearestItem(array, currentIndex) {
      const previousItem = array[currentIndex - 1];
      const nextItem = array[currentIndex + 1];
      return previousItem || nextItem;
    },
    onSearch(keyword) {
      const nodeArray = Array.from(document.querySelectorAll("#list-items button"));
      nodeArray.forEach(x => this.toggleElementDisplay(x, x.innerText.toLowerCase().indexOf(keyword.toLowerCase()) > -1));
    },
    onItemClick(event) {
      const element = event.target;
      const activeElement = document.querySelector("#list-items .active");
      activeElement && activeElement.classList.remove("active");
      element.classList.add("active");
      this.selectionChanged(element.getAttribute("id"));
    },
    toggleElementDisplay(element, visible) {
      if (visible) {
        element.classList.remove("hidden");
      } else {
        element.classList.add("hidden");
      }
    },
    makeFirstItemActive() {
      const urlParams = new URLSearchParams(window.location.search);
      const sentId = urlParams.get("id");
      const id = sentId || this.getElementId(this.getFirstItemInList());
      const item = document.querySelector(`#list-items > #${CSS.escape(id)}`);
      item && item.classList.add("active");
      item && sentId && item.scrollIntoView();
    },
    getFirstItemInList() {
      return document.querySelector("#list-items button");
    },
    getElementId(el) {
      return el ? el.getAttribute("id") : el;
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
