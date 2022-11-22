import DependentFilter from './components/DependentFilter'

Nova.booting((app, store) => {
    app.component('awesome-nova-dependent-filter', DependentFilter)
})