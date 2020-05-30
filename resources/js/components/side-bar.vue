<template>
  <div class="items-sidenav">
    <b-input-group class="mt-3">
      <b-form-input type="search" placeholder="Search..." @input="onSearch($event)"></b-form-input>
      <b-input-group-append is-text id="btn-search" title="Search">
        <b-icon icon="search"></b-icon>
      </b-input-group-append>
    </b-input-group>
    <br />
    <div id="list-items" class="list-group">
      <button
        v-for="item in dataItems"
        :key="item.id"
        :id="item.id"
        class="btn list-group-item list-group-item-action no-rounded-corners"
        @click="onItemClick($event)"
        v-html="item.name"
      ></button>
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
  created() {
    this.$root.$on("item-deleted", item => this.onItemDeleted(item));
  },
  mounted() {
    this.makeFirstItemActive();
  },
  methods: {
    async selectionChanged(currentSelectedId) {
      const fetchedItem = await this.axios.get(`/api/games/${currentSelectedId}`);
      this.$root.$emit("selection-changed", fetchedItem.data);
    },
    onItemDeleted(item) {
      this.axios
        .delete(`/api/games/${item.id}`)
        .then(response => {
          console.log(response);
          this.$root.showFlashMessage({
            title: "Success",
            message: [this.$createElement("b", response.data.name), " is deleted", "."],
            variant: "success"
          });

          const nearestItem = this.getNearestItem(
            this.dataItems,
            this.dataItems.findIndex(x => x.id === item.id)
          );
          this.dataItems = this.dataItems.filter(x => x.id !== item.id);
          nearestItem && document.querySelector(`#list-items #${CSS.escape(nearestItem.id)}`).classList.add("active");
          this.$root.$emit("selection-changed", nearestItem);
        })
        .catch(error => {
          console.error(error);
        });
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
      if (activeElement) {
        activeElement.classList.remove("active");
      }
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
      sentId && item.scrollIntoView();
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
  padding: 1.25rem;
  background-color: $milk;
  height: 100%;

  #list-items {
    height: calc(100% - 6em);
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
    height: auto;
    padding: 0.9375em;

    .list-group {
      height: 15.625em !important;
    }
  }
}
</style>
