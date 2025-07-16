<template>
  <div class="plan-step">
    <h2 class="title">Selecciona un Plan</h2>

    <div class="plan-list">
      <div
        v-for="(plan, index) in planes"
        :key="index"
        :class="['plan-card', { selected: planSeleccionado === plan.nombre }]"
        @click="mostrarModal(plan)"
      >
        <h3>{{ plan.nombre }}</h3>
        <p class="precio">{{ formatoPesos(plan.precio) }} / {{ plan.duracion_dias }} días</p>
        <ul class="features">
          <li>👥 {{ plan.usuarios_maximos }} usuarios</li>
          <li>🏬 {{ plan.sucursales_maximas }} sucursales</li>
          <li>📦 {{ plan.productos_maximos }} productos</li>
          <li v-if="plan.facturacion_electronica">🧾 Facturación Electrónica</li>
          <li v-if="plan.soporte_prioritario">⚡ Soporte Prioritario</li>
          <li v-if="plan.respaldo_automatico">🔄 Respaldo Automático</li>
          <li v-if="plan.acceso_api">🔌 Acceso API</li>
        </ul>
      </div>
    </div>

    <div class="actions">
      <button :disabled="!planSeleccionado" @click="continuar" class="btn-next">
        Continuar
      </button>
    </div>

    <!-- Modal de Confirmación -->
    <div v-if="mostrar" class="modal-overlay">
      <div class="modal">
        <h3>¿Deseas adquirir el plan <strong>{{ planTemporal?.nombre }}</strong>?</h3>
        <p>Este plan cuesta {{ formatoPesos(planTemporal?.precio) }} por {{ planTemporal?.duracion_dias }} días.</p>
        <button @click="procesarPago" class="modal-btn">Ir a Pagar</button>
        <button @click="cerrarModal" class="modal-btn cancel">Cancelar</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'PasoPlan',
  emits: ['next', 'prev', 'update'],
  data() {
    return {
      planSeleccionado: null,
      mostrar: false,
      planTemporal: null,
      planes: []
    };
  },
  mounted() {
    this.obtenerPlanes();
  },
  methods: {
    formatoPesos(valor) {
      const numero = parseFloat(valor);
      if (isNaN(numero)) return '$0';
      return new Intl.NumberFormat('es-CO', {
        style: 'currency',
        currency: 'COP',
        minimumFractionDigits: 0
      }).format(numero);
    },

    async obtenerPlanes() {
      try {
        const response = await axios.get('/api/planes');
        this.planes = response.data;
      } catch (error) {
        console.error('❌ Error al obtener los planes:', error);
      }
    },

    mostrarModal(plan) {
      this.planTemporal = plan;

      if (parseFloat(plan.precio) === 0) {
        this.planSeleccionado = plan.nombre;
        this.$emit('update', {
          plan_id: plan.id,
          plan_nombre: plan.nombre,
          plan_precio: plan.precio,
          plan_duracion: plan.duracion_dias,
          usuarios_maximos: plan.usuarios_maximos,
          sucursales_maximas: plan.sucursales_maximas,
          productos_maximos: plan.productos_maximos,
          facturacion_electronica: plan.facturacion_electronica,
          soporte_prioritario: plan.soporte_prioritario,
          respaldo_automatico: plan.respaldo_automatico,
          acceso_api: plan.acceso_api
        });
        this.$emit('next');
      } else {
        this.mostrar = true;
      }
    },

    procesarPago() {
      alert(`Simulando pago del plan: ${this.planTemporal.nombre}`);
      this.planSeleccionado = this.planTemporal.nombre;
      this.$emit('update', {
        plan_id: this.planTemporal.id,
        plan_nombre: this.planTemporal.nombre,
        plan_precio: this.planTemporal.precio,
        plan_duracion: this.planTemporal.duracion_dias,
        usuarios_maximos: this.planTemporal.usuarios_maximos,
        sucursales_maximas: this.planTemporal.sucursales_maximas,
        productos_maximos: this.planTemporal.productos_maximos,
        facturacion_electronica: this.planTemporal.facturacion_electronica,
        soporte_prioritario: this.planTemporal.soporte_prioritario,
        respaldo_automatico: this.planTemporal.respaldo_automatico,
        acceso_api: this.planTemporal.acceso_api
      });
      this.$emit('next');
      this.mostrar = false;
    },

    cerrarModal() {
      this.mostrar = false;
    }
  }
};
</script>


<style scoped>
.plan-step {
  animation: fadeIn 0.4s ease;
  padding: 2rem;
}

.title {
  font-size: 2rem;
  font-weight: 700;
  text-align: center;
  margin-bottom: 2rem;
  color: #1e293b;
}

.plan-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 32px;
}

.plan-card {
  background: linear-gradient(145deg, #f3f4f6, #ffffff);
  border-radius: 18px;
  padding: 2rem;
  border: 2px solid #e2e8f0;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
  transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
}

.plan-card:hover {
  transform: translateY(-6px);
  border-color: #0ea5e9;
  box-shadow: 0 20px 40px rgba(14, 165, 233, 0.1);
}

.plan-card.selected {
  border-color: #0ea5e9;
  background: #e0f2fe;
  box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.3);
}

.plan-card h3 {
  font-size: 1.4rem;
  color: #0f172a;
  margin-bottom: 8px;
}

.precio {
  font-size: 1.1rem;
  color: #0284c7;
  font-weight: bold;
  margin-bottom: 16px;
}

.features {
  list-style: none;
  padding: 0;
  margin: 0;
  color: #475569;
  font-size: 0.95rem;
}

.features li {
  display: flex;
  align-items: center;
  margin-bottom: 8px;
  gap: 8px;
}

.actions {
  display: flex;
  justify-content: center;
  margin-top: 36px;
}

.btn-next {
  background-color: #0ea5e9;
  color: white;
  padding: 14px 32px;
  font-weight: 600;
  font-size: 1rem;
  border: none;
  border-radius: 12px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.btn-next:hover {
  background-color: #0284c7;
}

.btn-next:disabled {
  background-color: #94a3b8;
  cursor: not-allowed;
}

/* Modal */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(15, 23, 42, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 999;
}

.modal {
  background: white;
  padding: 32px;
  border-radius: 16px;
  text-align: center;
  width: 90%;
  max-width: 400px;
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
}

.modal h3 {
  font-size: 1.4rem;
  margin-bottom: 12px;
}

.modal-btn {
  margin-top: 20px;
  background: #0ea5e9;
  color: white;
  padding: 12px 28px;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  font-weight: 600;
}

.modal-btn.cancel {
  background: transparent;
  color: #475569;
  margin-left: 12px;
}

.modal-btn:hover {
  background-color: #0284c7;
}

.modal-btn.cancel:hover {
  background-color: #f1f5f9;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(12px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
