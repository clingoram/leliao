<template>
  <!-- single post -->
  <!-- modal -->
  <p>{{ id }}</p>

  <div
    class="modal fade"
    id="singlePost"
    tabindex="-1"
    aria-labelledby="modalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">
            {{ id }}
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">{{ id }}</div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            關閉
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["categoryId", "id", "openCategoryModal"],
  created() {
    // this.allCategories();
  },
  data() {
    return {
      showModal: false,
      category: {
        name: "",
      },
      // category list
      categoryNameList: [],
    };
  },
  computed: {
    modal() {
      if (this.openCategoryModal === true) {
        this.showModal = true;
      } else {
        this.showModal = false;
      }
    },
  },
};
</script>
