<!-- 
	This is the tables page, it uses the dashboard layout in: 
	"./layouts/Dashboard.vue" .
 -->

<template>
  <div>
    <a-modal v-model="openOrg" width="1000px" title="Add Organisation">
      <p>
        <Steps :current="current" />
      </p>
      <div v-if="current == 0">
        <p>
          <label>Year of collection</label>
          <a-select
            v-model="data.yearOrg"
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
          <a-radio-group v-model="data.newOPAOrg" style="width: 100%">
            <a-radio :style="radioStyle" value="oui">Yes</a-radio>
            <a-radio :style="radioStyle" value="non">No</a-radio>
          </a-radio-group>
        </p>
          <Row :gutter="16">
            <Col span="12">
                <div>
                  <p>
                    <label>Department</label>
                    <a-select
                      v-model="data.depOrg"
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
                </div>
            </Col>
            <Col span="12">
                <div>
                  <p>
                    <label>Commune</label>
                    <a-select
                      v-model="data.comOrg"
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
                  </p>
                </div>
            </Col>
          </Row>
          
          <Row :gutter="16">
            <Col span="12">
                <div>
                  <p>
                    <label>Borough</label>
                    <a-select
                      v-model="data.arrOrg"
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
                </div>
            </Col>
            <Col span="12">
                <div>
                  <p>
                    <label>Village</label>
                    <a-select
                      v-model="data.vilOrg"
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
                </div>
            </Col>
          </Row>
        
        
        <p>
          <label>Address/House</label>
          <a-input v-model="data.addressOrg" />
        </p>

        <p>
          <label>King of OPA</label>
          <a-select v-model="data.typeOPA" style="width: 100%" @focus="focus">
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
        <p v-if="data.typeOPA == 'Coopérative'">
          <label>Legal status</label>
          <a-select
            v-model="data.jurOrg"
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
            <a-select-option
              v-for="(jur, i) in juridiques"
              :value="jur"
              :key="i"
            >
              {{ jur }}
            </a-select-option>
          </a-select>
        </p>
        <p v-if="data.typeOPA != ''">
          <label>Name of the OPA</label>
          <a-input v-model="data.nameOPAOrg" />
        </p>
        <p v-if="data.typeOPA != ''">
          <label>Creation date</label>
          <a-date-picker v-model="data.dateOPAOrg" style="width: 100%" />
        </p>
        <p v-if="data.typeOPA != ''">
          <label>Contact person</label>
          <a-input v-model="data.contactOPAOrg" />
        </p>
        <p v-if="data.typeOPA != ''">
          <label>Contact</label>
          <a-input v-model="data.contactOrg" />
        </p>
        <p v-if="data.typeOPA != ''">
          <label>E-mail</label>
          <a-input v-model="data.emailOrg" />
        </p>
        <p>
          <label>Maillons</label>
          <a-select
            v-model="data.maiOrg"
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

      <div v-if="current == 1">
        <p v-if="data.typeOPA != ''">
          <label>Total cooperative members</label>
          <a-input-number
            min="1"
            style="width: 100%"
            v-model="data.totalMemberOrg"
          />
        </p>
        <p v-if="data.typeOPA != ''">
          <label>Number of men in the cooperative</label>
          <a-input-number
            min="1"
            :max="data.totalMemberOrg"
            style="width: 100%"
            v-model="data.totalMenOrg"
          />
        </p>
        <p v-if="data.typeOPA != ''">
          <label>Number of women in the cooperative</label>
          <a-input-number
            min="0"
            :max="data.totalMemberOrg - data.totalMenOrg"
            style="width: 100%"
            v-model="data.totalWomenOrg"
          />
        </p>
        <p v-if="data.typeOPA != ''">
          <label>Number of young men in the cooperative</label>
          <a-input-number
            min="0"
            :max="data.totalMemberOrg - (data.totalMenOrg + data.totalWomenOrg)"
            style="width: 100%"
            v-model="data.totalYMenOrg"
          />
        </p>
        <p v-if="data.typeOPA != ''">
          <label>Number of young women in the cooperative</label>
          <a-input-number
            min="0"
            :max="
              data.totalMemberOrg -
              (data.totalMenOrg + data.totalWomenOrg + data.totalYMenOrg)
            "
            style="width: 100%"
            v-model="data.totalYWomenOrg"
          />
        </p>
        <p v-if="data.typeOPA != ''">
          <label>What services do you provide to your members?</label>
          <a-input v-model="data.serviceOrg" />
        </p>
        <p v-if="data.typeOPA != ''">
          <label>What are the sectors on which the OPA is positioned?</label>
          <a-select
            v-model="data.posOrg"
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
              v-for="(pos, i) in positions"
              :value="pos"
              :key="i"
            >
              {{ pos }}
            </a-select-option>
          </a-select>
        </p>
        <p>
          <label>Does the OPA have a management committee?</label>
          <a-radio-group v-model="data.manageOPA" style="width: 100%">
            <a-radio :style="radioStyle" value="oui">Yes</a-radio>
            <a-radio :style="radioStyle" value="non">No</a-radio>
          </a-radio-group>
        </p>
        <p>
          <label>Does the OPA have a board of directors?</label>
          <a-radio-group v-model="data.boardOPA" style="width: 100%">
            <a-radio :style="radioStyle" value="oui">Yes</a-radio>
            <a-radio :style="radioStyle" value="non">No</a-radio>
          </a-radio-group>
        </p>
        <p v-if="data.typeOPA != ''">
          <label>Does the OPA have a supervisory board or commission?</label>
          <a-radio-group v-model="data.commissionOPA" style="width: 100%">
            <a-radio :style="radioStyle" value="oui">Yes</a-radio>
            <a-radio :style="radioStyle" value="non">No</a-radio>
          </a-radio-group>
        </p>
        <p>
          <label>Does the OPA have an Executive Board?</label>
          <a-radio-group v-model="data.executiveOPA" style="width: 100%">
            <a-radio :style="radioStyle" value="oui">Yes</a-radio>
            <a-radio :style="radioStyle" value="non">No</a-radio>
          </a-radio-group>
        </p>
      </div>

      <template #footer>
        <a-button key="back" @click="handleNext" v-if="current == 0"
          >Next</a-button
        >
        <a-button key="back" @click="handlePrevious" v-if="current == 1"
          >Previous</a-button
        >
        <a-button
          key="submit"
          type="primary"
          :loading="loadingAdd"
          @click="handleOkOrg"
          v-if="current == 1"
          >Submit</a-button
        >
      </template>
    </a-modal>

    <a-modal v-model="openEditOrg" width="1000px" title="Edit Organisation">
      <p>
        <Steps :current="currentEdit" />
      </p>
      <div v-if="currentEdit == 0">
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
          <label>Borough</label>
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
          <label>Kind of OPA</label>
          <a-select
            v-model="editData.typeOpa"
            style="width: 100%"
            @focus="focus"
          >
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
            <a-select-option
              v-for="(jur, i) in juridiques"
              :value="jur"
              :key="i"
            >
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
          <label>Links</label>
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

      <div v-if="currentEdit == 1">
        <p v-if="editData.typeOPA != ''">
          <label>Total cooperative members</label>
          <a-input-number
            min="1"
            style="width: 100%"
            v-model="editData.totalMembre"
          />
        </p>
        <p v-if="editData.typeOPA != ''">
          <label>Number of men in the cooperative</label>
          <a-input-number
            min="1"
            style="width: 100%"
            v-model="editData.nbrHomme"
          />
        </p>
        <p v-if="editData.typeOPA != ''">
          <label>Number of women in the cooperative</label>
          <a-input-number
            min="0"
            style="width: 100%"
            v-model="editData.nbrFemme"
          />
        </p>
        <p v-if="editData.typeOPA != ''">
          <label>Number of young men in the cooperative</label>
          <a-input-number
            min="0"
            style="width: 100%"
            v-model="editData.nbrJHomme"
          />
        </p>
        <p v-if="editData.typeOPA != ''">
          <label>Number of young women in the cooperative</label>
          <a-input-number
            :min="0"
            style="width: 100%"
            v-model="editData.nbrJFemme"
          />
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
            <a-select-option
              v-for="(pos, i) in positions"
              :value="pos"
              :key="i"
            >
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
          <a-radio-group
            v-model="editData.administrationOpa"
            style="width: 100%"
          >
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

      <template #footer>
        <a-button key="back" @click="handleEditNext" v-if="currentEdit == 0"
          >Next</a-button
        >
        <a-button key="back" @click="handleEditPrevious" v-if="currentEdit == 1"
          >Previous</a-button
        >
        <a-button
          key="submit"
          type="primary"
          :loading="loadingEdit"
          @click="handleEditOrg"
          v-if="currentEdit == 1"
          >Submit</a-button
        >
      </template>
    </a-modal>

    <a-modal v-model="openInfoOrg" width="1000px" title="View Organisation">
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
import { message } from "ant-design-vue";
import Steps from "./Steps.vue";

