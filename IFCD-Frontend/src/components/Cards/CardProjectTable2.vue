<template>
  <!-- Projects Table Column -->
  <a-card
    :bordered="false"
    class="header-solid h-full"
    :bodyStyle="{ padding: 0 }"
  >
  <template #title>
      <a-row type="flex" align="middle">
        <a-col :span="24" :md="12">
          <h5 class="font-semibold m-0">Organisations</h5>
        </a-col>
        
        <a-col
          :span="24"
          :md="12"
          style="display: flex; align-items: center; justify-content: flex-end; gap: 4;"
        >
          
              <a-radio-group v-model="projectHeaderBtns" size="small">
                <a-radio-button value="all" @click="all">ALL</a-radio-button>
                <a-radio-button value="online" @click="notValidated"
                  >Not Validated</a-radio-button
                >
                <!--a-radio-button value="stores">STORES</a-radio-button-->
              </a-radio-group>
         
        </a-col>
      </a-row>
    </template>
    <a-row type="flex" align="middle" :gutter="40">
      
      <a-col :span="24" :md="12" style="margin-top: 10px;">
        <div >
          <a-button type="dashed" block @click="emitOpenFunc">
            <svg
              width="16"
              height="16"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M3 17C3 16.4477 3.44772 16 4 16H16C16.5523 16 17 16.4477 17 17C17 17.5523 16.5523 18 16 18H4C3.44772 18 3 17.5523 3 17ZM6.29289 6.70711C5.90237 6.31658 5.90237 5.68342 6.29289 5.29289L9.29289 2.29289C9.48043 2.10536 9.73478 2 10 2C10.2652 2 10.5196 2.10536 10.7071 2.29289L13.7071 5.29289C14.0976 5.68342 14.0976 6.31658 13.7071 6.70711C13.3166 7.09763 12.6834 7.09763 12.2929 6.70711L11 5.41421L11 13C11 13.5523 10.5523 14 10 14C9.44771 14 9 13.5523 9 13L9 5.41421L7.70711 6.70711C7.31658 7.09763 6.68342 7.09763 6.29289 6.70711Z"
                fill="#111827"
              />
            </svg>
            Add New Organisation
          </a-button>
        </div>
      </a-col>

      <a-col :span="24" :md="12" style="margin-top: 10px;">
        <a-input-search
                  v-model="search"
                  placeholder="input search text"
                  enter-button
                  @search="onSearch"
                  @input="onSearch"
                />
      </a-col>
      
    </a-row>
   
    <a-table :columns="columns" :data-source="data" :pagination="true">
      <template slot="name" slot-scope="text">
        <a>{{ text }}</a>
      </template>

      <a-space
        slot="members"
        slot-scope="members"
        :size="-12"
        class="avatar-chips"
      >
        <template v-for="member in members">
          <a-avatar :key="member" size="small" :src="member" />
        </template>
      </a-space>

      <template slot="denominationOpa" slot-scope="denominationOpa">
        <h6 class="m-0">
          {{ denominationOpa }}
        </h6>
      </template>

      <template slot="typeOpa" slot-scope="typeOpa">
        <div class="progress-right">
          <div class="text-right text-sm font-semibold text-muted pr-15">
            {{ typeOpa }}
          </div>
        </div>
      </template>

      <template slot="village" slot-scope="village">
        <div class="progress-right">
          <div class="text-right text-sm font-semibold text-muted pr-15">
            {{ village }}
          </div>
        </div>
      </template>

      <template slot="position" slot-scope="position">
        <div class="progress-right">
          <div class="text-right text-sm font-semibold text-muted pr-15">
            {{ position }}
          </div>
        </div>
      </template>

      <template slot="dateCreaction" slot-scope="dateCreaction">
        <div class="progress-right">
          <div class="text-right text-sm font-semibold text-muted pr-15">
            {{ dateCreaction }}
          </div>
        </div>
      </template>

      <template slot="user" slot-scope="user">
        <div class="progress-right">
          <div class="text-right text-sm font-semibold text-muted pr-15">
            {{ user.email }}
          </div>
        </div>
      </template>

      <template slot="editBtn" slot-scope="row">
        <a-space>
          
        <a-button type="link" :data-id="row.id" @click="view(row)">
          <svg
            width="20"
            height="20"
            viewBox="0 0 20 20"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            style="margin-left: 5px"
          >
            <path
              class="fill-gray-7"
              d="M10 3C5.5 3 1.7 6.1 0 10C1.7 13.9 5.5 17 10 17C14.5 17 18.3 13.9 20 10C18.3 6.1 14.5 3 10 3ZM10 15C7.2 15 5 12.8 5 10C5 7.2 7.2 5 10 5C12.8 5 15 7.2 15 10C15 12.8 12.8 15 10 15ZM10 7C8.3 7 7 8.3 7 10C7 11.7 8.3 13 10 13C11.7 13 13 11.7 13 10C13 8.3 11.7 7 10 7Z"
            />
          </svg>
        </a-button>

        <a-button type="link" :data-id="row.id" @click="edited(row)">
          <svg
            width="20"
            height="20"
            viewBox="0 0 20 20"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              class="fill-gray-7"
              d="M13.5858 3.58579C14.3668 2.80474 15.6332 2.80474 16.4142 3.58579C17.1953 4.36683 17.1953 5.63316 16.4142 6.41421L15.6213 7.20711L12.7929 4.37868L13.5858 3.58579Z"
            />
            <path
              class="fill-gray-7"
              d="M11.3787 5.79289L3 14.1716V17H5.82842L14.2071 8.62132L11.3787 5.79289Z"
            />
          </svg>
        </a-button>

        <a-button type="link" :data-id="row.id" @click="deleted(row)">
          <svg
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            style="margin-left: 5px"
          >
            <path
              class="fill-gray-7"
              d="M3 6L5 6L21 6C21.5523 6 22 6.44772 22 7C22 7.55228 21.5523 8 21 8H19.8333L18.7568 20.1422C18.7014 20.7227 18.2241 21.1667 17.641 21.1667H6.35902C5.77589 21.1667 5.29864 20.7227 5.2432 20.1422L4.16667 8H3C2.44772 8 2 7.55228 2 7C2 6.44772 2.44772 6 3 6ZM9.16667 4C9.16667 3.44772 9.61439 3 10.1667 3H13.8333C14.3856 3 14.8333 3.44772 14.8333 4H19C19.5523 4 20 4.44772 20 5C20 5.55228 19.5523 6 19 6H5C4.44772 6 4 5.55228 4 5C4 4.44772 4.44772 4 5 4H9.16667Z"
              fill="#111827"
            />
          </svg>
        </a-button>

        <a-button
          type="link"
          :data-id="row.id"
          @click="validated(row)"
          v-if="row.state == 'new'"
        >
          <svg
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            style="margin-left: 5px"
          >
            <path
              class="fill-gray-7"
              d="M20.285 6.27109C20.6645 6.64942 20.6645 7.25266 20.285 7.631L9.75 18.1661L4.96499 13.3811C4.58565 13.0018 4.58565 12.3985 4.96499 12.0191C5.34433 11.6398 5.94757 11.6398 6.32691 12.0191L9.75 15.4422L18.9239 6.26829C19.3032 5.88895 19.9065 5.88895 20.285 6.27109Z"
              fill="#111827"
            />
          </svg>
        </a-button>

      </a-space>
        
      </template>
    </a-table>
  </a-card>
  <!-- / Projects Table Column -->
</template>

<script>
import { formatDistance } from "date-fns";
import { fr } from "date-fns/locale";
import axios from "axios";
export default {
  props: {
    data: {
      type: Array,
      default: () => [],
    },
    columns: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      search: "",
      now: new Date(),
      // Active button for the "Projects" table's card header radio button group.
      projectHeaderBtns: "all",
    };
  },
  mounted() {
    //la fonction qui actualise dynamiquement notre date
    /*setInterval(() => {
      this.now = new Date();
    }, 1000);*/
  },

  methods: {
    onSearch() {
      // Émet l'événement "search" avec la valeur saisie
      this.$emit('search', this.search);
    },
    format(date) {
      return formatDistance(new Date(date), this.now, { locale: fr });
    },
    emitOpenFunc() {
      this.$emit("openFunc"); // Émettre l'événement 'openFunc' lors du clic
    },
    notValidated() {
      this.$emit("handleNotValidate");
    },
    all() {
      this.$emit("handleAll");
    },
    validated(row) {
      this.$emit("handleValidate", row);
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
  },
};
</script>

<style>
.ant-table-column-title {
  font-weight: bold;
  color: green;
  font-size:medium;
}
</style>