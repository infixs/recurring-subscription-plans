<script setup>
import { NButton, NSpace, NDataTable } from 'naive-ui'
import { useRouter } from 'vue-router'

import { __ } from '/src/i18n.js'

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
    <h1>{{ __('Name on Card') }}</h1>
    <n-space vertical :size="12" class="substable">
      <n-data-table
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