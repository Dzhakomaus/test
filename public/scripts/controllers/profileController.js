(function () {

    'use strict';

    angular
        .module('authApp')
        .controller('ProfileController', function ($scope, $auth, $state, MessageService) {

            var vm = this;

            vm.getUserMessage = function () {
                MessageService.getUserMessage().then(function (response) {
                    vm.mess = response;
                }, function (error) {
                    $scope.error = error;
                });
            };

            vm.logout = function () {
                $auth.logout(function () {
                    $state.go('auth', {});
                });
            };

            vm.getUserMessage();
        });

})();