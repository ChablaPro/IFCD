<!-- 
	This is the tables page, it uses the dashboard layout in: 
	"./layouts/Dashboard.vue" .
 -->

<template>
  <div>
    <a-modal v-model="openOrg" width="1000px" title="Add Actor">
      <p>
        <label>Actor avatar</label>
        <a-upload-dragger
          v-if="!data.avatar"
          :file-list="fileList"
          name="photo"
          :multiple="false"
          :action="'https://api.queenbloh.com/api/actor/upload'"
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
                :src="'https://api.queenbloh.com' + data.avatar"
                v-if="data.avatar"
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
              v-if="data.avatar"
              @click="handleRemove"
              >Remove Image</a-button
            >
          </a-col>
        </a-row>
      </p>
      <p>
        <label>Full Name</label>
        <a-input v-model="data.name" />
      </p>
          
          <Row :gutter="16">
            <Col span="12">
                <div>
                  <p>
                    <label>Gender</label>
                    <a-select
                      v-model="data.genre"
                      show-search
                      placeholder="Select a gender"
                      option-filter-prop="children"
                      style="width: 100%"
                      :filter-option="
                        (input, option) =>
                          option.componentOptions.children[0].text
                            .toLowerCase()
                            .includes(input.toLowerCase())
                      "
                    >
                      <a-select-option value="Man"> Man </a-select-option>
                      <a-select-option value="Woman"> Woman </a-select-option>
                    </a-select>
                  </p>
                </div>
            </Col>
            <Col span="12">
                <div>
                  <p>
                    <label>Age</label>
                    <a-input-number style="width: 100%" min="1" v-model="data.age" />
                  </p>
                </div>
            </Col>
          </Row>

      <p>
        <label>Language</label>
        <a-input v-model="data.langue" />
      </p>
      <p>
        <label>Level</label>
        <a-input v-model="data.niveau" />
      </p>
      <p>
        <label>Person with a disability</label>
        <a-radio-group v-model="data.handicap" style="width: 100%">
          <a-radio :style="radioStyle" value="oui">Yes</a-radio>
          <a-radio :style="radioStyle" value="non">No</a-radio>
        </a-radio-group>
      </p>
      <p>
        <label>Occupation</label>
        <a-select
          v-model="data.occupation"
          show-search
          placeholder="Select a occupation"
          option-filter-prop="children"
          style="width: 100%"
          :filter-option="
            (input, option) =>
              option.componentOptions.children[0].text
                .toLowerCase()
                .includes(input.toLowerCase())
          "
        >
          <a-select-option value="agricole">
            Agricultural producer
          </a-select-option>
          <a-select-option value="eleveur"> Breeder </a-select-option>
        </a-select>
      </p>
      <p v-if="data.occupation == 'agricole'">
        <label>Land area</label>
        <a-input-number style="width: 100%" min="1" v-model="data.superficie" />
      </p>
      <p v-if="data.occupation == 'eleveur'">
        <label>Number of livestock</label>
        <a-input-number style="width: 100%" min="1" v-model="data.nbrBetail" />
      </p>
      <p>
        <label>Company</label>
        <a-select
          v-model="data.compagny_id"
          show-search
          placeholder="Select a Arrondissement"
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
            v-for="(arr, i) in compagnies"
            :value="arr.id"
            :key="i"
          >
            {{ arr.denominationOpa }}
          </a-select-option>
        </a-select>
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

    <a-modal v-model="openEditOrg" width="1000px" title="Edit Actor">
      <p>
        <label>Actor avatar</label>
        <a-upload-dragger
          v-if="!editData.avatar"
          :file-list="fileList"
          name="photo"
          :multiple="false"
          :action="'https://api.queenbloh.com/api/actor/upload'"
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
                :src="'https://api.queenbloh.com' + editData.avatar"
                v-if="editData.avatar"
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
              v-if="editData.avatar"
              @click="handleRemove"
              >Remove Image</a-button
            >
          </a-col>
        </a-row>
      </p>
      <p>
        <label>Full Name</label>
        <a-input v-model="editData.name" />
      </p>
      <Row :gutter="16">
            <Col span="12">
                <div>
                  <p>
                    <label>Gender</label>
                    <a-select
                      v-model="editData.genre"
                      show-search
                      placeholder="Select a gender"
                      option-filter-prop="children"
                      style="width: 100%"
                      :filter-option="
                        (input, option) =>
                          option.componentOptions.children[0].text
                            .toLowerCase()
                            .includes(input.toLowerCase())
                      "
                    >
                      <a-select-option value="Man"> Man </a-select-option>
                      <a-select-option value="Woman"> Woman </a-select-option>
                    </a-select>
                  </p>
                </div>
            </Col>
            <Col span="12">
                <div>
                  <p>
                    <label>Age</label>
                    <a-input-number style="width: 100%" min="1" v-model="editData.age" />
                  </p>
                </div>
            </Col>
          </Row>

      
      
      <p>
        <label>Language</label>
        <a-input v-model="editData.langue" />
      </p>
      <p>
        <label>Level</label>
        <a-input v-model="editData.niveau" />
      </p>
      <p>
        <label>Person with a disability</label>
        <a-radio-group v-model="editData.handicap" style="width: 100%">
          <a-radio :style="radioStyle" value="oui">Yes</a-radio>
          <a-radio :style="radioStyle" value="non">No</a-radio>
        </a-radio-group>
      </p>
      <p>
        <label>Occupation</label>
        <a-select
          v-model="editData.occupation"
          show-search
          placeholder="Select a occupation"
          option-filter-prop="children"
          style="width: 100%"
          :filter-option="
            (input, option) =>
              option.componentOptions.children[0].text
                .toLowerCase()
                .includes(input.toLowerCase())
          "
        >
          <a-select-option value="agricole">
            Agricultural producer
          </a-select-option>
          <a-select-option value="eleveur"> Breeder </a-select-option>
        </a-select>
      </p>
      <p v-if="editData.occupation == 'agricole'">
        <label>Land area</label>
        <a-input-number
          style="width: 100%"
          min="1"
          v-model="editData.superficie"
        />
      </p>
      <p v-if="editData.occupation == 'eleveur'">
        <label>Number of livestock</label>
        <a-input-number
          style="width: 100%"
          min="1"
          v-model="editData.nbrBetail"
        />
      </p>
      <p>
        <label>Company</label>
        <a-select
          v-model="editData.compagny_id"
          show-search
          placeholder="Select a Arrondissement"
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
            v-for="(arr, i) in compagnies"
            :value="arr.id"
            :key="i"
          >
            {{ arr.denominationOpa }}
          </a-select-option>
        </a-select>
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

    <a-modal v-model="openInfoOrg" width="1000px" title="View Actor">
      <a-row>
        <a-col :span="24">
          <CardBillingInfoActor
            :info="viewData"
            @handleDeleteInfo="handleDeleteInfo"
            @handleEditInfo="handleEditInfo"
          >
          </CardBillingInfoActor>
        </a-col>

        <a-col
          :span="24"
          :md="12"
          :xl="6"
          v-for="(project, index) in viewData.activities"
          :key="index"
        >
          <h6>Participated activities</h6>
          <br />
          <CardProject
            :row="project"
            :id="project.id"
            :title="project.titre"
            :content="project.objectif"
            :cover="'https://api.queenbloh.com' + project.picture"
          ></CardProject>
        </a-col>
      </a-row>

      <template #footer>
        <a-button key="back" @click="handleCancelInfo">Cancel</a-button>
      </template>
    </a-modal>

    <!-- Projects Table -->
    <a-row :gutter="24" type="flex">
      <!-- Projects Table Column -->
      <a-col :span="24" class="mb-24">
        <!-- Projects Table Column -->
        <CardProjectTable2
          :anim="anim"
          :data="table2Data"
          :columns="table2Columns"
          @openFunc="handleOpenFunc"
          @handleValidate="handleValidate"
          @handleDelete="handleDelete"
          @handleEdit="handleEdit"
          @handleView="handleView"
          @handleNotValidate="handleNotValidate"
          @handleAll="handleAll"
          @search="handleSearch"
        >
        </CardProjectTable2>
        <!-- / Projects Table Column -->
      </a-col>
      <!-- / Projects Table Column -->
    </a-row>
    <!-- / Projects Table -->
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { InboxOutlined } from "@ant-design/icons-vue";
import { message } from "ant-design-vue";
import Steps from "./Steps.vue";

