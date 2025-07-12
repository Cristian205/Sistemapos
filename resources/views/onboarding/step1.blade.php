<x-layout>
  <h2>Paso 1: Registra tu tienda</h2>
  <form method="POST" action="{{ route('onboarding.step1') }}">
    @csrf
    <input type="text" name="name" placeholder="Nombre de la tienda" required>
    <input type="text" name="nit" placeholder="NIT o identificación">
    <input type="text" name="address" placeholder="Dirección">
    <button type="submit">Continuar</button>
  </form>
</x-layout>
