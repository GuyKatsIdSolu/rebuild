<template>
  <div class="store-management">
    <div class="cats-box">
      <div class="top-frame">
        <div class="title-2" style="">Set store discount (minimum 5%)
          <span class="spa">
            <input v-model="dynamicDiscount" style="border: 0;width: 30px;z-index: 2;" type="number"  max="99" />
            <span style="margin-left: -3px;">%</span>
          </span>
        </div>
        <a class="learn-more" href="https://sell.support.artigram.me/article/254-how-to-set-store-prices">Learn More</a>
        <div class="kohavit">*Retail price - include discount and clearing fees</div>
        <div v-if="$root.isMobile" class="title-3" style="">
          <div>*RSP- Recomended Selling Price</div>
          <div>**PAD - Price After Discount</div>
        </div>
      </div>
      <div v-for="(categoryName, categoryId,index) in categories" :key="categoryId" class="col-md-12 cat-box" style="">
        <div class="products-setup mobile-full-width">
          <div class="product-cat-title">
            {{categoryName}}
            <a target="_blank" :href="'https://artigram.me/product/'+categoryName.replace(' ','')">Product Description</a>
          </div>
          <!-- <div v-show="false">
            Sell These Products?
            <label class="switch-wrap all-cat-switch" style="margin-left:15px;margin-bottom: -6px;">
              <input @change="updateCategoryTemplates($event,categoryId)" type="checkbox" :checked="fullChecked(categoryId)? true:false" />
              <div class="switch"></div>
            </label>
          </div> -->
          <table>
            <tr v-if="!$root.isMobile">
              <th></th>
              <th>
                <div><br>Your price</div>
              </th>
              <th style="">
                <div><br>Name</div>
              </th>
              <th style="">
                <div><br>Size</div>
              </th>
              <th>
                <div><br>Base Price</div>
              </th>
              <th>
                <div><br>Retail Price</div>
              </th>
              <th>
                <div><br>Your Margin</div>
              </th>
            </tr>
            <tr v-else>
              <th></th>
              <th>
                <div><br>Your Price</div>
              </th>
              <th style="">
                <div><br>Size</div>
              </th>
              <th>
                <div><br>*RSP</div>
              </th>
              <th>
                <div>Base Price</div>
              </th>
              <th>
                <div><br>**PAD</div>
              </th>
              <th>
                <div>Your Margin</div>
              </th>
            </tr>
            <tr v-if="product.production_details" :class="chosenProducts.includes(productCode)? '':'disable'" v-for="(product, productCode) in productsByCategory[categoryId]" :key="productCode">
              <td style="position: relative;">
                <label class="switch-wrap">
                  <input :id="productCode" @change="setProductStatus($event,product)" type="checkbox" class="cat-input choose-product-input" :checked="chosenProducts.includes(productCode)? true:false" />
                  <div class="switch"></div>
                </label>
              </td>
              <td>
                <div class="price-box">
                  <input @change="setPrice($event,product)"  :min="product.production_details.price" :value="parseFloat(productsPrice[productCode]).toFixed(2)" :disabled="chosenProducts.includes(productCode)? false:true" type="number" pattern="[0-9]*" inputmode="numeric"
                  step="0.01" class="price-inpt" required />
                </div>
              </td>
              <td style="">{{product.title}}</td>
              <td style="">{{product.size}}</td>
              <td>${{product.production_details.msrp}}</td>
              <td>$<span class="base-price">{{product.production_details.price}}</span></td>
              <td>$<span class="discount-price">{{priceAfterDiscountAndFees(parseFloat(productsPrice[productCode]))}}</span></td>
              <td class="profit-td">$<span class="profit-inpt">{{(priceAfterDiscountAndFees(parseFloat(productsPrice[productCode]))-product.production_details.price).toFixed(2)}}</span></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="btns" v-if="$route.path=='/admin/store-management'">
      <div @click="setStoreDetails" class="btn purple continue">Update</div>
      <div @click="$router.push('/admin')" class="btn purple negative back">Cancel</div>
    </div>
    <div class="btns" v-else>
      <div @click="$parent.back" class="btn purple negative back">Back</div>
      <div @click="setStoreDetails" class="btn purple continue">Continue</div>
      <div @click="setStoreDetails(true)" class="btn purple negative skip">Skip</div>
    </div>
    <div class="store-footer" v-if="false">
      <a href="" @click.prevent="update">Update</a>
      <a class="negative" href="" @click.prevent="getContent(true)">Cancel</a>
    </div>
  </div>
</template>

<script>
import Api from "../../apis/Api";

