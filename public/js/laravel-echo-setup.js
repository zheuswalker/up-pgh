/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/laravel-echo/dist/echo.js":
/*!************************************************!*\
  !*** ./node_modules/laravel-echo/dist/echo.js ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
class Connector {
    /**
     * Create a new class instance.
     */
    constructor(options) {
        /**
         * Default connector options.
         */
        this._defaultOptions = {
            auth: {
                headers: {},
            },
            authEndpoint: '/broadcasting/auth',
            broadcaster: 'pusher',
            csrfToken: null,
            host: null,
            key: null,
            namespace: 'App.Events',
        };
        this.setOptions(options);
        this.connect();
    }
    /**
     * Merge the custom options with the defaults.
     */
    setOptions(options) {
        this.options = Object.assign(this._defaultOptions, options);
        if (this.csrfToken()) {
            this.options.auth.headers['X-CSRF-TOKEN'] = this.csrfToken();
        }
        return options;
    }
    /**
     * Extract the CSRF token from the page.
     */
    csrfToken() {
        let selector;
        if (typeof window !== 'undefined' && window['Laravel'] && window['Laravel'].csrfToken) {
            return window['Laravel'].csrfToken;
        }
        else if (this.options.csrfToken) {
            return this.options.csrfToken;
        }
        else if (typeof document !== 'undefined' &&
            typeof document.querySelector === 'function' &&
            (selector = document.querySelector('meta[name="csrf-token"]'))) {
            return selector.getAttribute('content');
        }
        return null;
    }
}

/**
 * This class represents a basic channel.
 */
class Channel {
    /**
     * Listen for a whisper event on the channel instance.
     */
    listenForWhisper(event, callback) {
        return this.listen('.client-' + event, callback);
    }
    /**
     * Listen for an event on the channel instance.
     */
    notification(callback) {
        return this.listen('.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', callback);
    }
    /**
     * Stop listening for a whispser event on the channel instance.
     */
    stopListeningForWhisper(event) {
        return this.stopListening('.client-' + event);
    }
}

/**
 * Event name formatter
 */
class EventFormatter {
    /**
     * Create a new class instance.
     */
    constructor(namespace) {
        this.setNamespace(namespace);
    }
    /**
     * Format the given event name.
     */
    format(event) {
        if (event.charAt(0) === '.' || event.charAt(0) === '\\') {
            return event.substr(1);
        }
        else if (this.namespace) {
            event = this.namespace + '.' + event;
        }
        return event.replace(/\./g, '\\');
    }
    /**
     * Set the event namespace.
     */
    setNamespace(value) {
        this.namespace = value;
    }
}

/**
 * This class represents a Pusher channel.
 */
class PusherChannel extends Channel {
    /**
     * Create a new class instance.
     */
    constructor(pusher, name, options) {
        super();
        this.name = name;
        this.pusher = pusher;
        this.options = options;
        this.eventFormatter = new EventFormatter(this.options.namespace);
        this.subscribe();
    }
    /**
     * Subscribe to a Pusher channel.
     */
    subscribe() {
        this.subscription = this.pusher.subscribe(this.name);
    }
    /**
     * Unsubscribe from a Pusher channel.
     */
    unsubscribe() {
        this.pusher.unsubscribe(this.name);
    }
    /**
     * Listen for an event on the channel instance.
     */
    listen(event, callback) {
        this.on(this.eventFormatter.format(event), callback);
        return this;
    }
    /**
     * Stop listening for an event on the channel instance.
     */
    stopListening(event) {
        this.subscription.unbind(this.eventFormatter.format(event));
        return this;
    }
    /**
     * Bind a channel to an event.
     */
    on(event, callback) {
        this.subscription.bind(event, callback);
        return this;
    }
}

/**
 * This class represents a Pusher private channel.
 */
class PusherPrivateChannel extends PusherChannel {
    /**
     * Trigger client event on the channel.
     */
    whisper(eventName, data) {
        this.pusher.channels.channels[this.name].trigger(`client-${eventName}`, data);
        return this;
    }
}

