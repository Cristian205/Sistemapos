<template>
  <div class="resumen-container">
    <h2 class="resumen-title">Resumen de tu información</h2>

    <!-- Datos de la tienda -->
    <div class="resumen-section">
      <h3 class="section-title">📍 Datos de la Tienda</h3>
      <ul>
        <li><strong>Nombre:</strong> {{ formData.Nombre_tienda }}</li>
        <li><strong>Categoría:</strong> {{ formData.categoria_nombre }}</li>
        <li><strong>Dirección:</strong> {{ formData.Direccion_corporativa }}</li>
        <li><strong>Descripción:</strong> {{ formData.Descripcion_corporativa }}</li>
        <li><strong>Correo Corporativo:</strong> {{ formData.Correo_corporativo }}</li>
        <li><strong>Teléfono:</strong> {{ formData.Telefono_corporativo }}</li>
        <li><strong>NIT:</strong> {{ formData.NIT }}</li>
        <li v-if="formData.LogoPreview || formData.Logo_tienda">
          <strong>Logo de la Tienda:</strong><br />
          <img
            :src="formData.LogoPreview || getImageUrl(formData.Logo_tienda)"
            alt="Logo"
            class="preview-image"
          />
        </li>
      </ul>
    </div>

    <!-- Usuario -->
    <div class="resumen-section">
      <h3 class="section-title">👤 Datos del Usuario</h3>
      <div class="avatar">
        {{ getIniciales(formData.nombre) }}
      </div>
      <ul>
        <li><strong>Nombre:</strong> {{ formData.nombre }}</li>
        <li><strong>Email:</strong> {{ formData.email }}</li>
        <li><strong>Teléfono:</strong> {{ formData.telefono }}</li>
      </ul>
    </div>

    <!-- Plan -->
    <div class="resumen-section">
      <h3 class="section-title">📦 Plan Seleccionado</h3>
      <ul>
        <li><strong>Plan:</strong> {{ formData.plan_nombre }}</li>
        <li><strong>Precio:</strong> {{ formatoPesos(formData.precio) }} / {{ formData.duracion_dias }} días</li>
        <li><strong>Máx. Usuarios:</strong> {{ formData.usuarios_maximos }}</li>
        <li><strong>Máx. Sucursales:</strong> {{ formData.sucursales_maximas }}</li>
        <li><strong>Máx. Productos:</strong> {{ formData.productos_maximos }}</li>
        <li v-if="formData.facturacion_electronica">🧾 Facturación Electrónica</li>
        <li v-if="formData.soporte_prioritario">⚡ Soporte Prioritario</li>
        <li v-if="formData.respaldo_automatico">🔄 Respaldo Automático</li>
        <li v-if="formData.acceso_api">🔌 Acceso API</li>
        <li v-if="formData.prueba">🎁 <strong>Plan de Prueba Activo (7 días)</strong></li>
      </ul>
    </div>

    <div class="button-group">
      <button @click="$emit('prev')" class="btn btn-back">← Volver</button>
      <button @click="confirmarRegistro" class="btn btn-confirmar">Confirmar Registro</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'PasoResumen',
  props: {
    formData: {
      type: Object,
      required: true
    }
  },
  emits: ['prev', 'submit'],
  methods: {
    async confirmarRegistro() {
      try {
        const form = new FormData();

        form.append('nombre', this.formData.Nombre_tienda);
        form.append('telefono', this.formData.Telefono_corporativo);
        form.append('email', this.formData.Correo_corporativo);
        form.append('direccion', this.formData.Direccion_corporativa);
        form.append('descripcion', this.formData.Descripcion_corporativa || '');
        form.append('nit', this.formData.NIT);
        form.append('categoria_id', this.formData.categoria_id);
        form.append('plan_id', this.formData.plan_id); // ✅ plan_id obligatorio
        form.append('password', this.formData.password);

        if (this.formData.Logo_tienda) {
          form.append('logo', this.formData.Logo_tienda);
        }

        const response = await axios.post('/registro', form);

        if (response.data.success) {
          alert('✅ Registro exitoso');
        }
      } catch (error) {
        console.error('❌ Error al confirmar el registro:', error);
        if (error.response && error.response.status === 422) {
          console.warn('❗ Validación fallida:', error.response.data.errors);
          alert('Revisa los campos del formulario. Hay errores de validación.');
        } else {
          alert('Hubo un error al procesar tu registro.');
        }
      }
    },

    getIniciales(nombre) {
      if (!nombre) return '';
      return nombre
        .split(' ')
        .map(word => word.charAt(0).toUpperCase())
        .join('')
        .slice(0, 2);
    },

    getImageUrl(file) {
      if (!file) return '';
      return URL.createObjectURL(file);
    },

    formatoPesos(valor) {
      const numero = parseFloat(valor);
      if (isNaN(numero)) return '$0';
      return new Intl.NumberFormat('es-CO', {
        style: 'currency',
        currency: 'COP',
        minimumFractionDigits: 0
      }).format(numero);
    }
  }
};
</script>


<style scoped>
.resumen-container {
  padding: 30px;
  max-width: 750px;
  margin: auto;
  background: #ffffff;
  border-radius: 16px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
  animation: fadeIn 0.5s ease-in-out;
}

.resumen-title {
  font-size: 1.8rem;
  font-weight: 700;
  color: #1e293b;
  text-align: center;
  margin-bottom: 30px;
  border-bottom: 2px solid #e2e8f0;
  padding-bottom: 10px;
}

.resumen-section {
  margin-bottom: 25px;
  padding: 20px;
  background: #f8fafc;
  border-left: 5px solid #0ea5e9;
  border-radius: 10px;
}

.section-title {
  font-size: 1.2rem;
  margin-bottom: 12px;
  color: #0f172a;
  font-weight: 600;
}

ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

li {
  padding: 6px 0;
  color: #334155;
  font-size: 0.95rem;
  border-bottom: 1px dashed #e2e8f0;
}

li:last-child {
  border-bottom: none;
}

strong {
  color: #1e293b;
}

.preview-image {
  max-width: 160px;
  margin-top: 12px;
  border-radius: 8px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Avatar */
.avatar {
  width: 60px;
  height: 60px;
  background: #3b82f6;
  color: white;
  border-radius: 50%;
  font-weight: bold;
  font-size: 1.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.button-group {
  display: flex;
  justify-content: space-between;
  margin-top: 30px;
}

.btn {
  padding: 12px 24px;
  font-size: 1rem;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.3s ease;
}

.btn-back {
  background-color: #94a3b8;
  color: white;
}

.btn-confirmar {
  background-color: #0ea5e9;
  color: white;
}

.btn-back:hover {
  background-color: #64748b;
}

.btn-confirmar:hover {
  background-color: #0284c7;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(16px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
