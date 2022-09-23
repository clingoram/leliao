<template>
  <!-- 使用者資訊(登出、登入、註冊) -->
  <!-- 判斷是否有登入，依據狀況在dropdown顯示不同頁面連結 -->
  <div class="dropdown">
    <div v-if="isLoggedIn === true">
      <button
        class="btn btn-secondary dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        {{ this.name }}
      </button>
      <ul class="dropdown-menu">
        <li>
          <router-link v-bind:to="{ name: 'about' }">關於了聊</router-link>
        </li>
        <li>
          <router-link v-bind:to="{ name: 'management' }">帳號資訊</router-link>
        </li>
        <li>
          <router-link v-bind:to="{ name: 'add' }">新增文章</router-link>
        </li>
        <li>
          <a class="nav-link" v-on:click="logout">登出</a>
        </li>
      </ul>
    </div>
    <div v-else>
      <button
        class="btn btn-secondary dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        註冊 / 登入
      </button>
      <ul class="dropdown-menu">
        <li>
          <router-link v-bind:to="{ name: 'about' }">關於了聊</router-link>
        </li>
        <li v-if="!isLoggedIn">
          <router-link v-bind:to="{ name: 'login-page' }">登入</router-link>
        </li>
        <li v-if="!isLoggedIn">
          <router-link v-bind:to="{ name: 'register-page' }">註冊</router-link>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
// import $api from "../../api/api";

export default {
  data() {
    return {
      isLoggedIn: false,
      name: "",
    };
  },
  created() {
    if (
      sessionStorage.getItem("identity") !== null &&
      sessionStorage.getItem("identity") !== "undefined"
    ) {
      //       JSON.parse(sessionStorage.getItem("branch")) !== null
      this.name = sessionStorage.getItem("name");

      this.isLoggedIn = true;
      this.checkExpiresTime(sessionStorage.getItem("expires"));
    } else {
      this.isLoggedIn = false;
    }

    // if (
    //   (axios.defaults.headers.common[
    //     "Authorization"
    //   ] = `Bearer ${this.accessToken}`)
    // ) {
    //   this.isLoggedIn = true;
    // }
  },
  methods: {
    /**
     * 在token還沒過期狀況下登出(自行按登出按鈕)
     *
     * */
    logout() {
      axios
        .post("api/lel/logout")
        .then((response) => {
          confirm("成功登出");
          sessionStorage.removeItem("id");
          sessionStorage.removeItem("name");
          sessionStorage.removeItem("identity");
          sessionStorage.removeItem("expires");
          // sessionStorage.removeItem("branch");

          document.location.href = "/";
          this.isLoggedIn = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    /**
     * 如果現在的時間 > expire_at的時間，remove items(id,name,token)
     *
     */
    checkExpiresTime(expires) {
      const current = new Date();
      // current.toISOString().split("T")[0];

      const convertTIme = this.timeLag(expires);
      const expire = new Date(convertTIme);

      let ONE_HOUR = 1000 * 60 * 60; // 1小時的毫秒數
      let ONE_MIN = 1000 * 60; // 1分鐘的毫秒數
      let ONE_SEC = 1000; // 1秒的毫秒數

      let diff = current - expire;

      let leftHours = Math.floor(diff / ONE_HOUR);
      if (leftHours > 0) {
        diff = diff - leftHours * ONE_HOUR;
      }
      let leftMins = Math.floor(diff / ONE_MIN);
      if (leftMins > 0) {
        diff = diff - leftMins * ONE_MIN;
      }

      let leftSecs = Math.floor(diff / ONE_SEC);

      // console.log(`兩個時間差距為 ${leftHours}小時${leftMins}分${leftSecs}秒`);
      if (leftHours >= 1 || leftMins >= 30) {
        // this.logout();
        sessionStorage.removeItem("id");
        sessionStorage.removeItem("name");
        sessionStorage.removeItem("identity");
        sessionStorage.removeItem("expires");

        document.location.href = "/";
        this.isLoggedIn = false;
      }
    },
    timeLag(datetime) {
      const date = new Date(datetime);
      // 年份
      const year = date.getFullYear();
      // 月份
      const month =
        date.getMonth() + 1 < 10 ? date.getMonth() + 1 : date.getMonth() + 1;
      // 日期
      const day = date.getDate() < 9 ? "0" + date.getDate() : date.getDate();
      // 時
      const hours =
        date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
      // 分
      const minutes =
        date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
      // 秒
      const sec =
        date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
      // 毫秒
      const millSec =
        date.getMilliseconds() < 9
          ? "0" + date.getMilliseconds()
          : date.getMilliseconds();

      return year + "-" + month + "-" + day + " " + hours + ":" + minutes;
    },
  },
};
</script>
