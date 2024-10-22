<!-- 
	This is the tables page, it uses the dashboard layout in: 
	"./layouts/Dashboard.vue" .
 -->

<template>
  <div>
    <a-modal v-model="openOrg" width="1000px" title="Add Activity">
      <p>
        <label>Activity Picture</label>
        <a-upload-dragger
          v-if="!data.picture"
          :file-list="fileList"
          name="photo"
          :multiple="false"
          :action="'https://api.queenbloh.com/api/activity/upload'"
          :headers="uploadHeaders"
          :before-upload="beforeUpload"
          @change="handleChange"
          @drop="handleDrop"
        >
          <p class="ant-upload-drag-icon">
            <inbox-outlined></inbox-outlined>
          </p>
          <p class="ant-upload-text">
            Click or drag an image to this area to upload
          </p>
          <p class="ant-upload-hint">
            Support for a single image upload. Strictly upload only image files
            (jpeg, png, jpg, gif) with a maximum size of 2MB.
          </p>
        </a-upload-dragger>
        <a-row type="flex">
          <a-col class="col-img" :span="24" :xl="12">
            <div class="card-img-bg">
              <img
                :src="'https://api.queenbloh.com' + data.picture"
                v-if="data.picture"
                style="max-width: 150px; border-radius: 5px"
              />
            </div>
          </a-col>
          <a-col
            class="col-content"
            :span="24"
            :xl="12"
            style="justify-content: center"
          >
            <a-button
              type="danger"
              danger
              style="width: 100%"
              v-if="data.picture"
              @click="handleRemove"
              >Remove Image</a-button
            >
          </a-col>
        </a-row>
      </p>
      <p>
        <label>Title</label>
        <a-input v-model="data.titre" />
      </p>
      <p>
        <label>Type</label>
        <a-select
          v-model="data.type"
          show-search
          placeholder="Select a type"
          option-filter-prop="children"
          style="width: 100%"
          :filter-option="
            (input, option) =>
              option.componentOptions.children[0].text
                .toLowerCase()
                .includes(input.toLowerCase())
          "
        >
          <a-select-option
            v-for="(depart, i) in types"
            :value="depart"
            :key="i"
          >
            {{ depart }}
          </a-select-option>
        </a-select>
      </p>
      <p>
        <label>Country</label>
        <a-select
          v-model="data.pays"
          show-search
          placeholder="Select a country"
          option-filter-prop="children"
          style="width: 100%"
          :filter-option="
            (input, option) =>
              option.componentOptions.children[0].text
                .toLowerCase()
                .includes(input.toLowerCase())
          "
        >
          <a-select-option v-for="(depart, i) in pays" :value="depart" :key="i">
            {{ depart }}
          </a-select-option>
        </a-select>
      </p>
      <p>
        <label>State</label>
        <a-select
          v-model="data.etat"
          show-search
          placeholder="Select a state"
          option-filter-prop="children"
          style="width: 100%"
          :filter-option="
            (input, option) =>
              option.componentOptions.children[0].text
                .toLowerCase()
                .includes(input.toLowerCase())
          "
        >
          <a-select-option
            v-for="(depart, i) in departs"
            :value="depart"
            :key="i"
          >
            {{ depart }}
          </a-select-option>
        </a-select>
      </p>
      <p>
        <label>Commune</label>
        <a-select
          v-model="data.commune"
          show-search
          placeholder="Select a commune"
          option-filter-prop="children"
          style="width: 100%"
          :filter-option="
            (input, option) =>
              option.componentOptions.children[0].text
                .toLowerCase()
                .includes(input.toLowerCase())
          "
        >
          <a-select-option
            v-for="(depart, i) in communes"
            :value="depart"
            :key="i"
          >
            {{ depart }}
          </a-select-option>
        </a-select>
      </p>
      <p>
        <label>Domain</label>
        <a-select
          v-model="data.domaine"
          show-search
          placeholder="Select a domain"
          option-filter-prop="children"
          style="width: 100%"
          :filter-option="
            (input, option) =>
              option.componentOptions.children[0].text
                .toLowerCase()
                .includes(input.toLowerCase())
          "
        >
          <a-select-option
            v-for="(depart, i) in domaines"
            :value="depart"
            :key="i"
          >
            {{ depart }}
          </a-select-option>
        </a-select>
      </p>
      <p>
        <label>Objectif</label>
        <a-input v-model="data.objectif" />
      </p>
      <p>
        <label>Bassin</label>
        <a-input v-model="data.bassin" />
      </p>
      <p>
        <label>Event date</label>
        <a-date-picker v-model="data.date" style="width: 100%" />
      </p>
      <p>
        <label>Address</label>
        <a-input v-model="data.lieu" />
      </p>

      <template #footer>
        <a-button key="back" @click="openOrg = false">Cancel</a-button>
        <a-button
          key="submit"
          type="primary"
          :loading="loadingAdd"
          @click="handleOkOrg"
          >Submit</a-button
        >
      </template>
    </a-modal>

    <a-modal v-model="openEditOrg" width="1000px" title="Edit Activity">
      <p>
        <label>Activity Picture</label>
        <a-upload-dragger
          v-if="!editData.picture"
          :file-list="fileList"
          name="photo"
          :multiple="false"
          :action="'https://api.queenbloh.com/api/activity/upload'"
          :headers="uploadHeaders"
          :before-upload="beforeUpload"
          @change="handleChange"
          @drop="handleDrop"
        >
          <p class="ant-upload-drag-icon">
            <inbox-outlined></inbox-outlined>
          </p>
          <p class="ant-upload-text">
            Click or drag an image to this area to upload
          </p>
          <p class="ant-upload-hint">
            Support for a single image upload. Strictly upload only image files
            (jpeg, png, jpg, gif) with a maximum size of 2MB.
          </p>
        </a-upload-dragger>
        <a-row type="flex">
          <a-col class="col-img" :span="24" :xl="12">
            <div class="card-img-bg">
              <img
                :src="'https://api.queenbloh.com' + editData.picture"
                v-if="editData.picture"
                style="max-width: 150px; border-radius: 5px"
              />
            </div>
          </a-col>
          <a-col
            class="col-content"
            :span="24"
            :xl="12"
            style="justify-content: center"
          >
            <a-button
              type="danger"
              danger
              style="width: 100%"
              v-if="editData.picture"
              @click="handleRemove"
              >Remove Image</a-button
            >
          </a-col>
        </a-row>
      </p>
      <p>
        <label>Title</label>
        <a-input v-model="editData.titre" />
      </p>
      <p>
        <label>Type</label>
        <a-select
          v-model="editData.type"
          show-search
          placeholder="Select a type"
          option-filter-prop="children"
          style="width: 100%"
          :filter-option="
            (input, option) =>
              option.componentOptions.children[0].text
                .toLowerCase()
                .includes(input.toLowerCase())
          "
        >
          <a-select-option
            v-for="(depart, i) in types"
            :value="depart"
            :key="i"
          >
            {{ depart }}
          </a-select-option>
        </a-select>
      </p>
      <p>
        <label>Country</label>
        <a-select
          v-model="editData.pays"
          show-search
          placeholder="Select a country"
          option-filter-prop="children"
          style="width: 100%"
          :filter-option="
            (input, option) =>
              option.componentOptions.children[0].text
                .toLowerCase()
                .includes(input.toLowerCase())
          "
        >
          <a-select-option v-for="(depart, i) in pays" :value="depart" :key="i">
            {{ depart }}
          </a-select-option>
        </a-select>
      </p>
      <p>
        <label>State</label>
        <a-select
          v-model="editData.etat"
          show-search
          placeholder="Select a state"
          option-filter-prop="children"
          style="width: 100%"
          :filter-option="
            (input, option) =>
              option.componentOptions.children[0].text
                .toLowerCase()
                .includes(input.toLowerCase())
          "
        >
          <a-select-option
            v-for="(depart, i) in departs"
            :value="depart"
            :key="i"
          >
            {{ depart }}
          </a-select-option>
        </a-select>
      </p>
      <p>
        <label>Commune</label>
        <a-select
          v-model="editData.commune"
          show-search
          placeholder="Select a commune"
          option-filter-prop="children"
          style="width: 100%"
          :filter-option="
            (input, option) =>
              option.componentOptions.children[0].text
                .toLowerCase()
                .includes(input.toLowerCase())
          "
        >
          <a-select-option
            v-for="(depart, i) in communes"
            :value="depart"
            :key="i"
          >
            {{ depart }}
          </a-select-option>
        </a-select>
      </p>
      <p>
        <label>Domain</label>
        <a-select
          v-model="editData.domaine"
          show-search
          placeholder="Select a domain"
          option-filter-prop="children"
          style="width: 100%"
          :filter-option="
            (input, option) =>
              option.componentOptions.children[0].text
                .toLowerCase()
                .includes(input.toLowerCase())
          "
        >
          <a-select-option
            v-for="(depart, i) in domaines"
            :value="depart"
            :key="i"
          >
            {{ depart }}
          </a-select-option>
        </a-select>
      </p>
      <p>
        <label>Objectif</label>
        <a-input v-model="editData.objectif" />
      </p>
      <p>
        <label>Bassin</label>
        <a-input v-model="editData.bassin" />
      </p>
      <p>
        <label>Event date</label>
        <a-date-picker v-model="editData.date" style="width: 100%" />
      </p>
      <p>
        <label>Address</label>
        <a-input v-model="editData.lieu" />
      </p>
      <p v-if="editData.state == 'validated'">
        <label>Status</label>
        <a-select
          v-model="editData.state"
          show-search
          placeholder="Select a status"
          option-filter-prop="children"
          style="width: 100%"
          :filter-option="
            (input, option) =>
              option.componentOptions.children[0].text
                .toLowerCase()
                .includes(input.toLowerCase())
          "
        >
          <a-select-option value="done"> Done </a-select-option>
        </a-select>
      </p>

      <p v-if="editData.state == 'done'">
        <label>Actors</label>
        <a-select
          v-model="editData.actorIds"
          mode="multiple"
          style="width: 100%"
          placeholder="Select Item..."
          :max-tag-text-length="maxTagTextLength"
          :options="options"
        ></a-select>
      </p>

      <template #footer>
        <a-button key="back" @click="openEditOrg = false">Cancel</a-button>
        <a-button
          key="submit"
          type="primary"
          :loading="loadingEdit"
          @click="handleEditOrg"
          >Submit</a-button
        >
      </template>
    </a-modal>

    <a-modal v-model="openInfoOrg" width="1000px" title="View Activity">
      <CardBillingInfoOrg
        :info="viewData"
        @handleDeleteInfo="handleDeleteInfo"
        @handleEditInfo="handleEditInfo"
      >
      </CardBillingInfoOrg>

      <template #footer>
        <a-button key="back" @click="handleCancelInfo">Cancel</a-button>
      </template>
    </a-modal>

    <!-- Projects Card -->
    <a-card
      :bordered="false"
      class="header-solid h-full mb-24"
      :bodyStyle="{ paddingTop: '14px' }"
      style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); padding: 20px"
    >
      <template #title>
        <a-row type="flex" align="middle">
          <a-col :span="24" :md="12">
            <h5 class="font-semibold m-0">Activities</h5>
          </a-col>

          <a-col
            :span="24"
            :md="12"
            style="
              display: flex;
              align-items: center;
              justify-content: flex-end;
              gap: 4;
            "
          >
            <a-radio-group v-model="projectHeaderBtns" size="small">
              <a-radio-button value="all" @click="handleAll"
                >ALL</a-radio-button
              >
              <a-radio-button value="online" @click="handleNotValidate"
                >Not Validated</a-radio-button
              >
              <a-radio-button value="validate" @click="handleShowValidate"
                >To be achieved</a-radio-button
              >
              <a-radio-button value="progress" @click="handleShowProgress"
                >In progress</a-radio-button
              >
              <a-radio-button value="done" @click="handleDone"
                >Done</a-radio-button
              >
              <!--a-radio-button value="stores">STORES</a-radio-button-->
            </a-radio-group>
          </a-col>
        </a-row>
      </template>
      <a-row
        type="flex"
        align="middle"
        :gutter="40"
        style="
          display: flex !important;
          align-items: center !important;
          justify-content: space-between !important;
          padding: 0 30px;
        "
      >
        <a-col
          :span="24"
          :md="12"
          style="margin-top: 10px; margin-bottom: 40px; width: 300px"
        >
          <div>
            <a-button type="dashed" block @click="handleOpenFunc">
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
              Add New Activities
            </a-button>
          </div>
        </a-col>

        <a-col
          :span="24"
          :md="12"
          style="margin-top: 10px; margin-bottom: 40px; width: 500px"
        >
          <a-input-search
            v-model="search"
            placeholder="input search text"
            enter-button
            @search="handleSearch"
            @input="handleSearch"
          />
        </a-col>
      </a-row>

      <a-row type="flex" :gutter="[24, 24]" align="stretch">
        <!-- Project Column -->
        <a-col
          :span="24"
          :md="12"
          :xl="6"
          v-for="(project, index) in events"
          :key="index"
        >
          <CardProject
            :row="project"
            :id="project.date"
            :title="project.titre"
            :content="project.objectif"
            :cover="'https://api.queenbloh.com' + project.picture"
            :team="['https://api.queenbloh.com' + project.user.photo]"
            @handleValidate="handleValidate"
            @handleDelete="handleDelete"
            @handleEdit="handleEdit"
            @handleView="handleView"
          ></CardProject>
        </a-col>

        <!-- / Project Column -->
      </a-row>
      <div style="display: flex; justify-content: center" v-if="anim">
        <div class="loader"></div>
      </div>
    </a-card>
    <!-- / Projects Card -->
  </div>
