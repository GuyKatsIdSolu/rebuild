<template>
  <div class="orders-page container" v-if="creator" >
    <div class="title">
      Account <span>#{{creator.id}}</span> - Orders
    </div>
    <div class="table-box">
      <vuetable ref="vuetable"
      :api-url="'/api/orders/'+creator.id"
      :fields="$root.isMobile? fieldsMobile : fields"
      :sort-order="sortOrder"
      :multi-sort="true"
      :css="css.table"
      data-path="data"
      pagination-path=""
      @vuetable:pagination-data="onPaginationData">
    </vuetable>
    <vuetable-pagination ref="pagination"
    :css="css.pagination"
    @vuetable-pagination:change-page="onChangePage">
  </vuetable-pagination>
</div>

</div>
</template>

<script>
import Vuetable from 'vuetable-2'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import moment from 'moment'

export default {
  props:['creator','user'],
  components: {
    Vuetable,
    VuetablePagination,
    // VuetablePaginationInfo,
  },
  data() {
    return {
      orderData:{},
      sortOrder: [
        { field: 'id', sortField: 'id', direction: 'desc'}
      ],
      fields: [
        {
          name: 'id',
          // sortField: 'id',
          title: 'Order ID',
        },
        {
          name: 'product.image_id',
          title: 'Image ID',
        },
        {
          title: 'Date',
          name: 'created_at',
          formatter: function(value) {
            return moment(value, 'YYYY-MM-DD h:mm:ss').format('D MMM h:mm a')
          },
          // sortField: 'created_at'
        },
        {
          name: 'product.details.title',
          title: 'Poduct',
        },
        {
          name: 'price',
          title: 'Sell Price',
        },
        {
          name: '',
          title: 'Profilt',
          formatter: function(item) {
            return item.price - item.product.details.production_details.cost;
          },
        },
        {
          name: 'status',
          title: 'Status',
        },

      ],
      fieldsMobile: [
        {
          name: 'id',
          sortField: 'id',
          title: 'ID',
        },
        {
          name: 'username',
          title: 'URL',
          formatter: function(value) {
            return '<a target="_blank" href="/@'+value+'">'+value+'<i class="fas fa-external-link-alt"></i></a>';
          },
        },
        {
          title: 'Created',
          name: 'created_at',
          formatter: function(value) {
            return moment(value, 'YYYY-MM-DD h:mm:ss').format('D MMM h a')
          },
          sortField: 'created_at'
        },
        {
          title: 'Imgs',
          name: 'images',
        },
        {
          title: '<i class="far fa-check-circle"></i>',
          name: 'confirmed',
        },
        {
          title: '<i class="fas fa-shopping-cart"></i>',
          name: 'orders',
        },
      ],
      css: {
        table: {
          tableClass: 'table  table-hover',
          ascendingIcon: 'fas fa-chevron-up',
          descendingIcon: 'fas fa-chevron-down',
          sortableIcon: 'grey fas fa-sort',
          handleIcon: 'grey sidebar icon',
        },
        pagination: {
          wrapperClass: 'pagination',
          activeClass: 'active',
          disabledClass: 'disabled',
          pageClass: 'page',
          linkClass: 'link',
          icons: {
            first: '',
            prev: '',
            next: '',
            last: '',
          },
        },
        icons: {
          first: 'fas fa-step-backward',
          prev: 'fas fa-chevron-left',
          next: 'fas fa-chevron-right',
          last: 'fas fa-step-forward',
        },
      },
    };
  },
  watch: {
    creator(val) {
      this.init();
    },
    '$route': {
      handler: function() {
        if(this.creator){
          this.init();
        }
      },
      deep: true,
      immediate: true
    }
  },
  methods:{
    init() {
      // Api.get('/api/orders/'+this.creator.id)
      // .then(response => {
      //   this.isEmpty=response.data;
      // });
      // this.refresh++;
    },
    onPaginationData(paginationData){
      this.$refs.pagination.setPaginationData(paginationData)
    },
    onChangePage(page){
      this.$refs.vuetable.changePage(page)
    },
    onPaginationDataOrder(paginationData){
      this.$refs.paginationOrder.setPaginationData(paginationData)
    },
    onChangePageOrder(page){
      this.$refs.vuetableOrder.changePage(page)
    }
  },
  created() {

  },
  mounted() {
  }
};
</script>
