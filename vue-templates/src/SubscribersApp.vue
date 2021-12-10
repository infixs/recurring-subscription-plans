<template>
  <div class="wrap">
    <n-message-provider>
      <n-dialog-provider>
        <router-view></router-view>
      </n-dialog-provider>
    </n-message-provider>
  </div>
</template>

<script>
import {NMessageProvider, NDialogProvider} from 'naive-ui'

export default {
  components: {
    NMessageProvider,
    NDialogProvider
  }
}
</script>

<style>

</style>