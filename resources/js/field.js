Nova.booting((Vue, router, store) => {
    Vue.component('index-nova-checklist', require('./components/IndexField').default);
    Vue.component('detail-nova-checklist', require('./components/DetailField').default);
    Vue.component('form-nova-checklist', require('./components/FormField').default);
});