</template>

<script>
import { message } from "ant-design-vue";
import Steps from "./Steps.vue";

// "Authors" table component.
import CardAuthorTable from "../components/Cards/CardAuthorTable";
import { InboxOutlined } from "@ant-design/icons-vue";

// "Projects" table component.
import CardProjectTable2 from "../components/Cards/CardProjectTable2";

import CardBillingInfoOrg from "../components/Cards/CardBillingInfoActivity";

import CardProject from "../components/Cards/CardActivity";

// Table.vue
import axios from "axios";

// "Authors" table list of columns and their properties.
const table1Columns = [
  {
    title: "AUTHOR",
    dataIndex: "author",
    scopedSlots: { customRender: "author" },
  },
  {
    title: "FUNCTION",
    dataIndex: "func",
    scopedSlots: { customRender: "func" },
  },
  {
    title: "STATUS",
    dataIndex: "status",
    scopedSlots: { customRender: "status" },
  },
  {
    title: "EMPLOYED",
    dataIndex: "employed",
    class: "text-muted",
  },
  {
    title: "",
    scopedSlots: { customRender: "editBtn" },
    width: 50,
  },
];

// "Authors" table list of rows and their properties.
const table1Data = [
  {
    key: "1",
    author: {
      avatar: "images/face-2.jpg",
      name: "Michael John",
      email: "michael@mail.com",
    },
    func: {
      job: "Manager",
      department: "Organization",
    },
    status: 1,
    employed: "23/04/18",
  },
  {
    key: "2",
    author: {
      avatar: "images/face-3.jpg",
      name: "Alexa Liras",
      email: "alexa@mail.com",
    },
    func: {
      job: "Programator",
      department: "Developer",
    },
    status: 0,
    employed: "23/12/20",
  },
  {
    key: "3",
    author: {
      avatar: "images/face-1.jpg",
      name: "Laure Perrier",
      email: "laure@mail.com",
    },
    func: {
      job: "Executive",
      department: "Projects",
    },
    status: 1,
    employed: "13/04/19",
  },
  {
    key: "4",
    author: {
      avatar: "images/face-4.jpg",
      name: "Miriam Eric",
      email: "miriam@mail.com",
    },
    func: {
      job: "Marketing",
      department: "Organization",
    },
    status: 1,
    employed: "03/04/21",
  },
  {
    key: "5",
    author: {
      avatar: "images/face-5.jpeg",
      name: "Richard Gran",
      email: "richard@mail.com",
    },
    func: {
      job: "Manager",
      department: "Organization",
    },
    status: 0,
    employed: "23/03/20",
  },
  {
    key: "6",
    author: {
      avatar: "images/face-6.jpeg",
      name: "John Levi",
      email: "john@mail.com",
    },
    func: {
      job: "Tester",
      department: "Developer",
    },
    status: 0,
    employed: "14/04/17",
  },
];

