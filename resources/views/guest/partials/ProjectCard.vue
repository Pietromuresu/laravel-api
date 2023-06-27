
<script>
export default {
    name: "ProjectCard",
    data(){
      return{

        storage_path: "http://127.0.0.1:8000/storage/",
      }
    },

  props: {
    name: String,
    technologies: Array,
    type: Object,
    is_done: Number,
    img_path: String,
  }
}
</script>

<template>

  <div class="pm-projectCard">
    <div class="pm-project-image">
      <img v-if="img_path" :src="storage_path + img_path" :alt="img_path">
      <img v-else :src="storage_path + 'uploads/default-image.jpeg' " :alt="img_path" >
    </div>

    <div class="pm-project-details">
      <h3>{{ name }}</h3>
      <p>
       <span v-for="technology in technologies" :key="technology.id">
        {{ technology.name }} -
       </span>
      </p>
      <p>{{ type.name }}</p>
      <p v-if="is_done">Completed</p>
      <p v-if="!is_done">Not completed</p>
    </div>
  </div>

</template>

<style lang="scss" scoped>

  .pm-projectCard{
    min-width: 250px;
    min-height: 300px;
    max-width: 350px;
    max-height: 400px;
    width: calc(90% / 4);

    text-align: center;


    border-radius: 7px;

    background: white;

    .pm-project-image{
      overflow: hidden;
      max-width: 100%;
      max-height: 200px;
      img{
        max-width: 100%;

      }
    }
    .pm-project-details{
      padding: 10px;
    }
  }
</style>