/**
 * This class represents a Pusher private channel.
 */
class PusherEncryptedPrivateChannel extends PusherChannel {
    /**
     * Trigger client event on the channel.
     */
    whisper(eventName, data) {
        this.pusher.channels.channels[this.name].trigger(`client-${eventName}`, data);
        return this;
    }
}

/**
 * This class represents a Pusher presence channel.
 */
class PusherPresenceChannel extends PusherChannel {
    /**
     * Register a callback to be called anytime the member list changes.
     */
    here(callback) {
        this.on('pusher:subscription_succeeded', data => {
            callback(Object.keys(data.members).map(k => data.members[k]));
        });
        return this;
    }
    /**
     * Listen for someone joining the channel.
     */
    joining(callback) {
        this.on('pusher:member_added', member => {
            callback(member.info);
        });
        return this;
    }
    /**
     * Listen for someone leaving the channel.
     */
    leaving(callback) {
        this.on('pusher:member_removed', member => {
            callback(member.info);
        });
        return this;
    }
    /**
     * Trigger client event on the channel.
     */
    whisper(eventName, data) {
        this.pusher.channels.channels[this.name].trigger(`client-${eventName}`, data);
        return this;
    }
}

/**
 * This class represents a Socket.io channel.
 */
class SocketIoChannel extends Channel {
    /**
     * Create a new class instance.
     */
    constructor(socket, name, options) {
        super();
        /**
         * The event callbacks applied to the channel.
         */
        this.events = {};
        this.name = name;
        this.socket = socket;
        this.options = options;
        this.eventFormatter = new EventFormatter(this.options.namespace);
        this.subscribe();
        this.configureReconnector();
    }
    /**
     * Subscribe to a Socket.io channel.
     */
    subscribe() {
        this.socket.emit('subscribe', {
            channel: this.name,
            auth: this.options.auth || {},
        });
    }
    /**
     * Unsubscribe from channel and ubind event callbacks.
     */
    unsubscribe() {
        this.unbind();
        this.socket.emit('unsubscribe', {
            channel: this.name,
            auth: this.options.auth || {},
        });
    }
    /**
     * Listen for an event on the channel instance.
     */
    listen(event, callback) {
        this.on(this.eventFormatter.format(event), callback);
        return this;
    }
    /**
     * Stop listening for an event on the channel instance.
     */
    stopListening(event) {
        const name = this.eventFormatter.format(event);
        this.socket.removeListener(name);
        delete this.events[name];
        return this;
    }
    /**
     * Bind the channel's socket to an event and store the callback.
     */
    on(event, callback) {
        let listener = (channel, data) => {
            if (this.name == channel) {
                callback(data);
            }
        };
        this.socket.on(event, listener);
        this.bind(event, listener);
    }
    /**
     * Attach a 'reconnect' listener and bind the event.
     */
    configureReconnector() {
        const listener = () => {
            this.subscribe();
        };
        this.socket.on('reconnect', listener);
        this.bind('reconnect', listener);
    }
    /**
     * Bind the channel's socket to an event and store the callback.
     */
    bind(event, callback) {
        this.events[event] = this.events[event] || [];
        this.events[event].push(callback);
    }
    /**
     * Unbind the channel's socket from all stored event callbacks.
     */
    unbind() {
        Object.keys(this.events).forEach(event => {
            this.events[event].forEach(callback => {
                this.socket.removeListener(event, callback);
            });
            delete this.events[event];
        });
    }
}

/**
 * This class represents a Socket.io presence channel.
 */
class SocketIoPrivateChannel extends SocketIoChannel {
    /**
     * Trigger client event on the channel.
     */
    whisper(eventName, data) {
        this.socket.emit('client event', {
            channel: this.name,
            event: `client-${eventName}`,
            data: data,
        });
        return this;
    }
}

/**
 * This class represents a Socket.io presence channel.
 */
