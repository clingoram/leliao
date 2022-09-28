<template>
  <!-- 訊息顯示 -->
  <template v-for="message in messages" v-bind:key="message">
    <tr>
      <td>
        <div class="rightChatContent">
          <div class="other">
            <div class="dialog">對方說什麼</div>
            <p>12:34</p>
          </div>
          <div class="self">
            <div class="dialog">我說什麼</div>
            <p>12:34</p>
            <span class="read">已讀</span>
          </div>
          <div class="other">
            <div class="dialog">對方再說甚麼</div>
            <p>12:34</p>
          </div>
        </div>
      </td>
    </tr>
  </template>
</template>

<script>
export default {
  data() {
    return {
      messages: ["Hello"],
    };
  },
  mounted() {},
};
</script>