// "Authors" table component.
import CardAuthorTable from "../components/Cards/CardAuthorTable";

// "Projects" table component.
import CardProjectTable2 from "../components/Cards/CardProjectTable2";

import CardBillingInfoOrg from "../components/Cards/CardBillingInfoOrg";

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
    title: "Organization",
    dataIndex: "denominationOpa",
    scopedSlots: { customRender: "denominationOpa" },
    width: 300,
  },
  {
    title: "Kind",
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
    title: "Creation date",
    dataIndex: "created_at",
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
  },
  data() {
    return {
      anim: true,
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
        user_id: 0,
        typeOPA: "",
        addressOrg: "",
        nameOPAOrg: "",
        dateOPAOrg: "",
        contactOPAOrg: "",
        contactOrg: "",
        emailOrg: "",
        totalMemberOrg: "",
        totalMenOrg: "",
        totalWomenOrg: "",
        totalYMenOrg: "",
        totalYWomenOrg: "",
        serviceOrg: "",
        manageOPA: "non",
        boardOPA: "non",
        executiveOPA: "non",
        commissionOPA: "non",
        yearOrg: "",
        depOrg: "",
        comOrg: "",
        arrOrg: "",
        vilOrg: "",
        maiOrg: "",
        jurOrg: "",
        posOrg: "",

        newOPAOrg: "oui",
      },

      departs: [],
      communes: [],
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
  methods: {
    formatDate(dateString) {
      const inputDate = new Date(dateString);
      const year = inputDate.getFullYear();
      const month = String(inputDate.getMonth() + 1).padStart(2, "0"); // Mois en entier, ajoute un zéro initial si < 10
      const day = String(inputDate.getDate()).padStart(2, "0"); // Ajoute un zéro initial si le jour est < 10

      return `${year}-${month}-${day}`;
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
      const res = await axios.post("/compagny/validate", row);
      message.success("Organization successfully validated.", 5);
    },
    async handleDelete(row) {
      this.table2Data = this.table2Data.filter((item) => item.id !== row.id);
      const res = await axios.post("/compagny/delete", row);
      message.success("Organization successfully deleted.", 5);
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
      this.currentEdit= 0;
      message.success("Organization successfully edited.", 5);
    },
    async handleOkOrg() {
      this.loadingAdd = true;
      try {
        const res = await axios.post("/compagny/create", this.data);
        if (res.status == 200) {
          this.current = 0;
          this.table2Data = res.data.compagnies.data.map((company) => {
            return {
              ...company,
              created_at: this.formatDate(company.created_at), // Formate l'attribut date
            };
          });
          this.data = {
            user_id: 0,
            typeOPA: "",
            addressOrg: "",
            nameOPAOrg: "",
            dateOPAOrg: "",
            contactOPAOrg: "",
            contactOrg: "",
            emailOrg: "",
            totalMemberOrg: "",
            totalMenOrg: "",
            totalWomenOrg: "",
            totalYMenOrg: "",
            totalYWomenOrg: "",
            serviceOrg: "",
            manageOPA: "non",
            boardOPA: "non",
            executiveOPA: "non",
            commissionOPA: "non",
            yearOrg: "",
            depOrg: "",
            comOrg: "",
            arrOrg: "",
            vilOrg: "",
            maiOrg: "",
            jurOrg: "",
            posOrg: "",

            newOPAOrg: "oui",
          };
          this.loadingAdd = false;
          this.openOrg = false;
          message.success("Organization successfully registered.", 5);
        }
        this.loadingAdd = false;
      } catch (error) {
        this.loadingAdd = false;
        message.error("Vérifiez vos champs.", 5);
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
    const res = await axios.get("/compagny/utilities");
    const resP = await axios.get("/compagny/paginate6");

    if (res.status == 200) {
      this.departs = res.data.departs.map((depart) => depart.name);
      this.communes = res.data.communes.map((com) => com.name);
      this.arrondissements = res.data.arrondissements.map((arr) => arr.name);
      this.villages = res.data.villages.map((vill) => vill.name);
      this.maillons = res.data.maillons.map((mail) => mail.name);
      this.juridiques = res.data.juris.map((jur) => jur.name);
      this.positions = res.data.positions.map((position) => position.name);
    }

    if (resP.status == 200) {
      this.table2Data = resP.data.compagnies.data.map((company) => {
        return {
          ...company,
          created_at: this.formatDate(company.created_at), // Formate l'attribut date
        };
      });

      console.log(this.table2Data);
      this.filteredData = resP.data.compagnies.data.map((company) => {
        return {
          ...company,
          created_at: this.formatDate(company.created_at), // Formate l'attribut date
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