<template>
	<div class="dashboard-page">
	  <FrontendHeader />
	  <section>
		<main>
		  <div class="dashboard-nav w-full">
			<nav class="max-w-7xl mx-auto">
			  <ul>
				<li :class="{ active: activeTab === 'Dashboard' }" @click="setActiveTab('Dashboard')">Dashboard</li>
				<li :class="{ active: activeTab === 'Listările mele' }" @click="setActiveTab('Listările mele')">Listările mele</li>
				<li :class="{ active: activeTab === 'Account details' }" @click="setActiveTab('Account details')">Detalii Cont</li>
			  </ul>
			</nav>
		  </div>
		  <div class="dashboard-content w-full p-6 bg-gray-100">
			<div v-if="activeTab === 'Dashboard'" class="max-w-7xl mx-auto">
			  <div class="stats flex justify-between mb-6">
				<div class="stat-box purple">
				  <div class="count">{{ publishedListings }}</div>
				  <div class="label">Listări publicate</div>
				</div>
				<div class="stat-box purple">
				  <div class="count">{{ pendingListings }}</div>
				  <div class="label">Listări în așteptare</div>
				</div>
				<div class="stat-box purple">
				  <div class="count">{{ activePromotions }}</div>
				  <div class="label">Promoții active</div>
				</div>
				<div class="stat-box blue">
				  <div class="count">{{ totalViews }}</div>
				  <div class="label">Vizite săptămâna aceasta</div>
				</div>
			  </div>
			  <div class="charts grid grid-cols-1 md:grid-cols-3 gap-6">
				<div class="col">
				  <div class="chart">
					<div class="chart-header">Vizualizări</div>
					<div class="chart-body">{{ totalViews }}</div>
				  </div>
				  <div class="chart">
					<div class="chart-header">Vizualizări unice</div>
					<div class="chart-body">{{ totalUniqueViews }}</div>
				  </div>
				  <div class="chart">
					<div class="chart-header">Clicuri pe buton</div>
					<div class="chart-body">{{ buttonClicks }}</div>
				  </div>
				  <div class="chart">
					<div class="chart-header">Vizite</div>
					<div class="chart-body">{{ totalViews }}</div>
				  </div>
				  <div class="chart">
					<div class="chart-header">Dispozitive</div>
					<div class="chart-body">{{ devices }}</div>
				  </div>
				  <div class="chart">
					<div class="chart-header">Referenți de top</div>
					<div class="chart-body">{{ topReferrers }}</div>
				  </div>
				</div>
				<div class="col-span-2">
				  <div class="chart">
					<div class="chart-header">Vizite</div>
					<LineChart :chartData="chartData" :chartOptions="chartOptions" />
				  </div>
				  <div class="chart">
					<div class="chart-header">Platforme de top</div>
					<div class="chart-body">{{ topPlatforms }}</div>
				  </div>
				  <div class="chart">
					<div class="chart-header">Browsere de top</div>
					<div class="chart-body">{{ topBrowsers }}</div>
				  </div>
				</div>
			  </div>
			</div>
			<div v-if="activeTab === 'Listările mele'" class="max-w-7xl mx-auto">
			  <Listings :salons="salons" :foodMenus="foodMenus" />
			</div>
			<div v-if="activeTab === 'Account details'">
			  <div class="greeting">Conținutul detaliilor contului</div>
			</div>
		  </div>
		</main>
	  </section>
	  <Footer :isHomepage="false" />
	</div>
  </template>
  
  <script>
  import FrontendHeader from '../components/Header.vue';
  import Footer from '../components/Footer.vue';
  import LineChart from '../components/LineChart.vue';
  import Listings from '../components/listings/ListingIndex.vue';
  
  export default {
	name: 'UserDashboard',
	components: {
	  FrontendHeader,
	  Footer,
	  LineChart,
	  Listings,
	},
	props: {
	  business: {
		type: Object,
		required: true
	  },
	  salons: {
		type: Array,
		required: true
	  },
	  foodMenus: {
		type: Array,
		required: true
	  },
	  views: {
		type: Array,
		required: true
	  }
	},
	data() {
	  return {
		activeTab: 'Dashboard',
		chartData: {
		  labels: [], 
		  datasets: [
			{
			  label: 'Vizualizări',
			  backgroundColor: '#8224E3',
			  borderColor: '#8224E3',
			  data: [], 
			},
			{
			  label: 'Vizualizări unice',
			  backgroundColor: '#0076ff',
			  borderColor: '#0076ff',
			  data: [], 
			},
		  ],
		},
		chartOptions: {
		  responsive: true,
		  plugins: {
			legend: {
			  position: 'bottom',
			},
			title: {
			  display: true,
			  text: 'Vizite',
			},
		  },
		},
		publishedListings: 0,
		pendingListings: 0,
		activePromotions: 0,
		weeklyVisits: 0,
		totalViews: 0,
		totalUniqueViews: 0,
		buttonClicks: 0,
		totalVisits: 0,
		devices: 0,
		topReferrers: 0,
		topPlatforms: 0,
		topBrowsers: 0,
	  };
	},
	mounted() {
	  this.processViewsData();
	},
	created() {
	  this.processViewsData();
	},
	methods: {
	  setActiveTab(tab) {
		this.activeTab = tab;
	  },
	  processViewsData() {
		if (!this.views.length) return;
  
		// Filter views for the last 7 days
		const sevenDaysAgo = new Date();
		sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);
  
		const last7DaysViews = this.views.filter(view => {
		  const viewDate = new Date(view.date);
		  return viewDate >= sevenDaysAgo;
		});
  
		// Example calculations, adjust these as needed
		this.publishedListings = this.business.salons.length || 0;
		this.pendingListings = this.business.pendingListings || 0;
		this.activePromotions = this.business.activePromotions || 0;
		this.weeklyVisits = last7DaysViews.reduce((sum, view) => sum + view.visits, 0);
		this.totalViews = this.views.reduce((sum, view) => sum + view.views, 0);
		this.totalUniqueViews = this.views.reduce((sum, view) => sum + view.unique_views, 0);
		this.buttonClicks = this.business.buttonClicks || 0;
		this.totalVisits = this.views.reduce((sum, view) => sum + view.visits, 0);
		this.devices = this.business.devices || 0;
		this.topReferrers = this.business.topReferrers || 0;
		this.topPlatforms = this.business.topPlatforms || 0;
		this.topBrowsers = this.business.topBrowsers || 0;
  
		const labels = this.views.map(data => data.date);
		const views = this.views.map(data => data.views);
		const uniqueViews = this.views.map(data => data.unique_views);
  
		this.chartData.labels = labels;
		this.chartData.datasets[0].data = views;
		this.chartData.datasets[1].data = uniqueViews;
	  }
	}
  };
  </script>