class SocketIoPresenceChannel extends SocketIoPrivateChannel {
    /**
     * Register a callback to be called anytime the member list changes.
     */
    here(callback) {
        this.on('presence:subscribed', (members) => {
            callback(members.map(m => m.user_info));
        });
        return this;
    }
    /**
     * Listen for someone joining the channel.
     */
    joining(callback) {
        this.on('presence:joining', member => callback(member.user_info));
        return this;
    }
    /**
     * Listen for someone leaving the channel.
     */
    leaving(callback) {
        this.on('presence:leaving', member => callback(member.user_info));
        return this;
    }
}

/**
 * This class represents a null channel.
 */
class NullChannel extends Channel {
    /**
     * Subscribe to a channel.
     */
    subscribe() {
        //
    }
    /**
     * Unsubscribe from a channel.
     */
    unsubscribe() {
        //
    }
    /**
     * Listen for an event on the channel instance.
     */
    listen(event, callback) {
        return this;
    }
    /**
     * Stop listening for an event on the channel instance.
     */
    stopListening(event) {
        return this;
    }
    /**
     * Bind a channel to an event.
     */
    on(event, callback) {
        return this;
    }
}

/**
 * This class represents a null private channel.
 */
class NullPrivateChannel extends NullChannel {
    /**
     * Trigger client event on the channel.
     */
    whisper(eventName, data) {
        return this;
    }
}

/**
 * This class represents a null presence channel.
 */
class NullPresenceChannel extends NullChannel {
    /**
     * Register a callback to be called anytime the member list changes.
     */
    here(callback) {
        return this;
    }
    /**
     * Listen for someone joining the channel.
     */
    joining(callback) {
        return this;
    }
    /**
     * Listen for someone leaving the channel.
     */
    leaving(callback) {
        return this;
    }
    /**
     * Trigger client event on the channel.
     */
    whisper(eventName, data) {
        return this;
    }
}

/**
 * This class creates a connector to Pusher.
 */
class PusherConnector extends Connector {
    constructor() {
        super(...arguments);
        /**
         * All of the subscribed channel names.
         */
        this.channels = {};
    }
    /**
     * Create a fresh Pusher connection.
     */
    connect() {
        if (typeof this.options.client !== 'undefined') {
            this.pusher = this.options.client;
        }
        else {
            this.pusher = new Pusher(this.options.key, this.options);
        }
    }
    /**
     * Listen for an event on a channel instance.
     */
    listen(name, event, callback) {
        return this.channel(name).listen(event, callback);
    }
    /**
     * Get a channel instance by name.
     */
    channel(name) {
        if (!this.channels[name]) {
            this.channels[name] = new PusherChannel(this.pusher, name, this.options);
        }
        return this.channels[name];
    }
    /**
     * Get a private channel instance by name.
     */
    privateChannel(name) {
        if (!this.channels['private-' + name]) {
            this.channels['private-' + name] = new PusherPrivateChannel(this.pusher, 'private-' + name, this.options);
        }
        return this.channels['private-' + name];
    }
    /**
     * Get a private encrypted channel instance by name.
     */
    encryptedPrivateChannel(name) {
        if (!this.channels['private-encrypted-' + name]) {
            this.channels['private-encrypted-' + name] = new PusherEncryptedPrivateChannel(this.pusher, 'private-encrypted-' + name, this.options);
        }
        return this.channels['private-encrypted-' + name];
    }
    /**
     * Get a presence channel instance by name.
     */
    presenceChannel(name) {
        if (!this.channels['presence-' + name]) {
            this.channels['presence-' + name] = new PusherPresenceChannel(this.pusher, 'presence-' + name, this.options);
        }
        return this.channels['presence-' + name];
    }
    /**
     * Leave the given channel, as well as its private and presence variants.
     */
    leave(name) {
        let channels = [name, 'private-' + name, 'presence-' + name];
        channels.forEach((name, index) => {
            this.leaveChannel(name);
        });
    }
    /**
     * Leave the given channel.
     */
    leaveChannel(name) {
        if (this.channels[name]) {
            this.channels[name].unsubscribe();
            delete this.channels[name];
        }
    }
    /**
     * Get the socket ID for the connection.
     */
    socketId() {
        return this.pusher.connection.socket_id;
    }
    /**
     * Disconnect Pusher connection.
     */
    disconnect() {
        this.pusher.disconnect();
    }
}

