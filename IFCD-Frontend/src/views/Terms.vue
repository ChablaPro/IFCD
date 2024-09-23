<template>
  <div class="privacy-policy">
    <h1 class="policy-title">
      POLITIQUE DE CONFIDENTIALITÉ ET DE PROTECTION DES DONNÉES À CARACTÈRE
      PERSONNEL IFDC
    </h1>
    <p class="update-date">Mise à jour : 12 juillet 2022</p>

    <div class="table-of-contents">
      <h2>SOMMAIRE</h2>
      <ul>
        <li v-for="(item, index) in tableOfContents" :key="index">
          <a :href="'#' + item.anchor">{{ index + 1 }}. {{ item.title }}</a>
        </li>
      </ul>
    </div>

    <section
      v-for="(section, index) in sections"
      :key="index"
      :id="section.anchor"
      class="section"
    >
      <h2>{{ section.title }}</h2>
      <p v-for="(paragraph, pIndex) in section.content" :key="pIndex">
        {{ paragraph }}
      </p>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tableOfContents: [
        { title: "PREAMBULE", anchor: "preamble" },
        { title: "DEFINITIONS", anchor: "definitions" },
        { title: "RESPONSABLE DE TRAITEMENT", anchor: "dataController" },
        {
          title: "DELEGUE A LA PROTECTION DES DONNEES",
          anchor: "dataProtectionOfficer",
        },
        // Ajoutez d'autres éléments de votre sommaire ici
      ],
      sections: [
        {
          title: "PREAMBULE",
          anchor: "preamble",
          content: [
            `Dans le cadre de ses activités, L’International Fertilizer Development Center BENIN a initié le programme APPROCHE COMMUNALE POUR LE MARCHE AGRICOLE au Bénin. Pour réaliser les objectifs du programme, IFDC-BENIN collecte et traite vos données à caractère personnel...`,
            `Le présent document est délivré à titre indicatif et a pour but d’expliquer les principes et les engagements de IFDC-BENIN en matière de protection des Données à caractère personnel.`,
          ],
        },
        {
          title: "DEFINITIONS",
          anchor: "definitions",
          content: [
            "Chaque terme débutant par une majuscule a le sens qui lui est donné ci-après :",
            "1. « Politique de confidentialité et de protection des Données à Caractère Personnel » ...",
            // Ajoutez plus de contenu si nécessaire
          ],
        },
        {
          title: "RESPONSABLE DE TRAITEMENT",
          anchor: "dataController",
          content: [
            "Conformément à l’article 1er du Code du numérique, L’International Fertilizer Development Center -Bénin (ci-après « IFDC-BENIN ») ...",
          ],
        },
        {
          title: "DELEGUE A LA PROTECTION DES DONNEES",
          anchor: "dataProtectionOfficer",
          content: [
            "L’International Fertilizer Development Center a désigné et notifié à l’Autorité de Protection des Données Personnelles (APDP) un délégué à la protection des données personnelles (ci-après « DPO ») en la personne de : RACHELLE ATINKPAHOUN.",
          ],
        },
        // Ajoutez d'autres sections ici
      ],
    };
  },
};
</script>

<style scoped>
.privacy-policy {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

.policy-title {
  text-align: center;
  font-weight: bold;
}

.update-date {
  text-align: center;
  font-style: italic;
  color: gray;
}

.table-of-contents {
  margin: 20px 0;
}

.table-of-contents ul {
  list-style: none;
  padding: 0;
}

.table-of-contents li {
  margin: 5px 0;
}

.section {
  margin: 20px 0;
}

.section h2 {
  margin-top: 20px;
  color: #333;
}

.section p {
  line-height: 1.6;
}
</style>
