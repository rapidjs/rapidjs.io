@include('components.heading', ['type' => 'h2', 'name' => 'custom-routes', 'title' => 'Custom Routes'])

<p>Routes</p>

@component('components.code')

const customRoutes = [
    {
        name: 'web_get_user_preferences',
        type: 'get',
        url: '/user/preferences',
    },

    {
        name: 'web_save_user_preferences',
        type: 'post',
        url: '/user/{id}/save/preferences'
    }
];

const router = new Rapid({ customRoutes, baseURL: '/api' });

router.route('web_get_user_preferences').then(); 
// GET => /api/user/preferences

router.route('web_save_user_preferences', { id: 1 }, { remeber: true }).then(); 
// POST => /api/user/1/save/preferences

@endcomponent
