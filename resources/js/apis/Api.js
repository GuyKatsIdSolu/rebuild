import axios from "axios";

let Api = axios.create({
  baseURL: "/",
  withCredentials: true
});

// Api.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// Api.defaults.withCredentials = true;


export default Api;
