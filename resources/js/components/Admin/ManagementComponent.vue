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
  created() {},
  methods: {
    management() {
      if (this.isLoggedIn === true) {
        axios
          .get("api/lel/management", {
            id: sessionStorage.getItem("id"),
          })
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>