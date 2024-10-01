<!-- 
	This is the tables page, it uses the dashboard layout in: 
	"./layouts/Dashboard.vue" .
 -->

 <template>
    <div>
      <a-modal
        v-model="openOrg"
        width="1000px"
        title="Add Actor"
      >

        
   
          <p>
          <label>Actor avatar</label>
          <a-upload-dragger v-if="!data.avatar"
                :file-list="fileList"
                name="photo"
                :multiple="false"
                :action="'http://localhost:8000/api/actor/upload'" 
                :headers="uploadHeaders"
                :before-upload="beforeUpload" 
                @change="handleChange"
                @drop="handleDrop"
            >
                <p class="ant-upload-drag-icon">
                <inbox-outlined></inbox-outlined>
                </p>
                <p class="ant-upload-text">Click or drag an image to this area to upload</p>
                <p class="ant-upload-hint">
                Support for a single image upload. Strictly upload only image files (jpeg, png, jpg, gif) with a maximum size of 2MB.
                </p>
            </a-upload-dragger>
            <img :src="'http://localhost:8000' + data.avatar" alt="" v-if="data.avatar" style="width: 100%">
            <a-button type="danger" danger style="width: 100%" v-if="data.avatar" @click="handleRemove">Remove Image</a-button>
          </p>
          <p>
            <label>Name</label>
            <a-input v-model="data.name" />
          </p>
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
              <a-select-option
                value="Man"
              >
                Man
              </a-select-option>
              <a-select-option
                value="Woman"
              >
               Woman
              </a-select-option>
            </a-select>
          </p>
          <p>
            <label>Age</label>
            <a-input v-model="data.age" />
          </p>
          <p>
            <label>Langage</label>
            <a-input v-model="data.langue" />
          </p>
          <p>
            <label>Level</label>
            <a-input v-model="data.niveau" />
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
        
      
        <template #footer >
          <a-button key="back" @click="openOrg = false" >Cancel</a-button>
          <a-button key="submit" type="primary" :loading="loadingAdd" @click="handleOkOrg" >Submit</a-button>
        </template>
  
      </a-modal>
  
      <a-modal
        v-model="openEditOrg"
        width="1000px"
        title="Edit Actor"
     
      >
      
        <p>
          <Steps :current="currentEdit"/>
        </p>
        <div v-if="currentEdit==0">
          <p>
            <label>Year of collection</label>
            <a-select
              v-model="editData.year"
              style="width: 100%"
              @focus="focus"
              @change="handleChange"
            >
              <a-select-option value="2024">2024</a-select-option>
              <a-select-option value="2025">2025</a-select-option>
              <a-select-option value="2026">2026</a-select-option>
              <a-select-option value="2027">2027</a-select-option>
            </a-select>
          </p>
          <p>
            <label>New OPA?</label>
            <a-radio-group v-model="editData.newOpa" style="width: 100%">
              <a-radio :style="radioStyle" value="oui">Yes</a-radio>
              <a-radio :style="radioStyle" value="non">No</a-radio>
            </a-radio-group>
          </p>
          <p>
            <label>Department</label>
            <a-select
              v-model="editData.departement"
              show-search
              placeholder="Select a Department"
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
          <!--p>
            <label>Commune</label>
            <a-select
              v-model="editData.comOrg"
              show-search
              placeholder="Select a Commune"
              option-filter-prop="children"
              style="width: 100%"
              :filter-option="
                (input, option) =>
                  option.componentOptions.children[0].text
                    .toLowerCase()
                    .includes(input.toLowerCase())
              "
            >
              <a-select-option v-for="(com, i) in communes" :value="com" :key="i">
                {{ com }}
              </a-select-option>
            </a-select>
          </p-->
          <p>
            <label>Arrondissement</label>
            <a-select
              v-model="editData.arrondissement"
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
                v-for="(arr, i) in arrondissements"
                :value="arr"
                :key="i"
              >
                {{ arr }}
              </a-select-option>
            </a-select>
          </p>
          <p>
            <label>Village</label>
            <a-select
              v-model="editData.village"
              show-search
              placeholder="Select a Village"
              option-filter-prop="children"
              style="width: 100%"
              :filter-option="
                (input, option) =>
                  option.componentOptions.children[0].text
                    .toLowerCase()
                    .includes(input.toLowerCase())
              "
            >
              <a-select-option v-for="(vil, i) in villages" :value="vil" :key="i">
                {{ vil }}
              </a-select-option>
            </a-select>
          </p>
          <p>
            <label>Address/House</label>
            <a-input v-model="editData.adresse" />
          </p>
          <p>
            <label>Type of OPA</label>
            <a-select v-model="editData.typeOpa" style="width: 100%" @focus="focus">
              <a-select-option value="Coopérative">Cooperative</a-select-option>
              <a-select-option value="Association">Association</a-select-option>
              <a-select-option value="GIE"
                >Economic Interest Group (GIE)</a-select-option
              >
              <a-select-option value="Union Communale"
                >Municipal Union</a-select-option
              >
            </a-select>
          </p>
          <p v-if="editData.typeOpa == 'Coopérative'">
            <label>Legal status</label>
            <a-select
              v-model="editData.juridique"
              show-search
              placeholder="Select a Legal status"
              option-filter-prop="children"
              style="width: 100%"
              :filter-option="
                (input, option) =>
                  option.componentOptions.children[0].text
                    .toLowerCase()
                    .includes(input.toLowerCase())
              "
            >
              <a-select-option v-for="(jur, i) in juridiques" :value="jur" :key="i">
                {{ jur }}
              </a-select-option>
            </a-select>
          </p>
          <p v-if="editData.typeOpa != ''">
            <label>Name of the OPA</label>
            <a-input v-model="editData.denominationOpa" />
          </p>
          <p v-if="editData.typeOpa != ''">
            <label>Creation date</label>
            <a-date-picker v-model="editData.dateCreaction" style="width: 100%" />
          </p>
          <p v-if="editData.typeOpa != ''">
            <label>Contact person</label>
            <a-input v-model="editData.personneContact" />
          </p>
          <p v-if="editData.typeOpa != ''">
            <label>Contact</label>
            <a-input v-model="editData.contact" />
          </p>
          <p v-if="editData.typeOpa != ''">
            <label>E-mail</label>
            <a-input v-model="editData.courriel" />
          </p>
          <p>
            <label>Maillons</label>
            <a-select
              v-model="editData.maillon"
              show-search
              placeholder="Select a Department"
              option-filter-prop="children"
              style="width: 100%"
              :filter-option="
                (input, option) =>
                  option.componentOptions.children[0].text
                    .toLowerCase()
                    .includes(input.toLowerCase())
              "
            >
              <a-select-option v-for="(mai, i) in maillons" :value="mai" :key="i">
                {{ mai }}
              </a-select-option>
            </a-select>
          </p>
        </div>
  
        <div v-if="currentEdit==1">
  
          <p v-if="editData.typeOpa != ''">
          <label>Total cooperative members</label>
          <a-input v-model="editData.totalMembre" />
          </p>
          <p v-if="editData.typeOpa != ''">
            <label>Number of men in the cooperative</label>
            <a-input v-model="editData.nbrHomme" />
          </p>
          <p v-if="editData.typeOpa != ''">
            <label>Number of women in the cooperative</label>
            <a-input v-model="editData.nbrFemme" />
          </p>
          <p v-if="editData.typeOpa != ''">
            <label>Number of young men in the cooperative</label>
            <a-input v-model="editData.nbrJHomme" />
          </p>
          <p v-if="editData.typeOpa != ''">
            <label>Number of young women in the cooperative</label>
            <a-input v-model="editData.nbrJFemme" />
          </p>
          <p v-if="editData.typeOpa != ''">
            <label>What services do you provide to your members?</label>
            <a-input v-model="editData.services" />
          </p>
          <p v-if="editData.typeOpa != ''">
            <label>What are the sectors on which the OPA is positioned?</label>
            <a-select
              v-model="editData.position"
              show-search
              placeholder="Select a Department"
              option-filter-prop="children"
              style="width: 100%"
              :filter-option="
                (input, option) =>
                  option.componentOptions.children[0].text
                    .toLowerCase()
                    .includes(input.toLowerCase())
              "
            >
              <a-select-option v-for="(pos, i) in positions" :value="pos" :key="i">
                {{ pos }}
              </a-select-option>
            </a-select>
          </p>
          <p>
            <label>Does the OPA have a management committee?</label>
            <a-radio-group v-model="editData.gestionOpa" style="width: 100%">
              <a-radio :style="radioStyle" value="oui">Yes</a-radio>
              <a-radio :style="radioStyle" value="non">No</a-radio>
            </a-radio-group>
          </p>
          <p>
            <label>Does the OPA have a board of directors?</label>
            <a-radio-group v-model="editData.administrationOpa" style="width: 100%">
              <a-radio :style="radioStyle" value="oui">Yes</a-radio>
              <a-radio :style="radioStyle" value="non">No</a-radio>
            </a-radio-group>
          </p>
          <p v-if="editData.typeOpa != ''">
            <label>Does the OPA have a supervisory board or commission?</label>
            <a-radio-group v-model="editData.surveillanceOpa" style="width: 100%">
              <a-radio :style="radioStyle" value="oui">Yes</a-radio>
              <a-radio :style="radioStyle" value="non">No</a-radio>
            </a-radio-group>
          </p>
          <p>
            <label>Does the OPA have an Executive Board?</label>
            <a-radio-group v-model="editData.bureauOpa" style="width: 100%">
              <a-radio :style="radioStyle" value="oui">Yes</a-radio>
              <a-radio :style="radioStyle" value="non">No</a-radio>
            </a-radio-group>
          </p>
  
        </div>
  
        <template #footer >
          <a-button key="back" @click="handleEditNext" v-if="currentEdit==0">Next</a-button>
          <a-button key="back" @click="handleEditPrevious" v-if="currentEdit==1">Previous</a-button>
          <a-button key="submit" type="primary" :loading="loadingEdit" @click="handleEditOrg" v-if="currentEdit==1">Submit</a-button>
        </template>
       
      </a-modal>
  
  
      <a-modal v-model="openInfoOrg"
        width="1000px"
        title="View Actor">
        <CardBillingInfoOrg :info="viewData" @handleDeleteInfo="handleDeleteInfo" @handleEditInfo="handleEditInfo"></CardBillingInfoOrg>
  
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
            :data="table2Data"
            :columns="table2Columns"
            @openFunc="handleOpenFunc"
            @handleValidate="handleValidate"
            @handleDelete="handleDelete"
            @handleEdit="handleEdit"
            @handleView="handleView"
            @handleNotValidate="handleNotValidate"
            @handleAll="handleAll"  @search="handleSearch"
          ></CardProjectTable2>
          <!-- / Projects Table Column -->
        </a-col>
        <!-- / Projects Table Column -->
      </a-row>
      <!-- / Projects Table -->
    </div>
  </template>
  
  <script>
  import { mapGetters } from 'vuex';
  import { InboxOutlined } from '@ant-design/icons-vue';
  import { message } from 'ant-design-vue';
  import Steps from "./Steps.vue";
  
  // "Authors" table component.
  import CardAuthorTable from "../components/Cards/CardAuthorTable";
  
  // "Projects" table component.
  import CardProjectTable2 from "../components/Cards/CardProjectTableActor";
  
  import CardBillingInfoOrg from "../components/Cards/CardBillingInfoOrg"
  
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
      title: "Name",
      dataIndex: "name",
      class: "font-semibold text-muted",
    },
    {
      title: "Genre",
      dataIndex: "genre",
      class: "font-semibold text-muted text-sm",
    },
    {
      title: "Age",
      dataIndex: "age",
      class: "font-semibold text-muted text-sm",
    },
    {
      title: "Langue",
      dataIndex: "langue",
      class: "font-semibold text-muted text-sm",
    },
    {
      title: "Niveau",
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
      CardBillingInfoOrg,
      Steps,
      InboxOutlined,
    },
    data() {
      return {
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
        compagny_id: ""
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
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      };
    },
  },
    methods: {
        async handleRemove(){
           const res = await axios.post('/actor/delete-img', {photo: this.data.avatar})
           this.data.avatar = "";
        },
        // Handle upload change events
        handleChange(info) {
            const status = info.file.status;
            
            if (status === 'done') {
                this.fileList = [info.file]; // Restrict to a single file in the list
                
                // Access the image URL returned from the backend
                this.data.avatar =  info.file.response.image_url;
                message.success(`Image uploaded successfully. URL: ${this.data.avatar}`);
            } else if (status === 'error') {
                message.error(`${info.file.name} image upload failed.`);
            }
            },

    
    // Handle file drop event
    handleDrop(e) {
      console.log(e);
    },
    
    // Before uploading, validate if the file is an image and restrict to only one image
    beforeUpload(file) {
      const isImage = file.type.startsWith('image/');
      const isLt2M = file.size / 1024 / 1024 < 2; // Check if the file is less than 2MB
      
      if (!isImage) {
        message.error('You can only upload image files!');
        return false;
      }
      if (!isLt2M) {
        message.error('Image must be smaller than 2MB!');
        return false;
      }
      
      this.fileList = [file]; // Ensure only one file is in the list
      return true; // Proceed with the upload
    },
      handleNext(){
     this.current = 1;
      },
      handlePrevious(){
        this.current = 0;
      },
      handleEditNext(){
     this.currentEdit = 1;
      },
      handleEditPrevious(){
        this.currentEdit = 0;
      },
      handleSearch(value) {
        console.log('Recherche effectuée avec:', value);
        // Ajoutez votre logique de recherche ici
        if (value) {
          this.table2Data = this.filteredData.filter(item => {
              // Remplacez 'name' et 'description' par les propriétés que vous souhaitez filtrer
              return (
                item.denominationOpa.toLowerCase().includes(value.toLowerCase()) ||
                item.position.toLowerCase().includes(value.toLowerCase())
              );
            });
          } else {
            // Si aucune valeur de recherche, on réinitialise les données filtrées
            this.table2Data = this.filteredData;
          }
      },
      async handleDeleteInfo(row){
        this.table2Data = this.table2Data.filter((item) => item.id !== row.id);
        const res = await axios.post("/compagny/delete", row);
        this.openInfoOrg = false;
      },
      async handleEditInfo(row){
        this.editData = row;
        this.openInfoOrg = false;
        this.openEditOrg = true;
      },
      handleCancelInfo(){
        this.openInfoOrg = false;
      },
      handleView(row){
        this.viewData = row;
        this.openInfoOrg = true;
      },
      handleNotValidate() {
        this.table2Data = this.table2Data.filter((item) => item.state == "new");
      },
      async handleAll() {
        const resP = await axios.get("/compagny/paginate6");
        this.table2Data = resP.data.compagnies.data;
      },
      handleOpenFunc() {
        this.openOrg = true; // Met à jour opeOrg lorsque l'événement est reçu
      },
      async handleValidate(row) {
        row.state = "validated";
        const res = await axios.post("/compagny/validate", row);
        message.success('Organization successfully validated.', 5);
      },
      async handleDelete(row) {
        this.table2Data = this.table2Data.filter((item) => item.id !== row.id);
        const res = await axios.post("/compagny/delete", row);
        message.success('Organization successfully deleted.', 5);
      },
      handleEdit(row) {
        this.editData = row;
        this.openEditOrg = true;
      },
      async handleEditOrg() {
        this.loadingEdit = true;
        const res = await axios.post("/compagny/update", this.editData);
        this.openEditOrg = false;
        this.loadingEdit = false;
        message.success('Organization successfully edited.', 5);
      },
      async handleOkOrg() {
        this.loadingAdd = true;
        const res = await axios.post("/actor/create", this.data);
        if (res.status == 200) {
          this.table2Data = res.data.compagnies.data;
          this.loadingAdd = false;
          this.openOrg = false;
          message.success('Organization successfully registered.', 5);
        }
        this.loadingAdd = false;
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
      }
    },
    mounted() {
      this.inputRef = this.$refs.inputRef;
    },
  };
  </script>
  
  <style lang="scss" scoped>
  </style>