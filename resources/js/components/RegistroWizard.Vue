<template>
  <div class="wizard-container">
    <div class="wizard-card">
      <!-- Pasos -->
      <div class="steps-wrapper">
        <div
          v-for="(step, index) in steps"
          :key="index"
          :class="['step-item', { active: currentStep === index, done: index < currentStep }]"
        >
          <div class="step-circle">
            <span v-if="index < currentStep">✔</span>
            <span v-else>{{ index + 1 }}</span>
          </div>
          <div class="step-label">{{ step.title }}</div>
        </div>
      </div>

      <!-- Barra de progreso -->
      <div class="progress-bar">
        <div class="progress" :style="{ width: progressWidth }"></div>
      </div>

      <!-- Contenido del paso -->
      <div class="step-content">
        <component
          :is="steps[currentStep].component"
          :form-data="formData"
          @update="updateForm"
          @next="nextStep"
          @prev="prevStep"
        />
      </div>
    </div>
  </div>
</template>

<script>
import PasoTienda from '../registro/PasoTienda.vue'
import PasoPlan from '../registro/PasoPlan.vue'
import PasoUsuario from '../registro/PasoUsuario.vue'
import PasoResumen from '../registro/PasoResumen.vue'

export default {
  components: { PasoTienda, PasoPlan, PasoUsuario, PasoResumen },
  data() {
    return {
      currentStep: 0,
      formData: {},
      steps: [
        { title: 'Tienda', component: 'PasoTienda' },
        { title: 'Plan', component: 'PasoPlan' },
        { title: 'Usuario', component: 'PasoUsuario' },
        { title: 'Resumen', component: 'PasoResumen' }
      ]
    }
  },
  computed: {
    progressWidth() {
      return ((this.currentStep + 1) / this.steps.length) * 100 + '%'
    }
  },
  methods: {
    nextStep() {
      if (this.currentStep < this.steps.length - 1) this.currentStep++
    },
    prevStep() {
      if (this.currentStep > 0) this.currentStep--
    },
    updateForm(updatedData) {
      this.formData = { ...this.formData, ...updatedData }
    }
  }
}
</script>

<style scoped>
/* Contenedor general */
.wizard-container {
  min-height: 100vh;
  background: linear-gradient(to right, #0f172a, #1e3a8a);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 50px 20px;
  font-family: 'Poppins', sans-serif;
}

/* Tarjeta principal */
.wizard-card {
  background: #ffffff;
  border-radius: 20px;
  padding: 40px;
  max-width: 850px;
  width: 100%;
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
  animation: fadeInUp 0.6s ease-out;
}

/* Pasos */
.steps-wrapper {
  display: flex;
  justify-content: space-between;
  margin-bottom: 30px;
  position: relative;
  gap: 10px;
  flex-wrap: wrap;
}

.step-item {
  flex: 1;
  text-align: center;
  position: relative;
}

.step-circle {
  width: 48px;
  height: 48px;
  margin: 0 auto;
  border-radius: 50%;
  background-color: #e2e8f0;
  color: #1e293b;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  transition: all 0.3s ease;
  font-size: 1.1rem;
}

.step-item.active .step-circle {
  background-color: #0ea5e9;
  color: white;
}

.step-item.done .step-circle {
  background-color: #10b981;
  color: white;
}

.step-label {
  margin-top: 8px;
  font-size: 0.95rem;
  font-weight: 500;
  color: #334155;
}

/* Barra de progreso */
.progress-bar {
  height: 6px;
  background-color: #e5e7eb;
  border-radius: 8px;
  margin-bottom: 30px;
  overflow: hidden;
}

.progress {
  height: 100%;
  background-color: #0ea5e9;
  transition: width 0.3s ease-in-out;
}

/* Contenido del paso */
.step-content {
  min-height: 240px;
  animation: fadeIn 0.4s ease-in-out;
}

/* Animaciones */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
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

/* Responsive */
@media (max-width: 768px) {
  .steps-wrapper {
    flex-direction: column;
    align-items: center;
  }

  .step-item {
    flex-direction: row;
    width: 100%;
    margin-bottom: 16px;
  }

  .step-circle {
    margin: 0;
    margin-right: 10px;
  }

  .step-label {
    text-align: left;
  }
}
</style>
