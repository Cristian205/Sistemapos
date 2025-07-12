<template>
  <div class="wizard">
    <div class="steps">
      <div v-for="(step, index) in steps" :key="index"
           :class="['step', { active: currentStep === index }]">
        {{ step.title }}
      </div>
    </div>

    <div class="step-content">
      <component :is="steps[currentStep].component"
                 :form-data="formData"
                 @update="updateForm"
                 @next="nextStep"
                 @prev="prevStep" />
    </div>
  </div>
</template>

<script>
import PasoTienda from './registro/PasoTienda.vue'
import PasoPlan from './registro/PasoPlan.vue'
import PasoUsuario from './registro/PasoUsuario.vue'
import PasoResumen from './registro/PasoResumen.vue'

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
.wizard {
  max-width: 800px;
  margin: auto;
  padding: 40px 20px;
}
.steps {
  display: flex;
  justify-content: space-between;
  margin-bottom: 30px;
  position: relative;
}
.steps::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 10%;
  width: 80%;
  height: 4px;
  background: #cbd5e1;
  z-index: 0;
  transform: translateY(-50%);
}
.step {
  z-index: 1;
  padding: 10px 20px;
  background: #e2e8f0;
  border-radius: 5px;
  font-weight: bold;
  text-align: center;
}
.step.active {
  background: #38bdf8;
  color: white;
}
</style>
