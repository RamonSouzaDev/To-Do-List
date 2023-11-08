<template>
  <menu-dashboard></menu-dashboard>
  <div class="about-me">
    <div class="about-me-header">
      <h2>Sobre Mim</h2>
    </div>
    <div class="about-me-content">
      <img src="../assets/sobre-mim.jpeg" alt="Minha Foto" class="my-photo" />
      <p>
        Olá, pessoal, tudo bem ? 
        Meu nome é Ramon e sou um Desenvolvedor de Software e tenho paixão por Tecnologia e PHP.
        Essa é minha familía, minha namorada e minha mãe.
      </p>
      <p>
        Sou apaixonado por Andar de skate, tocar guitarra, sair com os amigos e viajar.
        Acredito que podemos evoluir todos os dias.
      </p>
    </div>
  </div>
  <page-footer></page-footer>
</template>

<script>
import MenuDashboardView from '@/components/MenuDashboardComponent.vue';
import PageFooterView from '@/components/PageFooterComponent.vue';

export default {
  components: {
    'menu-dashboard': MenuDashboardView,
    'page-footer': PageFooterView
  },
}
</script>