// "Authors" table component.
import CardAuthorTable from "../components/Cards/CardAuthorTable";

import CardProject from "../components/Cards/CardActor";

// "Projects" table component.
import CardProjectTable2 from "../components/Cards/CardProjectTableActor";

import CardBillingInfoActor from "../components/Cards/CardBillingInfoActor";

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
    title: "Code",
    dataIndex: "code",
    scopedSlots: { customRender: "code" },
    width: 300,
  },
  {
    title: "Full Name",
    dataIndex: "name",
    class: "font-semibold text-muted",
  },
  {
    title: "Gender",
    dataIndex: "genre",
    class: "font-semibold text-muted text-sm",
  },
  {
    title: "Age",
    dataIndex: "age",
    class: "font-semibold text-muted text-sm",
  },
  {
    title: "Language",
    dataIndex: "langue",
    class: "font-semibold text-muted text-sm",
  },
  {
    title: "Level",
    dataIndex: "niveau",
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

export default {
  components: {
    CardAuthorTable,
    CardProjectTable2,
    CardBillingInfoActor,
    Steps,
    InboxOutlined,
    CardProject,
  },
  data() {
    return {
      anim: true,
      fileList: [],
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
        name: "",
        avatar: "",
        genre: "",
        age: "",
        langue: "",
        niveau: "",
        compagny_id: "",
        superficie: "",
        handicap: "non",
        occupation: "",
        nbrBetail: "",
      },

      departs: [],
      compagnies: [],
      arrondissements: [],
      villages: [],
      maillons: [],
      juridiques: [],
      positions: [],

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
    async handleRemove() {
      const res = await axios.post("/actor/delete-img", {
        photo: this.data.avatar,
      });
      this.data.avatar = "";
    },
    // Handle upload change events
    handleChange(info) {
      const status = info.file.status;
      console.log(status);
      if (status === "done") {
        this.fileList = [info.file]; // Restrict to a single file in the list

        // Access the image URL returned from the backend
        this.data.avatar = info.file.response.image_url;
        message.success(
          `Image uploaded successfully. URL: ${this.data.avatar}`
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
    handleSearch(value) {
      console.log("Recherche effectuée avec:", value);
      // Ajoutez votre logique de recherche ici
      if (value) {
        this.table2Data = this.filteredData.filter((item) => {
          // Remplacez 'name' et 'description' par les propriétés que vous souhaitez filtrer
          return item.name.toLowerCase().includes(value.toLowerCase());
        });
      } else {
        // Si aucune valeur de recherche, on réinitialise les données filtrées
        this.table2Data = this.filteredData;
      }
    },
    async handleDeleteInfo(row) {
      this.table2Data = this.table2Data.filter((item) => item.id !== row.id);
      const res = await axios.post("/compagny/delete", row);
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
      this.table2Data = this.filteredData.filter((item) => item.state == "new");
    },
    async handleAll() {
      this.table2Data = this.filteredData;
    },
    handleOpenFunc() {
      this.openOrg = true; // Met à jour opeOrg lorsque l'événement est reçu
    },
    async handleValidate(row) {
      row.state = "validated";
      const res = await axios.post("/actor/validate", row);
      message.success("Actor successfully validated.", 5);
    },
    async handleDelete(row) {
      this.table2Data = this.table2Data.filter((item) => item.id !== row.id);
      const res = await axios.post("/actor/delete", row);
      message.success("Actor successfully deleted.", 5);
    },
    handleEdit(row) {
      this.editData = row;
      this.openEditOrg = true;
    },
    async handleEditOrg() {
      this.loadingEdit = true;
      const res = await axios.post("/actor/update", this.editData);
      this.openEditOrg = false;
      this.loadingEdit = false;
      message.success("Actor successfully edited.", 5);
    },
    async handleOkOrg() {
      this.loadingAdd = true;
      try {
        const res = await axios.post("/actor/create", this.data);
        if (res.status == 200) {
          this.table2Data = res.data.users.data;
          this.data = {
            name: "",
            avatar: "",
            genre: "",
            age: "",
            langue: "",
            niveau: "",
            compagny_id: "",
            superficie: "",
            handicap: "non",
            occupation: "",
            nbrBetail: "",
          };
          this.loadingAdd = false;
          this.openOrg = false;
          message.success("Actor successfully registered.", 5);
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
  },
  async created() {
    const res = await axios.get("/actor/utilities");
    const resP = await axios.get("/actor/paginate6");

    if (res.status == 200) {
      this.compagnies = res.data.compagnies;
    }

    if (resP.status == 200) {
      this.table2Data = resP.data.users.data;
      this.filteredData = resP.data.users.data;
      this.anim = false;
    }
  },
  mounted() {
    this.inputRef = this.$refs.inputRef;
  },
};
</script>

<style lang="scss" scoped></style>