/**
 * This class creates a connnector to a Socket.io server.
 */
class SocketIoConnector extends Connector {
    constructor() {
        super(...arguments);
        /**
         * All of the subscribed channel names.
         */
        this.channels = {};
    }
    /**
     * Create a fresh Socket.io connection.
     */
    connect() {
        let io = this.getSocketIO();
        this.socket = io(this.options.host, this.options);
        return this.socket;
    }
    /**
     * Get socket.io module from global scope or options.
     */
    getSocketIO() {
        if (typeof this.options.client !== 'undefined') {
            return this.options.client;
        }
        if (typeof io !== 'undefined') {
            return io;
        }
        throw new Error('Socket.io client not found. Should be globally available or passed via options.client');
    }
    /**
     * Listen for an event on a channel instance.
     */
    listen(name, event, callback) {
        return this.channel(name).listen(event, callback);
    }
    /**
     * Get a channel instance by name.
     */
    channel(name) {
        if (!this.channels[name]) {
            this.channels[name] = new SocketIoChannel(this.socket, name, this.options);
        }
        return this.channels[name];
    }
    /**
     * Get a private channel instance by name.
     */
    privateChannel(name) {
        if (!this.channels['private-' + name]) {
            this.channels['private-' + name] = new SocketIoPrivateChannel(this.socket, 'private-' + name, this.options);
        }
        return this.channels['private-' + name];
    }
    /**
     * Get a presence channel instance by name.
     */
    presenceChannel(name) {
        if (!this.channels['presence-' + name]) {
            this.channels['presence-' + name] = new SocketIoPresenceChannel(this.socket, 'presence-' + name, this.options);
        }
        return this.channels['presence-' + name];
    }
    /**
     * Leave the given channel, as well as its private and presence variants.
     */
    leave(name) {
        let channels = [name, 'private-' + name, 'presence-' + name];
        channels.forEach(name => {
            this.leaveChannel(name);
        });
    }
    /**
     * Leave the given channel.
     */
    leaveChannel(name) {
        if (this.channels[name]) {
            this.channels[name].unsubscribe();
            delete this.channels[name];
        }
    }
    /**
     * Get the socket ID for the connection.
     */
    socketId() {
        return this.socket.id;
    }
    /**
     * Disconnect Socketio connection.
     */
    disconnect() {
        this.socket.disconnect();
    }
}

/**
 * This class creates a null connector.
 */
class NullConnector extends Connector {
    constructor() {
        super(...arguments);
        /**
         * All of the subscribed channel names.
         */
        this.channels = {};
    }
    /**
     * Create a fresh connection.
     */
    connect() {
        //
    }
    /**
     * Listen for an event on a channel instance.
     */
    listen(name, event, callback) {
        return new NullChannel();
    }
    /**
     * Get a channel instance by name.
     */
    channel(name) {
        return new NullChannel();
    }
    /**
     * Get a private channel instance by name.
     */
    privateChannel(name) {
        return new NullPrivateChannel();
    }
    /**
     * Get a presence channel instance by name.
     */
    presenceChannel(name) {
        return new NullPresenceChannel();
    }
    /**
     * Leave the given channel, as well as its private and presence variants.
     */
    leave(name) {
        //
    }
    /**
     * Leave the given channel.
     */
    leaveChannel(name) {
        //
    }
    /**
     * Get the socket ID for the connection.
     */
    socketId() {
        return 'fake-socket-id';
    }
    /**
     * Disconnect the connection.
     */
    disconnect() {
        //
    }
}

/**
 * This class is the primary API for interacting with broadcasting.
 */