// "Projects" table list of columns and their properties.
//'id', 'denominationOpa', 'typeOpa', 'village', 'position', 'dateCreaction', 'email'
const table2Columns = [
  {
    title: "Organisation",
    dataIndex: "denominationOpa",
    scopedSlots: { customRender: "denominationOpa" },
    width: 300,
  },
  {
    title: "Type",
    dataIndex: "typeOpa",
    class: "font-semibold text-muted",
  },
  {
    title: "Village",
    dataIndex: "village",
    class: "font-semibold text-muted text-sm",
  },
  {
    title: "Value chain",
    dataIndex: "position",
    class: "font-semibold text-muted text-sm",
  },
  {
    title: "Date de création",
    dataIndex: "dateCreaction",
    class: "font-semibold text-muted text-sm",
  },
  {
    title: "Add by",
    dataIndex: "user",
    scopedSlots: { customRender: "user" },
    class: "font-semibold text-muted text-sm",
  },
  {
    title: "Actions",
    scopedSlots: { customRender: "editBtn" },
    width: 50,
  },
];

// "Projects" table list of rows and their properties.
const table2Data = [];

// Project cards data
const projects = [
  {
    id: 1,
    title: "Modern",
    content:
      "As Uber works through a huge amount of internal management turmoil.",
    cover: "images/home-decor-3.jpeg",
    team: [
      "images/face-1.jpg",
      "images/face-4.jpg",
      "images/face-2.jpg",
      "images/face-3.jpg",
    ],
  },
  {
    id: 2,
    title: "Scandinavian",
    content:
      "Music is something that every person has his or her own specific opinion about.",
    cover: "images/home-decor-2.jpeg",
    team: [
      "images/face-1.jpg",
      "images/face-4.jpg",
      "images/face-2.jpg",
      "images/face-3.jpg",
    ],
  },
  {
    id: 3,
    title: "Minimalist",
    content:
      "Different people have different taste, and various types of music, Zimbali Resort.",
    cover: "images/home-decor-1.jpeg",
    team: [
      "images/face-1.jpg",
      "images/face-4.jpg",
      "images/face-2.jpg",
      "images/face-3.jpg",
    ],
  },
];

