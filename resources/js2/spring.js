import Vue from 'vue'

const Spring = {

    bus: new Vue(),

    bootingCallbacks: [],

    resources: {},
    /**
     * Register a callback to be called before Spring starts. This is used to bootstrap
     * addons, tools, custom fields, or anything else Spring needs
     */
    booting(callback) {
        this.bootingCallbacks.push(callback)
    },

    /**
     * Execute all of the booting callbacks.
     */
    fireCallbacks(Vue, Router, Routes) {
        this.bootingCallbacks.forEach(callback => callback(Vue, Router, Routes))

        this.bootingCallbacks = []
    },


    /**
     * Return an axios instance configured to make requests to Spring's API
     * and handle certain response codes.
     */
    request(options) {
        if (options !== undefined) {
            return axios(options)
        }

        return axios
    },

    /**
     * Register a listener on Spring's built-in event bus
     */
    $on(...args) {
        this.bus.$on(...args)
    },

    /**
     * Register a one-time listener on the event bus
     */
    $once(...args) {
        this.bus.$once(...args)
    },

    /**
     * De-register a listener on the event bus
     */
    $off(...args) {
        this.bus.$off(...args)
    },

    /**
     * Emit an event on the event bus
     */
    $emit(...args) {
        this.bus.$emit(...args)
    },
};

export default Spring;
