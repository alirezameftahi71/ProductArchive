<template>
    <div id="info-area" class="col-lg-9 col-md-9">
        <h3 class="mt-4 mb-4 d-none d-md-block">The Archive</h3>
        <hr class="d-none d-md-block" />
        <br class="d-block d-md-none" />
        <div class="row">
            <div class="col-lg-8 col-md-7 order-2 order-md-1 mt-4">
                <infogrid :item="dataItem"></infogrid>
            </div>
            <div class="col-lg-4 col-md-5 order-1 order-md-2">
                <div class="container-fluid">
                    <img id="cover-pic" class="img-fluid" :src="coverPic" alt="Product Cover" width="265" height="320" />
                </div>
                <div class="container-fluid toolbar mt-2">
                    <a data-target="#delete-modal" href="javascript:void(0);" class="icon" data-toggle="modal">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    <a id="item-heart" href="javascript:void(0);" class="icon">
                        <i class="fas fa-thumbs-up"></i>
                    </a>
                    <a id="item-edit" href="javascript:void(0);" class="icon">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a id="item-check" href="javascript:void(0);" :class="!!dataItem && !!dataItem.checked ? 'icon i-green' : 'icon'">
                        <i class="fas fa-check-circle"></i>
                    </a>
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
            dataItem: this.item,
        }
    },
    computed: {
        coverPic() {
            return !!this.dataItem ? `storage/${this.dataItem.cover_pic}` : 'storage/assets/default.png'
        }
    },
    created() {
        this.$root.$on('selectionchanged', item => this.dataItem = item);
    },
    
}
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