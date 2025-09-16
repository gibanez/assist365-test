<!-- src/components/ReservationsTable.vue -->
<template>
  <v-card>
    <v-card-title>Reservas recientes</v-card-title>

    <v-data-table
      :items="reservations"
      :headers="headers"
      dense
      outlined
    >
      <template #item.status="{ item }">
        <v-chip :color="statusColor(item.status)" dark>{{ item.status }}</v-chip>
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
export default {
  props: ['reservations'],
  data() {
    return {
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'Vuelo', value: 'flight_number' },
        { text: 'departure_time', value: 'departure_time' },
        { text: 'Estado', value: 'status' }
      ]
    }
  },
  methods: {
    statusColor(status) {
      switch (status) {
        case 'CONFIRMED': return 'green'
        case 'CANCELLED': return 'red'
        case 'PENDING': return 'orange'
        default: return 'grey'
      }
    }
  }
}
</script>
