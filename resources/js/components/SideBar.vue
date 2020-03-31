<template>
  <div class="col-lg-3 col-md-3 items-sidenav">
    <div class="input-group">
      <input id="search-box" class="form-control border-right-0 border" type="search" 
        placeholder="Search..." @input="onSearch($event)" @keyup="onSearch($event)" />
      <div class="input-group-append">
        <div class="input-group-text bg-white">
          <i class="icon fa fa-search"></i>
        </div>
      </div>
    </div>
    <br />
    <div id="list-items" class="list-group">
      <a v-for="item in dataItems" :key="item.id" :id="item.id" href="javascript:void(0);"
        class="list-group-item list-group-item-action" @click="onItemClick($event)"
        v-html="item.name"></a>
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
    this.$root.$on('itemdeleted', item => this.onItemDeleted(item))
  },
  mounted() {
    this.makeFirstItemActive();
  },
  methods: {
    async selectionChanged(currentSelectedId) {
      const fetchedItem = await axios.get(`/api/games/${currentSelectedId}`);
      this.$root.$emit('selectionchanged', fetchedItem.data);
    },
    onItemDeleted(item) {
      const nearestItem = this.getNearestItem(this.dataItems, this.dataItems.findIndex(x => x.id === item.id));
      this.dataItems = this.dataItems.filter(x => x.id !== item.id);
      document.querySelector(`#list-items #${CSS.escape(nearestItem.id)}`).classList.add('active');
      this.$root.$emit('selectionchanged', nearestItem);
    },
    getNearestItem(array, currentIndex) {
        const previousItem = array[currentIndex - 1];
        const nextItem = array[currentIndex + 1];
        return previousItem || nextItem;
    },
    onSearch(element) {
      const keyword = (element.target.value || "").toLowerCase();
      const nodeArray = Array.from(document.querySelectorAll("#list-items a"));
      nodeArray.filter(x =>
        this.toggleElementDisplay(x, x.innerText.toLowerCase().indexOf(keyword) > -1)
      );
    },
    onItemClick(event) {
      const element = event.target;
      const activeElement = document.querySelector('#list-items .active');
      if (!!activeElement) {
        activeElement.classList.remove('active');
      }
      element.classList.add('active');
      this.selectionChanged(element.getAttribute('id'));
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
      const id = urlParams.get('id') || this.getElementId(this.getFirstItemInList());
      const item = document.querySelector(`#list-items > a#${CSS.escape(id)}`);
      if (!!item) {
        item.classList.add('active');
        item.scrollIntoView();
      }
    },
    getFirstItemInList() {
      return document.querySelector("#list-items a");
    },
    getElementId(el) {
        return !!el ? el.getAttribute('id') : el;
    }
  }
};
</script>

<style lang="scss">
@import "../../sass/variables";

.hidden {
  display: none;
}

#list-items {
  height: calc(100% - 4.25rem);
  overflow: auto;
  a.list-group-item {
    background-color: $lightmilk;
  }
  a.list-group-item.active {
    background-color: $darkindigo;
    border-color: $darkindigo;
  }
}

#search-box {
  border-color: #ced4da !important;
}

.items-sidenav {
  padding: 1.25rem;
  background-color: $milk;
  height: 100%;
}

.list-group-item:not(.active) {
  color: #15072f;
}

@media screen and (max-width: 47.99em) {
  .items-sidenav {
    height: auto;
    padding: 0.9375em;
  }

  .list-group {
    height: 15.625em !important;
  }
}
</style>