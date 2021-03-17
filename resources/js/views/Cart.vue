<template>
  <div class="cart-page shop">
    <div class="top main-page">
      <div class="top">
        <h1>Shopping Cart <span>{{itemCount}} {{itemCount>1? 'items' : 'item'}} in cart</span></h1>
        <div class="link-continue">
          <a href="" @click.prevent="continueShopping">Continue Shopping </a>
        </div>
      </div>
      <div class="item row" v-for="(item, key,index) in cartContent" :key="key">
        <div class="col-md-4">
          <img class="img" :src="item.options.previewUrl" alt="">
        </div>
        <div class="col-md-8 row">
          <div class="col-md-6">
            <div class="">
              <h4>{{item.name}}</h4>
              <div class="property" v-for="(property, key,index) in item.options.properties">
                <label>{{key}}:</label>
                {{property}}
              </div>
              <div class="rv-ed-btn">
                <a href="" @click.prevent="changeQty(item.rowId,0)">Remove</a>
              </div>
              <label class="control-label">Qty</label>
              <div class="item-qty">
                <a href="" @click.prevent="changeQty(item.rowId,parseInt(item.qty)-1)"><i class="fas fa-minus"></i></a>
                <input :value="item.qty" max="9" min="0">
                <a href="" @click.prevent="changeQty(item.rowId,parseInt(item.qty)+1)"><i class="fas fa-plus"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-6 cart-am-rg">
            <div class="" style="    text-align: right;">
              <h3>Total <span>${{(item.price*item.qty*(1-parseFloat(item.options.discount)/100)).toFixed(2)}}</span></h3>
            </div>
          </div>
        </div>
        <div class="col-md-8 offset-4 estamite-shoping" style="">
          <span class="ppu">Price per unit</span>
          <div class="  price-des">
            <span class="price" style="font-size: 15px;color: #F44336;margin: 0 20px;">${{item.price}}</span>
            <span class="discount-price">${{(item.price*(1 - parseFloat(item.options.discount) / 100)).toFixed(2)}}</span>
          </div>
        </div>
        <div class="col-md-12">
          <hr style="">
        </div>
      </div>
      <div class="col-md-8 offset-4 bottom">
        <div class="row">
          <div class="col-md-6 offset-6">
            <div class="cart-wrp-rt">
              <div class="cart-reg-rgt">
                <h3>Order Summary <span>{{itemCount}} {{itemCount>1? 'items' : 'item'}}</span></h3>
              </div>
              <div class="pro-desc-re-rl">
                <p>Sub total <span>${{subTotal.toFixed(2)}}</span></p>
                <p><strong>Grand Total:</strong><span>${{subTotal.toFixed(2)}}</span></p>
              </div>
              <div class="pro-crt-rireg-btn">
                <a class="green btn-checkout" href="" @click.prevent="$router.push('/checkout')">Proceed to Checkout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Api from "../apis/Api";
export default {
  data: () => ({
    cartContent: {},
    subTotal: 0,
    itemCount: 0,
  }),
  methods: {
    changeQty(rowId, qty) {
      var that = this;
      Api.get('/change-qty/' + rowId + '/' + qty)
        .then(response => {
          that.cartContent = response.data;
          that.refreshCart();
        });
    },
    refreshCart() {
      this.subTotal = this.itemCount = 0;
      for (var item in this.cartContent) {
        this.subTotal += this.cartContent[item].price * this.cartContent[item].qty*(1-parseFloat(this.cartContent[item].options.discount)/100);
        this.itemCount++; // parseInt(this.cartContent[item].qty);
      }
    },
    continueShopping() {
      var that = this;
      Api.get('/api/username-by-product-id/'+that.cartContent[Object.keys(this.cartContent)[this.itemCount-1]].id)
        .then(response => {
          that.$router.push('/@'+response.data);
        });
    },
    getContent() {
      var that = this;
      Api.get('/api/get-cart-content')
        .then(response => {
          that.cartContent = response.data;
          that.refreshCart();
        });
    },
  },
  mounted() {},
  created() {
    this.getContent();
  }
};
</script>
