Nova.booting((Vue, router, store) => {
  Vue.component('index-nova-suggest-wrapper', require('./components/IndexField'))
  Vue.component('detail-nova-suggest-wrapper', require('./components/DetailField'))
  Vue.component('form-nova-suggest-wrapper', require('./components/FormField'))
})