export default {
  components: {
    CardAuthorTable,
    CardProjectTable2,
    CardBillingInfoOrg,
    Steps,
    CardProject,
    InboxOutlined,
  },
  data() {
    return {
      anim: true,
      options: [],
      maxTagCount: 2,
      maxTagTextLength: 10,
      actors: [],
      fileList: [],
      search: "",
      projects,
      events: [],
      loadingAdd: false,
      loadingEdit: false,
      current: 0,
      currentEdit: 0,
      openInfoOrg: false,
      openEditOrg: false,
      user: [],
      editData: {},
      viewData: [],
      data: {
        titre: "",
        picture: "",
        objectif: "",
        type: "",
        domaine: "",
        pays: "",
        etat: "",
        commune: "",
        bassin: "",
        date: "",
        lieu: "",
        state: "",
      },

      pays: [],
      departs: [],
      chaines: [],
      domaines: [],
      types: [],
      communes: [],
      nameDepOrg: "",
      inputRef: null,
      index: 0,
      openOrg: false,
      newOPA: "oui",
      // Associating "Authors" table data with its corresponding property.
      table1Data: table1Data,

      // Associating "Authors" table columns with its corresponding property.
      table1Columns: table1Columns,

      // Associating "Projects" table data with its corresponding property.
      table2Data: [],
      filteredData: [],

      // Associating "Projects" table columns with its corresponding property.
      table2Columns: table2Columns,
    };
  },
  computed: {
    uploadHeaders() {
      return {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
      };
    },
  },
  methods: {
    incrementMaxTagCount() {
      this.maxTagCount++;
    },
    decrementMaxTagCount() {
      this.maxTagCount--;
    },
    incrementMaxTagTextLength() {
      this.maxTagTextLength++;
    },
    decrementMaxTagTextLength() {
      this.maxTagTextLength--;
    },
    async handleRemove() {
      const res = await axios.post("/actor/delete-img", {
        photo: this.data.picture,
      });
      this.data.picture = "";
    },
    // Handle upload change events
    handleChange(info) {
      const status = info.file.status;
      console.log(status);
      if (status === "done") {
        this.fileList = [info.file]; // Restrict to a single file in the list

        // Access the image URL returned from the backend
        this.data.picture = info.file.response.image_url;
        message.success(
          `Image uploaded successfully. URL: ${this.data.picture}`
        );
      } else if (status === "error") {
        message.error(`${info.file.name} image upload failed.`);
      }
    },

    // Handle file drop event
    handleDrop(e) {
      console.log(e);
    },

    // Before uploading, validate if the file is an image and restrict to only one image
    beforeUpload(file) {
      const isImage = file.type.startsWith("image/");
      const isLt2M = file.size / 1024 / 1024 < 2; // Check if the file is less than 2MB

      if (!isImage) {
        message.error("You can only upload image files!");
        return false;
      }
      if (!isLt2M) {
        message.error("Image must be smaller than 2MB!");
        return false;
      }

      this.fileList = [file]; // Ensure only one file is in the list
      return true; // Proceed with the upload
    },
    handleNext() {
      this.current = 1;
    },
    handlePrevious() {
      this.current = 0;
    },
    handleEditNext() {
      this.currentEdit = 1;
    },
    handleEditPrevious() {
      this.currentEdit = 0;
    },
    handleSearch() {
      // Ajoutez votre logique de recherche ici
      if (this.search) {
        this.events = this.filteredData.filter((item) => {
          // Remplacez 'name' et 'description' par les propriétés que vous souhaitez filtrer
          return (
            item.titre.toLowerCase().includes(this.search.toLowerCase()) ||
            item.objectif.toLowerCase().includes(this.search.toLowerCase())
          );
        });
      } else {
        // Si aucune valeur de recherche, on réinitialise les données filtrées
        this.events = this.filteredData;
      }
    },
    async handleDeleteInfo(row) {
      this.events = this.events.filter((item) => item.id !== row.id);
      const res = await axios.post("/activity/delete", row);
      this.openInfoOrg = false;
    },
    async handleEditInfo(row) {
      this.editData = row;
      this.openInfoOrg = false;
      this.openEditOrg = true;
    },
    handleCancelInfo() {
      this.openInfoOrg = false;
    },
    handleView(row) {
      this.viewData = row;
      this.openInfoOrg = true;
    },
    handleNotValidate() {
      this.events = this.filteredData.filter((item) => item.state == "new");
    },
    handleAll() {
      this.events = this.filteredData;
    },
    handleShowValidate() {
      const today = new Date().toISOString().split("T")[0]; // Récupère la date actuelle au format 'YYYY-MM-DD'

      this.events = this.filteredData.filter((item) => {
        const itemDate = new Date(item.date).toISOString().split("T")[0]; // Convertit item.date en format 'YYYY-MM-DD'

        // Vérifie si l'état est "validated" et si la date est bien inférieure à aujourd'hui
        return item.state === "validated" && itemDate > today;
      });
    },
    handleDone() {
      const today = new Date().toISOString().split("T")[0]; // Récupère la date actuelle au format 'YYYY-MM-DD'

      this.events = this.filteredData.filter((item) => {
        const itemDate = new Date(item.date).toISOString().split("T")[0]; // Convertit item.date en format 'YYYY-MM-DD'

        // Vérifie si l'état est "validated" et si la date est bien inférieure à aujourd'hui
        return item.state === "done" && itemDate <= today;
      });
    },

    handleShowProgress() {
      // Utilisez `new Date()` pour obtenir la date actuelle et comparez-la correctement
      this.events = this.filteredData.filter((item) => {
        const today = new Date().toISOString().split("T")[0]; // Récupère la date au format 'YYYY-MM-DD'
        const itemDate = new Date(item.date).toISOString().split("T")[0]; // Format la date de l'élément pour comparaison
        return item.state === "validated" && itemDate === today;
      });
    },
    handleOpenFunc() {
      this.openOrg = true; // Met à jour opeOrg lorsque l'événement est reçu
    },
    async handleValidate(row) {
      row.state = "validated";
      const res = await axios.post("/activity/validate", row);
      message.success("Activity successfully validated.", 5);
    },
    async handleDelete(row) {
      this.events = this.events.filter((item) => item.id !== row.id);
      const res = await axios.post("/activity/delete", row);
      message.success("Activity successfully deleted.", 5);
    },
    handleEdit(row) {
      this.editData = row;
      this.openEditOrg = true;
    },
    async handleEditOrg() {
      this.loadingEdit = true;
      const res = await axios.post("/activity/update", this.editData);
      this.openEditOrg = false;
      this.loadingEdit = false;
      message.success("Activity successfully edited.", 5);
    },
    async handleOkOrg() {
      this.loadingAdd = true;
      try {
        const res = await axios.post("/activity/create", this.data);
        if (res.status == 200) {
          this.events = res.data.activities.data;
          this.data = {
            titre: "",
            picture: "",
            objectif: "",
            type: "",
            domaine: "",
            pays: "",
            etat: "",
            commune: "",
            bassin: "",
            date: "",
            lieu: "",
            state: "",
          };
          this.loadingAdd = false;
          this.openOrg = false;
          message.success("Activity successfully registered.", 5);
        }
        this.loadingAdd = false;
      } catch (error) {
        message.error("Vérifiez vos champs.", 5);
        this.loadingAdd = false;
      }
    },
    filterOptionDep(input, option) {
      return (
        option.componentOptions.children[0].text
          .toLowerCase()
          .indexOf(input.toLowerCase()) >= 0
      );
    },
    formatDate(dateString) {
      const inputDate = new Date(dateString);
      const year = inputDate.getFullYear();
      const month = String(inputDate.getMonth() + 1).padStart(2, "0"); // Mois en entier, ajoute un zéro initial si < 10
      const day = String(inputDate.getDate()).padStart(2, "0"); // Ajoute un zéro initial si le jour est < 10

      return `${year}-${month}-${day}`;
    },
  },
  async created() {
    const res = await axios.get("/activity/utilities");
    const resP = await axios.get("/activity/paginate6");

    if (res.status == 200) {
      this.departs = res.data.departs.map((depart) => depart.name);
      this.pays = res.data.pays.map((com) => com.name);
      this.chaines = res.data.chaines.map((arr) => arr.name);
      this.domaines = res.data.domaines.map((vill) => vill.name);
      this.types = res.data.events.map((mail) => mail.name);
      this.communes = res.data.communes.map((mail) => mail.name);
      this.options = res.data.actors.map((actor) => {
        // Assurez-vous que actor.name existe
        return {
          label: actor.name,
          value: actor.id,
        };
      });
    }

    if (resP.status == 200) {
      this.events = resP.data.activities.data.map((activity) => {
        return {
          ...activity,
          date: this.formatDate(activity.date), // Formate l'attribut date
        };
      });
      this.filteredData = resP.data.activities.data.map((activity) => {
        return {
          ...activity,
          date: this.formatDate(activity.date), // Formate l'attribut date
        };
      });

      this.anim = false;
    }
  },
  mounted() {
    this.inputRef = this.$refs.inputRef;
  },
};
</script>

<style lang="scss" scoped></style>