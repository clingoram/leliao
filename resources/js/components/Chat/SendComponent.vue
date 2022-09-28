<template>
  <!-- 發送訊息 -->
  <!-- <form>
    <input type="text" v-model="message" />
    <button type="button" @click="submit">點我送出</button>
  </form> -->
  <tr>
    <td>
      <div class="msg" id="msg">
        <input
          type="text"
          v-model="message"
          placeholder="輸入訊息"
          class="form-control"
        />
        <!-- <button type="button" v-on:click="submit">點我送出</button> -->
        <button type="button" v-on:click="submit">
          <i class="fa-regular fa-paper-plane"></i>
        </button>
        <!-- <input
                  type="text"
                  placeholder="輸入訊息"
                  class="form-control"
                  onchange="tt(this.value)"
                /> -->
      </div>
    </td>
  </tr>
</template>
<script>
export default {
  data() {
    return {
      message: "",
    };
  },
  methods: {
    submit() {
      axios.post("api/lel/message", {
        message: this.message,
      });
    },
  },
};
</script>