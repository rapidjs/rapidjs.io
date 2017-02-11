import stackTrace from 'stack-trace';
import Logger from './Logger';
import qs from 'qs';

export default class {
    constructor(caller) {
        this.caller = caller;
        this.data = {};
    }

    fakeRequest (type, url, data = {}, options) {
        let trace  = stackTrace.get(),
            length = trace.length,
            lastTrace = trace[length - 2],
            params = this.caller.parseRequestParams(type, data, options),
            lastUrl = this.setLastUrl(type, url, ...params);

        this.setLastRequest(...arguments);

        Logger.debug(`${this.caller.modelName}.${lastTrace.getFunctionName()} made a ${type} request (${lastUrl})`);
        Logger.log(params);

        return lastUrl;
    }

    setLastUrl(type, url, params = {}) {
        let lastUrl = '';

        if(['put', 'post', 'patch'].includes(type)) {
            lastUrl = this.caller.sanitizeUrl([this.caller.baseURL, url].join('/')) + '?'+ qs.stringify(params);
        } else {
            let urlParams = params.params,
                stringified = urlParams ? '?' + qs.stringify(urlParams) : '';

            lastUrl = this.caller.sanitizeUrl([this.caller.baseURL, url].join('/')) + stringified;
        }

        lastUrl = this.caller.sanitizeUrl(lastUrl);

        this.data.lastUrl = lastUrl;

        return lastUrl;
    }

    setLastRequest (type, url, data = {}, options = {}) {
        this.data.lastRequest = {
            type,
            url,
            data,
            options
        };
    }
}