<template>
  <div class="container">
    <h1>帳號資訊</h1>
    <div v-if="isLoggedIn === true">
      <table class="table">
        <thead>
          <tr>
            <!-- <th scope="col">#</th> -->
            <th scope="col">帳號</th>
            <th scope="col">電子信箱</th>
            <th scope="col">註冊時間</th>
            <th scope="col">最近登入時間</th>
            <!-- <th scope="col">詳細</th> -->
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
              <!-- <td>
                <button
                  type="button"
                  class="btn btn-info"
                  v-on:click="details()"
                >
                  詳細內容
                </button>
              </td> -->
            </tr>
          </template>
        </tbody>
      </table>
      <br />
      <h1>我創造的回覆</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">時間</th>
            <th scope="col">文章標題</th>
            <th scope="col">留言內容</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="reply in posts" v-bind:key="reply.id">
            <tr>
              <td>{{ timeLag(reply.created_at) }}</td>
              <td>{{ reply.title }}</td>
              <td>{{ reply.content }}</td>
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
      posts: [],
    };
  },
  created() {
    if (
      sessionStorage.getItem("identity") !== null &&
      sessionStorage.getItem("identity") !== "undefined"
    ) {
      this.isLoggedIn = true;
      this.management();
      this.getPostsReply();
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
     * 取得該帳號所有留言(留言時間、留言的文章標題、留言內容)
     */
    getPostsReply() {
      axios
        .get(
          "api/lel/allreplies/" +
            sessionStorage.getItem("id") +
            "/" +
            sessionStorage.getItem("name")
        )
        .then((response) => {
          // console.log(response);
          this.posts = response.data.data_return;
        })
        .catch((error) => {
          console.log(error);
        });
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