export default {
  props: ['creator'],
  data: () => ({
    products: {},
    chosenProducts: [],
    productsPrice: {},
    categories: {},
    products: [],
    productsByCategory: {},

    dynamicDiscount: 15,
    dynamicDiscountInProcess: false,

  }),
  watch: {
    creator(){
    },
    dynamicDiscount: function(newVal, oldVal) {
      for (var categoryId in this.categories) {
        for (var productCode in this.productsByCategory[categoryId]) {
          var product=this.productsByCategory[categoryId][productCode];
          if(this.priceAfterDiscountAndFees(parseFloat(this.productsPrice[productCode]))-product.production_details.price< 0.1){
            if(!this.dynamicDiscountInProcess){
              this.dynamicDiscountInProcess = product.title;
            }
            this.dynamicDiscount--;
            return;
          }

        }
      }

      // for (var catId in this.chosenTemplates) {
      //   for (var productCode in this.chosenTemplates[catId]) {
      //     var template = this.chosenTemplates[catId][productCode];
      //     if (((template.price * (100 - newVal) / 100) - template.cost) < 0.1) {
      //       if(!this.dynamicDiscountInProcess){
      //         this.dynamicDiscountInProcess = template.title;
      //       }
      //       this.dynamicDiscount--;
      //       return;
      //     }
      //   }
      // }
      if(this.dynamicDiscountInProcess){
        this.$toast.info({
          position: this.$root.toastPosition,
          title: 'Discount value exceeds limits-',
          message: 'Discount value is too high to apply on "' + this.dynamicDiscountInProcess + '"',
        });
        this.dynamicDiscountInProcess = false;
      }
    }
  },
  methods: {
    priceAfterDiscountAndFees(price){
      var afterDidcount=(price*(100-this.dynamicDiscount)/100);
      return (afterDidcount+(afterDidcount*0.0291+0.3)).toFixed(2);
    },
    setStoreDetails($skip=false) {
      if(this.dynamicDiscount<5){
        this.$toast.error({
          position: this.$root.toastPosition,
          title: 'Discount error',
          message: 'Discount value must be over 5%',
        });
        return;
      }
      var oldPrices=JSON.parse(this.creator.products_price);
      for (var productCode in oldPrices) {
        if(oldPrices[productCode]!= this.productsPrice[productCode]){
          this.$ma.trackEvent({
            action: 'store-settings',
            properties: {
              feature: productCode,
              type: 'store-price-'+this.productsPrice[productCode]
            }
          });
        }
      }
      if(this.dynamicDiscount!=this.creator.discount){
        this.$ma.trackEvent({
          action: 'store-settings',
          properties: {
            feature: 'store-discount',
            type: this.dynamicDiscount+' percent'
          }
        });
      }
      axios.post('/api/store-details' , {
        creatorId: this.creator.id,
        chosenProducts: JSON.stringify(this.chosenProducts),
        productsPrice: JSON.stringify(this.productsPrice)
      })
      .then(response => {
        if(!$skip || this.$route.path=='/admin/store-management'){
          this.$toast.success({
            position: this.$root.toastPosition,
            title: 'Good job!',
            message: 'Store settings was updated successfully!',
          });
        }
        if(this.$route.path!='/admin/store-management'){
          this.$parent.next();
        }
      });
    },
    setPrice(event, product) {
      var element = $(event.target);
      // debugger;
      if(this.priceAfterDiscountAndFees(element.val())-product.production_details.price< 0.1){
        this.$toast.info({
          position: this.$root.toastPosition,
          title: 'Price value below limit-',
          message: 'Price value is too low to apply on"'+product.title+'"',
        });
        this.$set(this.productsPrice,product.product_code,parseFloat(this.priceAfterDiscountAndFees(1/product.production_details.price)) + 0.1 +parseFloat(product.production_details.price));
        return false;
      }
      this.$set(this.productsPrice,product.product_code,element.val());
    },
    setProductStatus(event, product) {
      var element = $(event.target);
      var isChecked = element.is(":checked");
      if (isChecked) {
        element.closest('tr').addClass('disable');
        this.chosenProducts.push(product.product_code);
      } else {
        element.closest('tr').removeClass('disable');
        this.chosenProducts=this.chosenProducts.filter(e => e !== product.product_code)
      }
    },
    updateCategoryTemplates(event, catId) {
      var element = $(event.target);
      var templatesByCategory = this.templates[catId];
      for (var productCode in templatesByCategory) {
        this.chosenTemplatesStatus[templatesByCategory[productCode].id] = element.is(":checked");
        $('#' + templatesByCategory[productCode].id).change();
      }
    },
    fullChecked(catId) {
      var templatesByCategory = this.templates[catId];
      for (var productCode in templatesByCategory) {
        if (this.chosenTemplatesStatus[templatesByCategory[productCode].id]) {
          return true;
        }
      }
      return false;
    },
    getContent(cancel=false) {
      this.productsPrice=JSON.parse(this.creator.products_price);
      this.chosenProducts=Object.values(JSON.parse(this.creator.chosen_products));
      this.dynamicDiscount=this.creator.discount;
      var that = this;
      axios.get('/api/store-details/' + this.creator.id)
      .then(response => {
        var allProducts=response.data;
        that.products=allProducts;
        for (var index in allProducts) {
          if(Object.keys(that.categories).includes(allProducts[index].category_id+'')){
            that.$set(that.productsByCategory[allProducts[index].category_id], allProducts[index].product_code, allProducts[index]);
          }else{
            that.$set(that.productsByCategory, allProducts[index].category_id, {});
            that.$set(that.productsByCategory[allProducts[index].category_id], allProducts[index].product_code, allProducts[index]);
            that.$set(that.categories, allProducts[index].category_id, allProducts[index].category.name);
          }
        }
        if(cancel){
          that.$toast.info({
            position: this.$root.toastPosition,
            title: 'Cancel notice-',
            message: 'Changes has been canceled',
          });
        }
      });
    }
  },
  mounted() {},
  created() {
    this.getContent();
  }
}
</script>
<style>
.switch-wrap input {
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}
.switch-wrap {
  cursor: pointer;
  background: #eeeaef;
  border: solid 1px black;
  padding: 2px;
  width: 38px;
  height: 26px;
  border-radius: 33px;
  margin-bottom: 0;
}
.switch::after {
  content: '';
  border-radius: 50%;
  border: solid 1px #8100ff;
  grid-column: 2;
  transition: background .6s;
      background: white;
}
.switch {
  height: 100%;
  display: grid;
  grid-template-columns:0px 20px 12px;
  transition: .2s;
}
input:checked + .switch::after {
  background-color: #8100ff;
}
input:checked + .switch {
  grid-template-columns: 12px 20px 0px;
}
</style>
