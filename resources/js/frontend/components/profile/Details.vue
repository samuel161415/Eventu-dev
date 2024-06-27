<template>
    <div class="details">
      <div class="essentials">
        <h2>Esentiale</h2>
        <p>Oras: {{ business.city }}</p>
        <p>Zona: {{ business.district }}</p>
        <p>Adresa: {{ business.address }}</p>
        <p>Specific: Traditional</p>
      </div>
      <div class="description">
        <h2>Descriere</h2>
        <p>{{ business.short_description }}</p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      business: Object
    }
  };
  </script>
  
  <style scoped>
  /* Add styles for details */
  </style>
  