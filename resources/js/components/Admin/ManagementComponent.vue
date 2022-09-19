<template>
  <div v-if="isLoggedIn === true">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">帳號</th>
          <th scope="col">電子信箱</th>
          <th scope="col">註冊時間</th>
          <th scope="col">最近登入時間</th>
        </tr>
      </thead>
      <tbody>
        <template v-for="user in members" v-bind:key="user.id">
          <tr>
            <th scope="row">{{ user.id }}</th>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.created_at }}</td>
            <td>{{ user.upated_at }}</td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isLoggedIn: false,
      members: [],
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
    management() {
      axios
        .get(
          "api/lel/management/" +
            sessionStorage.getItem("id") +
            "/" +
            sessionStorage.getItem("name")
        )
        .then((response) => {
          console.log(response.data);
          this.members = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>