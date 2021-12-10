<script setup>
import { NButton, NSpace, NDataTable, NGi, NSkeleton, NGrid, NGridItem, NIcon, NInput, useDialog, NModal, NTabs, NTabPane } from 'naive-ui'
import { BrushOutline, EyeOutline } from '@vicons/ionicons5'
import { useRouter } from 'vue-router'
import { ref, h } from 'vue'
import { __ } from '/src/i18n.js'
import axios from 'axios'
import ViewSubscriberModal from './ViewSubscriberModal.vue'

const loading = ref(true)

const data = ref([])
const viewModal = ref(false)
const dialog = useDialog()
const subscriberViewId = ref(null)
const subscriberViewData = ref([])

axios.get( 'subscribers' )
  .then((res) => {
    data.value = res.data
  })
  .catch((err) => {
    console.log(err)
  })
  .then(() => {
    loading.value = false
})

const pagination = {
  pageSize: 10
}

const columns = [
  {
    title: __('Name'),
    key: 'name'
  },
  {
    title: __('Payment Method'),
    key: 'payment_method'
  },
  {
    title: __('Plan'),
    key: 'plan_name'
  },
  {
    title: __('Document Number'),
    key: 'document_number'
  },
  {
    title: __('Age'),
    key: 'age'
  },
  {
    title: __('Action'),
    key: 'actions',
    render(row){
      return [/*h(
        NButton,
        {
          size: 'small'
        },
        {
          default: () => __('Edit'),
          icon: () => h(
            NIcon,
            {},
            {
              default: () => h(BrushOutline)
            }
          )
        }
      ),*/
      h(
        NButton,
        {
          size: 'small',
          class: 'ml-1',
          onClick: () => {
            axios.get('subscribers/' + row.id).then((subs) => {
              subscriberViewData.value = subs.data
              subscriberViewId.value = row.id
              viewModal.value = true
            }).catch(() => {
              
            })
            
          }
        },
        {
          default: () => __('View'),
          icon: () => h(
            NIcon,
            {},
            {
              default: () => h(EyeOutline)
            }
          )
        }
      )]
    }
  }
]

</script>

<template>
  <div>
    <n-skeleton v-if="loading" :width="300" :sharp="false" size="large" style="margin-top: 2em"/>
    <h1 v-if="!loading">{{ __('Subscribers' ) }}</h1>
    <n-space vertical :size="12" class="substable">
    <div v-if="loading">
      <n-grid x-gap="12" :cols="3">
        <n-gi>
          <n-skeleton style="width: 100%;" :sharp="false" size="large" />
        </n-gi>
        <n-gi>
          <n-skeleton style="width: 100%;" :sharp="false" size="large" />
        </n-gi>
        <n-gi>
          <n-skeleton style="width: 100%;" :sharp="false" size="large" />
        </n-gi>
      </n-grid>
      <n-grid x-gap="12" :cols="3">
        <n-gi>
          <n-skeleton style="width: 100%;" :sharp="false" size="large" />
        </n-gi>
        <n-gi>
          <n-skeleton style="width: 100%;" :sharp="false" size="large" />
        </n-gi>
        <n-gi>
          <n-skeleton style="width: 100%;" :sharp="false" size="large" />
        </n-gi>
      </n-grid>
    </div>
    <n-data-table
      v-if="!loading"
      :bordered="false"
      :single-line="true"
      :columns="columns"
      :data="data"
      :pagination="pagination"
    />
    </n-space>
    <view-subscriber-modal v-model:show="viewModal" v-model:modelValue="subscriberViewData"></view-subscriber-modal>
  </div>
</template>

<style>
.substable{
  margin-top: 1em;
}
.ml-2{
  margin-left: 1.2em;
}
.ml-1{
  margin-left: 0.8em;
}
.n-card.n-card--bordered.n-modal.custom-card {
    --padding-left: 17px !important;
    --padding-top: 14px  !important;
    --padding-bottom: 20px  !important;
}
</style>