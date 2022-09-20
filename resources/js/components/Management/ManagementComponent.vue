<template>
  <div class="container">
    <div v-if="isLoggedIn === true">
      <h1>帳號資訊</h1>
      <table class="table">
        <thead>
          <tr>
            <!-- <th scope="col">#</th> -->
            <th scope="col">帳號</th>
            <th scope="col">電子信箱</th>
            <th scope="col">註冊時間</th>
            <th scope="col">最近登入時間</th>
            <th scope="col">詳細</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="user in members" v-bind:key="user.id">
            <tr>
              <!-- <th scope="row">{{ user.id }}</th> -->
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>{{ timeLag(user.created_at) }}</td>
              <td>{{ timeLag(user.updated_at) }}</td>
              <td>
                <button
                  type="button"
                  class="btn btn-info"
                  v-on:click="details()"
                >
                  詳細內容
                </button>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
    <div v-else>
      <p class="warning">請先登入。</p>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isLoggedIn: false,
      members: [],
      // count: [],
      // combine: [],
    };
  },
  created() {
    if (
      sessionStorage.getItem("token") !== null &&
      sessionStorage.getItem("token") !== "undefined"
    ) {
      this.isLoggedIn = true;
      this.management();
    }
  },
  methods: {
    /**
     * 依照登入者role做資料顯示切換
     */
    management() {
      axios
        .get(
          "api/lel/management/" +
            sessionStorage.getItem("id") +
            "/" +
            sessionStorage.getItem("name")
        )
        .then((response) => {
          this.members = response.data.data_return;
          // for (let j = 1; j <= response.data.data_return.length; j++) {
          //   // this.count = j;
          //   this.count.push(j);
          // }
          // this.combine = this.members.concat(this.count);
          // // console.log(this.count);
          // console.log(this.combine);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    /**
     * 詳細按鈕
     */
    details() {
      alert("目前這功能還沒開發完喔");
    },
    /**
     * 轉換時間格式
     */
    timeLag(datetime) {
      if (datetime === null) {
        return;
      }
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
        date.getHours() < 9 ? "0" + date.getHours() : date.getHours();
      // 分
      const minutes =
        date.getMinutes() < 9 ? "0" + date.getMinutes() : date.getMinutes();
      // 秒
      const sec =
        date.getSeconds() < 9 ? "0" + date.getSeconds() : date.getSeconds();
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