(function() {

    'use strict';

    angular
        .module('authApp', ['ui.router', 'satellizer'])
        .config(function($stateProvider, $urlRouterProvider, $authProvider) {

            $authProvider.loginUrl = '/api/authenticate';
            $authProvider.signupUrl = '/api/signup';

            $urlRouterProvider.otherwise('/auth');

            $stateProvider
                .state('auth', {
                    url: '/auth',
                    templateUrl: '../views/authView.html',
                    controller: 'AuthController as auth'
                })
                .state('home', {
                    url: '/home',
                    templateUrl: '../views/homeView.html',
                    controller: 'HomeController as home'
                });
        });
})();