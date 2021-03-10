import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Gallery from "../views/Gallery.vue";
import TrackOrder from "../views/TrackOrder.vue";
import Catalog from "../views/Catalog.vue";
import Product from "../views/ProductPage.vue";
import Cart from "../views/Cart.vue";
import Checkout from "../views/Checkout.vue";
import OrderReceived from "../views/OrderReceived.vue";
import Login from "../views/auth/Login.vue";
import Register from "../views/auth/Register.vue";
import Dashboard from "../views/admin/Dashboard.vue";
import ImageUploader from "../views/admin/ImageUploader.vue";
import BioPageManagement from "../views/admin/BioPageManagement.vue";
import StoreManagement from "../views/admin/StoreManagement.vue";
import Orders from "../views/admin/Orders.vue";
import Earnings from "../views/admin/Earnings.vue";
import BioPage from "../views/BioPage.vue";
import Profile from "../views/admin/Profile.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home
  },
  {
    path: "/@:username",
    name: "Gallery",
    component: Gallery
  },
  {
    path: "/:owner-bio-page",
    name: "BioPage",
    component: BioPage
  },
  {
    path: "/track-order",
    name: "TrackOrder",
    component: TrackOrder
  },
  {
    path: "/catalog-:imgId",
    name: "Catalog",
    component: Catalog
  },
  {
    path: "/product-:productId",
    name: "Product",
    component: Product
  },
  {
    path: "/cart",
    name: "Cart",
    component: Cart
  },
  {
    path: "/checkout",
    name: "Checkout",
    component: Checkout
  },
  {
    path: "/order-received-:orderId",
    name: "OrderReceived",
    component: OrderReceived
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
    meta: { guestOnly: true }
  },
  {
    path: "/register",
    name: "Register",
    component: Register,
    meta: { guestOnly: true }
  },
  {
    path: "/admin",
    name: "Dashboard",
    component: Dashboard,
    meta: { authOnly: true }
  },
  {
    path: "/admin/profile",
    name: "Profile",
    component: Profile,
    meta: { authOnly: true }
  },
  {
    path: "/admin/bio-page",
    name: "BioPageManagement",
    component: BioPageManagement,
    meta: { authOnly: true }
  },
  {
    path: "/admin/store-management",
    name: "StoreManagement",
    component: StoreManagement,
    meta: { authOnly: true }
  },
  {
    path: "/admin/orders",
    name: "Orders",
    component: Orders,
    meta: { authOnly: true }
  },
  {
    path: "/admin/earnings",
    name: "Earnings",
    component: Earnings,
    meta: { authOnly: true }
  },
  {
    path: "/admin/image-upload",
    name: "ImageUploader",
    component: ImageUploader,
    meta: { authOnly: true }
  }
];
const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

function isLoggedIn() {
  return localStorage.getItem("auth");
}

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.authOnly)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (!isLoggedIn()) {
      next({
        path: "/login",
        query: { redirect: to.fullPath }
      });
    } else {
      next();
    }
  } else if (to.matched.some(record => record.meta.guestOnly)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (isLoggedIn()) {
      next({
        path: "/admin",
        query: { redirect: to.fullPath }
      });
    } else {
      next();
    }
  } else {
    next(); // make sure to always call next()!
  }
});

export default router;
