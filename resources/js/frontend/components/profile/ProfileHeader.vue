<template>
    <div class="profile-header">
      <img :src="business.cover_photo_url" alt="Cover Photo" class="cover-photo">
      <div class="profile-info">
        <img :src="business.profile_picture_url" alt="Profile Picture" class="profile-picture">
        <div class="info">
          <h1>{{ business.name }}</h1>
          <p>{{ business.slogan }}</p>
        </div>
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
  /* Add styles for profile header */
  </style>
  