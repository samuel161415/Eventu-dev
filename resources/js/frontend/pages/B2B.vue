<template>
    <div class="b2b-page">
      <FrontendHeader />
      <div class="header-section bg-black text-white px-8 pt-16 pb-0">
        <div class="container mx-auto flex flex-col lg:flex-row items-center">
          <div class="title-section lg:ml-8">
            <h1 class="text-4xl font-bold mb-4">Descopera oportunitati nelimitate pentru afacerea ta!</h1>
            <p class="text-lg">Locul ideal pentru a creste vizibilitatea afacerii tale din industria evenimentelor este aici.</p>
          </div>
          <div class="cf-section bg-white text-black rounded-t-2xl px-4 py-12 mt-8 pb-20 lg:mt-0 lg:ml-auto">
            <form class="space-y-4">
              <div class="flex flex-col lg:flex-row gap-4">
                <input type="text" placeholder="Nume + Prenume"
                  class="b2b-form-input w-full lg:w-1/2 p-2 rounded-lg border-b-4 border-gray-300">
                <input type="text" placeholder="Website"
                  class="b2b-form-input w-full lg:w-1/2 p-2 rounded-lg">
              </div>
              <div class="flex flex-col lg:flex-row gap-4">
                <input type="text" placeholder="Numar Telefon"
                  class="b2b-form-input w-full lg:w-1/2 p-2 rounded-lg">
                <input type="email" placeholder="Adresa Mail"
                  class="b2b-form-input w-full lg:w-1/2 p-2 rounded-lg">
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="terms" class="mr-2">
                <label for="terms" class="text-sm text-gray-500">Sunt de acord cu termenii si conditiile Eventu.</label>
              </div>
              <button type="submit"
                class="bg-white text-purple-700 font-bold py-2 px-4 rounded-lg underline underline-offset-4">Trimite!</button>
            </form>
          </div>
        </div>
      </div>
      <div class="stats-section bg-white pb-2 pt-16">
        <div class="container mx-auto flex flex-wrap justify-between text-center">
          <div class="stat-item flex-1 p-4">
            <img src="/images/b2b/phone-icon.png" alt="Phone Icon" class="w-12 mx-auto">
            <h3 class="text-purple-700 text-2xl font-bold">50 K</h3>
            <p class="text-gray-600 font-bold">LEAD-URI Generate Anual</p>
          </div>
          <div class="stat-item flex-1 p-4">
            <img src="/images/b2b/experienta-icon.png" alt="Experience Icon" class="w-12 mx-auto">
            <h3 class="text-purple-700 text-2xl font-bold">10 ANI</h3>
            <p class="text-gray-600 font-bold">EXPERIENTA in industrie</p>
          </div>
          <div class="stat-item flex-1 p-4">
            <img src="/images/b2b/trafic-icon.png" alt="Traffic Icon" class="w-12 mx-auto">
            <h3 class="text-purple-700 text-2xl font-bold">25 K</h3>
            <p class="text-gray-600 font-bold">TRAFIC lunar pe platforma</p>
          </div>
          <div class="stat-item flex-1 p-4">
            <img src="/images/b2b/audienta-icon.png" alt="Audience Icon" class="w-12 mx-auto">
            <h3 class="text-purple-700 text-2xl font-bold">100%</h3>
            <p class="text-gray-600 font-bold">AUDIENTA specifica industriei</p>
          </div>
        </div>
      </div>
      <div class="features-section py-8">
        <div class="container mx-auto mb-8">
          <div class="feature-item flex flex-col lg:flex-row items-center my-16">
            <div class="text-section lg:w-1/2 text-left">
              <h2 class="text-2xl font-bold mb-4">Modifica anuntul in timp real.</h2>
              <p class="text-lg mb-4">Prin modificarea anuntului în timp real, puteți testa și optimiza constant strategiile și mesajele de marketing crescand astfel numarul de cereri primite.</p>
              <a href="#" class="text-purple-700 font-bold">Creeaza un anunt!</a>
            </div>
            <div class="image-section lg:w-1/2 flex justify-center my-12">
              <img src="/images/b2b/ipad.png" alt="Ipad" class="w-auto iphone">
            </div>
          </div>
  
          <div class="feature-item flex flex-col lg:flex-row-reverse items-center mt-16 mb-4">
            <div class="text-section lg:w-1/2 text-left">
              <h2 class="text-2xl font-bold mb-4">Panou de control de business.</h2>
              <p class="text-lg mb-4">Actualizează, personalizează și gestionează informațiile despre serviciile tale în timp real. Astfel te asiguri că ești mereu vizibil pentru clientii din cadrul platformei.</p>
              <a href="#" class="text-purple-700 font-bold">Incepe sa primesti cereri!</a>
            </div>
            <div class="image-section lg:w-1/2 flex justify-center">
              <img src="/images/b2b/iphone.png" alt="Phone Image" class="w-auto my-12 iphone">
            </div>
          </div>
        </div>
        <div class="my-10">
          <FeatureSlider :features="features" />
        </div>
      </div>
      <div class="cta-section bg-purple-700 text-white py-8">
        <div class="container mx-auto flex flex-col lg:flex-row items-center">
          <div class="image-section lg:w-1/2">
            <img src="/images/b2b/meeting.png" alt="Meeting Image" class="w-full rounded-lg">
          </div>
          <div class="form-section lg:w-1/2 lg:ml-8 mt-8 lg:mt-0 bg-white rounded-lg p-8">
            <h2 class="text-3xl font-bold mb-4 text-gray-950">Incepe chiar astazi!</h2>
            <form class="space-y-4">
              <div class="flex flex-col lg:flex-row gap-4">
                <input type="text" placeholder="Nume + Prenume"
                  class="b2b-form-input w-full lg:w-1/2 p-2 rounded-lg border-b-4 border-gray-300">
                <input type="text" placeholder="Website"
                  class="b2b-form-input w-full lg:w-1/2 p-2 rounded-lg">
              </div>
              <div class="flex flex-col lg:flex-row gap-4">
                <input type="text" placeholder="Numar Telefon"
                  class="b2b-form-input w-full lg:w-1/2 p-2 rounded-lg">
                <input type="email" placeholder="Adresa Mail"
                  class="b2b-form-input w-full lg:w-1/2 p-2 rounded-lg">
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="terms" class="mr-2">
                <label for="terms" class="text-sm text-gray-500">Sunt de acord cu termenii si conditiile Eventu.</label>
              </div>
              <button type="submit"
                class="bg-white text-purple-700 font-bold py-2 px-4 rounded-lg underline underline-offset-4">Trimite!</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <Footer :isHomepage="false" />

  </template>
  
  <script>
  import FeatureSlider from '../components/FeatureSlider.vue';
  import FrontendHeader from '../components/Header.vue';
  import Footer from '../components/Footer.vue';


  export default {
    components: {
      FeatureSlider,
      FrontendHeader,
      Footer,
    },
    data() {
      return {
        features: [
          {
            title: 'Cereri de oferta personalizate!',
            description: 'Identifica rapid cererile de oferta venite de la noi.',
            image: '/images/b2b/slide-1.png',
          },
          {
            title: 'Transparenta in rezultate!',
            description: 'Interfata noastra de business iti ofera date clare despre anunturile tale.',
            image: '/images/b2b/slide-2.png',
          },
          {
            title: 'Te includem in articolele de blog!',
            description: 'Urca mai usor in pozitiile din Google cu ajutorul articolelor noastre.',
            image: '/images/b2b/slide-3.png',
          },
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  .header-section {
    background-color: #000;
    text-align: center;
    color: #fff;
  }
  .header-section img {
  max-width: 150px;
}

.header-section h1 {
  font-size: 2rem;
  margin: 1rem 0;
}

.header-section p {
  font-size: 1.2rem;
  margin-bottom: 2rem;
}

.header-section .cta-button {
  background-color: #8224e3;
  color: #fff;
  padding: 0.75rem 1.5rem;
  border-radius: 0.5rem;
  text-decoration: none;
  font-weight: bold;
}

.stats-section {
  display: flex;
  justify-content: space-around;
  /* padding: 2rem; */
  background-color: #fff;
}

.stats-box {
  text-align: center;
}

.stats-box h2 {
  font-size: 1.5rem;
  color: #8224e3;
}

.stats-box p {
  font-size: 1rem;
  margin-top: 0.5rem;
}

.b2b-form-input {
  outline: none !important;
  border-bottom: 2px solid #8224e3 !important;
}

.features-section {
  padding: 2rem;
  text-align: center;
}

.features-section h2 {
  font-size: 2rem;
  margin-bottom: 1rem;
}

.features-section p {
  font-size: 1.2rem;
  margin-bottom: 2rem;
}

.features-section img {
  max-width: 100%;
  max-height: 25rem !important;
}

.feature-box {
  display: flex;
  align-items: center;
  margin-bottom: 2rem;
}

.feature-box img {
  max-width: 150px;
  margin-right: 1rem;
}

.feature-box h3 {
  font-size: 1.5rem;
  margin-bottom: 0.5rem;
}

.feature-box p {
  font-size: 1rem;
}

.cta-section {
  background-color: #8224e3;
  color: #fff;
  text-align: center;
  padding: 2rem;
}

.cta-section h2 {
  font-size: 2rem;
  margin-bottom: 1rem;
}

.cta-section p {
  font-size: 1.2rem;
  margin-bottom: 2rem;
}

.cta-section input[type="text"],
.cta-section input[type="email"],
.cta-section input[type="tel"] {
  padding: 0.75rem;
  margin-bottom: 1rem;
  border-radius: 0.5rem;
  border: none;
  display: inline-block;
}

.cta-section input[type="checkbox"] {
  margin-right: 0.5rem;
}

.cta-section button {
  background-color: #fff;
  color: #8224e3;
  padding: 0.75rem 1.5rem;
  border-radius: 0.5rem;
  border: none;
  font-weight: bold;
}

.cta-section .checkbox-container {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1rem;
}
</style>
