(function () {

    'use strict';

    angular
        .module('authApp')
        .controller('AuthController', function ($auth, $state) {

            var vm = this;

            vm.login = function () {

                var credentials = {
                    email: vm.email,
                    password: vm.password
                };

                $auth.login(credentials).then(function (data) {
                    $state.go('home', {});
                }, function (error) {
                    vm.error = error.statusText;
                });

            };

            vm.signup = function () {

                var credentials = {
                    name: vm.name,
                    email: vm.email,
                    password: vm.password
                };

                $auth.signup(credentials).then(function (data) {
                    $state.go('home', {});
                }, function (error) {
                    vm.error = error.statusText;
                });

            }

        });

})();