<template>
    <div :id="mapId" :style="{ height: isModal ? '100vh' : '100vh' }"></div>
  </template>
  
  <script>
  import 'leaflet/dist/leaflet.css';
  import L from 'leaflet';
  
  export default {
    name: 'MapComponent',
    props: {
      locations: {
        type: Array,
        required: true
      },
      isModal: {
        type: Boolean,
        default: false
      }
    },
    data() {
      return {
        myMap: null,
        mapId: 'map-' + Math.random().toString(36).substr(2, 9)
      };
    },
    mounted() {
      this.initializeMap();
    },
    beforeUnmount() {
      this.destroyMap();
    },
    methods: {
      initializeMap() {
        this.destroyMap(); // Ensure the map is destroyed before initializing
  
        let initialView = [51.505, -0.09];
  
        if (this.locations.length > 0 && this.locations[0].latitude && this.locations[0].longitude) {
          initialView = [this.locations[0].latitude, this.locations[0].longitude];
        }
  
        this.myMap = L.map(this.mapId).setView(initialView, 13);
  
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(this.myMap);
  
        this.locations.forEach(location => {
          if (location.latitude && location.longitude) {
            const marker = L.marker([location.latitude, location.longitude]).addTo(this.myMap);
            marker.bindPopup(this.getPopupContent(location));
          }
        });
      },
      destroyMap() {
        if (this.myMap) {
          this.myMap.off();
          this.myMap.remove();
          this.myMap = null;
        }
      },
      getPopupContent(location) {
        const directionsUrl = this.getDirectionsUrl(location.latitude, location.longitude);
        return `
          <b>${location.name}</b><br>
          ${location.address}<br>
          <a href="${directionsUrl}" target="_blank">Get Directions</a>
        `;
      },
      getDirectionsUrl(latitude, longitude) {
        return `https://www.google.com/maps/dir/?api=1&destination=${latitude},${longitude}`;
      }
    }
  };
  </script>
  
  <style>
  #map {
    width: 100%;
    height:100vh;
  }
  </style>
  