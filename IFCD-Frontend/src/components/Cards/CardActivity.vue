<template>
  <div>
    <a-card class="card-project">
      <img style="max-height: 200px" slot="cover" alt="example" :src="cover" />
      <div class="card-tag">{{ id }}</div>
      <h5>{{ title }}</h5>
      <p>
        {{ content }}
      </p>
      <a-row type="flex" :gutter="6" class="card-footer" align="middle">
        <a-col :span="20">
          <a-space>
            <a-button
              size="small"
              @click="validated(row)"
              v-if="row.state == 'new'"
              >VALIDATE</a-button
            >
            <a-button size="small" @click="view(row)">VIEW</a-button>
            <a-button size="small" primary type="primary" @click="edited(row)"
              >EDIT</a-button
            >
            <a-button size="small" danger type="danger" @click="deleted(row)"
              >DELETE</a-button
            >
          </a-space>
        </a-col>
        <a-col :span="4" class="text-right">
          <a-space class="avatar-chips">
            <a-avatar
              size="small"
              v-for="(img, index) in team"
              :key="index"
              :src="img"
            />
          </a-space>
        </a-col>
      </a-row>
    </a-card>
    <!-- / Project Card -->
  </div>

  <!-- Project Card -->
</template>

<script>
export default {
  props: {
    id: {
      type: Number,
      required: true,
    },
    title: {
      type: String,
      default: "",
    },
    content: {
      type: String,
      default: "",
    },
    cover: {
      type: String,
      default: "",
    },
    team: {
      type: Array,
      default: () => [],
    },
    row: [],
  },
  data() {
    return {};
  },
  methods: {
    deleted(row) {
      this.$emit("handleDelete", row);
    },
    edited(row) {
      this.$emit("handleEdit", row);
    },
    view(row) {
      this.$emit("handleView", row);
    },
    validated(row) {
      this.$emit("handleValidate", row);
    },
  },
};
</script>

<style >
.loader {
  width: 60px;
  aspect-ratio: 2;
  --_g: no-repeat radial-gradient(circle closest-side, lightblue 90%, #0000);
  background: var(--_g) 0% 50%, var(--_g) 50% 50%, var(--_g) 100% 50%;
  background-size: calc(100% / 3) 50%;
  animation: l3 1s infinite linear;
}
@keyframes l3 {
  20% {
    background-position: 0% 0%, 50% 50%, 100% 50%;
  }
  40% {
    background-position: 0% 100%, 50% 0%, 100% 50%;
  }
  60% {
    background-position: 0% 50%, 50% 100%, 100% 0%;
  }
  80% {
    background-position: 0% 50%, 50% 50%, 100% 100%;
  }
}
</style>