(function () {

    'use strict';

    angular
        .module('authApp')
        .controller('HomeController', function ($scope, $stateParams, $auth, $state, $http, MessageService) {
            var vm = this;

            vm.getMessages = function (page) {
                MessageService.getMessages(page).then(function (response) {
                    vm.mess = response.data;
                }, function (error) {
                    vm.error = error;
                });
            };

            vm.sendMessage = function () {
                MessageService.sendMessage(vm.text).then(function (response) {
                    vm.mess = response.data;
                    vm.text = "";
                }, function (error) {
                    $scope.error = error;
                });
            };

            vm.filterMessage = function () {
                MessageService.filterMessages(vm.filterText).then(function (response) {
                    vm.mess = response;
                }, function (error) {
                    $scope.error = error;
                });
            };

            vm.getNumber = function (num) {
                return new Array(num);
            };

            vm.getMessages(1);

        });

})();