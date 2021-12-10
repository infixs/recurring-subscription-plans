<script setup>
import { NButton, NSpace, NDataTable, NSkeleton, NGrid } from 'naive-ui'
import { useRouter } from 'vue-router'
import { ref } from 'vue'
import { __ } from '/src/i18n.js'

const loading = ref(true);

setTimeout(() => {
  loading.value = false
}, 2000);

const data = [
  {
    key: 0,
    name: 'John Brown',
    age: 32,
    address: 'New York No. 1 Lake Park',
    tags: ['nice', 'developer']
  },
  {
    key: 1,
    name: 'Jim Green',
    age: 42,
    address: 'London No. 1 Lake Park',
    tags: ['wow']
  },
  {
    key: 2,
    name: 'Joe Black',
    age: 32,
    address: 'Sidney No. 1 Lake Park',
    tags: ['cool', 'teacher']
  }
]

const pagination = {
  pageSize: 10
}

const columns = [
  {
    title: 'Name',
    key: 'name'
  },
  {
    title: 'Age',
    key: 'age'
  },
  {
    title: 'Address',
    key: 'address'
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
  </div>
</template>

<style>
.substable{
  margin-top: 1em;
}
</style>