class Echo {
    /**
     * Create a new class instance.
     */
    constructor(options) {
        this.options = options;
        this.connect();
        if (!this.options.withoutInterceptors) {
            this.registerInterceptors();
        }
    }
    /**
     * Get a channel instance by name.
     */
    channel(channel) {
        return this.connector.channel(channel);
    }
    /**
     * Create a new connection.
     */
    connect() {
        if (this.options.broadcaster == 'pusher') {
            this.connector = new PusherConnector(this.options);
        }
        else if (this.options.broadcaster == 'socket.io') {
            this.connector = new SocketIoConnector(this.options);
        }
        else if (this.options.broadcaster == 'null') {
            this.connector = new NullConnector(this.options);
        }
        else if (typeof this.options.broadcaster == 'function') {
            this.connector = new this.options.broadcaster(this.options);
        }
    }
    /**
     * Disconnect from the Echo server.
     */
    disconnect() {
        this.connector.disconnect();
    }
    /**
     * Get a presence channel instance by name.
     */
    join(channel) {
        return this.connector.presenceChannel(channel);
    }
    /**
     * Leave the given channel, as well as its private and presence variants.
     */
    leave(channel) {
        this.connector.leave(channel);
    }
    /**
     * Leave the given channel.
     */
    leaveChannel(channel) {
        this.connector.leaveChannel(channel);
    }
    /**
     * Listen for an event on a channel instance.
     */
    listen(channel, event, callback) {
        return this.connector.listen(channel, event, callback);
    }
    /**
     * Get a private channel instance by name.
     */
    private(channel) {
        return this.connector.privateChannel(channel);
    }
    /**
     * Get a private encrypted channel instance by name.
     */
    encryptedPrivate(channel) {
        return this.connector.encryptedPrivateChannel(channel);
    }
    /**
     * Get the Socket ID for the connection.
     */
    socketId() {
        return this.connector.socketId();
    }
    /**
     * Register 3rd party request interceptiors. These are used to automatically
     * send a connections socket id to a Laravel app with a X-Socket-Id header.
     */
    registerInterceptors() {
        if (typeof Vue === 'function' && Vue.http) {
            this.registerVueRequestInterceptor();
        }
        if (typeof axios === 'function') {
            this.registerAxiosRequestInterceptor();
        }
        if (typeof jQuery === 'function') {
            this.registerjQueryAjaxSetup();
        }
    }
    /**
     * Register a Vue HTTP interceptor to add the X-Socket-ID header.
     */
    registerVueRequestInterceptor() {
        Vue.http.interceptors.push((request, next) => {
            if (this.socketId()) {
                request.headers.set('X-Socket-ID', this.socketId());
            }
            next();
        });
    }
    /**
     * Register an Axios HTTP interceptor to add the X-Socket-ID header.
     */
    registerAxiosRequestInterceptor() {
        axios.interceptors.request.use((config) => {
            if (this.socketId()) {
                config.headers['X-Socket-Id'] = this.socketId();
            }
            return config;
        });
    }
    /**
     * Register jQuery AjaxPrefilter to add the X-Socket-ID header.
     */
    registerjQueryAjaxSetup() {
        if (typeof jQuery.ajax != 'undefined') {
            jQuery.ajaxPrefilter((options, originalOptions, xhr) => {
                if (this.socketId()) {
                    xhr.setRequestHeader('X-Socket-Id', this.socketId());
                }
            });
        }
    }
}

/* harmony default export */ __webpack_exports__["default"] = (Echo);


/***/ }),

/***/ "./resources/assets/js/laravel-echo-setup.js":
/*!***************************************************!*\
  !*** ./resources/assets/js/laravel-echo-setup.js ***!
  \***************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var laravel_echo__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! laravel-echo */ "./node_modules/laravel-echo/dist/echo.js");

window.Echo = new laravel_echo__WEBPACK_IMPORTED_MODULE_0__["default"]({
  broadcaster: 'socket.io',
  host: window.location.hostname + ":" + window.laravel_echo_port
});

/***/ }),

/***/ 1:
/*!*********************************************************!*\
  !*** multi ./resources/assets/js/laravel-echo-setup.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /opt/lampp/htdocs/pgh/pgh/resources/assets/js/laravel-echo-setup.js */"./resources/assets/js/laravel-echo-setup.js");


/***/ })

/******/ });