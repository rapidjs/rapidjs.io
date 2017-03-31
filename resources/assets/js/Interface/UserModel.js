import Auth from './Rapid/Models/Auth';

export default new Auth({
    modelName: 'user',
    debug: true,
    auth: {
        // modelPrefix: true
        routes: {
            auth: 'authenticate'
        }
    }
});
