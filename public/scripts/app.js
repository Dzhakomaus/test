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
                    templateUrl: '../views/auth/authView.html',
                    controller: 'AuthController as auth'
                })
                .state('home', {
                    url: '/home',
                    templateUrl: '../views/homeView.html',
                    controller: 'HomeController as home'
                })
                .state('homeId', {
                    url: '/home/{id}',
                    templateUrl: '../views/homeView.html',
                    controller: 'HomeController as home'
                })
                .state('myMessage', {
                    url: '/profil/mymessage',
                    templateUrl: '../views/profile/myMessagesView.html',
                    controller: 'ProfileController as profile'
                })
                .state('signup', {
                    url: '/signup',
                    templateUrl: '../views/auth/signupView.html',
                    controller: 'AuthController as auth'
                });
        });
})();