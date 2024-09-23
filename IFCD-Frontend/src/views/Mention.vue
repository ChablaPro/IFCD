<template>
  <div class="cgu-container">
    <h1 class="cgu-title">
      MENTION D’INFORMATION POUR LES SITES ET APPLICATIONS MOBILES
    </h1>

    <section class="cgu-section" id="article-1" style="min-height: 70vh">
      <p>
        Les données à caractère personnel collectées font l’objet d’un
        traitement dont le responsable est L’International Fertilizer
        Development Center -Bénin « IFDC-BENIN ».
      </p>
      <p>
        Ces données sont collectées pour créer et administrer votre compte et
        sont nécessaires à la fourniture et à l’utilisation des services offerts
        par nos services digitaux.
      </p>
      Elles sont destinées à IFDC-BENIN ainsi qu’aux prestataires externes
      auxquels le responsable de traitement fait appel.
      <p>
        Elles seront conservées pendant la durée nécessaire à la fourniture du
        service, et donc à votre utilisation du service, augmentée de la durée
        de conservation imposée par les règles applicables en matière de
        prescription légale.
      </p>
      <p>
        Conformément à la réglementation en vigueur en matière de protection des
        données personnelles, vous disposez d’un droit d’accès aux informations
        vous concernant, ainsi qu’un droit de rectification, d’opposition, de
        limitation du traitement et de suppression que vous pouvez exercer par
        mail en vous adressant à :
        <a href="mailto:ratinkpahoun@ifdc.org">ratinkpahoun@ifdc.org</a>, en
        précisant vos nom, prénom, adresse et en joignant une copie recto-verso
        de votre pièce d’identité.
      </p>
      <p>
        En cas de difficulté en lien avec la gestion de vos données
        personnelles, vous pouvez adresser une réclamation auprès de
        <a
          href="http://apdp.bj/wp-content/uploads/2018/11/Mod%C3%A8le-de-lettre-plainte-Valid%C3%A9.pdf"
          >l’Autorité de Protection des Données Personnelles APDP</a
        >.
      </p>
      <p>
        Pour en savoir plus sur la gestion de vos données personnelles
        reportez-vous à notre politique de confidentialité et de protection des
        données personnelles.
      </p>
    </section>
  </div>
</template>

<script>
export default {
  name: "CguPage",
};
</script>

<style scoped>
.cgu-container {
  padding: 20px;
  font-family: Arial, sans-serif;
  line-height: 1.6;
  background-color: #f9f9f9;
  color: #333;
}

.cgu-title {
  font-size: 24px;
  text-align: center;
  margin-bottom: 20px;
  color: #004080;
}

.cgu-section {
  margin-bottom: 20px;
  padding: 10px;
  background: white;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.cgu-section h2 {
  font-size: 18px;
  margin-bottom: 10px;
  color: #0073e6;
}

.cgu-section h3 {
  font-size: 16px;
  margin-bottom: 10px;
}

.cgu-section p {
  margin: 5px 0;
}

.cgu-section ul {
  padding-left: 20px;
}

.cgu-section ul li {
  list-style-type: disc;
}

a {
  color: #0073e6;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}
</style>
