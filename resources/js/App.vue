<script>
  import { store } from "./store/store";
  import axios from "axios";

import ProjectCard from '../views/guest/partials/ProjectCard.vue';

  export default {
    name: "App",
  components: {
    ProjectCard
  },

  data(){
    return {
      projects: [],
      links: [],
      currentPage: null,
      numLastPage: null,
      lastPage: null,
      firstPage: null,
    }
  },

  methods:{
    getApi(paginatedUrl){

      axios.get(paginatedUrl)
            .then(results => {
                this.projects = results.data.data;
                this.links = results.data.links;
                this.currentPage = results.data.current_page;
                this.lastPage = results.data.last_page_url;
                this.numLastPage = results.data.last_page;
                this.firstPage = results.data.first_page_url;
                console.log(this.projects);
            })
    }
  },

  mounted(){
    this.getApi(store.paginatedUrl);
  }
}
</script>

<template>
  <h1>Vite Boolfolio </h1>

  <div class="container pm-card-wrapper">

     <ProjectCard
      v-for="project in projects"
      :key="project.id"
      :name="project.name"
      :technologies="project.technologies"
      :type="project.type"
      :is_done="project.is_done"
      :img_path="project.image_path"/>

  </div>


  <div class="pm-card-controller">
    <button
      :disabled="currentPage == 1"
      @click="getApi(firstPage)"
      class="pm-button-card-controller">
      &lt;&lt;
    </button>

    <button
    class="pm-button-card-controller"
    v-for="(link, index) in links"
    :key="index"
    v-html="link.label"
    @click="getApi(link.url)"
    :disabled="link.active || !link.url "
    ></button>

    <button
      :disabled="currentPage == numLastPage"
      @click="getApi(lastPage)"
      class="pm-button-card-controller">
      &gt;&gt;
    </button>
  </div>
</template>

<style lang="scss">

h1{
  text-align: center;
  margin-top: 20px;
}


.pm-card-controller{
  text-align: center;
  .pm-button-card-controller{
    border: 0;
    background-color:white;
    padding: 5px 15px;
    border-radius: 7px;
    margin-left: 5px;
    margin-top: 25px;
  }

}


</style>
