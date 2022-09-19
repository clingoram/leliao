<template>
  <div v-if="isLoggedIn === true">
    <p>logg</p>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isLoggedIn: false,
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
        // .get("api/lel/management", {
        //   id: sessionStorage.getItem("id"),
        //   name: sessionStorage.getItem("name"),
        // })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>