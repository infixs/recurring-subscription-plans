<script setup>
import { NButton, NSpace, NDataTable, NSkeleton, NGrid, NGridItem, NIcon, NInput, useDialog, NModal, NTabs, NTabPane } from 'naive-ui'
import { defineProps, ref, onMounted, defineEmits, computed, toRefs } from 'vue'
import { __ } from '/src/i18n.js'

const props = defineProps({
  show: {
    type: Boolean,
    default: false
  },
  modelValue: {
    type: Object,
    required: true,
    default: {}
  }
})

const {modelValue} = toRefs(props)

const emit = defineEmits(['update:show'])

const onShow = ($event) => {
  console.log('oi')
}

const columns = [
  {
    title: __('Installment'),
    key: 'installment'
  },
  {
    title: __('Amout'),
    key: 'amount'
  },
  {
    title: __('Status'),
    key: 'status'
  },
  {
    title: __('Actions'),
    key: 'payment_method'
  }
]

</script>
<template>
  <n-modal
    class="custom-card"
    :show="show"
    @update:show="emit('update:show', $event)"
    preset="card"
    style="width: 600px;"
    :title="__('View Subscriber')"
    :bordered="true"
  >
    <n-tabs type="card">
      <n-tab-pane name="subscriber" :tab="__('Subscriber')">
        <n-grid :x-gap="12" :y-gap="12" :cols="2">
          <n-grid-item span="2">
          </n-grid-item>
          <n-grid-item>
            <n-input type="text" :placeholder="__('Fist Name')" :value="modelValue.first_name"></n-input>
          </n-grid-item>
          <n-grid-item>
            <n-input type="text" :placeholder="__('Last Name')" :value="modelValue.last_name"/>
          </n-grid-item>
          <n-grid-item span="2">
            <n-input type="text" :placeholder="__('E-mail')" :value="modelValue.email"/>
          </n-grid-item>
          <n-grid-item>
            <n-input type="text" :placeholder="__('Document Number')" :value="modelValue.document_number"/>
          </n-grid-item>
          <n-grid-item>
            <n-input type="text" :placeholder="__('Birth Date')" :value="modelValue.birth_date"/>
          </n-grid-item>
          <n-grid-item>
            <n-input type="text" :placeholder="__('Phone Number')" :value="modelValue.phone_number"/>
          </n-grid-item>
        </n-grid>
      </n-tab-pane>
      <n-tab-pane name="address" :tab="__('Address')">
        <n-grid :x-gap="12" :y-gap="12" :cols="4">
          <n-grid-item span="2">
            <n-input type="text" :placeholder="__('Zip Code')" :value="modelValue.zip_code"></n-input>
          </n-grid-item>
          <n-grid-item span="2"></n-grid-item>
          <n-grid-item span="3">
            <n-input type="text" :placeholder="__('Address')" :value="modelValue.address"/>
          </n-grid-item>
          <n-grid-item span="1">
            <n-input type="text" :placeholder="__('Number')" :value="modelValue.address_number"/>
          </n-grid-item>
          <n-grid-item span="2">
            <n-input type="text" :placeholder="__('Address 2')" :value="modelValue.address2"/>
          </n-grid-item>
          <n-grid-item span="2">
            <n-input type="text" :placeholder="__('State')" :value="modelValue.state"/>
          </n-grid-item>
          <n-grid-item span="2">
            <n-input type="text" :placeholder="__('Neighborhood')" :value="modelValue.neighborhood"/>
          </n-grid-item>
          <n-grid-item span="2">
            <n-input type="text" :placeholder="__('City')" :value="modelValue.city"/>
          </n-grid-item>
        </n-grid>
      </n-tab-pane>
      <n-tab-pane name="payments" :tab="__('Payments')">
      <n-data-table
        size="small"
        :bordered="false"
        :single-line="true"
        :columns="columns"
        :data="modelValue.charges"
        :pagination="pagination"
      />
      </n-tab-pane>
      <n-tab-pane name="history" :tab="__('History')"></n-tab-pane>
    </n-tabs>
    <template #footer>
      <n-button>{{ __('Save') }}</n-button>
    </template>
  </n-modal>
</template>