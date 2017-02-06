class Logger {
    constructor (prefix) {
        this.prefix = prefix;
    }

    debug (message) {
        console.info(`[${this.prefix}]: ${message}`);
    }

    log (message) {
        console.log(`[${this.prefix}]:`, message);
    }

    warn (message) {
        console.warn(`[${this.prefix} warn]:`, message);
    }
}

export default new Logger('rapid js');