<style scoped>
.dashboard-nav {
	background-color: #fff;
	border-bottom: 1px solid #ddd;
	width: 100%;
}

.dashboard-nav nav ul {
	display: flex;
	justify-content: space-around;
	padding: 10px 0;
}

.dashboard-nav nav ul li {
	list-style: none;
	padding: 10px;
	cursor: pointer;
}

.dashboard-nav nav ul li.active {
	border-bottom: 2px solid #8224E3;
	color: #8224E3;
}

.dashboard-content {
	padding: 20px;
	background-color: #f5f5f5;
	width: 100%;
}

.greeting {
	font-size: 24px;
	margin-bottom: 20px;
}

.stats {
	display: flex;
	justify-content: space-between;
}

.stat-box {
	width: 22%;
	padding: 20px;
	border-radius: 8px;
	color: #fff;
	text-align: center;
}

.stat-box.purple {
	background-color: #8224E3;
}

.stat-box.blue {
	background-color: #0076ff;
}

.stat-box .count {
	font-size: 36px;
	margin-bottom: 10px;
}

.stat-box .label {
	font-size: 18px;
}

.charts {
	display: grid;
	gap: 20px;
	margin-top: 20px;
}

.chart {
	margin-bottom: 1rem;
	background-color: #fff;
	padding: 20px;
	border-radius: 8px;
	box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.chart-header {
	font-size: 18px;
	margin-bottom: 10px;
}

.chart-body {
	font-size: 24px;
	text-align: center;
}
</style>