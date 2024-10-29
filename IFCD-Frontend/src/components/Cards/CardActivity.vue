<template>
  <div>
    <a-card class="card-project" >
      
      <div class="img-content">
        <img style="height: 200px; object-fit: cover; object-position: top;" alt="example" :src="cover!=='https://api.queenbloh.comnull'?cover:'https://api.queenbloh.com/defaultPro.jpg'" />
        <div class="badge">
          {{row.state}}
        </div>
      </div>
      <div class="card-tag" style="margin-top: 20px;">
        <Row>
            <Col span="12" style="font-size:smaller;"><Icon type="md-calendar" />  {{ id }}</Col>
            <Col span="12" style="font-size:smaller; display: flex; justify-content: flex-end;"> <Icon type="ios-pin-outline" /> {{place}}</Col>
        </Row>
        
      </div>
      <h5 style="min-height: 30px; font-size:medium;" >{{ limitText(title) }}</h5>
      <p style="min-height: 50px;">
        {{ limitText(content) }}
      </p>
      <Row>
          <Col span="20" style="gap: 5px;">
                <Button size="small" ghost 
                  @click="validated(row)"
                  v-if="row.state == 'new'" type="success"
                  style="margin-right: 5px; margin-bottom: 5px;">Validate</Button
                >
                <Button size="small" ghost type="info" @click="view(row)" style="margin-right: 5px; margin-bottom: 5px;">View</Button>
                <Button size="small" ghost type="warning" @click="edited(row)"
                style="margin-right: 5px; margin-bottom: 5px;">Edit</Button
                >
                <Button size="small" ghost type="error" @click="deleted(row)"
                style="margin-bottom: 5px;">Delete</Button
                >
          </Col>
          <Col span="4">
              <a-avatar
              size="small"
              v-for="(img, index) in team"
              :key="index"
              :src="img"
              />
          </Col>
        </Row>
     

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
    place: {
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
    return {
      maxLength: 50,
    };
  },
  methods: {

    limitText(text) {
      if (text.length > this.maxLength) {
        return text.slice(0, this.maxLength) + "..."; // Ajouter '...' si le texte est tronqué
      }
      return text;
    },

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
.img-content {
  position: relative;
}

.img-content img {
  width: 100%;
  border-radius: 8px;
}

.badge {
  position: absolute;
  bottom: 0px;
  left: 0px;
  background-color: #FFA500;
  color: white;
  padding: 5px 10px;
  font-size: 12px;
  font-weight: bold;
}

.layout-dashboard .ant-card {
    border-radius: 0px;
}
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