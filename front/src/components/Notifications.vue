<!-- src/components/Notifications.vue -->
<template>
  <v-card>
    <v-card-title>Notificaciones</v-card-title>
    <v-list>
      <v-list-item v-for="(note, i) in notifications" :key="i">
        <v-list-item-content>
          <v-list-item-title>{{ note.message }}</v-list-item-title>
          <v-list-item-subtitle>{{ note.time }}</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-card>
</template>

<script>
export default {
  props: ['notifications']
}
</script>
