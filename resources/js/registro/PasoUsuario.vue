<template>
  <div class="form-step">
    <h2 class="title">Datos del Usuario Administrador</h2>

    <form @submit.prevent="continuar" class="form-grid">
      <div class="form-group avatar-group full">
        <label>Avatar</label>
        <input type="file" accept="image/*" @change="cargarAvatar" />
        <div class="preview" v-if="preview">
          <img :src="preview" alt="Avatar Preview" />
        </div>
      </div>

      <div class="form-group">
        <label>Nombre Completo</label>
        <input v-model="form.nombre" type="text" required />
      </div>

      <div class="form-group">
        <label>Correo Electrónico</label>
        <input v-model="form.email" type="email" required />
      </div>

      <div class="form-group"><label>Fecha de Nacimiento</label>
        <input v-model="form.birthdate" type="date" required />
      </div>

      <div class="form-group">
        <label>Teléfono</label>
        <input v-model="form.telefono" type="tel" required />
      </div>

      <div class="form-group">
        <label>Contraseña</label>
        <input v-model="form.password" type="password" required minlength="6" />
      </div>

      <div class="form-group full">
        <label>Confirmar Contraseña</label>
        <input v-model="form.password_confirmation" type="password" required minlength="6" />
      </div>

      <div class="actions">
        <button type="button" @click="$emit('prev')" class="btn-back">Atrás</button>
        <button type="submit" class="btn-next">Siguiente</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: 'PasoUsuario',
  emits: ['next', 'prev', 'update'],
  data() {
    return {
      form: {
        nombre: '',
        email: '',
        telefono: '',
        password: '',
        password_confirmation: '',
        avatar: null, // Nuevo campo
      },
      preview: null
    };
  },
  methods: {
    cargarAvatar(event) {
      const file = event.target.files[0];
      if (file && file.type.startsWith('image/')) {
        this.form.avatar = file;
        this.preview = URL.createObjectURL(file);
      } else {
        alert('Por favor selecciona una imagen válida.');
      }
    },
    continuar() {
      if (this.form.password !== this.form.password_confirmation) {
        alert('Las contraseñas no coinciden');
        return;
      }

      this.$emit('update', this.form);
      this.$emit('next');
    }
  }
};
</script>

<style scoped>
.form-step {
  animation: fadeIn 0.4s ease-in-out;
}

.title {
  font-size: 1.5rem;
  margin-bottom: 20px;
  font-weight: 600;
  color: #1e293b;
  text-align: center;
}

.form-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 20px;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group.full {
  grid-column: span 2;
}

.avatar-group input[type="file"] {
  padding: 8px 0;
}

.preview {
  margin-top: 10px;
}

.preview img {
  width: 100px;
  height: 100px;
  object-fit: cover;
  border-radius: 50%;
  border: 2px solid #0ea5e9;
}

label {
  font-weight: 500;
  margin-bottom: 6px;
  color: #475569;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="password"] {
  padding: 10px 12px;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  font-size: 1rem;
  background-color: #f8fafc;
  transition: border-color 0.2s;
}

input:focus {
  border-color: #38bdf8;
  outline: none;
}

.actions {
  grid-column: span 2;
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

.btn-next,
.btn-back {
  background-color: #0ea5e9;
  color: white;
  padding: 12px 24px;
  font-weight: bold;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.btn-back {
  background-color: #94a3b8;
}

.btn-next:hover {
  background-color: #0284c7;
}

.btn-back:hover {
  background-color: #64748b;
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
